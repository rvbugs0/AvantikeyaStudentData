<?php
require_once("RoleDAO.php");
$name=$_GET["name"];

try{
    $role=new Role();
    $role->name=trim($name);
	$roleDAO=new RoleDAO();
    $roles=$roleDAO->add($role);                    
    echo "Added";
   }catch(Exception $exception)
    {
    echo $exception->getMessage();
    }


?>