<?php
    defined('BASEPATH') OR exit('No permitido acceso directo al script.');
    class Login extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->model('login_model');
        }

        public function index()
        {
            $this->form_validation->set_rules('username', 'Nombre', 'trim|required');
            $this->form_validation->set_rules('password', 'Contraseña', 'required|callback_verifica');
            if($this->form_validation->run() == false)
            {
                $this->load->view('login/login_form');
            }
            else
            {
                redirect('dashboard');
            }
        }

        public function verifica()
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if($this->login_model->login($username, $password))
            {
                redirect('dashboard');
            }
            else
            {
                $this->form_validation->set_message('verifica', 'Contrasena y/o usuarios incorrectos.');
                redirect('login');
            }
        }

        function logout()
        {
            $this->session->sess_destroy();
            redirect(base_url());
        }
    }
?>