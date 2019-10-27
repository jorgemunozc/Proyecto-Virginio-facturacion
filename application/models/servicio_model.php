<?php 
	class Servicio_model extends CI_model {
		public $tipo_servicio;
		public $razon_social;
		public $rut;
		public $giro;
		public $direccion;
		public $comuna;
		public $fono;
        public $url_logo;
        public $exento = 0;

        private $_campos = array('tipo_servicio', 'razon_social', 'rut',
                                    'giro', 'direccion', 'comuna', 
                                    'fono', 'url_logo', 'exento');
		//SETTERS & GETTERS

        /*
        Codigos error:  - 1: "ingreso exitoso",
                        - 404: "campo no existe",
                        - 0: "campo o valor no asignados"
        */
        public function _set($property_name, $value)
        {
            if(isset($property_name) && isset($value))
            {
                json_encode("Valor recibido: ${value}");
                switch ($property_name) 
                {
                	case 'tipo_servicio':
                		$this->tipo_servicio = $value;
                		break;
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
                    case 'fono':
                        $this->fono = $value;
                        break;
                    case 'url_logo':
                        $this->url_logo = $value;
                        break;
                    case 'exento':
                        if (is_string($value) && $value === 'on'){
                            $this->exento = 1;
                        }
                        elseif ($value == 0){
                            $this->exento = $value;
                        }
                        break;
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
                switch ($property_name) 
                {
                	case 'tipo_servicio':
                		return $this->tipo_servicio;
                		break;
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
                    case 'fono':
                        return $this->fono;
                    case 'url_logo':
                        return $this->url_logo;
                    case 'exento':
                        return $this->exento;
                    default:
                        return NULL;
                }
            }
            return NULL;
        }//END SETTERS & GETTERS

        //Funcion entrega toda la info de los servicios
        public function obtener_servicios()
        {
            $query = $this->db->get('servicio');
            return $query->result();    
        }

        public function insertar_servicio()
        {
            $this->db->where('tipo_servicio', $this->tipo_servicio);
            $this->db->limit(1);
            $query = $this->db->get('servicio');
            if($query->num_rows() == 0)
            {
                $this->db->insert('servicio', $this);
                return true;
            }
            return false;
        }

        public function actualizar_campo($campo, $nuevo_valor, $servicio)
        {
            if(in_array($campo, $this->_campos))
            {
                try 
                {
                    $this->db   ->set($campo, $nuevo_valor)
                                ->where('tipo_servicio', $servicio)
                                ->update('servicio');
                } catch (Exception $e) {
                    echo $e.message;
                    return false;
                }
                return true;
            }
            return false;
        }

        public function actualizar_servicio($servicio)
        {
            $campos = array(  'tipo_servicio' =>  $this->tipo_servicio,
                                    'razon_social'  =>  $this->razon_social,
                                    'rut'           =>  $this->rut,
                                    'giro'          =>  $this->giro,
                                    'direccion'     =>  $this->direccion,
                                    'comuna'        =>  $this->comuna,
                                    'fono'          =>  $this->fono,
                                    'exento'        =>  $this->exento
                            );
            $this->db   ->set($campos)
                        ->where('tipo_servicio', $servicio)
                        ->update('servicio');
        }
        
        public function subir_logo($form_fieldname, $filename)
        {
            $config['upload_path'] = './public/images/';
            $config['allowed_types'] = 'png|svg';
            $config['max_size'] = '1024';
            $config['file_name'] = $filename;
            $config['overwrite'] = TRUE;
            $config['max_filename'] = 0;

            $this->load->library('upload');
            $this->upload->initialize($config);
            if(! $this->upload->do_upload($form_fieldname))
            {
                $this->_set('url_logo', 'NA');
                return false;
            }else
            {   
                $data = array('file' => $this->upload->data());
                $this->_set('url_logo', $data['file']['file_name']);
                return true;
            }
        }

        public function obtener_listado_campo($campo)
        {
            $posibles_campos = array('tipo_servicio',
                                    'razon_social',
                                    'rut',
                                    'giro',
                                    'direccion',
                                    'comuna',
                                    'fono',
                                    'url_logo',
                                    'exento'
            );
            if(in_array($campo, $posibles_campos))
            {
                $query = $this->db->select($campo)
                        ->order_by($campo, 'ASC')
                        ->get('servicio');
                return $query->result();
            }
            return NULL;
        }

        public function obtener_info_servicio($tipo_servicio)
        {
            if(isset($tipo_servicio))
            {
                $query = $this->db->where('tipo_servicio', $tipo_servicio)
                                    ->get('servicio');
                return $query->row();
            }
            return null;
        }

        private function _eliminar_servicio($tipo_servicio)
        {
            $query = $this->db->where('servicio__tipo_servicio', $tipo_servicio)
                                ->get('factura');
            /*Buscamos facturas que puedan estar asociadas al servicio que se quiere borrar,
              de ser asi procedemos a borrar dichas facturas primero.
            */
            $fact_asociadas = $query->num_rows();
            $query->free_result();
            if ($fact_asociadas > 0)
            {
                $query = $this->db->where('servicio__tipo_servicio', $tipo_servicio)
                                    ->delete('factura');
                // $query->free_result();
            }
            /* Borramos configuracion de factura asociada al servicio */
            $this->db->where('servicio__tipo_servicio', $tipo_servicio)
                    ->delete('configuracion_factura');
            /* Borramos los valores mensuales a pagar para cualquier cliente que haya
            /* contratado el servicio
            */
            $this->db->where('servicio__tipo_servicio', $tipo_servicio)
                    ->delete('tarifa');
            /* Finalmente borramos el servicio */
            $query = $this->db->where('tipo_servicio', $tipo_servicio)
                                ->delete('servicio');
            return $query;
        }

        public function eliminar_servicio($tipo_servicio)
        {
            return $this->_eliminar_servicio($tipo_servicio);
        }
	}
?>