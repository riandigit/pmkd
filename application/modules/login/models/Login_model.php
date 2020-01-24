<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends MY_Model
{
	public function get_login($username, $password)
    {
        $this->db->select('mg.id as group_id, ms.*');
        $this->db->join('tbl_user_group mg', 'ms.user_group_id = mg.id');
        $this->db->where('ms.username', $username);
        $this->db->where('ms.status = 1 ');
        $this->db->limit(1);
        $q   = $this->db->get('tbl_user ms');
        $res ='failed';

        if ($q->num_rows() > 0) {
            $user = $q->row();

            if ($this->bcrypt->check_password(strtoupper(md5($password)), $user->password))
             {
                $this->db->select('*');
                $this->db->limit(1);                

                // pengecekan apakah dia punya hak akses
               $session = array(
                        'logged_in'    => 1,
                        'id'           => $user->id,
                        'group_id'     => $user->group_id,
                        'firstname'    => $user->first_name,
                        'lastname'     => $user->last_name,
                        'username'     => $user->username,
                        'operator_cs_id'  => $user->operator_cs_id,
                    );

                    $this->session->set_userdata($session);

                    $message['success'] = 'Login success. ';
                    echo json_encode($message);
                }
            else 
            {
                $message['error'] = 'Username Atau Password Tidak Cocok. ';
                echo json_encode($message);
            }
        } 
        else 
        {
            $message['error'] = 'Username Atau Password  Cocok. ';
            echo json_encode($message);
        }
        
    }

    public function check_user($username)
    {
        $this->db->select('mg.id as group_id, ms.*');
        $this->db->join('tbl_user_group mg', 'ms.user_group_id = mg.id');
        $this->db->where('ms.username', $username);
        $this->db->where('ms.status = 1 ');
        $this->db->limit(1);

        return $this->db->get('tbl_user ms');      
    }

}