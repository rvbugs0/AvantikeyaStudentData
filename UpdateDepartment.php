<?php
require_once("DepartmentDAO.php");
$name=$_GET["name"];
$code=$_GET["code"];
try{
    $department=new Department();
    $department->name=trim($name);
    $department->code=$code;
	$departmentDAO=new DepartmentDAO();
    $departments=$departmentDAO->update($department);                    
    echo "Updated";
   }catch(Exception $exception)
    {
    echo $exception->getMessage();
    }
?>