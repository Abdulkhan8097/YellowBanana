<article id="content">
<section>
<div id="middel_cont_new">
  <div class="clear">&nbsp;</div>
  <div class="box1 adminlogin_height">
    <div class="box5 padding10_5">
      <table width="100%" align="center" cellspacing="0" cellpadding="0" class="IconTable">
        <tr style="background:#0165AA;">
          <td class="IconBtmDotLn Pad5">
		  	<h1> 
				<img src="http://www.fusionmediasoft.com/web/lightdemosite/images/admin/user-managemnet.png" height="24" width="24"> 
				<span class="white">Content Management</span> 
					
					
			</h1>
		</td>
        </tr>
		<tr>
			<td align="center">
				<div id="message"  style="width:90%; text-align:left;" >
				  
				</div>
			</td>
		</tr>
      </table>
      
      
      </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
	  
      <tr>
        <td class="Pad5">
		<form method="post" name="frmListing" id="frmListing" action="http://www.fusionmediasoft.com/web/lightdemosite/admin.php/user/sendemail">
        <table width="100%" align="center" cellspacing="1" cellpadding="1" class="brd1">
          <tr>
            <td colspan="13" class="Pad5"><table width="25%" border="0" align="right" cellspacing="0" cellpadding="0">
                <tr>
                  <td><div align="right" style="line-height:25px; padding:5px;">   
                  <?php echo $this->pagination->create_links();?>
                </div></td>
                </tr>
              </table></td>
          </tr>
          <tr class="fldbg">
           
            <td align="left" id="sf_admin_list_th_usa_id" class="whttxt"><a href="">Page Name</a></td>
			<td align="left" id="sf_admin_list_th_usr_edit" class="whttxt">Status</td>
			<td align="left" id="sf_admin_list_th_usr_edit" class="whttxt"><center>Action</center></td>
			            
          </tr>
          
          <?php
		  		if(count($cmsData)>0){
					foreach($cmsData AS $kData){					
			?>
          
          <tr class="fldrowbg">            
            <td class="fldrowbg" align="left"><?php echo ucfirst($kData->page_title);?></td>
            <td class="fldrowbg" align="left"><?php if($kData->status == 0) echo "Inactive"; else echo "Active";?></td>				
			<td align="center">
            	<center><img border="0" align="middle" src="http://www.fusionmediasoft.com/web/lightdemosite//images/admin/edit_profile.png" title="Edit" alt="Edit"> </center>
            </td>

          </tr>
          
          <?php 
					}
				}else{ ?>		
			<div class="nomsg">No Records Found</div>
			<?php
				}
			?>
          
          
                    
                    
                  
                    
                   
                   
                   
                  </table>
        </td>
      </tr>
      </table>
	  </form>
    
    </div>
  </div>
</div>
</section>
</article>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Welcome to CodeIgniter</title>
</head>
<body>
<div id="container">
  <h1>Welcome to CodeIgniter!</h1>
  <?php echo form_open('welcome');?> <?php //echo $this->ckeditor->editor('description',@$default_value);?> <?php echo form_error('description','<p class="error">'); ?>
  <input type="submit" name="submit" value="Save" id="save" class="save" />
  <?php echo form_close();?>
  <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>
</body>
</html>
