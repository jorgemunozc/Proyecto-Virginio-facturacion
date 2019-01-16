<?php
    class Login_model extends CI_Model {
        public function login($username, $password)
        {
            $this->db->where('username', $username);
            $query = $this->db->get('admin');
            if($query->num_rows() == 1)
            {
                $row = $query->row();
                if(password_verify($password, $row->password))
                {
                    $data = array('user_data' => array(
                        'username' => $row->username,
                        'id' => $row->id,
                        'password' => $row->password)
                    );
                    $this->session->set_userdata($data);
                    return true;
                }
            }
            $this->session->unset_userdata('user_data');
            return false;
        }
    }
?>