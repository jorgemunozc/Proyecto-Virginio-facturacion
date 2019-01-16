<?php 
    class Cliente_model extends CI_Model {
        public $razon_social;
        public $rut;
        public $giro;
        public $direccion;
        public $comuna;
        public $is_active = 1;
        public $rango_cobros;
        

        //SETTERS & GETTERS

        public function _set($property_name, $value)
        {
            if(isset($property_name) && isset($value))
            {
                switch ($property_name) 
                {
                    case 'razon_social':
                        $this->razon_social = $value;
                        break;
                    case 'rut':
                        $this->rut = $value;
                        break;
                    case 'giro':
                        $this->giro = $value;
                        break;
                    case 'direccion':
                        $this->direccion = $value;
                        break;
                    case 'comuna':
                        $this->comuna = $value;
                        break;
                    case 'is_active':
                        $this->is_active = $value;
                        break;
                    case 'rango_cobros':
                        $value = (float) $value/100;
                        $this->rango_cobros = $value;
                        break;
                    default:
                        return 0;
                }
                return 1;
            }
            return 0;
        }

        public function _get($property_name)
        {
            if(isset($property_name))
            {
                switch ($property_name) 
                {
                    case 'razon_social':
                        return $this->razon_social;
                    case 'rut':
                        return $this->rut;
                    case 'giro':
                        return $this->giro;
                    case 'direccion':
                        return $this->direccion;
                    case 'comuna':
                        return $this->comuna;
                    case 'is_active':
                        return $this->is_active;
                    case 'rango_cobros':
                        return $this->rango_cobros;
                    default:
                        return NULL;
                }
            }
            return NULL;
        }

        //END SETTERS & GETTERS


        public function obtener_clientes()
        {
            $query = $this->db->get('cliente');
            return $query->result();
        }

        public function insertar_cliente()
        {
            $this->db->where('rut', $this->rut);
            $query = $this->db->get('cliente');
           if($query->num_rows() == 0)
           {
                $this->db->insert('cliente', $this);
                return true;
           }
            return false;
        }

        public function actualizar_cliente($old_rut)
        {
            $this->db->where('rut', $old_rut)
                        ->update('cliente', $this);
        }

        public function obtener_info($field, $value)
        {
            if(isset($field) && isset($value))
            {
                $query = $this->db->where($field, $value)
                                    ->get('cliente');
                return $query->result();
            }
        }
    
    }

?>