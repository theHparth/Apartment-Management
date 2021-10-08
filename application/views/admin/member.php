<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?=$page_title;?></h1>
    </div>
    
    <?php  if($this->session->flashdata('flash_message')!=""){$message= $this->session->flashdata('flash_message');  ?>
    
                    <div class="alert alert-<?=$message['class']; ?> alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php echo $message['message']; ?>
                    </div>
                    
    <?php  $this->session->set_flashdata('flash_message' , ""); }  ?>
                
            <div class="card shadow mb-4">
                <a href="#collapseCardExample" class="d-block card-header py-3 <?php if(!isset($row_data)){ echo 'collapsed'; } ?>" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary"><?=$page_title;?></h6>
                </a>
                <div class="collapse <?php if(isset($row_data)){ echo 'show'; } ?>" id="collapseCardExample">
                    <div class="card-body">
                        <form role="form" id="form" action="<?php if(!isset($row_data)){ echo site_url('admin/member/create'); }else{ echo site_url('admin/member/update/'.$row_data['id']); }?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>House Number *</label>
                                    <input type="text" name="h_no" class="form-control" value="<?php if(isset($row_data)){ echo $row_data['h_no']; } ?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Name *</label>
                                    <input type="text" name="name" class="form-control" value="<?php if(isset($row_data)){ echo $row_data['name']; } ?>" required>
                                </div>
                                
                                <!-- <div class="form-group col-md-6">
                                    <label>Mobile *</label>
                                    <input type="number" name="mobile" class="form-control" value="<?php if(isset($row_data)){ echo $row_data['mobile']; } ?>" required>
                                </div> -->
                            </div>
                            <div class="row float-right m-3">
                                <input type="submit" id="submit" class="btn btn-primary" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Member Report</h6>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table1" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Action</th>
                                    <th>House No.</th>
                                    <th>Name</th>
                                    <!-- <th>Mobile</th> -->
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
                                        <td>
                                            <a href="<?php echo site_url('admin/member/edit/'.$data['id']); ?>"><i class="fa fa-pencil text-warning" aria-hidden="true">Edit</i></a><br>
                                            <!-- <a href="<?php echo site_url('admin/member/delete/'.$data['id']); ?>"><i class="fa fa-trash fa-2x text-danger" aria-hidden="true" onclick="return confirm('Are you sure to delete?');"></i></a><br> -->
                                        </td>
                                        <td><?=$data['h_no']; ?></td>
                                        <td><?=$data['name']; ?></td>
                                        <!-- <td><?=$data['mobile']; ?></td> -->
                                        <td><?=date('d-m-Y',strtotime($data['created_at'])); ?></td>
                                    </tr>
                                <?php
                                    $i++;
                                    endforeach;
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Action</th>
                                    <th>House No.</th>
                                    <th>Name</th>
                                    <!-- <th>Mobile</th> -->
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