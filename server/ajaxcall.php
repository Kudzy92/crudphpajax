<?php
include '../config/connect.php';
include '../config/functions.php';
if(isset($_POST['client_delete_row'])){
	$id = $_POST["client_id"];
	$data=getDataBy($conn,"client","id",$id);
	foreach($data as $item){
		$name=$item["name"];
	if(setDeleteBy($conn,"client",$id)){
		
		echo"<div class='content sucess'><div class='icon'><span></span></div><div class='info'><h3>Notification message</h3><p>Client $name is sucessfull removed from into our databases.</p></div></div>";
			exit();
	}else{
		echo"<div class='content error'><div class='icon'><span></span></div><div class='info'><h3>Notification message</h3><p>Client $name is unsucessfull removed from into our databases.</p></div></div>";
			exit();
	}
	}
}
if(isset($_POST['contact_delete_row'])){
	$id = $_POST["client_id"];
	$data=getDataBy($conn,"contact","id",$id);
	foreach($data as $item){
		$name=$item["name"];
	if(setDeleteBy($conn,"contact",$id)){
		
		echo"<div class='content sucess'><div class='icon'><span></span></div><div class='info'><h3>Notification message</h3><p>Client $name is sucessfull removed from into our databases.</p></div></div>";
			exit();
	}else{
		echo"<div class='content error'><div class='icon'><span></span></div><div class='info'><h3>Notification message</h3><p>Client $name is unsucessfull removed from into our databases.</p></div></div>";
			exit();
	}
	}
}
if(isset($_POST['contact_update_row']) || isset($_POST['client_update_row'])){
	$db = $_POST["db"];
	$id = $_POST["id"];
	$col=$db."_id";
	if($db==="contact"){
		$col2="client_id";
	}else{
		$col2="contact_id";
	}
	echo $col.$id;
	//$count=getCountby($conn,"linked",$col,$id);
	$count=1;
	if($count>0){
	if(setDataBy($conn,"linked",$col,"","id",$id)){
		echo"<div class='content sucess'><div class='icon'><span></span></div><div class='info'><h3>Notification message</h3><p>$field_name is sucessfull saved into our databases.</p></div></div>";
			exit();
	}else{
		echo"<div class='content error'><div class='icon'><span></span></div><div class='info'><h3>Notification message</h3><p>$field_name is unsucessfull saved into our databases.</p></div></div>";
			exit();
	}
	}else{
		insertTwoColumns($conn,"linked",$col,$id,$col2,$row2);
	}
}
if(isset($_POST['update-field'])){
$field_name = $_POST["field_name"];
	$field_value = $_POST["field_value"];	
	$field_type = $_POST["field_value"];	
	$client_id = $_POST["client_id"];	
	echo $field_name.$field_value;
	$db="client";
	if($field_type==="edit-contact"){
		$db="contact";
	}
	if(setDataBy($conn,$db,$field_name,$field_value,"id",$client_id)){
		echo"<div class='content sucess'><div class='icon'><span></span></div><div class='info'><h3>Notification message</h3><p>$field_name is sucessfull saved into our databases.</p></div></div>";
			exit();
	}else{
		echo"<div class='content error'><div class='icon'><span></span></div><div class='info'><h3>Notification message</h3><p>$field_name is unsucessfull saved into our databases.</p></div></div>";
			exit();
	}
}
if(isset($_POST['new-contact'])){
$name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $surname = $_POST['surname'];
   $surname = filter_var($surname, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $linked = $_POST['linked'];
   
   $select_user = $conn->prepare("SELECT * FROM `contact` WHERE email = ?");
   $select_user->execute([$email]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);
    
   if($select_user->rowCount() > 0){
	   echo"<div class='content error'><div class='icon'><span></span></div><div class='info'><h3>Notification message</h3><p>Contact already in our database.Try again another different email to save the contact.</p></div></div>";
		exit();
   }
    $insert_user = $conn->prepare("INSERT INTO `contact`(name,surname,email) VALUES(?,?,?)");
    $insert_user->execute([$name,$surname,$email]);
	 if($insert_user){
	echo"<div class='content sucess'><div class='icon'><span></span></div><div class='info'><h3>Notification message</h3><p>Contact is sucessfull saved into our databases.</p></div></div>";
		 exit();
		 }else{
			 echo"<div class='content error'><div class='icon'><span></span></div><div class='info'><h3>Notification message</h3><p>Contact not sucessfully saved into our database.Try again.</p></div></div>";
		exit();
		 }
}
if(isset($_POST['new-client'])){
$name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $linked = $_POST['linked'];
   $code=generateRandomCode($conn,$name);
   $select_user = $conn->prepare("SELECT * FROM `client` WHERE client_code = ?");
   $select_user->execute([$code]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);
    
   if($select_user->rowCount() > 0){
      $code=generateRandomCode($conn,$name);
   }else{
     
         $insert_user = $conn->prepare("INSERT INTO `client`(client_code, name,email) VALUES(?,?,?)");
         $insert_user->execute([$code,$name,$email]);
		 if($insert_user){
			 $client_id =$conn->lastInsertId();
			 $linked_array=str_split($linked);
			 foreach($linked_array as $item){
				$insert_link = $conn->prepare("INSERT INTO `linked`(client_id, contact_id) VALUES(?,?)");
         $insert_link->execute([$client_id,$item]);
			 }		 
			
		 echo"<div class='content sucess'><div class='icon'><span></span></div><div class='info'><h3>Notification message</h3><p>Information is sucessfull saved into our databases.</p></div></div>";
		 exit();
		 }else{
			 echo"<div class='content error'><div class='icon'><span></span></div><div class='info'><h3>Notification message</h3><p>Information not sucessfully saved into our database.Try again.</p></div></div>";
		exit();
		 }
     
   }
   
}
function generateRandomCode($conn,$name){
	$part_two="";
	$part_one="";
	$sql = $conn->query("SELECT id FROM client ORDER BY id DESC LIMIT 1");
   $row = $sql->fetch(PDO::FETCH_ASSOC);
   $db_id=$row['id'];
 
	print_r($row);
	$val_int=(int) $db_id;
	if($val_int<10){
	$part_two="00".$db_id;
	}else if($val_int<100 && $val_int>9){
		$part_two="0".$db_id;
	}else {
		$part_two="0".$db_id;
	}
	if(strlen($name)>2){
	$part_one=substr($name,0,3);
	}else{
		$part_one=substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0,3);
	}
	
	$code=$part_one.$part_two;
	return $code;
}

