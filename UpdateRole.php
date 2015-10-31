<?php
require_once("RoleDAO.php");
$name=$_GET["name"];
$code=$_GET["code"];
try{
    $role=new Role();
    $role->name=$name;
    $role->code=$code;
	$roleDAO=new RoleDAO();
    $roles=$roleDAO->update($role);                    
    echo "Updated";
   }catch(Exception $exception)
    {
    echo $exception->getMessage();
    }


?>