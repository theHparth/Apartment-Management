<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $page_title; ?></title>
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/docs/DataTables-1.10.21/css/jquery.dataTables.min.css');?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/docs/Buttons-1.6.2/css/buttons.dataTables.min.css');?>"/>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

    <!--jquery-->
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
   
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />-->
</head>

<body id="page-top">
<div class="preloader">
    <div style="background-color: rgba(42, 81, 196, 0.1);top:0;left:0;position: fixed;z-index: +100 !important;width: 100%;height:100%;">
        <div class="spinner-border text-success" style="border-right-color: #007bff;border-left-color: #ffc107;border-top-color: #dc3545;width:30px;height:30px;position:fixed;top:49%;left:49%;padding:2px;" role="status">
          <span class="sr-only">Loading...</span>
        </div>
    </div>
</div> 
<script type="text/javascript">
jQuery(document).ready(function($) {  
    $('.preloader').hide();
    $(window).load(function(){
        $('.preloader').fadeOut('slow',function(){
    	    $(this).remove();
    	});
    });
});
</script>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <?php $page_name = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
            <input type="hidden" id="site-path" value="<?=$page_name;?>" />
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('admin/dashboard'); ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3"><sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin/dashboard'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin/member'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Member</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin/set_maintenance'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Set Maintenance</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin/maintenance'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Add Maintenance</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin/member_data'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Member Data</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('admin/mts_report'); ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Maintenance Report</span></a>
            </li>
            <hr class="sidebar-divider">
            
            <!--fa-wrench-->
            <!-- Divider -->
            <!-- <hr class="sidebar-divider"> -->


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
<!--fontawesome cdn-->
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<script>
    var path = $("#site-path").val();
    $(document).ready(function() {
        $("#accordionSidebar a").each(function(index, element) {
            if ($(element).attr('href') == path) 
            {
                if ($(element).hasClass('collapse-item') == true) 
                {
                    $(element).parent().parent().parent().addClass("active");
                    $(element).parent().parent().addClass("show");
                    $(element).addClass("active");
                } else {
                    $(element).parent().addClass("active");
                }
            }
        });
    });
    $( document ).ready(function() {$("#content").after('<footer class="sticky-footer bg-white"><div class="container my-auto"><div class="copyright text-center my-auto"><span>Copyright © <i class="fab fa-btc"></i> <i class="fab fa-btc"></i> 2021</span></div></div></footer>');});
</script>