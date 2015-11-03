<?php
require_once("DepartmentDAO.php");
$name=str_replace('"',"'",$_GET["name"]);

try{
    $department=new Department();
    $department->name=trim($name);
	$departmentDAO=new DepartmentDAO();
    $departments=$departmentDAO->add($department);                    
    echo "Added";
   }catch(Exception $exception)
    {
    echo $exception->getMessage();
    }


?>