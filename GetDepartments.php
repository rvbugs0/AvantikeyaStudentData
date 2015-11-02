<?php
require_once("DepartmentDAO.php");

try{
	$departmentDAO=new DepartmentDAO();
    $departments=$departmentDAO->getAll();                    
    echo "[";
    $x=0;
    foreach ($departments as $department ) 
    {
    	if($x>0)
    	{
    		echo ",";
    	}
    	$code=trim($department->code);
    	$name=trim($department->name);
    echo '{"code":'.$code.',"name":"'.$name.'"}';
    $x++;
    }
    echo "]";
   }catch(Exception $exception)
    {
    echo $exception->getMessage();
    }


?>