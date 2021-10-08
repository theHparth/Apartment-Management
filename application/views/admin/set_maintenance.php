<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?=$page_title." of ".date('F, Y');?></h1>
    </div>
    
    <?php  if($this->session->flashdata('flash_message')!=""){$message= $this->session->flashdata('flash_message'); ?>
       
        <div class="alert alert-<?=$message['class']; ?> alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $message['message']; ?>
        </div>
        
    <?php
         $this->session->set_flashdata('flash_message' , "");
                }
     ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?=$page_title;?></h6>
                </div>
                
                    <div class="card-body">
                        <form role="form" id="form" action="<?php if(!isset($row_data)){ echo site_url('#'); }else{ echo site_url('admin/set_maintenance/update'); }?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                           
                            <div class="row">
                                
                            <div class="form-group col-md-6">
                                <label>Maintenance *</label>
                                <input type="number" name="mts_value" class="form-control" value="<?php if(isset($row_data)){ echo $row_data['mts_value']; } ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Lift Maintenance *</label>
                                <input type="number" name="lift" class="form-control" value="<?php if(isset($row_data)){ echo $row_data['lift']; } ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Kitchen Maintenance *</label>
                                <input type="number" name="kitchen" class="form-control" value="<?php if(isset($row_data)){ echo $row_data['kitchen']; } ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Late Fees *</label>
                                <input type="number" name="late" class="form-control" value="<?php if(isset($row_data)){ echo $row_data['late']; } ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Transfer Fees *</label>
                                <input type="number" name="transfer" class="form-control" value="<?php if(isset($row_data)){ echo $row_data['transfer']; } ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Other *</label>
                                <input type="number" name="other" class="form-control" value="<?php if(isset($row_data)){ echo $row_data['other']; } ?>" required>
                            </div>     
                                
                            </div>
                            <div class="row float-right m-3">
                                <input type="submit" id="submit" class="btn btn-outline-primary" value="Update">
                            </div>
                        </form>
                    </div>
              
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Set Maintenance Report</h6>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table1" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Maintenance</th>
                                    <th>Lift</th>
                                    <th>Kitchen</th>
                                    <th>Late Fees</th>
                                    <th>Transfer Fees</th>
                                    <th>Other</th>
                                    <th>Entry Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i=1;
                                foreach($data as $data):
                                ?>
                                    <tr>
                                        <td><?=$i;?></td>
                                        <td><?=$data['mts_value']; ?></td>
                                        <td><?=$data['lift']; ?></td>
                                        <td><?=$data['kitchen']; ?></td>
                                        <td><?=$data['late']; ?></td>
                                        <td><?=$data['transfer']; ?></td>
                                        <td><?=$data['other']; ?></td>
                                        <td><?=date('d-m-Y',strtotime($data['created_at'])); ?></td>
                                    </tr>
                                <?php
                                    $i++;
                                    endforeach;
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Maintenance</th>
                                    <th>Lift</th>
                                    <th>Kitchen</th>
                                    <th>Late Fees</th>
                                    <th>Transfer Fees</th>
                                    <th>Other</th>
                                    <th>Entry Date</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table1').DataTable({});
        
    });
</script>