<?php
if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );


if ( ! function_exists("generate_menu") ) {

    function generate_menu($arr, $menu_order) {
        $CI =& get_instance();

        if ($menu_order == 0) {
            $html = "\n<ul class='page-sidebar-menu  page-header-fixed page-sidebar-menu-light ' data-keep-expanded='false' data-auto-scroll='true' data-slide-speed='200'>
                            <li class='sidebar-toggler-wrapper hide'>
                                <div class='sidebar-toggler'>
                                    <span></span>
                                </div>
                            </li>\n";
        } else {
            $html = "\n<ul class='sub-menu' >\n";
        }

        $slug = '';

        if ($CI->uri->segment(1) && !$CI->uri->segment(2))
        {
        	$slug = $CI->uri->segment(1);
        }
        elseif ($CI->uri->segment(1) && $CI->uri->segment(2))
        {
        	$slug = $CI->uri->segment(1).'/'.$CI->uri->segment(2);
        }

        foreach ($arr as $key => $v)
        {
            if (array_key_exists('children', $v))
            {
                $parent_segment = menu_parent($slug);
                $parent_active  = $parent_segment == $v['id'] ? 'start active' : ''; // jika parent id sama dengan id menu, maka menu parent aktif

                $html .= "<li class='nav-item ".$parent_active."'>\n"; // Parent
                $html .= '
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="' . $v['icon'] . '"></i>
                            <span class="title">' . $v['name'] . '</span>
                            <span class="selected"></span>
                            <span class="arrow"></span>
                        </a>
                ';

                $html .= generate_menu($v['children'], 1);
                $html .= "</li>\n";
            } else {
                $child_segment = $slug; // uri segment
                $child_active  = $v['slug'] == $child_segment ? 'start active open' : ''; // jika link sama dengan uri segment, menu aktif
                $html .= '<li class="nav-item '.$child_active.'"><a href="' . site_url($v['slug']) . '">';
                if ($menu_order == 0) {
                    $html .= '<i class="' . $v['icon'] . '"></i>';
                }
                if ($menu_order == 1) {
                    $html .= '<i class="fa fa-angle-double-right"></i>';
                }
                $html .= "<span class='title'> ". $v['name'] . "</span><span class='selected'></span></a></li>\n";
            }
        }
        $html .= "</ul>\n";
        return $html;
    }

}

if ( ! function_exists("list_menu") ) {

    function list_menu() {
        $CI =& get_instance();

        $list_privilege = menu_privilege();

        if($list_privilege){
             $sql = "
                SELECT *
                FROM core.t_mtr_menu
                WHERE
                    id IN ({$list_privilege})
                AND
                    status = 1
                ORDER BY number
            ";
            $q  = $CI->db->query($sql)->result_array();

            $refs = array();
            $list = array();

            foreach($q as $row) {
                $thisref =& $refs[$row['id']];

                $thisref['id']     = $row['id'];
                $thisref['parent'] = $row['parent'];
                $thisref['name']   = $row['name'];
                $thisref['slug']   = $row['slug'];
                $thisref['icon']   = $row['icon'];

                if ($row['parent'] == 0) {
                    $list[$row['id']] =& $thisref;
                } else {
                    $refs[$row['parent']]['children'][$row['id']] =& $thisref;
                }
            }

            return generate_menu($list, 0);
        }else{
            return false;
        }       
    }

}

if ( ! function_exists("menu_privilege") ) {
    function menu_privilege() {
        $CI =& get_instance();
		$CI->load->library('session');

        $group_id = $CI->session->userdata('group_id');       
		$sql1     = "
			SELECT
				mpd.menu_id
			FROM
				core.t_mtr_privilege mp
			JOIN core.t_mtr_privilege_detail mpd ON mp.id = mpd.privilege_id
			WHERE
				mp.group_id IN ('{$group_id}') AND view = 't'
			AND
				mp.status = 1
		";
		$groups   = $CI->db->query($sql1)->result();
        if(count($groups)>0){
          
            $arr_menu = array();
            foreach($groups as $group) {
                $arr_menu[] = $group->menu_id;
            }

            $str_menu = "'".implode("','",$arr_menu)."'";

            return $str_menu;  
        }
        else{
             // redirect('error_401');
            return false;
        }


        
    }
}

