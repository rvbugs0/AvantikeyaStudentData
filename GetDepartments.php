<?php
require_once("DepartmentDAO.php");
    echo "[";
try{
	$departmentDAO=new DepartmentDAO();
    $departments=$departmentDAO->getAll();                    

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

   }catch(Exception $exception)
    {
//    echo $exception->getMessage();
    }
    echo "]";

?>