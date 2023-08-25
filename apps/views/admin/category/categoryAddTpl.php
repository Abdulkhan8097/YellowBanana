<div id="page-wrapper">
    <?php $this->load->view('admin/_topmessage'); ?>


    <div class="row">
        <div class="col-md-12 col-sm-12 useraddform">
            <div class="panel panel-default" style="margin-top:-30px">
                <div class="panel-heading">
                    <img src="<?php echo base_url("assets/admin/images/group.png"); ?>" height="35" width="35">
                    <b style="font-size:16px;">Add Category</b>
                    <a href="<?php echo site_url('AdminCategory/index'); ?>" class="btn btn-warning pull-right">Back</a>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">

                    <div class="col-md-10 col-sm-10">
                        <div id="divSuccess" style="display:none;"></div>

                        <form action="<?php echo site_url("AdminCategory/postNewCategory"); ?>" method="post" name="addGroupForm" id="addGroupForm"  enctype="multipart/form-data">

                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td  width="20%"><span class="Ment"></span><b>Parent Category:</b></td>
                                        <td >
                                            <div class=" col-md-8">   <select id="pcategory" name="pcategory" class="form-control">
                                                <option value="">Select</option>
                                                <?php
                                                if (count($parentCategory) > 0) {
                                                    foreach ($parentCategory AS $cobj) {
                                                ?>
                                                        <option value="<?php echo $cobj->id; ?>">&nbsp;<?php echo $cobj->name; ?></option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td width="20%" ><span class="Ment"> * </span>  <b>Name :</b></td>
                                        <td>
                                            <input type="text" name="txtName" id="txtName" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td ><span class="Ment"> * </span><b>Description:</b></td>
                                        <td >
                                            <textarea name="txtDescription" cols="58" rows="10" class="form-control" id="txtDescription"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td ><b>Status:</b></td>
                                        <td >
                                        <div class=" col-md-4">    <select id="txtStatus" name="txtStatus" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center" >
                                            <input type="submit" class="btn btn-success" value="Add" name="filter">
                                            <input type="reset" value="Clear" class="btn btn-primary">
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
    /*function uploadFile(){
   var formData = new FormData();	
   formData.append('file', $('input[type=file]')[0].files[0]);
   $.ajax( {
                url: '<?php echo site_url('storyclip/checkImage'); ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success:function(data, textStatus, jqXHR){
		
                if(data=="error_ext"){
                        $("#divSuccess").show();
                        $("#divSuccess").html("You can upload only jpg, png, jpeg Images !");
                        $("#divSuccess").addClass("error1");
                }else if(data=="error_size"){
                        $("#divSuccess").show();
                        $("#divSuccess").html("You can upload only upto 900MB !");
                        $("#divSuccess").addClass("error1");
                }else {
                        $("#divSuccess").html("");
                }
                }
    });
} */
</script>

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
                },
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
