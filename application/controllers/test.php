<?php 
class Test extends CI_Controller {
    public function index() {
        echo base_url() . "<br> ";
            if(!is_logged_in()){
                echo "No estas logueado";
            }
    }
}
?>