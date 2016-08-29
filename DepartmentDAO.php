<?php
require_once("DatabaseConnection.php");
require_once("DAOException.php");
require_once("Department.php");
require_once("MemberDAO.php");
class DepartmentDAO 
{
	public function getAll()
	{
		$c=DatabaseConnection::getConnection();
		try
		{
			$rs=$c->query("select * from tbl_department");
			$x=0;
			$departments=[];
			foreach ($rs as $row ) 
			{
				$department=new Department();
				$department->code = $row["code"];
				$department->name = $row["name"];
				$departments[$x]=$department;
				$x++;
			}
			if($x==0)
			{
			$rs=null;
			$ps=null;
			$c=null;
			throw new DAOException("DepartmentDAO : gelAll : No records ");
			}
			$rs=null;
			$ps=null;
			$c=null;
			return $departments;
		}
		catch(Exception $exception)
		{
			throw new DAOException("DepartmentDAO : getAll() : ".$exception->getMessage());
		}
	}

	public function add($department)
	{
		try
		{
			$c=DatabaseConnection::getConnection();
			if(self::existsByName($department->name)==true)
			{
			throw new  DAOException("DepartmentDAO : add : Department Already exists ".$department->name);				
			}
			$ps=$c->prepare("insert into tbl_department (name) values (?)");
			$ps->bindParam(1,$department->name);
			$ps->execute();
			$ps=null;
			$c=null;
			
		}
		catch(Exception $exception)
		{
			throw new  DAOException("DepartmentDAO : add : ".$exception->getMessage());
			
		}
	}


		public function update($department)
	{
		try
		{
			$c=DatabaseConnection::getConnection();
			if(self::exists($department->code)==false)
			{
			throw new  DAOException("DepartmentDAO : update : Invalid Department Code ".$department->code);				
			}
			$tempDepartment=null;
			$valid=true;
			try
			{
				$tempDepartment=self::getByName($department->name);
				if($tempDepartment->code!=$department->code)
				{
					$valid=false;
				}

			}
			catch(Exception $exception)
			{

			}
			if($valid==false)
			{
			throw new  DAOException("DepartmentDAO : update : Department with same name already exists ".$department->name);
			}
			$ps=$c->prepare("update tbl_department set name=? where code = ?");
			$ps->bindParam(1,$department->name);
			$ps->bindParam(2,$department->code);
			$ps->execute();
			$ps=null;
			$c=null;
			}		
		catch(Exception $exception)
		{
			throw new  DAOException("DepartmentDAO : add : ".$exception->getMessage());
			
		}
	}



	public function delete($code)
	{
		try
		{
			$c=DatabaseConnection::getConnection();
			if(self::exists($code)==false)
			{
			throw new  DAOException("DepartmentDAO : delete : Invalid code ".$code);				
			}
			$memberDAO=new MemberDAO();
			if($memberDAO->getCountByDepartment($code)>0)
			{
			throw new  DAOException("DepartmentDAO : delete : Department used against some member(s) ".$code);	
			}
			$ps=$c->prepare("delete from tbl_department  where code = ?");
			$ps->bindParam(1,$code);
			$ps->execute();
			$ps=null;
			$c=null;
		}
		catch(Exception $exception)
		{
			throw new  DAOException("DepartmentDAO : delete : ".$exception->getMessage());
			
		}
	}	


	public function getByName($departmentName)
	{
		try
		{
			$c=DatabaseConnection::getConnection();
			$rs=$c->query("select * from tbl_department where name='".$departmentName."'");
			$department=null;
			$x=0;
			foreach ($rs as $row) {
			$department=new Department();
			$department->code = $row["code"];
			$department->name = $row["name"];
			$x++;
			}
			if($x==0)
			{
			$rs=null;
			$ps=null;
			$c=null;
			throw new  DAOException("DepartmentDAO : getByName : Invalid name");				
			}
			$rs=null;
			$ps=null;
			$c=null;
			return $department;
		}
		catch(Exception $exception)
		{
			throw new  DAOException("DepartmentDAO : getByName : ".$exception->getMessage());
			
		}
	}	

	public function get($code)
	{
		try
		{
			$c=DatabaseConnection::getConnection();
			$rs=$c->query("select * from tbl_department where code = ".$code);
			$department=null;
			$x=0;
			foreach ($rs as $row) {
			$department=new Department();
			$department->code = $row["code"];
			$department->name = $row["name"];
			$x++;
			}
			if($x==0)
			{
			$rs=null;
			$ps=null;
			$c=null;
			throw new  DAOException("DepartmentDAO : get : Invalid code");				
			}
			$rs=null;
			$ps=null;
			$c=null;
			return $department;
		}
		catch(Exception $exception)
		{
			throw new  DAOException("DepartmentDAO : get : ".$exception->getMessage());
			
		}
	}

	public function exists($code)
	{
		try
		{
			$c=DatabaseConnection::getConnection();
			$rs=$c->query("select * from tbl_department where code= ".$code);
			$x=0;
			foreach ($rs as $row) {
				$x++;
			}
			$rs=null;
			$ps=null;
			$c=null;
			if($x>0)
			{
				return true;
			}
			return false;
		}
		catch(Exception $exception)
		{
			throw new  DAOException("DepartmentDAO : exists : ".$exception->getMessage());
			
		}
	}	

	public function existsByName($departmentName)
	{
		try
		{
			$c=DatabaseConnection::getConnection();
			$rs=$c->query("select * from tbl_department where name='".$departmentName."'");
			$x=0;
			foreach ($rs as $row) {
				$x++;
			}
			$rs=null;
			$ps=null;
			$c=null;
			if($x>0)
			{
				return true;
			}
			return false;
		}
		catch(Exception $exception)
		{
			throw new  DAOException("DepartmentDAO : existsByName : ".$exception->getMessage());
			
		}
	}

}

?>