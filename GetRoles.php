<?php
require_once("RoleDAO.php");

try{
	$roleDAO=new RoleDAO();
    $roles=$roleDAO->getAll();                    
    echo "[";
    $x=0;
    foreach ($roles as $role ) 
    {
    	if($x>0)
    	{
    		echo ",";
    	}
    	$code=trim($role->code);
    	$name=trim($role->name);
    echo '{"code":'.$code.',"name":"'.$name.'"}';
    $x++;
    }
    echo "]";
   }catch(Exception $exception)
    {
    echo $exception->getMessage();
    }


?>