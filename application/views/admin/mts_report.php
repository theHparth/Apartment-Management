<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $page_title; ?></h1>
    </div>
    <?php  if($this->session->flashdata('flash_message')!=""){$message= $this->session->flashdata('flash_message');  ?>
        <div class="alert alert-<?=$message['class']; ?> alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $message['message']; ?>
        </div>
    <?php  $this->session->set_flashdata('flash_message' , ""); }  ?>
        <div class="card shadow mb-4">
                <div class="card-header py-3" >
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $page_title; ?></h6>
                </div>
                <div class="card-body">
                <form action="<?php echo base_url().'admin/mts_report/fetch_report'?>" method="post">
                    <input type="hidden" id="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="row">
                        <div class="form-group col-md-1"></div>
                        <div class="form-group col-md-3">
                            <label>From Date</label>
                            <input type="date" name="start_date" class="form-control" value="<?php if(isset($start_date)){echo date("Y-m-d",strtotime($start_date));}else{echo date("Y-m-d"); }?>" required/>
                        </div>
                        <div class="form-group col-md-3">
                            <label>To Date</label>
                            <input type="date" name="end_date" class="form-control" value="<?php if(isset($end_date)){echo date("Y-m-d",strtotime($end_date));}else{echo date("Y-m-d"); }?>" required/>
                        </div>
                       
                        <div class="form-group col-md-2">
                            <button class="btn btn-primary" style="margin-top:31px;" type="submit">Search</button>
                        </div>
                    </div>
                </form>
                    <?php if(isset($data)) {?>
                    <div class="table-responsive" style="overflow-x:auto;">
                        <table id="table1" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Member</th>
                                    <th>Maintenance</th>
                                    <th>Pre. Main.</th>
                                    <th>Lift</th>
                                    <th>Kitchen</th>
                                    <th>Late Fees</th>
                                    <th>Transfer Fees</th>
                                    <th>Other</th>
                                    <th>Total</th>
                                    <th>Payment Type</th>
                                    <th>Txn ID/ Cheque</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i=1;
                                foreach($data as $data):
                                ?>
                                    <tr>
                                        <td><?=$i;?></td>
                                        <td><?=$data['h_no']." - ".$data['name']; ?></td>
                                        <td><?php if(isset($data['mts'])){ echo $data['mts'];} ?></td>
                                        <td><?php if(isset($data['pr_mts'])){ echo $data['pr_mts'];} ?></td>
                                        <td><?php if(isset($data['lift_mts'])){ echo $data['lift_mts'];} ?></td>
                                        <td><?php if(isset($data['kitchen_mts'])){ echo $data['kitchen_mts'];} ?></td>
                                        <td><?php if(isset($data['late_fee'])){ echo $data['late_fee'];} ?></td>
                                        <td><?php if(isset($data['transfer_fee'])){ echo $data['transfer_fee'];} ?></td>
                                        <td><?php if(isset($data['other'])){ echo $data['other'];} ?></td>
                                        <td><?php if(isset($data['total'])){ echo $data['total'];} ?></td>
                                        <td><?php if(isset($data['pay_type'])){ echo $data['pay_type'];} ?></td>
                                        <td><?php if(isset($data['txn_id'])){ echo $data['txn_id'];} ?></td>
                                        <td><?php if(isset($data['created_at'])){ echo date('d-m-Y',strtotime($data['created_at']));} ?></td>
                                    </tr>
                                <?php
                                    $i++;
                                    endforeach;
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Member</th>
                                    <th>Maintenance</th>
                                    <th>Pre. Main.</th>
                                    <th>Lift</th>
                                    <th>Kitchen</th>
                                    <th>Late Fees</th>
                                    <th>Transfer Fees</th>
                                    <th>Other</th>
                                    <th>Total</th>
                                    <th>Payment Type</th>
                                    <th>Txn ID/ Cheque</th>
                                    <th>Date</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <?php } ?>
                </div>
        </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table1').DataTable({
            lengthChange: false,
            dom: 'Bfrtip',
            buttons: {
                name: 'primary',
                buttons: [ 'copy','print', 'csv', 'excel', 'pdf', 'colvis' ]
            }
        });
    });
</script>