<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Common_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    public function validate_user(){
        $validate = $this->db->get_where('user',array('id'=>$this->session->userdata('user_id'),'status'=>'A'))->num_rows();
        if($validate==1){
            return true;
        }else{
            return false;
        }
    }    
}
?>