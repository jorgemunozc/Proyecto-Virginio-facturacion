<?php
    defined('BASEPATH') OR exit('No permitido acceso directo al script.');
    class Dashboard extends CI_Controller{
        public $title = 'Administración de Servicios:
        Central de Simulación Virginio Gómez';

        public function __construct(){
            parent::__construct();
            if(!is_logged_in()){
                redirect('login');
            }
        }
        public function index(){
            $data['nombre'] = $this->session->userdata('user_data')['username'];
            $this->load->view('dashboard');
            $this->load->view('bienvenido', $data);
        }
    }
?>