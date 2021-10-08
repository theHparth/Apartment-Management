<?php

class Member_data extends CI_Controller {
    
    function __construct()
	{
		parent::__construct();
        /*cache control*/
        $this->load->library('date_time');
        $this->load->model('common_model');
	    if ($this->session->userdata('login_status')!= 1 || $this->session->userdata('user_id') =="" || $this->session->userdata('user_type')!='Admin' || $this->common_model->validate_user()==false ){
            redirect(site_url('login'),'refresh');
	    }
	}
	
	public function index(){
	    $page_data['page_name']  = 'member_data';
        $page_data['page_title'] = 'Member data';
        $page_data['member'] = $this->db->order_by('h_no','asc')->get('member')->result_array();
        $this->load->view('admin/common', $page_data);
	}
	

    public function search_member(){
        $this->form_validation->set_rules('member_id', 'member id', 'trim|required|numeric|max_length[11]');
        if($this->form_validation->run() == false){
            $message = array('message'=>validation_errors(), 'class'=>'danger');
        }else{
            $page_data['member_id'] = $this->security->xss_clean($this->input->post('member_id'));
            $page_data['data'] = $this->db->order_by('id','desc')->get_where('mts',array('member_id'=>$page_data['member_id']))->result_array();
            $message = array('message'=>'Data Fetched Successfully.', 'class'=>'success');
        }
        $this->session->set_flashdata('flash_message',$message);
        $page_data['page_name']  = 'member_data';
        $page_data['page_title'] = 'Member data';
        $page_data['member'] = $this->db->order_by('h_no','asc')->get('member')->result_array();
        $this->load->view('admin/common', $page_data);
    }

}