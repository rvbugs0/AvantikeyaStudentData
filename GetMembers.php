<?php
require_once("MemberDAO.php");
echo "[";
try{
	$memberDAO=new MemberDAO();

    $members=$memberDAO->getAll();                    

  
    $x=0;
    foreach ($members as $member ) 
    {
    	if($x>0)
    	{
    		echo ",";
    	}

    	$code=trim($member->code);
    	$name=trim($member->name);
        $roleName = trim($member->roleName);
        $roleCode= trim($member->role);
        $dateOfBirth= trim($member->dateOfBirth);
        $gender = trim($member->gender);
        $departmentCode = trim($member->department);
        $departmentName = trim($member->departmentName);
        $address = trim($member->address);
        $email = trim($member->email);
        $phone = $member->phone;
        $institution=$member->institution;
    echo '{"code":'.$code.',"name":"'.$name.'","roleName":"'.$roleName.'","dateOfBirth":"'.$dateOfBirth.'",
    "gender":"'.$gender.'","departmentName":"'.$departmentName.'","address":"'.$address.'","email":"'.$email.'",
    "phone":"'.$phone.'","institution":"'.$institution.'","roleCode":'.$roleCode.',"departmentCode":'.$departmentCode.'}';
    $x++;
    }
    
   }
   catch(Exception $exception)
    {
//    echo $exception->getMessage();
    }
echo "]";

?>