<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );



class Menu extends MY_Controller {

	public function __construct() {
		parent::__construct();

    logged_in();

    $this->load->model('menu_model');
    $this->_table    = 'tbl_menu_web';
    $this->_username = $this->session->userdata('username');
    $this->_module   = 'configuration/menu';
  }

  function index() {
    checkUrlAccess($this->_module,'view');
    $data = array(
      'home'      => 'Home',
      'url_home'  => site_url('home'),
      'parent'    => 'Configuration',
      'url_parent'=> '#',
      'title'     => 'Menu',
      'content'   => 'menu/index',
      'btn_add'   => generate_button_new($this->_module, 'add',  site_url($this->_module.'/add'))
    );

    $this->load->view ( 'default', $data );
  }

  function add(){   
    validate_ajax();
    $data['title']   = 'Tambah Menu';
    $data['icon']    = $this->dropdown_icon();
    $data['actions'] = $this->dropdown_action();
    $this->load->view($this->_module.'/add',$data);
  }

  function edit($param){   
    validate_ajax();
    $id = $this->enc->decode($param);
    $where       = array('menu_id' => $id);
    $menu_detail = $this->global_model->selectData('tbl_menu_detail', $where);

    $arr_detail = array();
    foreach ($menu_detail as $val) {
      $arr_detail[] = $val->action_id;
    }

    $data['title'] = 'Edit Menu';
    $data['id']    = $param;
    $data['icon']    = $this->dropdown_icon();
    $data['actions'] = $this->dropdown_action();
    $data['row']   = $this->global_model->selectById($this->_table, 'id', $id);
    $data['menuaction']= json_encode($arr_detail);
    
    $this->load->view($this->_module.'/edit',$data);
  }

  function action_add(){
    validate_ajax();
    $post = $this->input->post();

    /* validation */
    $this->form_validation
    ->set_rules('name', 'Nama Menu', 'trim|required')
    ->set_rules('menuAction', 'Aksi Menu', 'trim|required')
    ->set_rules('ordering', 'Order', 'trim|required');
    $this->form_validation->set_message('required','%s harus diisi!');

    $parent = $post['parent'] == '' ? 0 : $post['parent'];
    $link   = $post['link'] == '' ? '#' : $post['link'];

    /* data post */
    $data = array(
      'name' => $post['name'], 
      'icon' => $post['icon'],
      'order' => $post['ordering'],
      'slug' => $link,
      'parent_id' => $parent,
    );

    if($this->form_validation->run() == FALSE){
      $response = json_api(0,validation_errors());
    }else{
      /* check url */
      $checkMenuUrl = false;
      if($post['link'] != '#'){
        $where = array(
          'LOWER(slug)' => strtolower($post['link']),
        );

        $checkMenuUrl = $this->global_model->checkData($this->_table, $where);        
      }

      $checkOrder = $this->menu_model->checkOrder($parent,$post['ordering']);

      if($checkMenuUrl){
        $response = json_api(0,'Link '.$post['link'].' Sudah digunakan'); 
      }elseif($checkOrder){
        $response = json_api(0,'Order '.$post['ordering'].' Sudah digunakan'); 
      }else{
        $save = $this->global_model->saveData($this->_table, $data);
        if($save){
          $menu_detail = array();
          foreach ($post['actions'] as $val) {
            $menu_detail[] = array(
              'menu_id' => (int) $save, 
              'action_id' => $val, 
              'created_by' => $this->session->userdata('id'),
              'created_on' => date('Y-m-d H:i:s'),
            );
          }
          $this->db->insert_batch('tbl_menu_detail', $menu_detail);
          $response = json_api(1,'Simpan Data Berhasil');
        }else{
          $response = json_encode($this->db->error()); 
        }
      }   
    }

    $this->log_activitytxt->createLog($this->_username, uri_string(), 'ADD', json_encode($data), $response); 
    echo $response;   
  }

