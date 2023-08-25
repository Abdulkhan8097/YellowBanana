<style>
label.error{
   color:red;
}
</style>
<div class="app-content bg-img my-3 my-md-5">
    <div class="side-app">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Update Profile</div>
                    </div>

                    <div class="card-body col-lg-10">
                        <?php $this->load->view('admin/_topmessage'); ?>
                            <form class="card" id='add_member_form' method='post' action="<?php echo site_url('adminprofile/update_password'); ?>" enctype='multipart/form-data'>
                                <div class="card-body">
                                    <div class="row">                                        
                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Old Password</label>
                                                <input type="password" name="old_password" id="old_password"  class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">New Password</label>
                                                <input type="password" name="new_password" id="new_password" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">New Password</label>
                                                <input type="password" name="cnf_new_password" class="form-control" required>
                                            </div>
                                        </div>

                                  </div>
                               </div>
                               <div class="card-footer text-right">
                                 
                                  <button type="submit" class="btn btn-success pull-left">Submit</button>
                                  <button type="button" class="btn btn-danger pull-left" style="margin-left: 5px;">Cancel</button>
                               </div>
                            </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->load->view('admin/footer'); ?>
</div>