if (! function_exists('menu_parent')) {
	function menu_parent($slug) {
		$CI =& get_instance();

		$sql = "SELECT parent from core.t_mtr_menu WHERE slug = '{$slug}'";
        // $sql = "select tmm.parent from core.t_mtr_menu tm
        //         join core.t_mtr_menu tmm on tm.id = tmm.parent
        //         where tmm.slug = '{$slug}'";
		$q   = $CI->db->query($sql);

		if ($q->num_rows() > 0) {
			return $q->row()->parent;
		} else {
			return array();
		}
	}
}

// Generate button sesuai dengan privilege
if (! function_exists('generate_button') ) {
	function generate_button($slug, $action, $button) {
		$CI =& get_instance();
		$CI->load->library('session');

        $group_id = $CI->session->userdata('group_id');

		
        $sql="SELECT cc.id, cc.parent_id, cc.name, icon, slug, cc.order FROM
            tbl_privilege aa
        JOIN tbl_user_group bb ON bb.id = aa.user_group_id AND bb.status = 1 AND bb.id = {$group_id}
        JOIN tbl_menu_web cc ON cc.id = aa.menu_id AND cc.status = 1
        JOIN tbl_menu_detail dd ON dd.id = aa.menu_detail_id AND dd.status = 1
        JOIN tbl_action ee ON ee.id = dd.action_id AND ee.status = 1 AND LOWER(ee.action_name) = '{$action}'
        WHERE aa.status = 1 and slug='{$slug}' ORDER BY cc.order ASC";

		$q = $CI->db->query($sql)->num_rows();

        if($q<1)
        {
            // return '&ensp';
            return '';
        }
        else
        {
            return $button;
        }


	}
}

/* robai */
if (!function_exists('generate_button_new')) {
    function generate_button_new($slug, $action, $url,$status = null) {
        $CI      =& get_instance();
        $user_id = $CI->session->userdata('id');
        $button  = '';
        $access  = checkBtnAccess($slug,$action);

        if($access){
            if(strtolower($action) == 'add'){
                $button = '<button onclick="showModal(\''.$url.'\')" class="btn btn-sm btn-add" title="Add Data" '.$status.'><i class="fa fa-plus"></i> ADD DATA</button> ';
            }

            if(strtolower($action) == 'import_excel'){
                $button = '<button onclick="showModal(\''.$url.'\')" class="btn btn-sm btn-warning" title="Import Data"><i class="fa fa-plus"></i> Import Data</button>';
            }

            elseif(strtolower($action) == 'edit'){
                $button = '<button onclick="showModal(\''.$url.'\')" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-pencil"></i></button> ';
            }

            elseif(strtolower($action) == 'delete'){
                $button = '<button class="btn btn-sm btn-danger" onclick="confirmationAction(\'Are you sure want to delete ?\', \''.$url.'\')" title="Delete"> <i class="fa fa-trash-o"></i> </button>';
            }

            elseif(strtolower($action) == 'change_status'){
                $button = '<button class="btn btn-sm btn-primary" onclick="confirmationAction(\'Apakah Anda yakin mengganti status data ini ?\', \''.$url.'\')" title="Ganti Status"> <i class="fa fa-exchange"></i> </button>';
            }

            elseif(strtolower($action) == 'detail'){
                $button = '<button onclick="showModal(\''.$url.'\')" class="btn btn-sm btn-primary" title="detail"><i class="fa fa-search-plus"></i></button> ';
            }

            elseif(strtolower($action) == 'approval'){
                $button = '<button class="btn btn-sm btn-success" onclick="confirmationAction(\'Apakah Anda yakin akan menyetujui data ini ?\', \''.$url.'\')" title="Approve"> <i class="fa fa-check"></i> </button>';
            }

            elseif(strtolower($action) == 'open_boarding'){
                $button = '<button class="btn btn-sm btn-warning" onclick="confirmationAction(\'Apakah Anda yakin ingin OPEN BOARDING ?\', \''.$url.'\')" title="Open Boarding">Open Boarding</button> ';
            }

            elseif(strtolower($action) == 'close_boarding'){
                $button = '<button class="btn btn-sm btn-primary" onclick="confirmationAction(\'Apakah Anda yakin ingin CLOSE BOARDING ?\', \''.$url.'\')" title="Close Boarding">Close Boarding</button>';
            }

            elseif(strtolower($action) == 'sailing_ship'){
                $button = '<button class="btn btn-sm btn-primary" onclick="confirmationAction(\'Apakah Anda yakin ingin BERANGKATKAN KAPAL ?\', \''.$url.'\')" title="Siap Berangkat">Siap Berangkat</button>';
            }

            elseif(strtolower($action) == 'close_balance'){
                $button = '<button class="btn btn-sm btn-danger" onclick="confirmationAction(\'Apakah Anda yakin close balance data ini ?\', \''.$url.'\')" title="close Balance"> <i class="fa fa-close"></i> </button>';
            }

            elseif(strtolower($action) == 'download_pdf'){
                $button = '<a target="_blank" href="'.$url.'" class="btn btn-default" title="PDF"> <i class="fa fa-file-pdf-o" style="color: #ea5460"></i> </a>';
            }

            elseif(strtolower($action) == 'download_excel'){
                $button = '<a target="_blank" href="'.$url.'" class="btn btn-default" title="EXCEL"> <i class="fa fa-file-excel-o" style="color: #ea5460"></i> </a>';
            }

            elseif(strtolower($action) == 'download_excel'){
                $button = '<a target="_blank" data-href="'.$url.'" class="btn btn-sm green-jungle btn-download-excel" title="Download Excel" style="display:none"> <i class="fa fa-download"></i> *.xlsx</a>';
            }

        }
        return $button;
    }
}

