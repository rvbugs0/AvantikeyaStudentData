<?php
require_once("RoleDAO.php");
    echo "[";
try{
	$roleDAO=new RoleDAO();
    $roles=$roleDAO->getAll();                    

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

   }catch(Exception $exception)
    {
//    echo $exception->getMessage();
    }
    echo "]";

?>