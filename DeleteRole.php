<?php
require_once("RoleDAO.php");
$code=$_GET["code"];
try
{
$roleDAO=new RoleDAO();
$roleDAO->delete($code);
echo "Successfully Deleted";
}
catch(Exception $exception)
{
echo $exception->getMessage();
}


?>