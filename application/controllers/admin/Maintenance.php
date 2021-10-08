<?php

class Maintenance extends CI_Controller {
    
    function __construct()
	{
		parent::__construct();
        $this->load->library('date_time');
        $this->load->model('common_model');
	    
	    if ($this->session->userdata('login_status')!= 1 || $this->session->userdata('user_id') =="" || $this->common_model->validate_user()==false || $this->session->userdata('user_type')!='Admin' ){
            redirect(site_url('login'),'refresh');
	    }
	}
	
	public function index(){
	    $page_data['page_name']  = 'maintenance';
        $page_data['page_title'] = 'Add Maintenance';
        $page_data['member'] = $this->db->order_by('h_no','asc')->get('member')->result_array();
        $page_data['mdata'] = $this->db->get_where('mts_value',array('EXTRACT(year_month from created_at)='=>date('Ym')))->row_array();
        $page_data['data'] = $this->db->order_by('mts.id','desc')->limit(10)->select('mts.*,m.name,m.h_no,m.mobile')->join('member m','mts.member_id=m.id','left')->get('mts')->result_array();
        if(!empty($page_data['mdata'])){
            $this->load->view('admin/common', $page_data);
        }else{
            $message = array('message'=>'Please, set maintenance of this month.', 'class'=>'success');
            $this->session->set_flashdata('flash_message',$message);
            redirect(site_url('admin/set_maintenance'),'refresh');
        }
        
	}
	
	public function create(){
	    $this->form_validation->set_rules('value_id', 'Maintenance id', 'trim|numeric|required|max_length[10]');
        $this->form_validation->set_rules('member_id', 'Member', 'trim|numeric|required|max_length[10]');
        $this->form_validation->set_rules('mts', 'Maintenance', 'trim|numeric|max_length[10]');
        $this->form_validation->set_rules('pr_mts', 'Previous Maintenance', 'trim|numeric|max_length[10]');
        $this->form_validation->set_rules('lift_mts', 'Lift Maintenance', 'trim|numeric|max_length[10]');
        $this->form_validation->set_rules('kitchen_mts', 'Kitchen Maintenance', 'trim|numeric|max_length[10]');
        $this->form_validation->set_rules('late_fee', 'Late Fees', 'trim|numeric|max_length[10]');
        $this->form_validation->set_rules('transfer_fee', 'Transfer Fees', 'trim|numeric|max_length[10]');
        $this->form_validation->set_rules('other', 'Other', 'trim|numeric|max_length[10]'); 
        $this->form_validation->set_rules('total', 'Total', 'trim|required|numeric|max_length[10]'); 
        $this->form_validation->set_rules('pay_type', 'Pay type', 'trim|max_length[20]');
        $this->form_validation->set_rules('remark', 'Remark', 'trim|max_length[300]'); 
        $this->form_validation->set_rules('txn_id', 'Tran.Number or Cheque no.', 'trim|numeric|max_length[150]'); 
        if($this->form_validation->run() == false){
            $message = array('message'=>validation_errors(), 'class'=>'danger');
        }else{
        
            $post = $this->security->xss_clean($this->input->post());
            $data['mts'] = $post['mts'];
            $data['value_id'] = $post['value_id'];
            $data['member_id'] = $post['member_id'];
            $data['pr_mts'] = $post['pr_mts'];
            $data['lift_mts'] = $post['lift_mts'];
            $data['kitchen_mts'] = $post['kitchen_mts'];
            $data['late_fee'] = $post['late_fee'];
            $data['transfer_fee'] = $post['transfer_fee'];
            $data['other'] = $post['other'];
            $data['total'] = $post['total'];
            $data['pay_type'] = $post['pay_type'];
            $data['txn_id'] = $post['txn_id'];
            $data['remark'] = $post['remark'];
            $data['date'] = date('Y-m-d');
            $data['user_id'] = $this->session->userdata('user_id');
            $data['created_at'] = $this->date_time->date();

    $check = $this->db->get_where('mts',array('member_id'=>$data['member_id'],'value_id'=>$data['value_id']))->num_rows();
            if($check==0){
                $insert = $this->db->insert('mts',$data);
                
                if(isset($insert)){
                    $message = array('message'=>'Maintenance Added Successfully.', 'class'=>'success');
                }else{
                    $message = array('message'=>'Failed to Add Maintenance.', 'class'=>'danger');
                }
            }else{
                $message = array('message'=>'Already Added Maintenance in This Month.', 'class'=>'danger');
            }
        }
        $this->session->set_flashdata('flash_message',$message);
        redirect(site_url('admin/maintenance'),'refresh');
	}
	
