<?php
    class Tarifa_model extends CI_Model {
        public $cliente__rut;
        public $servicio__tipo_servicio;
        public $monto_tarifa;
        public $rango_cobros;

        //SETTER & GETTER
        public function _set($property_name, $value)
        {
            if(isset($property_name) && isset($value))
            {
                switch($property_name)
                {
                    case 'rut':
                        $this->cliente__rut = $value;
                        break;
                    case 'tipo_servicio':
                        $this->servicio__tipo_servicio = $value;
                        break;
                    case 'monto_tarifa':
                        $this->monto_tarifa = $value;
                        break;
                    case 'rango_cobros':
                        $this->rango_cobros = $value/100;
                    default:
                        return 404;
                }
                return 1;
            }
            return 0;
        }

        public function _get($property_name)
        {
            if(isset($property_name))
            {
                switch ($property_name) {
                    case 'rut':
                        return $this->cliente__rut;
                    case 'tipo_servicio':
                        return $this->servicio__tipo_servicio;
                    case 'monto_tarifa':
                        return $this->monto_tarifa;
                    case 'rango_cobros':
                        return $this->rango_cobros;
                    default:
                        return NULL;
                }
            }
            return NULL;
        }

        public function insertar_tarifa()
        {
            $this->db->insert('tarifa', $this);
        }
        
        public function actualizar_tarifa($nuevo_monto)
        {
            if(isset($nuevo_monto) && is_numeric($nuevo_monto))
            {
                $this->db->where('cliente__rut', $this->_get('rut'));
                $this->db->where('servicio__tipo_servicio', $this->_get('tipo_servicio'));
                $this->db->set('monto_tarifa', $nuevo_monto);
                if ($this->rango_cobros != null)
                {
                    $this->db->set('rango_cobros', $this->rango_cobros);
                }
                $this->db->update('tarifa');
                return true;
            }
            return false;
        }

        public function eliminar_tarifa()
        {
            $this->db->where('cliente__rut', $this->_get('rut'));
            $this->db->where('servicio__tipo_servicio', $this->_get('tipo_servicio'));
            if($this->db->delete('tarifa'))
            {
                return true;
            }
            return false;
        }

        public function listar_tarifas()
        {
            $query = $this->db->where('cliente__rut', $this->_get('rut'))
                                ->get('tarifa');
            return $query->result();
        }

        public function _obtener_info_tarifa($rut, $servicio)
        {
            $query = $this->db->select('monto_tarifa, rango_cobros')
                                ->where('cliente__rut', $rut)
                                ->where('servicio__tipo_servicio', $servicio)
                                ->get('tarifa');
            $result = $query->row();
            if( ! empty($result))
            {
                return $result;
            }else
            {
                return null;
            }
        }

        public function existe_tarifa()
        {
            if($this->_get('rut') !== null && $this->_get('tipo_servicio') !== null)
            {
                $this->db->where('cliente__rut', $this->_get('rut'));
                $this->db->where('servicio__tipo_servicio', $this->_get('tipo_servicio'));
                $query = $this->db->get('tarifa');
                return $query->num_rows();
            }
            return false;
        }
    }
?>