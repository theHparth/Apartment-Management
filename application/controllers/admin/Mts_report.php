<?php

class Mts_report extends CI_Controller {
    
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
	    $page_data['page_name']  = 'mts_report';
        $page_data['page_title'] = 'Maintenance Report';
        $this->load->view('admin/common', $page_data);
	}
	
	public function fetch_report()
    {
        $this->form_validation->set_rules('start_date', 'From Date', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('end_date', 'To Date', 'trim|required|max_length[25]');
         
        if($this->form_validation->run() == false){
            $message = array('message'=>validation_errors(), 'class'=>'danger');
            $this->session->set_flashdata('flash_message',$message);
            redirect(site_url('admin/mts_report'),'refresh');
        }else{
            $arr=$this->security->xss_clean($this->input->post());
            
            $start_date = $arr['start_date'];
            $end_date = $arr['end_date'];
            
            $page_data['page_name']  = 'mts_report';
            $page_data['page_title'] = 'Maintenance Report';
            $page_data['data'] = $this->data($start_date,$end_date);
            $page_data['start_date'] = $start_date;
            $page_data['end_date'] = $end_date;
            $this->load->view('admin/common', $page_data);
        }
    }
	
    private function data($start_date,$end_date){
        
        $start_date = date('Y-m-d 00:00:00',strtotime($start_date));
        $end_date = date('Y-m-d 23:59:59',strtotime($end_date));
        
        $m = $this->db->order_by('id','asc')->select('id as m_id,h_no,name')->get('member')->result_array();

        $data = array();
        for($i=0;count($m)>$i;$i++){
            $check = $this->db->get_where('mts',array('member_id'=>$m[$i]['m_id'],'created_at >='=>$start_date,'created_at <='=>$end_date))->row_array();
            if($check>0){
                $data[$i] = array_merge($m[$i],$check);
            }else{
                $data[$i] = $m[$i];
            }
        }
// echo "<pre>";print_r($data);exit;
        return $data;
    }

}