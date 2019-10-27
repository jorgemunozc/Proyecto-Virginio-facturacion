<?php 
    defined('BASEPATH') OR exit('No permitido acceso directo al script.');
    class Servicios extends CI_Controller{
        public $title = 'Servicios';
<<<<<<< HEAD

        private $campos = array('tipo_servicio', 'razon_social', 'rut', 'giro',
        'giro', 'direccion', 'comuna', 'fono', 'exento');
=======
>>>>>>> 16052615bcbda34153f7eed10fd873ae7bdc35ea
        
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
            $this->_listar_servicios();
        }

        public function new()
        {
            $this->title = "Servicios | Nuevo Servicio";
            $this->load->view('dashboard');
<<<<<<< HEAD
=======
            // $this->_listar_servicios();
>>>>>>> 16052615bcbda34153f7eed10fd873ae7bdc35ea
            $this->load->view('servicio/servicio_form_view', array('msg' => ''));
            $this->load->view('servicio/scripts');
        }

        public function edit($servicio_enc)
        {
<<<<<<< HEAD
            /*Decodificamos espacios y otros caracteres especiales en el nombre
            /* de un servicio.
            */
=======
>>>>>>> 16052615bcbda34153f7eed10fd873ae7bdc35ea
            $servicio_dec = rawurldecode($servicio_enc);
            $this->load->model('servicio_model');
            $info_servicio = $this->servicio_model->obtener_info_servicio($servicio_dec);
            $data['servicio'] = $info_servicio;
            $this->title = "Servicios | Editar Servicio";
            $this->load->view('dashboard');
            $this->load->view('servicio/edit_form', $data);
            $this->load->view('servicio/scripts');
        }

        public function guardar_servicio()
        {
            if($this->input->post())
            {   
<<<<<<< HEAD
=======
                $campos = array('tipo_servicio', 'razon_social', 'rut', 'giro',
                                'giro', 'direccion', 'comuna', 'fono');
>>>>>>> 16052615bcbda34153f7eed10fd873ae7bdc35ea
                $this->load->model('servicio_model');
                if ($this->servicio_model->subir_logo('logo', $this->input->post('tipo_servicio')))
                {
                    //Procesamiento de datos
<<<<<<< HEAD
                    foreach ($this->campos as $campo)
                    {
                        if ($campo === "exento" && $this->input->post($campo) === null)
                        {
                            break;
                        }
                        $status = $this->servicio_model->_set($campo, $this->input->post($campo, true));
                        if($status === 0)
                        {   
                            $data['msg'] = "Campo o valor no asignados para atributo '${campo}' ";
                            $data['status'] = 'error';
                            echo json_encode($data);
                            return;
                            
                        }elseif($status === 404)
                        {
                            $data['msg'] = "Campo: ${campo} no existe";
                            $data['status'] = 'error';
                            echo json_encode($data);
                            return;
=======
                    foreach ($campos as $campo)
                    {
                        $status = $this->servicio_model->_set($campo, $this->input->post($campo, true));
                        if($status === 0)
                        {   
                            $data['msg'] = 'Campo o valor no asignados';
                            $data['status'] = 'error';
                            echo json_encode($data);
                            
                        }elseif($status === 404)
                        {
                            $data['msg'] = 'Campo: ${campo} no existe';
                            $data['status'] = 'error';
                            echo json_encode($data);
>>>>>>> 16052615bcbda34153f7eed10fd873ae7bdc35ea
            
                        }
                    }
                    $num_detalles = $this->input->post('num_detalles', true);
                    $arr_detalles = $arr_cantidades = $arr_porcent = array();
                    for($i = 0; $i < $num_detalles; $i++)
                    {
                        $arr_detalles[] = ucfirst($this->input->post('detalle'.$i));
                        $arr_cantidades[] = $this->input->post('cantidad'.$i);
                        $arr_porcent[] = $this->input->post('porc_precio'.$i);
                    }
                    $this->load->model('config_factura_model', 'conf_fact');
                    $this->conf_fact->_set('detalles', implode(';', $arr_detalles));
                    $this->conf_fact->_set('cantidades', implode(';', $arr_cantidades));
                    $this->conf_fact->_set('porcentajes', implode(';', $arr_porcent));
                    $this->conf_fact->_set('tipo_servicio', $this->input->post('tipo_servicio'));
                    //Fin procesamiento de datos
                    try 
                    {
                        if($this->servicio_model->insertar_servicio())
                        {
                            $this->conf_fact->insertar_config_factura();
                            $data['msg'] = 'Ingresado correctamente a la BD';
                            $data['status'] = 'success';
                            echo json_encode($data);
                        }else
                        {
                            $data['msg'] = 'Servicio ya existe.';
                            $data['status'] = 'error';
                            echo json_encode($data);
                        }
                    } catch (Exception $e) {
                        $data['msg'] = $e.message;
                        $data['status'] = 'error';
                        echo json_encode($data);
                    }
                }else
                {
                    $data = array('msg'=> 'Ocurrió un error.', 'status' => 'false');
                    echo json_encode($data);
                }
            }
        }

        public function editar_servicio()
        {
            if($this->input->post())
            {
<<<<<<< HEAD
                $this->load->model('servicio_model');
                foreach($this->campos as $campo)
                {
                    if ($campo === "exento" && $this->input->post($campo) === null)
                    {
                        $this->servicio_model->_set($campo, 0);
                    }
                    else {
                        $this->servicio_model->_set($campo, $this->input->post($campo, true));
                    }
                }
                // print_r($this->servicio_model);
                // die();
=======
                $array_campos = array('rut', 'razon_social', 'direccion', 'giro', 'comuna', 'fono', 'tipo_servicio');
                $this->load->model('servicio_model');
                foreach($array_campos as $campo)
                {
                    $this->servicio_model->_set($campo, $this->input->post($campo, true));
                }
>>>>>>> 16052615bcbda34153f7eed10fd873ae7bdc35ea
                try 
                {
                    $this->servicio_model->actualizar_servicio($this->input->post('old_tipo_serv', true));
                    $data['status'] = 'success';
<<<<<<< HEAD
                    $data['msg'] = 'Actualizado correctamente';
=======
                    $data['msg'] = 'Acutalizado correctamente';
>>>>>>> 16052615bcbda34153f7eed10fd873ae7bdc35ea
                    echo json_encode($data);
                    return true;
                } catch (Exception $e) 
                {
                    $data['status'] = 'error';
                    $data['msg'] = 'No se pudo actualizar servicio';
                    echo json_encode($data);
                    return false;
                }
            }
        }

        public function editar_logo()
        {
            if($this->input->post())
            {
                $tipo_servicio = $this->input->post('tipo_servicio', true);
                // $file = $this->input->post('logo');
                $this->load->model('servicio_model');
                if($this->servicio_model->subir_logo('logo', $tipo_servicio))
                {
                    
                    $nombre_logo = $this->servicio_model->_get('url_logo');
                    $actualizado = $this->servicio_model->actualizar_campo('url_logo', $nombre_logo, $tipo_servicio);
                    if( ! $actualizado){
                        $data['status'] = 'error';
                        $data['msg'] = 'Logo no se actualizó.';
                        echo json_encode($data);
                    }else
                    {
                        $data['status'] = 'success';
                        $data['msg'] = 'Logo actualizado';
                        $data['filename'] = $nombre_logo;
                        echo json_encode($data);
                    }
                }else
                {

                    $data['status'] = 'error';
                    $data['msg'] = 'Logo no se actualizó.';
                    echo json_encode($data);
                }
            }
        }

        private function _listar_servicios()
        {
            $this->load->model('servicio_model');
            $data['servicios'] = $this->servicio_model->obtener_servicios();
            $this->load->view('servicio/lista_servicios_view', $data);
<<<<<<< HEAD
            $this->load->view('servicio/scripts');
        }

        public function delete()
        {
            if ($this->input->post('tipo_servicio'))
            {
                $servicio = $this->input->post('tipo_servicio', true);
                $this->load->model('servicio_model');
                $eliminado = $this->servicio_model->eliminar_servicio($servicio);
                if($eliminado)
                {
                    $data['msg'] = 'Servicio eliminado';
                    $data['status'] = 'success';
                }else
                {
                    $data['msg'] = 'Servicio no existe';
                    $data['status'] = 'error';
                }
                echo json_encode($data);
            }
=======
            // $this->load->view('servicio/scripts');
>>>>>>> 16052615bcbda34153f7eed10fd873ae7bdc35ea
        }

    }
?>