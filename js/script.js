let grid_layout = document.querySelector('#client_grid_wrapper'),
list_layout = document.querySelector('#client_list_wrapper'),
btns = document.getElementsByClassName('action-btn'),
client_contact_item = document.querySelectorAll('.bc-dev-test-container'),
nav_item_btn = document.querySelectorAll('.nav-item'),
client_items = document.querySelectorAll('.client-content-item'),
sectionsActive = document.getElementsByClassName('client-contact-container active'),
sections = document.querySelectorAll('.client-contact-container');

 
  let contact_link_items =document.querySelectorAll(".link-item"),
  overlay =document.querySelector("#page_overlay"),
msg_dialog =document.querySelector(".msg-dialog"),
  dialog =document.querySelector("#crud_dialog"),
  client_container =document.querySelector("#client_container"),
  contact_container =document.querySelector("#contact_container"),
  body=document.body;



function openDialog(overlay,dialog,body){
	overlay.classList.add("active");
	dialog.classList.add("active");
	body.classList.add("remove-scroll");
}
function closeDialog(overlay,dialog,body){
	overlay.classList.remove("active");
	dialog.classList.remove("active");
	body.classList.remove("remove-scroll");
}

[].forEach.call(contact_link_items , function(event1) {
	//event1.classList.remove("active");
    event1.onclick = (e) =>{
		e.target.classList.toggle('active');
	}
  });


function ajaxCallWithReturn(formdata){
	var hr=new XMLHttpRequest();
	hr.open("POST","server/ajaxcall.php",true);
	hr.onreadystatechange= function(){
		if(hr.readyState== 4 && hr.status == 200){
			console.log(hr.responseText);
		}
	}
	hr.send(formdata);
}
function ajaxCallWithReturn(formdata,file){
	var hr=new XMLHttpRequest();
		hr.open("POST",file, true);
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
			console.log(hr.responseText);
		    showDialog(hr.responseText);
			
	    }
    }
	hr.send(formdata);
}
function ajaxCallWithReturnNoDialog(formdata,file,el){
	var hr=new XMLHttpRequest();
		hr.open("POST",file, true);
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		   el.innerHTML=hr.responseText;
			
	    }
    }
	hr.send(formdata);
}
function ajaxCall(file,el){
	var hr=new XMLHttpRequest();
		hr.open("POST",file, true);
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		   el.innerHTML=hr.responseText;
			
	    }
    }
	hr.send();
}
function refreshData(file,el){
	ajaxCall(file,el);
}
function showDialog(return_data){
	msg_dialog.innerHTML = return_data;
	msg_dialog.classList.add("active");
	setTimeout(function(){msg_dialog.classList.remove("active");},3000);
}
function addFocusAndVadidation(el){
	if(el.parentNode.classList.contains('isvalid')){
		el.parentNode.classList.remove("isvalid");
	}
	
	if(el.parentNode.classList.contains('isnotvalid')){
		el.parentNode.classList.remove("isnotvalid");
	}
}
function removeFocusAndValidateInput(el,field_type){
	var hr = new XMLHttpRequest(),
	formdata = new FormData(),
	field_name=el.value,
	type= dialog.getAttribute("data-dialog-name");
	formdata.append("validate-data","1");
	formdata.append("field_name",field_name);
	formdata.append("field_type",field_type);
	hr.open("POST","server/ajaxcall.php", true);
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
			let str=hr.responseText;
			if(str==="isvalid"){el.parentNode.classList.add("isvalid");
			if(type==="edit-client"||type==="edit-contact"){
			
			var client_id=el.getAttribute("data-client-id"),
				field=el.value,
				col=el.id,
				formdata = new FormData();
				formdata.append("update-field","1");
	formdata.append("field_name",col);
	formdata.append("field_type",type);
	formdata.append("field_value",field);
	formdata.append("client_id",client_id);
	ajaxCallWithReturn(formdata,"server/ajaxcall.php");
			}
			}else{el.parentNode.classList.add("isnotvalid");}
	    }
    }
	hr.send(formdata);
}

