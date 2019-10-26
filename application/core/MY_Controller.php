<?php
    defined('BASEPATH') OR exit('No permitido acceso directo al script.');
    class MY_Controller extends CI_Controller {
        public $title = '';

        function __construct()
        {
            parent::__construct();
        }
        function _output($content)
        {
            //Load the base template with output content available as $content
            $data['content'] = &$content;
            echo($this->load->view('base', $data, true));
        }
    }
    ?>