    public function receipt($id)
    {
        $id = $this->security->xss_clean($id);
        $param = base64_decode($id);
        $rechdata = $this->db->get_where('mts',array('id'=>$param))->num_rows();
        if($rechdata==1){
            $page_data['data'] = $this->db->select('mts.*,m.name,m.h_no,m.mobile')->join('member m','mts.member_id=m.id','left')->get_where('mts',array('mts.id'=>$param))->row_array();
            $this->load->view('receipt.php', $page_data);
        }else{
            $message = array('message'=>'Data invalid or Something went wrong.', 'class'=>'danger');
            $this->session->set_flashdata('flash_message',$message);
            redirect(site_url('admin/maintenance'),'refresh');
        }
    }

	public function mts_values()
    {
        $id = $this->security->xss_clean($this->input->get('member_id'));
        $check_member = $this->db->get_where('member',array('id' => $id))->row_array();
        if(count($check_member)>0){
$sql = $this->db->select('sum(mts_value) as pr_amount')->get_where('mts_value',array('EXTRACT(year_month from created_at)!='=>date('Ym')))->row_array();

$m_mts = $this->db->select('sum(mts) as mts,sum(pr_mts) as pr_mts')->get_where('mts',array('member_id'=>$id,'EXTRACT(year_month from created_at)!='=>date('Ym')))->row_array();
            $pr_amount = $sql['pr_amount']-($m_mts['mts']+$m_mts['pr_mts']);
            echo $pr_amount;
        }else{
            echo false;
        }
    }

    public function fetch_report()
    {
        $this->form_validation->set_rules('start_date', 'From Date', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('end_date', 'To Date', 'trim|required|max_length[25]');
         
        if($this->form_validation->run() == false){
            $message = array('message'=>validation_errors(), 'class'=>'danger');
            $this->session->set_flashdata('flash_message',$message);
            redirect(site_url('admin/maintenance'),'refresh');
        }else{
            $arr=$this->security->xss_clean($this->input->post());
            
            $start_date = $arr['start_date'];
            $end_date = $arr['end_date'];
            $start_date = date('Y-m-d 00:00:00',strtotime($start_date));
            $end_date = date('Y-m-d 23:59:59',strtotime($end_date));
            $page_data['page_name']  = 'maintenance';
            $page_data['page_title'] = 'Add Maintenance';
            $page_data['member'] = $this->db->order_by('h_no','asc')->get('member')->result_array();
            $page_data['mdata'] = $this->db->get_where('mts_value',array('EXTRACT(year_month from created_at)='=>date('Ym')))->row_array();
            $page_data['data'] = $this->db->order_by('mts.id','desc')->select('mts.*,m.name,m.h_no,m.mobile')->join('member m','m.id=mts.member_id','left')->get_where('mts',array('mts.created_at >='=>$start_date,'mts.created_at <='=>$end_date))->result_array();
            $page_data['start_date'] = $start_date;
            $page_data['end_date'] = $end_date;
            if(!empty($page_data['mdata'])){
                $this->load->view('admin/common', $page_data);
            }else{
                $message = array('message'=>'Please, set maintenance of this month.', 'class'=>'success');
                $this->session->set_flashdata('flash_message',$message);
                redirect(site_url('admin/set_maintenance'),'refresh');
            }
        }
    }
    
	// public function delete($param=''){
	//     $param=$this->security->xss_clean($param);
	    
	//     $delete = $this->db->delete('Maintenance',array('id'=>$param));
	    
	//     if($delete){
 //            $message = array('message'=>'Maintenance Deleted Successfully.', 'class'=>'success');
 //        }else{
 //            $message = array('message'=>'Failed to Delete Maintenance.', 'class'=>'danger');
 //        }
 //        $this->session->set_flashdata('flash_message',$message);
 //        redirect(site_url('admin/maintenance'),'refresh');
	// }
	
}