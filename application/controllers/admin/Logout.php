<?php
class Logout extends CI_Controller {
    function __construct()
	{
		parent::__construct();
        /*cache control*/
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
	}
	
	public function index(){
	    
	    $this->session->unset_userdata('user_id');
	    redirect(site_url('admin'),'refresh');
	}
	
}
?>