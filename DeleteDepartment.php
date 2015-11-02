<?php
require_once("DepartmentDAO.php");
$code=$_GET["code"];
try
{
$departmentDAO=new DepartmentDAO();
$departmentDAO->delete($code);
echo "Successfully Deleted";
}
catch(Exception $exception)
{
echo $exception->getMessage();
}


?>