  function action_edit(){
    validate_ajax();
    $post = $this->input->post();

    /* validation */
    $this->form_validation
    ->set_rules('id', 'ID Menu', 'trim|required')
    ->set_rules('name', 'Nama Menu', 'trim|required')
    ->set_rules('menuAction', 'Aksi Menu', 'trim|required')
    ->set_rules('ordering', 'Order', 'trim|required');
    $this->form_validation->set_message('required','%s harus diisi!');

    $parent = $post['parent'] == '' ? 0 : $post['parent'];
    $link   = $post['link'] == '' ? '#' : $post['link'];
    $id     = $this->enc->decode($post['id']);

    /* data post */
    $data = array(
      'id' => $id, 
      'name' => $post['name'], 
      'icon' => $post['icon'],
      'order' => $post['ordering'],
      'slug' => $link,
      'parent_id' => $parent,
    );

    if($this->form_validation->run() == FALSE)
    {
      $response = json_api(0,validation_errors());
    }
    else
    {
      /* check url */
      $checkMenuUrl = false;
      if($post['link'] != '#' )
      {
        $where = array(
          'LOWER(slug)' => strtolower($post['link']),
        );

        $checkMenuUrl = $this->global_model->checkData($this->_table, $where, 'id', $id);        
      }

      $checkOrder = $this->menu_model->checkOrder($parent,$post['ordering'],$id);
      if($checkMenuUrl)
      {
        $response = json_api(0,'Link '.$post['link'].' Sudah digunakan'); 
      }
      elseif($checkOrder)
      {
        $response = json_api(0,'Order '.$post['ordering'].' Sudah digunakan'); 
      }
      else
      {
        $update = $this->global_model->updateData($this->_table, $data, 'id');
        if($update)
        {
          $list_detail= $this->menu_model->select_menu_detail($id);

          $arr_diff   = array_diff($list_detail, $post['actions']);
          if($arr_diff){
            $detail_id = array();

            foreach ($arr_diff as $key => $val) {
              $detail_id[] = $key;
            }
            $this->global_model->deleteDataMultiple('tbl_menu_detail','id',$detail_id);
            if($this->menu_model->select_menu_privilege($id,$detail_id))
            {
              $this->menu_model->deletePrivilege($id,$detail_id);
            }
          }

          $arr_diff2 = array_diff($post['actions'],$list_detail);

          if($arr_diff2){
            $menu_detail = array();
            foreach ($arr_diff2 as $val) {
              $menu_detail[] = array(
                'menu_id' => $id, 
                'action_id' => $val, 
                'created_by' => $this->session->userdata('id'),
                'created_on' => date('Y-m-d H:i:s'),
              );
            }
            $this->db->insert_batch('tbl_menu_detail', $menu_detail);
          }
          $response = json_api(1,'Update Data Berhasil');
        }else{
          $response = json_encode($this->db->error()); 
        }
      }  
    } 

    $this->log_activitytxt->createLog($this->_username, uri_string(), 'EDIT', json_encode($data), $response); 
    echo $response;   
  }

  function action_delete($param){
    validate_ajax();
    $id = $this->enc->decode($param);

    /* data */
    $data = array('id' => $id,'status' => -5);

    $query = $this->global_model->updateData($this->_table, $data, 'id');

    if($query)
    {
      $checkParent = $this->global_model->checkData($this->_table, array('parent_id' => $id));

      if($checkParent)
      {
        $data_parent = array('parent' => $id,'status' => -5);
        $this->global_model->updateData($this->_table, $data_parent, 'parent_id');
      }
      
      $response = json_api(1,'Delete Data Berhasil');
    }
    else
    {
      $response = json_encode($this->db->error()); 
    }

    $this->log_activitytxt->createLog($this->_username, uri_string(), 'delete', json_encode($data), $response); 
    echo $response;
  }

  function get_list(){
    validate_ajax();
    echo json_encode($this->menu_model->get_list());
  }

  function dropdown_action(){
    $datas = $this->global_model->selectAll('tbl_action');
    $data = array();
    foreach($datas as $row){
      $data[$row->id] = $row->action_name;
    }
    return $data;
  }

  function dropdown_icon(){
    $datas  = $this->global_model->selectAll('tbl_icon');
    $data   = array();
    if($datas){
      foreach($datas as $row){
        $data[$row->name] = $row->name;
      }
    }
    
    return $data;
  }
}
