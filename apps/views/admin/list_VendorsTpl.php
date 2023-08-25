<div class="app-content  my-3 my-md-5">
   <div class="side-app">
      <div class="row">
         <div class="col-md-12 col-lg-12">
            <div class="card">
               <div class="card-header">
                  <h3 class="card-title">Vendors</h3>
                  <?php 
                  $sessionData = $this->session->userdata('adminSession');
                  $userType =  $sessionData['usertype']; 
                  if($userType=='admin' || $userType=='area_manager'){?>
                   <div class="card-options">
                     <a href="<?php echo site_url('adminDashboard/add_vendor') ?>" id="add__new__list" class="btn btn-sm btn-success " ><i class="fa fa-plus"></i> Add New Vendor</a>
                  </div>
               <?php } ?>              
            </div>


            <div class="card-body">
               <?php $this->load->view('admin/_topmessage'); ?>

               <form action="" method="get" class="form-inline">
                  <div class="form-group">
                     <p><b>Search By Name / Email / Mobile / Company :&nbsp; </b></p>
                     <input type="text" class="form-control input-sm" name="search" placeholder="Search" value="<?php echo !empty($search)?$search:''?>" />
                  </div>
                  <button type="submit" class="btn btn-success btn-sm" style="margin-left:10px">Search</button>
                  <a href="<?php echo site_url('adminDashboard/list_vendor'); ?>" class="btn btn-primary btn-sm" style="margin-left:10px">Refresh</a>
               </form>
               <br/>

               <div class="table-responsive" style="overflow-x: auto;">
                  <table class="table table-hover card-table table-striped table-vcenter table-outline table-responsive">
                   <thead class="bg-info">
                     <tr>
                        <th>Sr. No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Company</th>
                        <!-- <th>City</th> -->
                        <th>Created Date</th>
                        <?php if ($userType=='admin' || $userType =='area_manager') {?>
                           <th>Status</th>
                           <th>Action</th>
                        <?php } ?>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     if(count($vendors)>0)
                     {
                        if ($pagination['getNbResults']) 
                        {
                           $j=$startLimit;
                           for($i=0;$i<count($vendors);$i++)
                           {
                              echo "<tr>";
                              echo "<td>".++$j."</td>";
                              echo "<td>".$vendors[$i]['vendor_name']."</td>";
                              echo "<td>".$vendors[$i]['email']."</td>";
                              echo "<td>".$vendors[$i]['mobile_no']."</td>";
                              echo "<td>".$vendors[$i]['company']."</td>";
                              echo "<td>".$vendors[$i]['created_at']."</td>";
                              if ($userType=='admin' || $userType =='area_manager'){
                              echo "<td>";
                                 if($vendors[$i]['status']==1)
                                 { 
                                    echo '<a style="color:#fff" class="btn btn-success btn-sm status_btn" id="'.$vendors[$i]['vendor_id'].'" data-status="0">Active</a>';
                                 }
                                 else
                                 { 
                                    echo '<a style="color:#fff" class="btn btn-sm btn-danger status_btn" id="'.$vendors[$i]['vendor_id'].'" data-status="1">Inactive</a>';
                                 }
                              echo "</td>";
                              }
                              echo "<td>";
                              ?>
                              <?php if ($userType=='admin' || $userType=='area_manager'){?>
                                 <a href="<?php echo site_url('adminDashboard/load_edit_vendor/'.$vendors[$i]['vendor_id'])?>" class='btn btn-secondary btn-sm'><i class="fa fa-edit"></i>Edit</a>
                              <?php } ?>

                              <!-- <a href="<?php //echo site_url('adminDashboard/delete_vendor/'.$vendors[$i]['vendor_id'])?>"  id="<?php echo $vendors[$i]['vendor_id'] ; ?>" class='btn btn-danger btn-sm delete_profile' onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Delete</a> -->

                              <?php
                              echo "</td>";
                              echo "</tr>";
                                          // $j++;
                           }
                        }   
                     }
                     else
                     {
                        echo '<tr>';
                        echo "<td colspan='8' style='text-align:center'> Data Not Available</td>"; 
                        echo '</tr>';
                     }
                     ?>      
                  </tbody>
               </table>
               <div>
                  <?php 
                  if($pagination['haveToPaginate'])
                     { ?>
                      <?php $this->load->view('admin/_paging',array('paginate'=>$pagination,'siteurl'=>'/adminDashboard/list_vendor','varExtra'=>$filtres)); ?>
                      <?php 
                   } 
                   ?>  
                </div>
             </div>                        
          </div>
       </div>
    </div>
 </div>

</div>
<?php $this->load->view('admin/footer'); ?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
      $('.status_btn').click(function(){
         var id = $(this).attr('id');
         var status = $(this).attr('data-status');
         $.ajax({
            type:'post',
            data:{'vendor_id':id,'status':status},
            url :"<?php echo site_url('adminDashboard/ban_vendor');?>",
            success:function(res)
            {
               console.log(res);
               if(res == '1')
               {
                  location.reload();
               }
               else
               {
                  alert('Something went wrong. Try again later');
               }
            }
         })
      });
   });
</script>