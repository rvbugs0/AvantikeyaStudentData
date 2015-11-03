<?php
require_once("MemberDAO.php");
$name=str_replace('"',"'",trim($_GET["name"]));
$email=str_replace('"',"'",trim($_GET["email"]));
$phone=str_replace('"',"'",trim($_GET["phone"]));
$address=str_replace('"',"'",trim($_GET["address"]));
$department=str_replace('"',"'",trim($_GET["department"]));
$institution=str_replace('"',"'",trim($_GET["institution"]));
$gender=str_replace('"',"'",trim($_GET["gender"]));
$role=str_replace('"',"'",trim($_GET["role"]));
$dob=str_replace('"',"'",trim($_GET["dob"]));
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