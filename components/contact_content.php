<?php

?>

<div id="contact_container" class="bc-dev-test-container">
<div class="bc-client-action">
<div class="btn-container">
<button id="client_grid_layout_btn" class="btn"><i class="fas fa-grid"></i></button>
<button id="client_list_layout_btn" class="btn active"><i class="fas fa-list"></i></button>
<button id="client_add_btn" class="btn"><i class="fas fa-plus"></i></button>
</div>
<div id="client_list_wrapper" class="client-content-item active">
<table>
<tr>
<th>Client Code</th>
<th>Name</th>
<th>Linked Contacts</th>
<th>Actions</th>
</tr>


<tr>
<td>KUD001</td>
<td>Kudzanai</td>
<td>02</td>
<td>
<button class="btn edit"></button>
<button class="btn delete"></button>
</td>
</tr>

<tr>
<td>JAM002</td>
<td>James</td>
<td>05</td>
<td>
<button class="btn edit"></button>
<button class="btn delete"></button>
</td>
</tr>

</table>
</div>

<div id="client_grid_wrapper" class="client-content-item">
<div class="grid-wrapper">
<div class="client-item">
<div class="row"><span>Code :</span><span>KUD001</span></div>
<div class="row"><span>Name :</span><span>Kudzanai</span></div>
<div class="row"><span>linked to :</span><span>03</span></div>
<div class="grid-btn-container">
<button class="btn edit"></button>
<button class="btn delete"></button>
</div>
</div>

<div class="client-item">
<div class="row"><span>Code :</span><span>JAM002</span></div>
<div class="row"><span>Name :</span><span>James</span></div>
<div class="row"><span>linked to :</span><span>05</span></div>
<div class="grid-btn-container">
<button class="btn edit"></button>
<button class="btn delete"></button>
</div>
</div>

</div>
</div>


</div>
</div>