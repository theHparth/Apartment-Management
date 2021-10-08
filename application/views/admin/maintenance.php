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
            <form role="form" id="form" action="<?php if(!isset($row_data)){ echo site_url('admin/maintenance/create'); }else{ echo site_url('admin/member1/update/'.$row_data['id']); }?>" method="post" enctype="multipart/form-data">
            <input type="hidden" id="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <input type="hidden" name="value_id" value="<?php echo $mdata['id']; ?>">    
                <div class="row">
                  <div class="col-md-6">  
                    <div class="form-group">
                        <label>Maintenance *</label>
                        <input type="number" name="mts" class="form-control c" value="<?php if(isset($mdata)){ echo $mdata['mts_value']; }else{ echo 0;} ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Lift Maintenance *</label>
                        <input type="number" name="lift_mts" class="form-control c" value="<?php if(isset($mdata)){ echo $mdata['lift']; }else{ echo 0;} ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Kitchen Maintenance *</label>
                        <input type="number" name="kitchen_mts" class="form-control c" value="<?php if(isset($mdata)){ echo $mdata['kitchen']; }else{ echo 0;} ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Late Fees *</label>
                        <input type="number" name="late_fee" class="form-control c" value="<?php if(isset($mdata)){ echo $mdata['late']; }else{ echo 0;} ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Transfer Fees *</label>
                        <input type="number" name="transfer_fee" class="form-control c" value="<?php if(isset($mdata)){ echo $mdata['transfer']; }else{ echo 0;} ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Previous Maintenance *</label>
                        <input type="number" name="pr_mts" class="form-control c" id="pr_mts" value="<?php if(isset($row_data)){ echo $mdata['pr_mts']; }else{ echo 0;} ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Other *</label>
                        <input type="number" name="other" class="form-control c" value="<?php if(isset($mdata)){ echo $mdata['other']; }else{ echo 0;} ?>" required>
                    </div>     
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Member *</label>
                        <select name="member_id" id="member_id" class="form-control" required>
                            <option value="">--select member--</option>
                            <?php foreach ($member as $member) { ?>
                            <option value="<?=$member['id'];?>" <?php if(isset($row_data)&& $row_data['member_id']==$member['id']){ echo 'selected'; } ?> ><?=$member['h_no'].", ".$member['name'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Payment Type * </label>
                        <select name="pay_type" class="form-control" required>
                            <option value="CASH" <?php if(isset($row_data)&& $row_data['pay_type']=='CASH'){ echo 'selected'; } ?> >CASH</option>
                            <option value="Cheque" <?php if(isset($row_data)&& $row_data['pay_type']=='Cheque'){ echo 'selected'; } ?> >Cheque</option>
                            <option value="Online" <?php if(isset($row_data)&& $row_data['pay_type']=='Online'){ echo 'selected'; } ?> >Online</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Cheque/DD/Tran. Number *</label>
                        <input type="text" name="txn_id" class="form-control" value="<?php if(isset($row_data)){ echo $row_data['txn_id']; }else{ echo 0;} ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Total *</label>
                        <input type="number" name="total" class="form-control total" value="" readonly required>
                    </div>
                    <div class="form-group">
                        <label>Remark</label>
                        <textarea name="remark" class="form-control"><?php if(isset($row_data)){ echo $row_data['remark']; } ?></textarea>
                    </div>
                  </div>  
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
                    <h6 class="m-0 font-weight-bold text-primary">Maintenance Report</h6>
                </div>
                
                <div class="card-body">
                <form action="<?php echo base_url().'admin/maintenance/fetch_report';?>" method="post">
                <input type="hidden" id="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div class="row">
                        <!-- <div class="form-group"></div> -->
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
                    <div class="table-responsive">
                        <table id="table1" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Action</th>
                                    <th>Member</th>
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
                                    <th>Remark</th>
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
                                            <?php if($data['status'] == 'SUCCESS'){ ?>
                                            <a href="<?php echo base_url().'admin/maintenance/receipt/'.base64_encode($data['id'])?>" class="btn btn-info my-1" target="_blank" role="button">Receipt</a>
                                            <?php }?>
                                        </td>
                                        <td><?=$data['h_no'].", ".$data['name']; ?></td>
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
                                        <td><?=$data['remark']; ?></td>
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
                                    <th>Member</th>
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
                                    <th>Remark</th>
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
<script type="text/javascript">
    var $loading = $('.preloader').hide();
    $(document)
      .ajaxStart(function () {
        $loading.show();
      })
      .ajaxStop(function () {
        $loading.hide();
    });
    $(document).ready(function(){
            var total = 0;
            for(var i=0; i<$('.c').length; i++){
                if($($('.c')[i]).val()>0){
                    total = total + parseFloat($($('.c')[i]).val());
                }
            }
            $('.total').val(total.toFixed(2));
        
    });
    $(document).ready(function(){
        $('.c').keyup(function(){
            var total = 0;
            for(var i=0; i<$('.c').length; i++){
                if($($('.c')[i]).val()>0){
                    total = total + parseFloat($($('.c')[i]).val());
                }
            }
            $('.total').val(total.toFixed(2));
        });
    });
    var sitepath='<?php echo base_url()?>';
    $("#member_id").change(function(){
        var member_id = $("#member_id").val();
        // alert('hello');
        // console.log('123');
            $.ajax({
                url: sitepath + "admin/maintenance/mts_values",
                method: 'GET',
                data:{member_id: member_id},
            
                success:function(data)
                {
                    console.log(data);
                    if(data != false)
                    {
                        if(data>0){
                            alert("Previous Maintenance : "+ data);
                            $("#pr_mts").val(data);
                            var total = 0;
                            for(var i=0; i<$('.c').length; i++){
                                if($($('.c')[i]).val()>0){
                                    total = total + parseFloat($($('.c')[i]).val());
                                }
                            }
                            $('.total').val(total.toFixed(2));
                        }
                        
                    }else{
                        alert("Member Does Not Found.");
                        $("#member_id").val("");
                    }
                }
            });
        
    });
</script>