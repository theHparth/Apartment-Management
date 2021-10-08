<?php

class Set_maintenance extends CI_Controller {
    
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
	    $page_data['page_name']  = 'set_maintenance';
        $page_data['page_title'] = 'Edit Set Maintenance';
        $page_data['row_data'] = $this->db->order_by('id','desc')->get('mts_value')->row_array();
        $page_data['data'] = $this->db->order_by('id','desc')->get('mts_value')->result_array();
        $this->load->view('admin/common', $page_data);
	}
	
	
	public function update(){
	   $this->form_validation->set_rules('mts_value', 'Maintenance', 'trim|required|numeric|max_length[10]');
       $this->form_validation->set_rules('lift', 'Lift Maintenance', 'trim|required|numeric|max_length[10]');
       $this->form_validation->set_rules('kitchen', 'Kitchen Maintenance', 'trim|required|numeric|max_length[10]');
       $this->form_validation->set_rules('late', 'Late Fees', 'trim|required|numeric|max_length[10]');
       $this->form_validation->set_rules('transfer', 'Transfer Fees', 'trim|required|numeric|max_length[10]');
       $this->form_validation->set_rules('other', 'Other', 'trim|required|numeric|max_length[10]');
       
	    if($this->form_validation->run() == false){
            $message = array('message'=>validation_errors(), 'class'=>'danger');
        }else{

            $today = date('Y-m-d');
            $check = $this->db->get_where('mts_value',array('EXTRACT(year_month from created_at)='=>date('Ym')));
            $post = $this->security->xss_clean($this->input->post());
            $data['mts_value'] = $post['mts_value'];
            $data['lift'] = $post['lift'];
            $data['kitchen'] = $post['kitchen'];
            $data['late'] = $post['late'];
            $data['transfer'] = $post['transfer'];
            $data['other'] = $post['other'];
            $data['user_id'] = $this->session->userdata('user_id');

            if($check->num_rows()>0){
                $data['updated_at'] = $this->date_time->date();
                $this->db->where('id',$check->row()->id);
                $update = $this->db->update('mts_value',$data);
            }else{
                $data['created_at'] = $this->date_time->date();
                $update = $this->db->insert('mts_value',$data);
            }
            
	        
	        if($update){
                $message = array('message'=>'Updated Successfully.', 'class'=>'success');
            }else{
                $message = array('message'=>'Failed to Update.', 'class'=>'danger');
            }
        }
        $this->session->set_flashdata('flash_message',$message);
        redirect(site_url('admin/set_maintenance'),'refresh');
	}
	
}