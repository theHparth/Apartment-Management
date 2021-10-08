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
                <form action="<?php echo base_url().'admin/member_data/search_member'?>" method="post">
                    <input type="hidden" id="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="row">
                        <div class="form-group col-md-5">
                          <label>Member name</label>
                          <select class="form-control" name="member_id" required>
                            <option value="">--select member--</option>
                            <?php foreach($member as $m){ ?>
<option value="<?=$m['id'];?>" <?php if(isset($member_id) && $member_id==$m['id']){echo "selected";}?>><?=$m['h_no']." - ".$m['name'];?></option>
                            <?php } ?>
                          </select>
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
                                    <th>Date</th>
                                    <th>Maintenance</th>
                                    <th>Previous Main.</th>
                                    <th>Lift</th>
                                    <th>Kitchen</th>
                                    <th>Late Fees</th>
                                    <th>Transfer Fees</th>
                                    <th>Other</th>
                                    <th>Total</th>
                                    <th>Payment Type</th>
                                    <th>Txn ID/ Cheque</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i=1;
                                foreach($data as $data):
                                ?>
                                    <tr>
                                        <td><?=$i;?></td>
                                        <td><?=date('d-m-Y h:i A',strtotime($data['created_at'])); ?></td>
                                        <td><?=$data['mts']; ?></td>
                                        <td><?=$data['pr_mts']; ?></td>
                                        <td><?=$data['lift_mts']; ?></td>
                                        <td><?=$data['kitchen_mts']; ?></td>
                                        <td><?=$data['late_fee']; ?></td>
                                        <td><?=$data['transfer_fee']; ?></td>
                                        <td><?=$data['other']; ?></td>
                                        <td><?=$data['total']; ?></td>
                                        <td><?=$data['pay_type']; ?></td>
                                        <td><?=$data['txn_id']; ?></td>
                                    </tr>
                                <?php
                                    $i++;
                                    endforeach;
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Date</th>
                                    <th>Maintenance</th>
                                    <th>Previous Main.</th>
                                    <th>Lift</th>
                                    <th>Kitchen</th>
                                    <th>Late Fees</th>
                                    <th>Transfer Fees</th>
                                    <th>Other</th>
                                    <th>Total</th>
                                    <th>Payment Type</th>
                                    <th>Txn ID/ Cheque</th>
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
            // lengthChange: false,
            // dom: 'Bfrtip',
            // buttons: {
            //     name: 'primary',
            //     buttons: [ 'copy','print', 'csv', 'excel', 'pdf', 'colvis' ]
            // }
        });
    });
</script>