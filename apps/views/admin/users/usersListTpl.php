<div class="row">
    <div class="col-sm-12"><h3>User Management</h3></div>
  <div class="col-sm-12">
  <div class="panel panel-default">
    <div class="panel-heading">
      <div>
        <form action="<?php echo site_url('adminUsers/index');?>" method="post" class="form-inline">
          <div class="form-group">            
            <input type="text" maxlength="15" class="form-control input-sm" value="<?php echo $searchArray["firstName"];?>" id="first_name" name="first_name" placeholder="Firstname">
          </div>

            <div class="form-group">
            <select class="form-control" id="filters_status" name="filters_status">
                <option value="-1">All</option>
                <option value="1" <?php if($searchArray["status"] == 1){echo "selected";}?>>Active</option>
                <option value="0" <?php if($searchArray["status"] == 0){ echo "selected";}?>>Inactive</option>
              </select>
          </div>
            
          <button type="submit" class="btn btn-success btn-sm">Search</button>
          <a href="<?php echo site_url('adminUsers/index');?>" class="btn btn-primary btn-sm" style="margin-right:10px">Refresh</a>
          <a href="<?php echo site_url('adminUsers/add');?>" class="btn btn-warning btn-md pull-right">Add New User</a>
        </form>

      </div>
    </div>
    <div >
      
        <div class="table-resposive">
        <table class="table table-hover table-striped">
          <thead>
            <tr>
              <th width="1%">SNo.</th>
              <th  width="2%"></th>
              <th>Name</th>
              <th>Email</th>
              <th>Type</th>
              <th>Country</th>
              <th>Created Date</th>
              <th>Status</th>
              <th width="15%">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if($pagination['getNbResults']){ $i=$startLimit;?>
              <?php foreach($usersData as $kData){

                                    $image  = $kData->profile_picture;

                                    if($image != "" && file_exists(FCPATH.'assets\upload\users\\'.$kData->id.'\\'.$image)){
                                            $imagePath 	= base_url()."assets/upload/users/".$kData->id."/thumb120_".$image;
                                    }else{
                                            $imagePath 	= base_url()."assets/images/friend_request.png";
                                    }

                  ?>
                <tr>
                  <td><?php echo ++$i;?></td>
                  <td><img src="<?php echo $imagePath;?>" height="20" width="20" /></td>
                  <td><?php echo ucwords($kData->fname." ".$kData->lname);?></td>
                  <td><?php echo $kData->email;?></td>
                  <td><?php echo $kData->type_account; ?></td>
                  <td><?php echo $kData->contry_name; ?></td>
                 
                  <td><?php echo $kData->created_date;?></td>
                  <td><?php if($kData->status == 0) echo "Inactive"; else echo "Active";?></td>

                  <td>
                      <a class="btn btn-warning btn-sm" href="<?php echo site_url("adminUsers/viewUser"); ?>?id=<?php echo $kData->id; ?>" title="View"><i class="fa fa-caret-square-o-down"></i></a>
                    <a class="btn btn-info btn-sm" href="<?php echo site_url('adminUsers/editUser?id='.$kData->id)?>" title="Edit"><i class="fa fa-edit"></i></a>
                    <a onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm" href="<?php echo site_url('adminUsers/deleteUser?id='. $kData->id); ?>" title="Delete"><i class="fa fa-trash-o"></i></a>
                  </td>
                </tr>
              <?php } } else{ ?>
            <tr>
              <td colspan="9"><div class="alert alert-info text-center">No Record Found!<a class="close" data-dismiss="alert">x</a></td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </div>
      
    </div>
  </div>
  <div class="col-md-12">
     <?php if($pagination['haveToPaginate']){ ?>
        <?php $this->load->view('admin/_paging',array('paginate'=>$pagination,'siteurl'=>'adminUsers/index','varExtra'=>$searchArray)); ?>
        <?php } ?>
        </div>
</div>
</div>