<?php
include '../config/functions.php';
include '../config/connect.php';
if(isset($_POST['edit_client_dialog'])){
	$id=$_POST["client_id"];
$contact=getData($conn,"contact");
$contacts_no=getCount($conn,"contact");
$client=getDataBy($conn,"client","id",$id);
//$=array();
foreach($client as $item){
$client_id=$item["id"];
$name=$item["name"];
$code=$item["client_code"];
$email=$item["email"];
//$activeContact=getDataBy($conn,"linked","contact_id",$client_id);
?>
<div  class="crud-dialog-wrapper">
<div class="title"><h1>Edit Client ~ <?php echo $name;?> </h1></div>
<div class='dialog-error-msg'></div>
<div class="form-control">
<label>Your Client Code</label>
<h1><?php echo $code;?></h1>
</div>
<div class="form-control">
<label>Your Full Name</label>
<input type="text" id="name" data-client-id="<?php echo $id;?>" value="<?php echo $name;?>" onfocus="addFocusAndVadidation(this)" onblur='removeFocusAndValidateInput(this,"name")' class="input-box">
</div>
<div class="form-control">
<label>Your Email Address</label>
<input type="email" data-client-id="<?php echo $id;?>" value="<?php echo $email;?>" id="email" onfocus="addFocusAndVadidation(this)" onblur='removeFocusAndValidateInput(this,"email")' class="input-box">
</div>
<div class='link-contact-list-wrapper'>
<label>Link contacts</label>
<?php if($contacts_no>0){ ?>
<ul class='link-contact-list'>
<?php

 foreach ($contact as $contact_item)  { 
 ?>
<li><a href='#' class="link-item" data-contact-id='<?php echo $contact_item["id"];?>'><?php echo $contact_item["name"]." ".$contact_item["surname"];?></a></li>

<?php } ?>
</ul>
<?php } else {?>
<div class="not-found-item">
<p>No contact yet. Please add new contact(s) to link.</p>
</div>
<?php }?>

</div>
<div class="bottom-btn">
<button id="close_dialog_btn" class='btn cancel'><i class="fas fa-times"></i>Cancel</button>

</div>
</div>

<?php } } ?>
