<?php 
class Rd extends CI_Controller {
    public function response($data,$status){
        $this->output->set_status_header($status)->set_content_type('application/json')->set_output(json_encode($data));
    }
}