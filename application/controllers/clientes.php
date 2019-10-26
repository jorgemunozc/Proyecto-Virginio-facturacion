<?php
    defined('BASEPATH') OR exit('No permitido acceso directo al script.');
    class Clientes extends CI_Controller {
        public $title = 'Clientes';
        
        public function __construct()
        {
            parent::__construct();
            if(!is_logged_in()){
                redirect('login');
            }
        }
        
        public function index()
        {
            $this->load->view('dashboard');
            $this->_listar_clientes();
        }

        public function _listar_clientes()
        {
            $this->load->model('cliente_model');
            $data['clientes'] = $this->cliente_model->obtener_clientes();
            $this->load->view('cliente/lista_cliente_view', $data);
        }

        public function edit($rut)
        {
            $this->title = "Clientes | Editar Cliente";
            $this->load->view('dashboard');
            $data['mode'] = 'edit';
            //Cargamos modelo para obtener info del rut solicitado en BD
            $this->load->model('cliente_model');
            // $this->_listar_clientes();
            $cliente = $this->cliente_model->obtener_info('rut', $rut);
            $data['cliente'] = $cliente[0];
            //Pasamos datos cliente para procesamiento en formulario
            $this->load->view('cliente/cliente_form_view', $data);
            $this->load->view('cliente/scripts');
        }

        public function new()
        {
            $this->title = "Clientes | Nuevo Cliente";
            $this->load->view('dashboard');
            $data['mode'] = 'new';
            $this->load->view('cliente/cliente_form_view', $data);
            $this->load->view('cliente/scripts');
        }

        public function agregar_cliente()
        {
            $this->load->model('cliente_model');
            if(is_array($this->input->post()) && count($this->input->post()) == 6)
            {
                foreach($this->input->post(NULL, TRUE) as $campo => $valor)
                {
                    $this->cliente_model->_set($campo, $valor);
                }
                if($this->cliente_model->insertar_cliente()) 
                {
                    
                    $data['status'] = 'success';
                    $data['msg'] = 'Ingresado correctamente';
                    echo json_encode($data);
                    return true;
                } else 
                {
                    
                    $data['status'] = 'error';
                    $data['msg'] = 'Rut ya existe.';
                    echo json_encode($data);
                    return false;
                }
            }
            $data['status'] = 'error';
            $data['msg'] = 'Faltan campos para enviar o no fue mandado con el formato correcto';
            echo json_encode($data);
            return false;
        }

        /*Funcion busca todos los servicios contratados
        /*a partir del rut de cliente dado a la funcion
        */
        public function servicios($rut)
        {
            $this->load->model('cliente_model');
            $cliente = $this->cliente_model->obtener_info('rut', $rut);
            
        }

        public function actualizar_datos_cliente()
        {
            if($this->input->post())
            {
                $this->load->model('cliente_model');
                $array_campos = array('rut', 'razon_social', 'direccion', 'giro', 'comuna', 'rango_cobros');
                foreach($array_campos as $campo)
                {
                    $this->cliente_model->_set($campo, $this->input->post($campo, true));
                }
                try 
                {
                    $this->cliente_model->actualizar_cliente($this->input->post('old-rut', true));
                    $data['rut'] = $this->cliente_model->_get('rut');
                    $data['status'] = 'success';
                    $data['msg'] = 'Actualizado correctamente';
                    echo json_encode($data);
                    return true;
                } catch (Exception $e) 
                {
                    $data['status'] = 'error';
                    $data['msg'] = 'No se pudo actualizar cliente';
                    echo json_encode($data);
                    return false;
                }
            }
        }
    }
?>