let page_content_element = document.getElementById("page_content"),
page_name=sectionsActive[0].id;
console.log(page_content_element+sectionsActive.length+page_name);
if (typeof(page_content_element) !== 'undefined' && page_content_element!== null)
{
	 page_content_element.addEventListener('click',function(e){
if(e.target && e.target.classList.contains('nav-item')){
	e.preventDefault();
	var page= e.target.getAttribute("href"),
	activeActionBtn=document.getElementsByClassName("action-btn active");
		var el=document.querySelector(page),
		layout=activeActionBtn[0].getAttribute("data-layout");
		loader="<div class='content-show-loading loading-container'><div class='loading-wrapper'><span class='circle circle-1'></span><span class='circle circle-2'></span><span class='circle circle-3'></span><span class='circle circle-4'></span><span class='circle circle-5'></span><span class='circle circle-6'></span><span class='circle circle-7'></span><span class='circle circle-8'></span></div></div>";
	el.innerHTML +=loader; 
	var nav_item_btnActive = document.getElementsByClassName('nav-item active'),
sectionsActive = document.getElementsByClassName('client-contact-container active');
console.log("Page"+page+"nav_item_btnActive"+nav_item_btnActive.length+"section"+sectionsActive.length);
	if(nav_item_btnActive.length>0){nav_item_btnActive[0].classList.remove("active");}
		if(sectionsActive.length>0){sectionsActive[0].classList.remove("active");}
		
	var refreshIntervalId = setInterval(function() {
                //el.innerHTML +=loader;
            }, 0);
			 
			 	var element=document.getElementsByClassName("content-show-loading")[0];
				setTimeout(function() {
		     element.remove();
			 },4000);
			 //clearTimeout(removeLoader);
		 //clearTimeout(sec); 
		 var id=page+"_"+layout+"_wrapper";	
document.querySelector(id).classList.add("active");
el.classList.add("active");
		 
		e.target.classList.add("active");
}
if(e.target && e.target.classList.contains('cancel')){
e.preventDefault();
closeDialog(overlay,dialog,body);	
refreshData("components/refreshclients.php",client_container);	
}

if(e.target && e.target.classList.contains('action-btn')){
	e.preventDefault();
	var layout=e.target.getAttribute("data-layout");
	[].forEach.call(client_items , function(event1) {
    event1.classList.remove("active");
  });
  [].forEach.call(btns , function(event1) {
    event1.classList.remove("active");
  });
    e.target.classList.toggle('active');
	var loader="<div class='loading-container'><div class='loading-wrapper'><span class='circle circle-1'></span><span class='circle circle-2'></span><span class='circle circle-3'></span><span class='circle circle-4'></span><span class='circle circle-5'></span><span class='circle circle-6'></span><span class='circle circle-7'></span><span class='circle circle-8'></span></div></div>";
	var activeSection=document.getElementsByClassName("nav-item active");
var section =activeSection[0].getAttribute("data-section-name");
console.log("page"+section+"Action"+layout);
let contact_list_layout = document.querySelector('#contact_list_wrapper'),
	activeLayout = document.getElementsByClassName('client-content-item active'),
	client_list_layout = document.querySelector('#client_list_wrapper'),
    contact_grid_layout = document.querySelector('#contact_grid_wrapper'),
	client_grid_layout = document.querySelector('#client_grid_wrapper'),
	btn = document.querySelector('#contact_list_layout_btn');
	
if(layout==="add"){
var activeSection=document.getElementsByClassName("nav-item active"),
section =activeSection[0].getAttribute("data-section-name")+"_insert_row";
console.log(section);
if(section==="client_insert_row"){
	dialog.setAttribute("data-dialog-name","new-client");
ajaxCallWithReturnNoDialog(formdata,'components/new_client.php',dialog);
}else if(section==="contact_insert_row"){
	dialog.setAttribute("data-dialog-name","new-contact");
ajaxCallWithReturnNoDialog(formdata,'components/new_contact.php',dialog);	
}
	openDialog(overlay,dialog,body);	
}else{
	if(activeLayout.length>0){
	for(var i=0;i<=activeLayout.length-1;i++){
		activeLayout[i].classList.remove("active");
	}
	}
if(layout==="list"){
if(section==="contact"){
	contact_list_layout.classList.toggle('active');
}else if(section==="client"){
	client_list_layout.classList.toggle('active');
}
}else if(layout==="grid"){
	if(section==="contact"){
	contact_grid_layout.classList.toggle('active');
}else if(section==="client"){
	client_grid_layout.classList.toggle('active');
}
}
}
}

if(e.target && e.target.classList.contains('delete')){
	e.preventDefault();
	var activeSection=document.getElementsByClassName("nav-item active");
	 //section=activeSection[0].textContent.toLowerCase()+"_delete_row",
	var formdata = new FormData(),
	section =activeSection[0].getAttribute("data-section-name")+"_delete_row",
	id=e.target.getAttribute("data-client-id"),
	activeLayout =document.getElementsByClassName("action-btn active"),
	layout="list";
	var page="client";
	if(activeLayout.length===1){
		layout=activeLayout[0].getAttribute("data-layout");
	}
	if(activeSection.length===1){
		page=activeSection[0].getAttribute("data-section-name");
	}
	console.log(section+"page"+page+"layout"+layout);
	formdata.append(section,"1");
	formdata.append("client_id",id);
	if(page==="client"){
	ajaxCallWithReturn(formdata,"server/ajaxcall.php");
	refreshData("components/refreshclients.php",client_container);	
	}else if(page==="contact"){
		ajaxCallWithReturn(formdata,"server/ajaxcall.php");
	refreshData("components/refreshcontacts.php",contact_container);
	}
	
}

if(e.target && e.target.classList.contains('edit')){
	e.preventDefault();
	var activeSection=document.getElementsByClassName("nav-item active");
	var section=activeSection[0].getAttribute("data-section-name")+"_edit_row";
	dialog.innerHTML="";
	var formdata = new FormData(),
	client_id=e.target.getAttribute("data-client-id");
	formdata.append("edit_client_dialog","1");
	formdata.append("client_id",client_id);
	console.log(section);
	if(section==="client_edit_row"){
		dialog.setAttribute("data-dialog-name","edit-client");
ajaxCallWithReturnNoDialog(formdata,'components/edit_client.php',dialog);
}else if(section==="contact_edit_row"){
	console.log(section+"inside");
	dialog.setAttribute("data-dialog-name","edit-contact");
ajaxCallWithReturnNoDialog(formdata,'components/edit_contact.php',dialog);	
}
openDialog(overlay,dialog,body);
	/*if(client_id!==null){
	ajaxCallWithReturnNoDialog(formdata,'components/edit_client.php',dialog);
	
	}*/
	
}
if(e.target && e.target.classList.contains('link-item')){
	e.preventDefault();
	e.target.classList.toggle("active");
	var dialog_name=document.querySelector("#crud_dialog").getAttribute("data-dialog-name"),
	activeSection=document.getElementsByClassName("nav-item active"),
	formdata = new FormData(),
	section =activeSection[0].getAttribute("data-section-name")+"_update_row";
	db =activeSection[0].getAttribute("data-section-name");
	file="server/ajaxcall.php";
	console.log("section"+section+"id"+id+"db"+db);
	if(dialog_name==="edit-client"||dialog_name==="edit-contact"){
		var id2=document.querySelector("#name").getAttribute("data-client-id"),
		id=e.target.getAttribute("data-contact-id");
	formdata.append(section,"1");
	formdata.append("id",id);
	formdata.append("id2",id2);
	formdata.append("db",db);

	ajaxCallWithReturn(formdata,file);
	}
}
if(e.target && e.target.classList.contains('save')){
e.preventDefault();
var loader="<span class='circle circle-1'></span><span class='circle circle-2'></span><span class='circle circle-3'></span><span class='circle circle-4'></span><span class='circle circle-5'></span><span class='circle circle-6'></span>";
	e.target.classList.add("btn-ajax-loader");
	e.target.innerHTML=loader;
				setTimeout(function() {
		    e.target.innerHTML="<i class='fas fa-save'></i>Save";
			 },3000);
			 var name_el=document.querySelector("#name"),
email_el=document.querySelector("#email");
let name=name_el.value,
email=email_el.value,
contact_link_items_active =document.querySelectorAll(".link-item.active"),
	dialog_name=dialog.getAttribute("data-dialog-name"),
	linked="";
	
	for(var i=0;i<contact_link_items_active.length;i++){
		linked+=contact_link_items_active[i].getAttribute('data-contact-id');
	}
	console.log("linked"+linked);
	var formdata = new FormData(),
	file="server/ajaxcall.php";
	formdata.append(dialog_name,"1");
	formdata.append("name",name);
	formdata.append("email",email);
	formdata.append("linked",linked);
	if(dialog_name==="new-client"){
		if(name_el.parentNode.classList.contains("isvalid")&& email_el.parentNode.classList.contains("isvalid")){
		ajaxCallWithReturn(formdata,file);
	refreshData("components/refreshclients.php",client_container);
	document.querySelector("#name").value="";
	document.querySelector("#email").value="";
	var link_items_active =document.querySelectorAll(".link-item.active");
	for(var i=0;i<link_items_active.length;i++){
		link_items_active[i].classList.remove("active");
	}
	closeDialog(overlay,dialog,body);
		}else{
			var msg="<div class='content error'><div class='icon'><span></span></div><div class='info'><h3>Notification message</h3><p>Information is unsucessfull saved into our databases.Try again to continue</p></div></div>";
			  showDialog(msg);
		}
	}else if(dialog_name==="new-contact"){
		var surname_el=document.querySelector("#surname");
		var surname=surname_el.value;
		if(name_el.parentNode.classList.contains("isvalid")&& email_el.parentNode.classList.contains("isvalid")&& surname_el.parentNode.classList.contains("isvalid")){
		
		formdata.append("surname",surname);
			ajaxCallWithReturn(formdata,file);
	refreshData("components/refreshcontacts.php",contact_container);
	document.querySelector("#name").value="";
	document.querySelector("#email").value="";
	document.querySelector("#surname").value="";
	var link_items_active =document.querySelectorAll(".link-item.active");
	for(var i=0;i<link_items_active.length;i++){
		link_items_active[i].classList.remove("active");
	}
	closeDialog(overlay,dialog,body);
	}else{
			var msg="<div class='content error'><div class='icon'><span></span></div><div class='info'><h3>Notification message</h3><p>Information is unsucessfull saved into our databases.Try again to continue</p></div></div>";
			  showDialog(msg);
		}
	}
	console.log(page_name);
	console.log("Dialog"+dialog_name+"name"+name+"linked"+linked);
}	
})
}
(function() {
  let preloader = document.querySelector("#page_loader"),
            site_footer = document.querySelector("#footer"),
            site_content = document.querySelector("#dev_pratical_test");
			
  var refreshIntervalId = setInterval(function() {
                preloader.classList.add("start");
				//document.body.classList.add("remove-scroll");
            }, 0);
			 setTimeout(function() {
				 preloader.classList.remove("start");
				 document.body.classList.remove("remove-scroll");
				 site_footer.classList.add('active');
				 site_content.classList.add('active');
				 clearInterval(refreshIntervalId);
			 },4000);
			
        })();
