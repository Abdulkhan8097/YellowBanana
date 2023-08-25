
<div id="page-wrapper">
    <?php $this->load->view('admin/_topmessage'); ?>


    <div class="row">
        <div class="col-md-12 col-sm-12 useraddform">
            <div class="panel panel-default" style="margin-top:-30px">
                <div class="panel-heading">
                    <img src="<?php echo base_url("assets/admin/images/group.png"); ?>" height="35" width="35">
                    <b style="font-size:16px;">Update Group</b>
                    <a href="<?php echo site_url('AdminCategory/index'); ?>" class="btn btn-warning pull-right">Back</a>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">

                    <div class="col-md-10 col-sm-10">


                        <div id="divSuccess" style="display:none;"></div>

                        <form action="<?php echo site_url("AdminCategory/updateCategory?id=" . $groupDetailArray['detail'][0]->id); ?>" method="post" name="addGroupForm" id="addGroupForm"  enctype="multipart/form-data">

                            <table class="table table-bordered">
                                <tbody>
                                   <?php if($groupDetailArray['detail'][0]->parent_id != 0) { ?>
                                    <tr>
                                        <td ><span class="Ment"> </span><b>Parent Category:</b></td>
                                        <td >
                                            <div class=" col-md-8">
                                            <select id="pcategory" name="pcategory" class="form-control">
                                                <option value="">Select</option>
                                                <?php
                                                if (count($parentCategory) > 0) {
                                                    foreach ($parentCategory AS $cobj) {
                                                ?>
                                                        <option value="<?php echo $cobj->id; ?>" <?php echo $cobj->id==$groupDetailArray['detail'][0]->parent_id?"selected":""; ?>><?php echo $cobj->name; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td width="15%" ><span class="Ment">*</span>  <b>Name :</b></td>
                                        <td >
                                            <input type="text" name="txtName" id="txtName" class="form-control" value="<?php echo $groupDetailArray['detail'][0]->name; ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td ><span class="Ment">*</span><b>Description:</b></td>
                                        <td >
                                            <textarea name="txtDescription" cols="58" rows="10" class="form-control" id="txtDescription"><?php echo $groupDetailArray['detail'][0]->desc; ?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td ><b>Status:</b></td>
                                        <td >
                                            <div class=" col-md-4">
                                                <select id="txtStatus" name="txtStatus" class="form-control">
                                                <option <?php if ($groupDetailArray['detail'][0]->status == 0) { ?> selected="selected" <?php } ?> value="0">Inactive</option>
                                                <option <?php if ($groupDetailArray['detail'][0]->status == 1) { ?> selected="selected"<?php } ?> value="1">Active</option>
                                            </select>
                                              </div>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td colspan="2" align="center" >
                                            <input type="submit" class="btn btn-success" value="Update" name="filter">
                                            <a href="<?php echo site_url('AdminCategory/index'); ?>" class="btn btn-primary">Back </a>
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                        </form>



                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear"></div>
<script>
    var stateURL = "<?php echo site_url("adminUsers/ajaxGetState"); ?>";
    newj(document).ready(function() {
        newj("#addGroupForm").validate({
            rules: {
                txtName: {
                    required: true
                },
                txtDescription: {
                    required: true
                },
                txtGroupType: {
                    required: true
                },
                file_upload: {
                    required: true
                }
            },
            messages: {
                txtName: {
                    required: " Please enter a Name of Category"
                },
                txtDescription: {
                    required: " Please enter Description"
                }
            }
        });


        $("#txtCountry").change(function() {
            var countryId = this.value;
            $.ajax({
                type: "POST",
                url: stateURL,
                data: {countryId: countryId},
                success: function (data){
                    if(data != ""){
                        $("#divState").html(data);
                    }
                }
            });
        });

	

	
    });
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    $(document).ready( function() {
        $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        
            var input = $(this).parents('.input-group').find(':text'),
            log = numFiles > 1 ? numFiles + ' files selected' : label;
        
            if( input.length ) {
                input.val(log);
            } else {
                if( log ) alert(log);
            }
        
        });
    });
</script>