<?php 
include '../config/connect.php';
include '../config/functions.php';
$clients_no=getCount($conn,"client");
$contacts_no=getCount($conn,"contact");
$contact=getData($conn,"contact");
?>
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
$item_per_page=100;
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
$item_per_page=100;
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