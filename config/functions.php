<?php
function getDataByLimit($conn,$table,$limit){
	 $resultArray = array();
	$select_data = $conn->query("SELECT * FROM $table LIMIT $limit");
        // $select_orders->execute([$user_id]);
         if($select_data->rowCount() > 0){
            while($fetch_data_item = $select_data->fetch(PDO::FETCH_ASSOC)){
				$resultArray[] = $fetch_data_item;
			}
		 }
		 return $resultArray;
}
function insertTwoColumns($conn,$tb,$col1,$row1,$col2,$row2){
	$insert_user = $conn->prepare("INSERT INTO $tb ($col1,$col2) VALUES(?,?)");
    $insert_user->execute([$row1,$row2]);
	 if($insert_user){
	echo"<div class='content sucess'><div class='icon'><span></span></div><div class='info'><h3>Notification message</h3><p>Contact is sucessfull saved into our databases.</p></div></div>";
		 exit();
		 }else{
			 echo"<div class='content error'><div class='icon'><span></span></div><div class='info'><h3>Notification message</h3><p>Contact not sucessfully saved into our database.Try again.</p></div></div>";
		exit();
		 }
}
function getData($conn,$table){
	 $resultArray = array();
	$select_data = $conn->query("SELECT * FROM $table");
        // $select_orders->execute([$user_id]);
         if($select_data->rowCount() > 0){
            while($fetch_data_item = $select_data->fetch(PDO::FETCH_ASSOC)){
				$resultArray[] = $fetch_data_item;
			}
		 }
		 return $resultArray;
}
function setDataBy($conn,$table,$row1,$col1,$row2,$col2){
	$update_sql = $conn->prepare("UPDATE $table set $row1 = ? WHERE $row2 = ?");
	echo "UPDATE $table set $row1 = ? WHERE $row2 = ?";
   $update_sql->execute([$col1, $col2]);
   if($update_sql->rowCount()){return true;}else{return false;}
}



function setDeleteBy($conn,$table,$id){
	
   $delete_row_item = $conn->prepare("DELETE FROM `$table` WHERE id = ?");
   $delete_row_item->execute([$id]);
   if($delete_row_item->rowCount()){return true;}else{return false;}
}
function getDataBy($conn,$table,$col,$id){
	 $resultArray = array();
	$select_data = $conn->query("SELECT * FROM $table WHERE $col='$id'");
        // $select_orders->execute([$user_id]);
         if($select_data->rowCount() > 0){
            while($fetch_data_item = $select_data->fetch(PDO::FETCH_ASSOC)){
				$resultArray[] = $fetch_data_item;
			}
		 }
		 return $resultArray;
}
function getCountby($conn,$table,$col,$id){
	$sql= $conn->prepare("SELECT * FROM $table WHERE $col = ?");
         $sql->execute([$id]);
         return $sql->rowCount();
}
function getCount($conn,$table){
	$sql= $conn->prepare("SELECT * FROM $table");
         $sql->execute();
         return $sql->rowCount();
}
?>