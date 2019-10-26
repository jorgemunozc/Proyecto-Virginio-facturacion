<?php
    defined('BASEPATH') OR exit('No permitido acceso directo al script.');
    class Tarifas extends CI_Controller{
        public $title = 'Servicios Contratados';

        public function __construct()
        {
            parent::__construct();
            if(!is_logged_in()){
                redirect('login');
            }
        }

        public function index($rut){
            $this->info($rut);
        }
        
        public function info($rut)
        {
            $this->load->view('dashboard');
            $this->load->model('cliente_model');
            $data['rut'] = $rut;
            if($result = $this->cliente_model->obtener_info('rut', $rut))
            {
                $data['cliente'] = $result[0];
            }else
            {
                $data['cliente'] = "N/A";
            }
            $this->load->model('tarifa_model');
            $this->tarifa_model->_set('rut', $rut);
            $data['tarifas'] = $this->tarifa_model->listar_tarifas();
            $this->load->view('tarifa/info_empresa', $data);
            $this->load->view('tarifa/lista_tarifas', $data);
            $this->load->model('servicio_model');
            $data['servicios'] = $this->servicio_model->obtener_listado_campo('tipo_servicio');
            $this->load->view('tarifa/nueva_tarifa_form', $data);
            $this->load->view('tarifa/scripts');
        }

        public function guardar_tarifa()
        {
            if($this->input->post())
            {
                $rut = $this->input->post('rut', TRUE);
                $servicio = $this->input->post('servicio', TRUE);
                $monto_tarifa = $this->input->post('monto_tarifa', TRUE);
                $rango_cobros = $this->input->post('rango_cobros', TRUE);
                $this->load->model('tarifa_model');
                $this->tarifa_model->_set('rut', $rut);
                $this->tarifa_model->_set('tipo_servicio', $servicio);
                $this->tarifa_model->_set('monto_tarifa', $monto_tarifa);
                if ($rango_cobros != null)
                {
                    $this->tarifa_model->_set('rango_cobros', $rango_cobros);
                }
                if($this->tarifa_model->existe_tarifa())
                {
                    try {
                        if ($this->tarifa_model->actualizar_tarifa($monto_tarifa))
                        {
                            $data['status'] = 'success';
                            $data['msg'] = 'Tarifa actualizada';
                        } else
                        {
                            $data['status'] = 'error';
                            $data['msg'] = 'No se pudo actualizar';
                        }
                        echo json_encode($data);
                        return true;
                    } catch (Exception $e) 
                    {
                        $data['status'] = 'error';
                        $data['msg'] = $e.message;
                        json_encode($data);
                        return false;
                    }
                }else
                {
                    try 
                    {
                        $this->tarifa_model->insertar_tarifa();
                        $data['status'] = 'success';
                        $data['msg'] = 'Tarifa ingresada.';
                        echo json_encode($data);
                        return true;
                    } catch (Exception $e)
                    {
                        $data['status'] = 'error';
                        $data['msg'] = var_dump($e);
                        echo json_encode($data);
                        return false;
                    }
                }
            }
            $data['status'] = 'error';
            $data['msg'] = 'Variables no enviadas.';
            json_encode($data);
            return false;
        }

        public function eliminar_tarifa(){
            if($this->input->post())
            {
                $rut = $this->input->post('rut', true);
                $servicio = $this->input->post('tipo_servicio', true);
                $this->load->model('tarifa_model');
                $this->tarifa_model->_set('rut', $rut);
                $this->tarifa_model->_set('tipo_servicio', $servicio);
                if($this->tarifa_model->eliminar_tarifa());
                {
                    $data['status'] = 'success';
                    $data['msg'] = 'Tarifa eliminada.';
                    echo json_encode($data);
                    return;
                }
                $data['status'] = 'error';
                $data['msg'] = 'No se pudo eliminar tarifa';
                echo json_encode($data);
            }
        }

       
    }
?>