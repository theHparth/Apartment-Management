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
            $message = array('message'=>'Form Validation Failed.', 'class'=>'danger');
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
	public function forgotpassword(){
	    $this->load->view('admin/forgotpassword');
	}
	
	public function resetlink(){
	    $email = $this->security->xss_clean($this->input->post('email'));
	    $result= $this->db->get_where('user',array('email'=>$email))->result_array();
	    if(count($result)>0)
	    {
	        $token= rand(100000,999999);
	        $row = $this->db->query("update user SET token='$token' where email='$email'");
	        $message = "<html><head></head><body>Please click on password reset link <br> <a href='".site_url('admin/login/reset/').$token."'>Reset Password</a></body></html>";
	        
	        
	       // $config = Array(
        //       'protocol' => 'smtp',
        //       'smtp_host' => 'ssl://smtp.googlemail.com',
        //       'smtp_port' => 465,
        //       'smtp_user' => 'xxx@gmail.com', // change it to yours
        //       'smtp_pass' => 'xxx', // change it to yours
        //       'mailtype' => 'html',
        //       'charset' => 'iso-8859-1',
        //       'wordwrap' => TRUE
        //     );
            // ini_set('SMTP', "server.com");
            // ini_set('smtp_port', "25");
            // ini_set('sendmail_from', "bhargavkumar212121@gmail.com");
            
            // $config = Array(
            // 'protocol' => 'smtp',
            // 'smtp_host' => 'ssl://smtp.gmail.com',
            // 'smtp_port' => 465,
            // 'smtp_user' => 'bhargavkumar212121@gmail.com',
            // 'smtp_pass' => '9824389404@bb',
            // 'mailtype' => 'html',
            // 'charset'   => 'iso-8859-1'
            // );
	        $this->load->library('email');
	       // $this->email->initialize($config);
	        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
            $this->email->set_header('Content-type', 'text/html');
        
        
        
            $this->email->set_newline("\r\n");
            $this->email->from('bhargavragingdev@bhargav.ragingdeveloper.com', 'Reset Password');
            $this->email->to($email);
            $this->email->subject('Reset Password Link');
            $this->email->message($message);
            
                if($this->email->send()){
                    $message = array('message'=>'Reset Password Link has been Delivered to your Email Id.', 'class'=>'info');
                    $this->session->set_flashdata('flash_message',$message);
                    redirect(site_url('admin/login'),'refresh');
                }else{
                    echo $this->email->print_debugger(); 
                    // $message = array('message'=>'Your email id is not valid.', 'class'=>'danger');
                    // $this->session->set_flashdata('flash_message',$message);
                    // redirect(site_url('admin/login'),'refresh');
                }
	       
	    }else{
	        $message = array('message'=>'Email id is not registered.', 'class'=>'danger');
            $this->session->set_flashdata('flash_message',$message);
            redirect(site_url('admin/login/forgotpassword'),'refresh');
	    }
	    
	}
	public function reset($token=''){
	    $page_data = array();
	    $page_data['token'] = $this->security->xss_clean($token);
	    $page_data['check']='Check';
	    $this->load->view('admin/resetpassword.php',$page_data);
	}
	public function updatepassword(){
	    
	    $data = $this->security->xss_clean($this->input->post());
	    $token = $data['token'];
	    $password = sha1($this->security->xss_clean($this->input->post('password')));
	    if($data['password']==$data['cpassword']){
	        $r=  $this->db->get_where('user',array('token'=>$token))->result_array();
	       if(count($r) == 1){
	           $this->db->where(array('token'=>$token));
	         $result = $this->db->update('user',array('password'=>$password,'token'=>NULL));
	        if($result){
	            $message = array('message'=>'Your Password Reset Successfully.', 'class'=>'success');
                $this->session->set_flashdata('flash_message',$message);
                redirect(site_url('admin'),'refresh');
	        }else{
	            $message = array('message'=>'password is not set.', 'class'=>'danger');
                $this->session->set_flashdata('flash_message',$message);
                redirect(site_url('admin'),'refresh');
	        }  
	       }else{
	            $message = array('message'=>'Your Reset Password Link has been Expired.', 'class'=>'danger');
                $this->session->set_flashdata('flash_message',$message);
                redirect(site_url('admin'),'refresh');
	       }
	       
	    }
	    else
	    {
	        
	        $message = array('message'=>'Your Password not Confirmed.', 'class'=>'danger');
            $this->session->set_flashdata('flash_message',$message);
            redirect(site_url('admin/login/reset/').$token,'refresh');
	    }
	}
}
?>