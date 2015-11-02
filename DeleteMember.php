<?php
require_once("MemberDAO.php");
$code=$_GET["code"];
try
{
$memberDAO=new MemberDAO();
$memberDAO->delete($code);
echo "Successfully Deleted";
}
catch(Exception $exception)
{
echo $exception->getMessage();
}


?>