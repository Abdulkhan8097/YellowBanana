<div class="row">
    <div class="col-sm-12" ><h3>Category Management</h3></div>
  <div class="col-sm-12">
      <?php $this->load->view('admin/_topmessage'); ?>
  <div class="panel panel-default">      
    <div class="panel-heading">
      <div>
        <form action="<?php echo site_url('AdminCategory/index');?>" method="get" class="form-inline" name="search_list_form" id="search_list_form">
          <div class="form-group">
              <input type="text" maxlength="15" class="form-control input-sm" value="<?php echo $searchArray["name"];?>" id="name" name="name">
          </div>
            <div class="form-group">
                <select class="form-control" id="status" name="status">
                    <option value="-1">All</option>
                    <option value="1" <?php if($searchArray["status"] == 1){echo "selected='selected'";}?>>Active</option>
                    <option value="0" <?php if($searchArray["status"] == 2){echo "selected='selected'";}?>>Inactive</option>
                  </select>
            </div>

            <div class="form-group">
                <select name="pcategory" id="pcategory" class="form-control">
                <option value="-1">Select</option>
                <?php foreach($parentCategory as $data) { ?>
                        <option value="<?php echo $data->id; ?>" <?php if($searchArray["pcategory"] == $data->id){echo "selected='selected'";}?>><?php echo $data->name; ?></option>
                <?php } ?>
            </select>            
          </div>
          <button type="submit" class="btn btn-success btn-sm">Search</button>
          <a href="<?php echo site_url('AdminCategory/index');?>" class="btn btn-primary btn-sm" style="margin-right:10px">Refresh</a>
          <a href="<?php echo site_url('AdminCategory/add');?>" class="btn btn-warning btn-md pull-right">Add New Category</a>
        </form>

      </div>
    </div>
    <div class="panel-body">
      <div class="col-md-12 ">
        <div class="table-resposive">
        <table class="table table-hover table-striped">
          <thead>
            <tr>
              <th width="1%">SNo.</th>              
              <th>Title</th>
              <th>Description</th>
              <th>Status</th>
              <th width="15%">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php if($pagination['getNbResults']){ $i=$startLimit;?>
              <?php foreach($usersData as $kData){ ?>
                <tr>
                  <td><?php echo ++$i;?></td>
                  <td><?php echo ucfirst($kData->name);?></td>
                  <td><?php echo $kData->desc;?></td>
                  <td><?php if($kData->status == 0) echo "Inactive"; else echo "Active";?></td>
                  <td>
                    <!-- <a class="btn btn-warning btn-sm" href="<?php echo site_url("adminGroups/viewGroup?id=".$kData->id); ?>" title="View"><i class="fa fa-caret-square-o-down"></i></a> -->
                    <a class="btn btn-info btn-sm" href="<?php echo site_url("AdminCategory/editCategory?id=".$kData->id); ?>" title="Edit"><i class="fa fa-edit"></i></a>
                    <a onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-sm" href="<?php echo site_url('AdminCategory/deleteCategory?id='. $kData->id); ?>" title="Delete"><i class="fa fa-trash-o"></i></a>
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
  </div>
  <div class="col-md-12">
     <?php if($pagination['haveToPaginate']){
          $status=(isset($_GET['status']))?$_GET['status']:'';
          $name=(isset($_GET['name']))?$_GET['name']:'';
           $pcategory=(isset($_GET['pcategory']))?$_GET['pcategory']:'';
          //$current_date=(isset($_GET['current_date']))?$_GET['current_date']:'';
      ?>
        <?php $this->load->view('admin/_paging',array('paginate'=>$pagination,'siteurl'=>'AdminCategory/index','varExtra'=>array('status'=>$status,'name'=>$name,'pcategory'=>$pcategory))); ?>
        <?php } ?>
        </div>
</div>
</div>