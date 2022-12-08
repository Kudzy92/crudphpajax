<?php
include 'config/connect.php';
include 'config/functions.php';
$clients_no=getCount($conn,"client");
$contacts_no=getCount($conn,"contact");
$contact=getData($conn,"contact");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Development Practical Test</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/styles.css">

</head>
<body id="page_content">
<div id="page_loader" class="loading-container">
<div class="loading-wrapper">
  <span class="circle circle-1"></span>
  <span class="circle circle-2"></span>
  <span class="circle circle-3"></span>
  <span class="circle circle-4"></span>
  <span class="circle circle-5"></span>
  <span class="circle circle-6"></span>
  <span class="circle circle-7"></span>
  <span class="circle circle-8"></span>
</div>
</div>
<div id="page_overlay" class="page-overlay"></div>
<div class="msg-dialog"></div>
<section id="dev_pratical_test" class="dev-pratical-test">
<div class="container">
<div class="section-title-wrapper">
<h1 class="title">Development Practical Test</h1>
<p>Thank you for choosing and giving me this wonderful opportunity which allows me to showcase my ability in coding.
This pratical development test was done with PHP,MySQL database as the backend technologies and HTML, CSS and Vanila javascript.
There is the implementation of MySQL Database CRUD operations,frontend, backend input valiadation and AJAX server request and mobile responsiveness.
</p>
<span class="line"></span>
</div>
<div class="section-content-wrapper">

<div id="crud_dialog" data-dialog-name="new-client" class="crud-dialog">

</div>

<ul class="section-navigation">
<li><a class="nav-item active" data-section-name="client" href="#client">Client</a></li>
<li><a class="nav-item" data-section-name="contact" href="#contact">Contact</a></li>
</ul>
<div id="client"  class="client-contact-container active">
<div id="client_container" class="bc-dev-test-container">
<div class="bc-client-action">
<div class="btn-container">
<?php if($clients_no>0){ ?><button id="client_grid_layout_btn" data-layout="grid" class="action-btn"><i class="fas fa-list"></i></button>
<button id="client_list_layout_btn" data-layout="list" class="action-btn active"><i class="fas fa-bars"></i></button><?php } ?>
<button id="client_add_btn" data-layout="add" class="action-btn"><i class="fas fa-plus"></i></button>
</div>
<div id="client_list_wrapper" class="client-content-item active">

<?php if($clients_no>0){ ?><table class="tb-content">
<tr>
<th>Client Code</th>
<th>Name</th>
<th>Email</th>
<th>Linked Contacts</th>
<th>Actions</th>
</tr>

<?php 
$item_per_page=10;
 $client=getDataByLimit($conn,"client",$item_per_page); foreach ($client as $client_item)  { 
 $id=$client_item["id"];
 ?>
<tr>
<td><?php echo $client_item["client_code"];?></td>
<td><?php echo $client_item["name"];?></td>
<td><?php echo $client_item["email"];?></td>
<td><?php echo getCountby($conn,'linked','client_id',$id);?></td>
<td>
<button data-client-id="<?php echo $id; ?>" class="btn edit"><i class="fas fa-edit"></i></button>
<button class="btn delete" data-client-id="<?php echo $id; ?>"><i class="fas fa-trash"></i></button>
</td>
</tr>
<?php } ?>


</table>
<?php }else{ ?>
<p>No client(s) yet. Please add new client(s).</p>
<?php } ?>
</div>

<div id="client_grid_wrapper" class="client-content-item">
<div class="grid-wrapper">
<?php 
if($clients_no>0){
$item_per_page=10;
 $client=getDataByLimit($conn,"client",$item_per_page);
 foreach ($client as $client_item)  {
$id=$client_item["id"];
	 ?>
<div class="client-item">
<div class="row"><span>Code :</span><span><?php echo $client_item["client_code"];?></span></div>
<div class="row"><span>Name :</span><span><?php echo $client_item["name"];?></span></div>
<div class="row"><span>Email :</span><span><?php echo $client_item["email"];?></span></div>
<div class="row"><span>linked to :</span><span><?php echo getCountby($conn,'linked','client_id',$id);?></span></div>
<div class="grid-btn-container">
<button class="btn edit" data-client-id="<?php echo $id; ?>"><i class="fas fa-edit"></i></button>
<button class="btn delete" data-client-id="<?php echo $id; ?>"><i class="fas fa-trash"></i></button>
</div>
</div>
<?php } }else{  ?>
<p>No client(s) yet. Please add new client(s).</p>
<?php } ?>

</div>
</div>

</div>
</div>


</div>
<div id="contact" class="client-contact-container">
<div id="contact_container" class="bc-dev-test-container">
<div class="bc-client-action">
<div class="btn-container">
<?php if($contacts_no>0){ ?>
<button id="contact_grid_layout_btn" data-layout="grid" class="action-btn"><i class="fas fa-list"></i></button>
<button id="contact_list_layout_btn" data-layout="list" class="action-btn active"><i class="fas fa-bars"></i></button><?php } ?>
<button id="contact_add_btn"  data-layout="add" class="action-btn"><i class="fas fa-plus"></i></button>
</div>
<div id="contact_list_wrapper" class="client-content-item active">

<?php if($contacts_no>0){ ?><table class="tb-content">
<tr>
<th>Name</th>
<th>Surname</th>
<th>Email</th>
<th>Linked Contacts</th>
<th>Actions</th>
</tr>

<?php 
$item_per_page=100;
 $contact=getDataByLimit($conn,"contact",$item_per_page); foreach ($contact as $contact_item)  { 
 $id=$contact_item["id"];
 ?>
<tr>
<td><?php echo $contact_item["name"];?></td>
<td><?php echo $contact_item["surname"];?></td>
<td><?php echo $contact_item["email"];?></td>
<td><?php echo getCountby($conn,'linked','contact_id',$id);?></td>
<td>
<button data-client-id="<?php echo $id; ?>" class="btn edit"><i class="fas fa-edit"></i></button>
<button class="btn delete" data-client-id="<?php echo $id; ?>"><i class="fas fa-trash"></i></button>
</td>
</tr>
<?php } ?>


</table>
<?php }else{ ?>
<p>No contact(s) yet. Please add new contact(s).</p>
<?php } ?>
</div>

<div id="contact_grid_wrapper" class="client-content-item">
<div class="grid-wrapper">
<?php 
if($contacts_no>0){

 foreach ($contact as $contact_item)  {
$id=$contact_item["id"];
	 ?>
<div class="client-item">
<div class="row"><span>Name :</span><span><?php echo $contact_item["name"];?></span></div>
<div class="row"><span>Surname :</span><span><?php echo $contact_item["surname"];?></span></div>
<div class="row"><span>Email :</span><span><?php echo $contact_item["email"];?></span></div>
<div class="row"><span>linked to :</span><span><?php echo getCountby($conn,'linked','contact_id',$id);?></span></div>
<div class="grid-btn-container">
<button class="btn edit" data-client-id="<?php echo $id; ?>"><i class="fas fa-edit"></i></button>
<button class="btn delete" data-client-id="<?php echo $id; ?>"><i class="fas fa-trash"></i></button>
</div>
</div>
<?php } }else{  ?>
<p>No contact(s) yet. Please add new contact(s).</p>
<?php } ?>

</div>
</div>

</div>
</div>


</div>
</div>
</div>
</div>

<?php include 'components/footer.php';?>
<!-- custom js file link  -->
<script src="js/script.js"></script>
    
</body>
</html>