if(isset($_POST['validate-data'])){
	$field_name=$_POST['field_name'];
	$field_type=$_POST['field_type'];
	
	
	switch($field_type){
		
		case "email":
		if(isValidEmail($field_name)){
			echo "isvalid";
			}else{
			echo "isnotvalid";
				}
		break;
		
		case "name":
		if(isValidString($field_name)){
		echo "isvalid";
			}else{
			echo "isnotvalid";
		}
		break;
		
		case "phone":
		if(isValidPhone($field_name)){echo "isvalid";}else{echo "isnotvalid";}
		break;
	}
}
function removeTags($data){
	$data=trim($data);
	$data=stripslashes($data);
	$data=htmlspecialchars($data);
	return $u;
}
function isValidString($s){
	if(!empty($s)){
	if(preg_match("/^[_a-zA-z0-9- ]+$/",$s) && !is_numeric($s[0])){
		
		if(strlen($s) > 1 && strlen($s) < 20){
			
		return true;	
		}
	}else{
		
	return false;
	}
	}else{return false;}
}
function isValidNameString($s){
	if(!empty($s)){
	if(preg_match("/^[_a-zA-z0-9- ]+$/",$s) && !is_numeric($s[0])){
		if(strlen($s) > 3 && strlen($s) < 20){
		return true;	
		}
	}else{
	return false;
	}
	}else{return false;}
}
function isValidPhone($s){
	if(!empty($s)){
	$length=strlen($s);
	if(preg_match("/^[0-9]*$/",$s) && $length<10){
		return true;
	}else{
	return false;
	}
}else{return false;}
}
function isValidEmail($s){
	if(!empty($s)){
	//$pattern="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$^";
	$pattern="^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$^";
	if(preg_match($pattern,$s)){
		return true;
	}else{
	return false;
	}
}else{return false;}
}
?>