if (!function_exists('generate_button_download')) {
    function generate_button_download($slug, $action, $url) {
        $CI      =& get_instance();
        $user_id = $CI->session->userdata('id');
        $button  = '';
        $access  = checkBtnAccess($slug,$action);

        if($access){
            if(strtolower($action) == 'download_pdf'){
                $button = '<a target="_blank" data-href="'.$url.'" class="btn btn-sm btn-danger btn-download btn-download-pdf" title="Download PDF" style="display:none"> <i class="fa fa-download"></i> *.pdf</a>';
            }

            elseif(strtolower($action) == 'download_excel'){
                $button = '<a target="_blank" data-href="'.$url.'" class="btn btn-sm green-jungle btn-download btn-download-excel" title="Download Excel" style="display:none"> <i class="fa fa-download"></i> *.xlsx</a>';
            }

        }
        return $button;
    }
}

if(!function_exists('getMenu')){
    function getMenu($action='view'){
        $CI =& get_instance();
        $group_id = $CI->session->userdata('group_id');

        $data = array();

        $sql = "SELECT cc.id, cc.parent_id, cc.name, icon, slug, cc.order FROM
            tbl_privilege aa
        JOIN tbl_user_group bb ON bb.id = aa.user_group_id AND bb.status = 1 AND bb.id = $group_id
        JOIN tbl_menu_web cc ON cc.id = aa.menu_id AND cc.status = 1
        JOIN tbl_menu_detail dd ON dd.id = aa.menu_detail_id AND dd.status = 1
        JOIN tbl_action ee ON ee.id = dd.action_id AND ee.status = 1 AND LOWER(ee.action_name) = '{$action}'
        WHERE aa.status = 1 ORDER BY cc.order ASC";

        $query = $CI->db->query($sql)->result();

        foreach ($query as $row) {
            // $row->action = checkAction($group_id,$row->id);
            $data[$row->parent_id][] = $row;
        }

        return $data;
    }
}

if(!function_exists('checkAction')){
    function checkAction($menu_id){
        $CI =& get_instance();
        $group_id = $CI->session->userdata('group_id');
        $data = array();

        $sql = "SELECT ee.action_name FROM tbl_privilege aa
            JOIN tbl_user_group bb ON aa.user_group_id = bb.id AND bb.status = 1 AND bb.id = $group_id
            JOIN tbl_menu_web cc ON aa.menu_id = cc.id AND cc.status = 1 AND cc.id = $menu_id
            JOIN tbl_menu_detail dd ON aa.menu_detail_id = dd.id AND dd.status = 1
            JOIN tbl_action ee ON ee.id = dd.action_id AND ee.status = 1
            WHERE aa.status = 1 ORDER BY cc.order ASC";

        $query = $CI->db->query($sql)->result();

        foreach ($query as $row) {
            $data[] = $row->action_name;
        }

        return $data;
    }
}

