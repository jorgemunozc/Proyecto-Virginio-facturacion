<?php 
    class Factura_model extends CI_Model {
        private $folio;
        public $servicio__tipo_servicio;
        public $cliente__rut;
        public $dia_emision;
        public $mes_emision;
        public $anio_emision;
        public $dia_vencimiento;
        public $mes_vencimiento;
        public $anio_vencimiento;
        public $neto;
        public $exento = 0;
        public $iva;
        public $total;

        private $_meses = array('Ene', 'Feb', 'Mar', 'Abr',
                                'May', 'Jun', 'Jul', 'Ago',
                                'Sep', 'Oct', 'Nov', 'Dic');

        private $_ERROR_DUPLICADO = 2;
        
        //SETTER & GETTER
        public function _set($property_name, $value)
        {
            if(isset($property_name) && isset($value))
            {
                switch ($property_name) {
                    case 'rut_cliente':
                        $this->cliente__rut = $value;
                        break;
                    case 'tipo_servicio':
                        $this->servicio__tipo_servicio = $value;
                        break;
                    case 'dia_emision':
                        $this->dia_emision = $value;
                        break;
                    case 'mes_emision':
                        $this->mes_emision = $value;
                        break;
                    case 'anio_emision':
                        $this->anio_emision = $value;
                        break;
                    case 'dia_venc':
                        $this->dia_vencimiento = $value;
                        break;
                    case 'mes_venc':
                        $this->mes_vencimiento = $value;
                        break;
                    case 'anio_venc':
                        $this->anio_vencimiento = $value;
                        break;
                    case 'neto':
                        $this->neto = $value;
                        break;
                    case 'exento':
                        $this->exento = $value;
                        break;
                    case 'iva':
                        $this->iva = $value;
                        break;
                    case 'total':
                        $this->total = $value;
                        break;
                    default:
                        return 404;
                }
            }
        }

        public function _get($property_name)
        {
            if(isset($property_name))
            {
                switch ($property_name) {
                    case 'rut_cliente':
                        return $this->cliente__rut;
                    case 'tipo_servicio':
                        return $this->servicio__tipo_servicio;
                    case 'dia_emision':
                        return $this->dia_emision;
                    case 'mes_emision':
                        return $this->mes_emision;
                    case 'anio_emision':
                        return $this->anio_emision;
                    case 'dia_venc':
                        return $this->dia_vencimiento;
                    case 'mes_venc':
                        return $this->mes_vencimiento;
                    case 'anio_venc':
                        return $this->anio_vencimiento;
                    case 'neto':
                        return $this->neto;
                    case 'exento':
                        return $this->exento;
                    case 'iva': 
                        return $this->iva;
                    case 'total':
                        return $this->total;
                    case 'folio':
                        return $this->folio;
                    case 'ERROR_DUPLICADO':
                        return $this->_ERROR_DUPLICADO;
                    default:
                        return 404;
                }
            }
        }//END SETTER & GETTER

        
        public function insertar_factura()
        {
            $filtro = array('cliente__rut'               => $this->cliente__rut,
                            'mes_emision'                => $this->mes_emision,
                            'anio_emision'               => $this->anio_emision,
                            'servicio__tipo_servicio'    => $this->servicio__tipo_servicio);
            $query = $this->db->get_where('factura', $filtro);
            $existeFactura = $query->num_rows() > 0;
            if ($existeFactura){
                throw new Exception("", $this->_ERROR_DUPLICADO);
            }
            $this->db->insert('factura', $this);
            $this->folio = $this->db->insert_id();
        }

        public function get_info_factura($folio)
        {
            $query = $this->db->where('folio', $folio)
                                ->get('factura');
            return $query->row();
        }

        public function obtener_listado_facturas($rut)
        {
            $query = $this->db->where('cliente__rut', $rut)
                                ->order_by('anio_emision', 'DESC')
                                ->order_by('mes_emision', 'DESC')
                                // ->order_by('dia_emision', 'DESC')
                                ->get('factura');
            return $query->result();
        }
    }
?>