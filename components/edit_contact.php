<?php
echo "here";
include '../config/functions.php';
include '../config/connect.php';
if(isset($_POST['edit_client_dialog'])){
	$id=$_POST["client_id"];
$contact=getData($conn,"contact");
$client=getData($conn,"client");
$contacts_no=getCount($conn,"contact");
$clients_no=getCount($conn,"client");
$contact_by=getDataBy($conn,"contact","id",$id);
foreach($contact_by as $item){
$name=$item["name"];
$surname=$item["surname"];
$email=$item["email"];
?>
<div  class="crud-dialog-wrapper">
<div class="title"><h1>Edit Contact ~ <?php echo $name;?> </h1></div>
<div class='dialog-error-msg'></div>
<div class="form-control">
<label>Your  name</label>
<input type="text" id="name" data-client-id="<?php echo $id;?>" value="<?php echo $name;?>" onfocus="addFocusAndVadidation(this)" onblur='removeFocusAndValidateInput(this,"name")' class="input-box">
</div>
<div class="form-control">
<label>Your surname</label>
<input type="text" id="surname" data-client-id="<?php echo $id;?>" value="<?php echo $surname;?>" onfocus="addFocusAndVadidation(this)" onblur='removeFocusAndValidateInput(this,"name")' class="input-box">
</div>
<div class="form-control">
<label>Your email address</label>
<input type="email" data-client-id="<?php echo $id;?>" value="<?php echo $email;?>" id="email" onfocus="addFocusAndVadidation(this)" onblur='removeFocusAndValidateInput(this,"email")' class="input-box">
</div>
<div class='link-contact-list-wrapper'>
<label>Link clients</label>
<?php if($clients_no>0){ ?>
<ul class='link-contact-list'>
<?php

 foreach ($client as $client_item)  { 
 ?>
<li><a href='#' class="link-item" data-contact-id='<?php echo $client_item["id"];?>'><?php echo $client_item["name"];?></a></li>

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
