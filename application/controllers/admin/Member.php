<?php

class Member extends CI_Controller {
    
    function __construct()
	{
		parent::__construct();
        $this->load->library('date_time');
        // $this->load->model('admin/student_model');
        $this->load->model('common_model');
	    
	    if ($this->session->userdata('login_status')!= 1 || $this->session->userdata('user_id') =="" || $this->common_model->validate_user()==false || $this->session->userdata('user_type')!='Admin' ){
            redirect(site_url('login'),'refresh');
	    }
	}
	
	public function index(){
        // echo date('Y-m-01');exit;
	    $page_data['page_name']  = 'member';
        $page_data['page_title'] = 'Add Member';
        $page_data['data'] = $this->db->order_by('h_no','asc')->get('member')->result_array();
        $this->load->view('admin/common', $page_data);
	}
	
	public function create(){
	    
	    $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[100]');
	    // $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|max_length[30]');
	    $this->form_validation->set_rules('h_no', 'House Number', 'trim|required|max_length[50]');
	    
	    if($this->form_validation->run() == false){
            $message = array('message'=>validation_errors(), 'class'=>'danger');
        }else{
        
            $data['name'] = $this->security->xss_clean($this->input->post('name'));
            $data['h_no'] = $this->security->xss_clean($this->input->post('h_no'));
            // $data['mobile'] = $this->security->xss_clean($this->input->post('mobile'));
            $data['user_id'] = $this->session->userdata('user_id');
            $data['created_at'] = $this->date_time->date();
            $insert = $this->db->insert('member',$data);
            
            if($insert){
                $message = array('message'=>'Member Added Successfully.', 'class'=>'success');
            }else{
                $message = array('message'=>'Failed to Add Member.', 'class'=>'danger');
            }
        }
        $this->session->set_flashdata('flash_message',$message);
        redirect(site_url('admin/member'),'refresh');
	}
	
	public function edit($param=''){
	    $param=$this->security->xss_clean($param);
	    
	    $page_data['data'] = $this->db->order_by('h_no','asc')->get('member')->result_array();
	    $page_data['row_data'] = $this->db->get_where('member',array('id'=>$param))->row_array();
	    $page_data['page_name']  = 'member';
        $page_data['page_title'] = 'Edit Member';
        $this->load->view('admin/common', $page_data);  
	}
	
	public function update($param=''){
	    $param=$this->security->xss_clean($param);
	    $this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[100]');
        // $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|numeric|max_length[30]');
        $this->form_validation->set_rules('h_no', 'House Number', 'required|max_length[50]');
        if($this->form_validation->run() == false){
            $message = array('message'=>validation_errors(), 'class'=>'danger');
        }else{
            $data['name'] = $this->security->xss_clean($this->input->post('name'));
            $data['h_no'] = $this->security->xss_clean($this->input->post('h_no'));
            // $data['mobile'] = $this->security->xss_clean($this->input->post('mobile'));
            $data['updated_at'] = $this->date_time->date();
            $this->db->where('id',$param);
	        $update = $this->db->update('member',$data);
	        
	        if($update){
                $message = array('message'=>'Member Updated Successfully.', 'class'=>'success');
            }else{
                $message = array('message'=>'Failed to Update Member.', 'class'=>'danger');
            }
        }
        $this->session->set_flashdata('flash_message',$message);
        redirect(site_url('admin/member'),'refresh');
	}
	
	// public function delete($param=''){
	//     $param=$this->security->xss_clean($param);
	    
	//     $delete = $this->db->delete('member',array('id'=>$param));
	    
	//     if($delete){
 //            $message = array('message'=>'Member Deleted Successfully.', 'class'=>'success');
 //        }else{
 //            $message = array('message'=>'Failed to Delete Member.', 'class'=>'danger');
 //        }
 //        $this->session->set_flashdata('flash_message',$message);
 //        redirect(site_url('admin/member'),'refresh');
	// }
	
}