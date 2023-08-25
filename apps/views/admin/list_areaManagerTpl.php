<div class="app-content  my-3 my-md-5">
   <div class="side-app">
      <div class="row">
         <div class="col-md-12 col-lg-12">
            <div class="card">
               <div class="card-header">
                  <h3 class="card-title">Area Managers</h3>
                  <div class="card-options">
                     <a href="<?php echo site_url('adminDashboard/add_areaManager') ?>" id="add__new__list" class="btn btn-sm btn-success " ><i class="fa fa-plus"></i> Add New Area Manager</a>
                  </div>
               </div>

                    
               <div class="card-body">
                  <?php $this->load->view('admin/_topmessage'); ?>

                  <form action="" method="get" class="form-inline">
                     <div class="form-group">
                        <p><b>Search By Name / Email / Mobile :&nbsp; </b></p>
                        <input type="text" class="form-control input-lg" name="search" value="<?php echo !empty($search)?$search:''?>" />
                     </div>
                     <button type="submit" class="btn btn-success btn-sm" style="margin-left:10px">Search</button>
                     <a href="<?php echo site_url('adminDashboard/list_areaManager'); ?>" class="btn btn-primary btn-sm" style="margin-left:10px">Refresh</a>
                  </form>
                  <br/>
                  
                  <div class="table-responsive" style="overflow-x: auto;">
                        <table class="table table-hover card-table table-striped table-vcenter table-outline table-responsive">
                          <thead class="bg-info">
                              <tr>
                                 <th>Sr. No</th>
                                 <th>First Name</th>
                                 <th>Last Name</th>
                                 <th>Email</th>
                                 <th>Mobile</th>
                                 <th>Created Date</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                                 if(count($area_managers)>0)
                                 {
                                    if ($pagination['getNbResults']) 
                                    {
                                       $j=$startLimit+1;
                                       for($i=0;$i<count($area_managers);$i++)
                                       {

                                          echo "<tr>";
                                             echo "<td>".$j."</td>";
                                             echo "<td>".$area_managers[$i]['fname']."</td>";
                                             echo "<td>".$area_managers[$i]['lname']."</td>";
                                             echo "<td>".$area_managers[$i]['email']."</td>";
                                             echo "<td>".$area_managers[$i]['mobile']."</td>";
                                             echo "<td>".$area_managers[$i]['created_date']."</td>";
                                             echo "<td>";
                                                if($area_managers[$i]['status']==1)
                                                { 
                                                   // echo '<span class="tag tag-lime">Active</span>';
                                                   echo '<a style="color:#fff" class="btn btn-success btn-sm status_btn" id="'.$area_managers[$i]['id'].'" data-status="0">Active</a>';
                                                }
                                                else
                                                { 
                                                   // echo '<span class="tag tag-red">Inactive</span>';
                                                   echo '<a style="color:#fff" class="btn btn-sm btn-danger status_btn" id="'.$area_managers[$i]['id'].'" data-status="1">Inactive</a>';
                                                }
                                             echo "</td>";
                                             echo "<td>";
                                             ?>
                                                <a href="<?php echo site_url('adminDashboard/load_edit_profile/'.$area_managers[$i]['id'])?>" class='btn btn-secondary btn-sm'><i class="fa fa-edit"></i>Edit</a>
                                                <!-- <a href="<?php //echo site_url('adminDashboard/delete_profile/'.$area_managers[$i]['id'])?>"  id="<?php echo $area_managers[$i]['id'] ; ?>" class='btn btn-danger btn-sm delete_profile' onclick="return confirm('Are you sure?')" ><i class="fa fa-trash"></i> Delete</a> -->

                                             <?php
                                             echo "</td>";


                                          echo "</tr>";
                                          $j++;
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
                      <?php 
                        if($pagination['haveToPaginate'])
                           { ?>
                             <?php $this->load->view('admin/_paging',array('paginate'=>$pagination,'siteurl'=>'/adminDashboard/list_areaManager','varExtra'=>$filtres)); ?>
                           <?php 
                           } 
                        ?> 
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
            data:{'userid':id,'status':status},
            url :"<?php echo site_url('adminDashboard/ban_user');?>",
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
