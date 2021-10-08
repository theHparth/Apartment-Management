<?php
class Login extends CI_Controller {
    function __construct()
	{
		parent::__construct();
        /*cache control*/
	}
	
	public function index(){
	    $this->load->view('admin/index.php');
	}
	
	public function validateLogin(){
	    
	    $this->form_validation->set_rules('email', 'Email', 'required');
	    $this->form_validation->set_rules('password', 'Password', 'required');
	    
	    if($this->form_validation->run()==false){
            $message = array('message'=>validation_errors(), 'class'=>'danger');
            $this->session->set_flashdata('flash_message',$message);
            redirect(site_url('admin'),'refresh');
        }else{
            $email = $this->security->xss_clean($this->input->post('email'));
	        $password = sha1($this->security->xss_clean($this->input->post('password')));
	        
	        $validate = $this->db->get_where('user',array('email'=>$email,'password'=>$password,'user_type'=>'Admin'))->num_rows();
	        
	        if($validate==1){
	            $data = $this->db->get_where('user',array('email'=>$email,'password'=>$password,'user_type'=>'Admin'))->row_array();
	           // set user session data
	            $this->session->set_userdata('login_status', '1');
	            $this->session->set_userdata('user_id', $data['id']);
	            $this->session->set_userdata('user_type', $data['user_type']);
	            $this->session->set_userdata('name', $data['name']);
	            $this->session->set_userdata('photo', $data['photo']);
	            
                redirect(site_url('admin/dashboard'),'refresh');
	        }else{
	            $message = array('message'=>'Invalid User Name or Password !', 'class'=>'danger');
                $this->session->set_flashdata('flash_message',$message);
                redirect(site_url('admin'),'refresh');
	        }
        }
	}
	
}
?>