if(!function_exists('listMenu')){
    function listMenu($parent = 0){
        $CI   =& get_instance();
        $data = getMenu();
        $uri  = uri_string();

        if (isset($data[$parent])) {
            if($parent == 0){
                $html = '<ul class="page-sidebar-menu page-header-fixed page-sidebar-menu-light " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">';
                $html .= '<li class="heading"><h3 class="uppercase">Menu</h3></li>';
            }else{
                $html = '<ul class="sub-menu" style="padding-bottom:20px">';
            }


            foreach ($data[$parent] as $v) {
                $child  = listMenu($v->id);
                $active = '';
                $start  = "start active open";

                if($v->slug == null || $v->slug == '' || $v->slug == '#'){
                    $link = '#';
                }else{
                    $link = site_url().$v->slug;
                }

                if($v->slug == uri_string()){
                    $active = $start;
                }elseif($v->slug == $CI->uri->segment(1)){
                    $active = $start;
                }elseif($v->slug == $CI->uri->segment(1).'/'.$CI->uri->segment(2)){
                    $active = $start;
                }

                $rpc = str_replace('/', '_', $v->slug);
                if($child){
                    $html .= '<li class="nav-item">';
                    $html .= '<a href="javascript:;" class="nav-link nav-toggle">';
                    $html .= '<i class="fa fa-'.$v->icon.'"></i>';
                    $html .= '<span class="title">'.$v->name.'</span>';
                    $html .= '<span class="selected"></span>';
                    $html .= '<span class="arrow"></span>';
                    $html .= '</a>';
                }else{
                    $html .= '<li class="nav-item"><a href="'.$link.'"><i class="fa fa-'.$v->icon.'"></i><span class="title"> '.$v->name.'</span></a></li>';
                }

                if($child){
                    $html .= $child;
                }
                $html .= '</li>';
            }

            $html .= "</ul>";
            return $html;
        }else{
            return false;
        }
    }
}

if(!function_exists('checkUrlAccess')){
    function checkUrlAccess($current_url,$action){
        $CI =& get_instance();
        $group_id = $CI->session->userdata('group_id');

        $data = array();

        $sql = "SELECT cc.id, cc.parent_id, cc.name, icon, slug, cc.order FROM
            tbl_privilege aa
        JOIN tbl_user_group bb ON bb.id = aa.user_group_id AND bb.status = 1 AND bb.id = $group_id
        JOIN tbl_menu_web cc ON cc.id = aa.menu_id AND cc.status = 1 AND slug = '$current_url'
        JOIN tbl_menu_detail dd ON dd.id = aa.menu_detail_id AND dd.status = 1
        JOIN tbl_action ee ON ee.id = dd.action_id AND ee.status = 1 AND LOWER(ee.action_name) = '{$action}'
        WHERE aa.status = 1 ORDER BY cc.order ASC";

        if($CI->db->query($sql)->result()){
            return true;
        }else{
            redirect('error_401');
        }

        // $CI     =& get_instance();
        // $session= $CI->session->userdata('app_session');
        // $menu   = getMenu($action);
        // $link   = array();

        // foreach ($menu as $key => $val) {
        //     $data = array_filter($menu[$key], function ($item) {
        //         if ($item->slug == '#' || $item->slug == '') return false;
        //         return true; 
        //     });

        //     foreach ($data as $k => $v) {
        //         $link[$v->slug] = $v->slug;
        //     }
        // }

        // if(isset($link[''.$current_url.''])){
        //     return true;
        // }else{
        //     redirect('error_401');
        // }
    }
}

if(!function_exists('checkBtnAccess')){
    function checkBtnAccess($current_url,$action){
        // $CI     =& get_instance();
        // $session= $CI->session->userdata('app_session');
        // $menu   = getMenu($action);
        // $link   = array();

        // foreach ($menu as $key => $val) {
        //     $data = array_filter($menu[$key], function ($item) {
        //         if ($item->slug == '#' || $item->slug == '') return false;
        //         return true; 
        //     });

        //     foreach ($data as $k => $v) {
        //         $link[$v->slug] = $v->slug;
        //     }
        // }

        $CI =& get_instance();
        $group_id = $CI->session->userdata('group_id');

        $data = array();

        $sql = "SELECT cc.id, cc.parent_id, cc.name, icon, slug, cc.order FROM
            tbl_privilege aa
        JOIN tbl_user_group bb ON bb.id = aa.user_group_id AND bb.status = 1 AND bb.id = $group_id
        JOIN tbl_menu_web cc ON cc.id = aa.menu_id AND cc.status = 1 AND slug = '$current_url'
        JOIN tbl_menu_detail dd ON dd.id = aa.menu_detail_id AND dd.status = 1
        JOIN tbl_action ee ON ee.id = dd.action_id AND ee.status = 1 AND LOWER(ee.action_name) = '{$action}'
        WHERE aa.status = 1 ORDER BY cc.order ASC";

        if($CI->db->query($sql)->result()){
            return true;
        }else{
            return false;
        }
    }
}

