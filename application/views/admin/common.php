<?php 
$this->load->view('admin/include/sidebar.php');
$this->load->view('admin/include/navbar.php');

$this->load->view('admin/'.$page_name.'.php');

$this->load->view('admin/include/footer.php');
?>