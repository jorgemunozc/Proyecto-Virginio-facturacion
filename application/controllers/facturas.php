<?php 
    defined('BASEPATH') OR exit('No permitido acceso directo al script.');
    class Facturas extends CI_Controller{
        public $title = 'Facturas';

        public function __construct()
        {
            parent::__construct();
            if(!is_logged_in()){
                redirect('login');
            }
        }
        
        public function index(){
            $this->listar_facturaciones();
        }
        
        public function listar_facturaciones(){
            $servicios = $facturaciones = array();
            $this->title = "Facturación";
            $this->load->view('dashboard');
            $this->load->model('cliente_model');
            $clientes = $this->cliente_model->obtener_clientes();
            /**obtenemos los servicios de cada cliente
            /* y agregamos cada info de cliente a un arreglo
            /* para pasarselo a la vista */
            foreach($clientes as $cliente)
            {
                $rut = $cliente->rut;
                $servicios[$rut] = $this->obtener_lista_servicios($rut);
                $facturaciones[$rut] = array();
                foreach($servicios[$rut] as $servicio)
                {
                    $facturaciones[$rut][$servicio] = $this->obtener_ultima_facturacion($rut, $servicio);
                }
            }
            $data['clientes'] = $clientes;
            $this->load->view('factura/listado_clientes', $data);
            $data['servicios'] = $servicios;
            $data['facturaciones'] = $facturaciones;
            $this->load->view('factura/listado_servicios', $data);
            $this->load->view('factura/scripts');
        }

        /*Funcion devuelve un arreglo de strings con los servicios
        /*contratados
        */
        public function obtener_lista_servicios($rut)
        {
            if(isset($rut))
            {
                $tarifas = array();
                $this->load->model('tarifa_model');
                $this->tarifa_model->_set('rut', $rut);
                $result = $this->tarifa_model->listar_tarifas();
                foreach($result as $tarifa)
                {
                    $tarifas[] = $tarifa->servicio__tipo_servicio;
                }
                
                return $tarifas;
            }
        }

        /*Funcion procesa datos para facturacion e ingresa
        /*la factura a la BD.
        /*Codigos:  200: Ingreso exitoso 
        /*          400: Problema del cliente 
        /*          500: Error interno de la BD
        */
        public function facturar()
        {
            if($this->input->post())
            {
                $rut_cli = $this->input->post('rut');
<<<<<<< HEAD
                $tipo_servicio = $this->input->post('servicio');
=======
                $servicio = $this->input->post('servicio');
>>>>>>> 16052615bcbda34153f7eed10fd873ae7bdc35ea
                $dia_emision = (int) date('d');
                $mes_emision = (int) date('m');
                $anio_emision = (int) date('Y');
                if($mes_emision === 12)
                {
                    $mes_venc = 1;
                    $anio_venc = $anio_emision + 1;
                }else
                {
                    $mes_venc = $mes_emision + 1;
                    $anio_venc = $anio_emision;
                }
                if($mes_venc === 2 && $dia_emision > 28)
                {
                    $dia_venc = 28;
                }else
                {
                    $dia_venc = $dia_emision;
                }
<<<<<<< HEAD
                //Cargamos el servicio
                $this->load->model('servicio_model');
                $servicio = $this->servicio_model->obtener_info_servicio($tipo_servicio);
                $factura_exenta = $servicio->exento == 1 ? true : false;
                $this->load->model('tarifa_model');

                //Buscamos si existe una tarifa y 
                //cargamos la informacion de la tarifa asociada al cliente
                $info_tarifa = $this->tarifa_model->_obtener_info_tarifa($rut_cli, $tipo_servicio);
                $tarifa = $info_tarifa->monto_tarifa;
                $rango_cobro_esp = $info_tarifa->rango_cobros;
                $this->load->model('cliente_model');
                $cliente = $this->cliente_model->obtener_info('rut', $rut_cli)[0];
                $rango_valores = $rango_cobro_esp != null ? $rango_cobro_esp : $cliente->rango_cobros;

                //Calculamos los montos de la factura
                $mind_rand = $tarifa - ($tarifa * $rango_valores);
                $max_rand = $tarifa + ($tarifa * $rango_valores);
                $total_fac = mt_rand($mind_rand, $max_rand);
                $monto_exento = 0;
                if ($factura_exenta)
                {
                    $neto_fac = $monto_exento = $total_fac;
                    $iva_fac = 0;
                } else {
                    $neto_fac = round($total_fac / 1.19);
                    $iva_fac = $total_fac - $neto_fac;
                }
=======

                $this->load->model('tarifa_model');
                $tarifa = $this->tarifa_model->_obtener_tarifa($rut_cli, $servicio);
                $this->load->model('cliente_model');
                $cliente = $this->cliente_model->obtener_info('rut', $rut_cli)[0];
                $rango_valores = $cliente->rango_cobros;
                $mind_rand = $tarifa - ($tarifa * $rango_valores);
                $max_rand = $tarifa + ($tarifa * $rango_valores);
                $total_fac = mt_rand($mind_rand, $max_rand);
                $neto_fac = round($total_fac / 1.19);
                $iva_fac = $total_fac - $neto_fac;
>>>>>>> 16052615bcbda34153f7eed10fd873ae7bdc35ea
                $datos_factura = array('dia_emision'    => $dia_emision,
                                        'mes_emision'   => $mes_emision,
                                        'anio_emision'  => $anio_emision,
                                        'dia_venc'      => $dia_venc,
                                        'mes_venc'      => $mes_venc,
                                        'anio_venc'     => $anio_venc,
                                        'neto'          => $neto_fac,
                                        'iva'           => $iva_fac,
                                        'total'         => $total_fac,
                                        'tipo_servicio' => $tipo_servicio,
                                        'rut_cliente'   => $rut_cli,
                                        'exento'        => $monto_exento
                                );
                $this->load->model('factura_model');
                foreach($datos_factura as $campo => $valor)
                {
                    $this->factura_model->_set($campo, $valor);
                }
                try 
                {
                    $this->factura_model->insertar_factura();
                    $data['status'] = 'success';
                    $data['folio'] = $this->factura_model->_get('folio');
                    echo json_encode($data);
                    return true;
                } catch (Exception $e) {
                    $data['status'] = 'error';
                    $data['msg'] = 'Hubo un error al facturar.';
                    echo json_encode($data);
                    return false;
                }                          
            }
            $data['status'] = 'error';
            $data['msg'] = "Ya se facturó este mes.";
            echo json_encode($data);
            return false;
        }

        /*Funcion retorna un array asociativo con el mes y año
        /*de la ultima factura emitida por el servicio dado.
        /*Si no se encuentra una factura retorna un arreglo vacio*/
        private function obtener_ultima_facturacion($rut, $tipo_servicio)
        {
            try 
            {
                $query = $this->db->select('mes_emision, anio_emision')
                                ->order_by('anio_emision', 'DESC')
                                ->order_by('mes_emision', 'DESC')
                                // ->limit(1)
                                ->where('cliente__rut', $rut)
                                ->where('servicio__tipo_servicio', $tipo_servicio)
                                ->get('factura');
                $result = $query->row();
            } catch (Excepction $e) {
                echo $e.message;
                return array();
            }
            if(isset($result))
            {
                $datos_ult_factura['anio'] = $result->anio_emision;
                $datos_ult_factura['mes'] = $result->mes_emision;
                return $datos_ult_factura;
            }
            else
            {
                return array();
            }
        }

        public function listar_facturas()
        {
            $clientes = $facturas = array();
            $this->load->model('cliente_model');
            $clientes = $this->cliente_model->obtener_clientes();
            $data['clientes'] = $clientes;
            $this->load->view('dashboard');
            $this->load->view('factura/listado_clientes', $data);
            $this->load->model('factura_model');
            foreach($clientes as $cliente)
            {
                $facturas[$cliente->rut] = $this->factura_model->obtener_listado_facturas($cliente->rut);//recuperamos las facturas por rut, de haberlas.
            }
            $data['facturas'] = $facturas;
            $this->load->view('factura/listado_facturas', $data);
            $this->load->view('factura/scripts');
        }

        public function template(){
            $this->load->view('pdf/factura_servicio');
        }
    }
?>