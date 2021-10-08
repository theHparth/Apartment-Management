<?php
class Dashboard extends CI_Controller {
    function __construct()
	{
		parent::__construct();
        $this->load->model('common_model');
		if ($this->session->userdata('login_status')!= 1  || $this->common_model->validate_user()==false || $this->session->userdata('user_id') =="" || $this->session->userdata('user_type')!='Admin' ){
            redirect(site_url('admin'),'refresh');
	    }
	}
	
	public function index(){
	    
	    $page_data['page_name']  = 'dashboard';
        $page_data['page_title'] = 'Dashboard';
        $this->load->view('admin/common',$page_data);
	}
	
}
?>