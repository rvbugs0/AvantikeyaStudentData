<?php
require_once("MemberDAO.php");
$name=trim($_GET["name"]);
$email=trim($_GET["email"]);
$phone=trim($_GET["phone"]);
$address=trim($_GET["name"]);
$department=trim($_GET["department"]);
$institution=trim($_GET["institution"]);
$gender=trim($_GET["gender"]);
$role=trim($_GET["role"]);
$dob=trim($_GET["dob"]);
try{
    $member=new Member();
    $member->name=$name;
	$member->email=$email;
	$member->phone=$phone;
	$member->address=$address;
	$member->department=$department;
	$member->institution=$institution;
	$member->gender=$gender;
	$member->role=$role;
	$member->dateOfBirth=$dob;
	$memberDAO=new MemberDAO();
    $members=$memberDAO->add($member);                    
    echo "Added";
   }catch(Exception $exception)
    {
    echo $exception->getMessage();
    }


?>