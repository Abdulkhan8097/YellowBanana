<?php
 $message = $this->session->flashdata('message') ? $this->session->flashdata('message') : '';
 $errmessage = $this->session->flashdata('errmessage') ? $this->session->flashdata('errmessage') : '';
if ($message) {
?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php echo $message; ?>
</div><br>
<?php } else if($errmessage){
 ?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<?php echo $errmessage; ?><br>
</div>
<?php } ?>