<?php 
    class Config_factura_model extends CI_Model {
        public $servicio__tipo_servicio;
        public $detalles;
        public $cantidades;
        public $porcen_del_valor_total;

        private $delim = ';';

        //SETTER & GETTER
        public function _get($property_name)
        {
            if(isset($property_name))
            {
                switch($property_name)
                {
                    case 'tipo_servicio':
                        return $this->servicio__tipo_servicio;
                    case 'detalles':
                        return $this->detalles;
                    case 'cantidades':
                        return $this->cantidades;
                    case 'porcentajes':
                        return $this->porcen_del_valor_total;
                    default:
                        return 404;
                }
            }
            return null;
        }

        public function _set($property_name, $value)
        {
            if(isset($property_name) && isset($value))
            {
                switch($property_name)
                {
                    case 'tipo_servicio':
                    $this->servicio__tipo_servicio = $value;
                    break;
                    case 'detalles':
                        $this->detalles = $value;
                        break;
                    case 'cantidades':
                        $this->cantidades = $value;
                        break;
                    case 'porcentajes':
                        $this->porcen_del_valor_total = $value;
                        break;
                    default:
                        return 404;
                }
                return 1;
            }
            return 0;
        }
        //END SETTER & GETTER
        public function insertar_config_factura()
        {
            $this->db->insert('configuracion_factura', $this);
        }

        private function extraer_campo($campo)
        {
            $arr_items_extraidos = explode($this->delim, $this->_get($campo));
            return $arr_items_extraidos;
        }

        public function obtener_conf_factura($tipo_servicio)
        {
            if(isset($tipo_servicio))
            {
                $this->db->where('servicio__tipo_servicio', $tipo_servicio);
                $query = $this->db->get('configuracion_factura');
                return $query->row();
            }
            return array();
        }
        
    }
?>