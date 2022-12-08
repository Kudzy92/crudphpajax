<?php
include '../config/functions.php';
include '../config/connect.php';
$contacts_no=getCount($conn,"contact");
$contact=getData($conn,"contact");
//$common_contacts=array_intersect($sp_by_countryid_array,$sp_by_provid_array);
?>
<div  class="crud-dialog-wrapper">
<div class="title"><h1>Add New Client</h1></div>
<div class='dialog-error-msg'></div>

<div class="form-control">
<label>Your Full Name</label>
<input type="text" id="name" onfocus="addFocusAndVadidation(this)" onblur='removeFocusAndValidateInput(this,"name")' class="input-box">
</div>
<div class="form-control">
<label>Your Email Address</label>
<input type="email" id="email" onfocus="addFocusAndVadidation(this)" onblur='removeFocusAndValidateInput(this,"email")' class="input-box">
</div>
<div class='link-contact-list-wrapper'>
<label>Link contacts</label>
<?php 
if($contacts_no>0){
?><ul class='link-contact-list'>
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
<button id="save_dialog_btn" class='btn save'><i class="fas fa-save"></i>Save</button>
</div>
</div>