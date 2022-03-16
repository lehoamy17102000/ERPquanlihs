<?php

$_arguments = array();
if(count($_POST) > 0){
	$_arguments = $_POST;
}else if(count($_GET) > 0){
	$_arguments = $_GET;
}

if(isset($_arguments["do"])&& ($_arguments["do"] != "")){
	if(($_arguments["do"] == "add_classroom")){
		$page = "model/add_classroom.php";
	}else if(($_arguments["do"] == "add_subject")){
		$page = "model/add_subject.php";
	}else if(($_arguments["do"] == "add_grade")){
		$page = "model/add_grade.php";
	}else if(($_arguments["do"] == "add_teacher")){
		$page = "model/add_teacher.php";
	}else if(($_arguments["do"] == "update_teacher")){
		$page = "model/update_teacher.php";
	}else if(($_arguments["do"] == "add_subject_routing")){
		$page = "model/add_subject_routing.php";
	}else if(($_arguments["do"] == "add_student")){
		$page = "model/add_student.php";
	}else if(($_arguments["do"] == "update_student")){
		$page = "model/update_student.php";
	}else if(($_arguments["do"] == "add_admin")){
		$page = "model/add_admin.php";
	}else if(($_arguments["do"] == "user_login")){
		$page = "model/user_login.php";
	}else if(($_arguments["do"] == "update_admin")){
		$page = "model/update_admin.php";
	}
}else{
	header("Location: view/login.php");
}

require $page;

?>