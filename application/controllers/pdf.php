<?php
    class Pdf extends CI_Controller {

        private $_servicios_basicos = array('Luz', 'Agua', 'Electricidad', 'Telefono', 'Teléfono',
                                            'luz eléctrica', 'Gas', 'Fono');
        public function __construct()
        {
            parent::__construct();
            if(!is_logged_in()){
                redirect('login');
            }
        }
        public function index()
        {
            $this->load->view('pdf/pdf_error');
        }

        private function _obtener_datos_factura($folio)
        {
            if(isset($folio))
            {
                $this->load->model('factura_model');
                $factura = $this->factura_model->get_info_factura($folio);
                if( ! empty($factura))
                {
                    $this->load->model('config_factura_model', 'conf_fac');
                    $this->load->model('cliente_model');
                    $this->load->model('servicio_model');
                    $config_fac =  $this->conf_fac->obtener_conf_factura($factura->servicio__tipo_servicio);
                    $config_fac->detalles = explode(';', $config_fac->detalles);
                    $config_fac->cantidades = explode(';', $config_fac->cantidades);
                    $config_fac->porcen_del_valor_total = explode(';', $config_fac->porcen_del_valor_total);
                    $cliente = $this->cliente_model->obtener_info('rut', $factura->cliente__rut)[0];
                    $servicio = $this->servicio_model->obtener_info_servicio($factura->servicio__tipo_servicio);
                    return array(   'datos_factura' => $factura, 'datos_cliente' => $cliente, 
                                    'config_fac' => $config_fac, 'datos_servicio' => $servicio);
                }
            }
            return array();
        }

        public function mostrar_factura($folio)
        {
            $factura = $this->_obtener_datos_factura($folio);
           if(empty($factura))
            {
                $this->load->view('pdf/pdf_error');
                return false;
            }
            $tipo_servicio = ucfirst($factura['datos_servicio']->tipo_servicio);
            if(in_array($tipo_servicio, $this->_servicios_basicos))
            {
                $this->load->view('pdf/factura_servicio', $factura);
            }else
            {
                $this->load->view('pdf/factura_normal', $factura);
            }
            return true;
        }

        public function template($folio)
        {
            $factura = $this->_obtener_datos_factura($folio);
            $html = $this->load->view('pdf/factura_table', $factura, TRUE);
            // echo $html;
            // $html = '<h1>HTML Example</h1>';
            $this->load->library('pdf_report');
            $pdf = new PDF_Report(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->AddPage();
            // $html = '<h1>Test Page</h1';
            $pdf->writeHTML($html, true, false, true, false, '');
            $pdf->Output();
        }
    }
?>