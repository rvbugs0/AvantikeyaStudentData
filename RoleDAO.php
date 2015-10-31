	<?php
	require_once("DatabaseConnection.php");
	require_once("DAOException.php");
	require_once("Role.php");
	class RoleDAO 
	{
		public function getAll()
		{
			$c=DatabaseConnection::getConnection();
			try
			{
				$rs=$c->query("select * from tbl_role");
				
				$x=0;
				$roles=[];
				foreach ($rs as $row ) 
				{
					$role=new Role();
					$role->code = $row["code"];
					$role->name = $row["name"];
					$roles[$x]=$role;
					$x++;
				}
				if($x==0)
				{
				$rs=null;
				$c=null;
				throw new DAOException("RoleDAO : getAll : No records ");
				}
				$rs=null;
				$ps=null;
				$c=null;
				return $roles;
			}
			catch(Exception $exception)
			{
				throw new DAOException("RoleDAO : getAll() : ".$exception->getMessage());
			}
		}

		public function add($role)
		{
			try
			{
				$c=DatabaseConnection::getConnection();
				if(self::existsByName($role->name)==true)
				{
				throw new  DAOException("RoleDAO : add : Role Already exists ".$role->name);				
				}
				$ps=$c->prepare("insert into tbl_role (name) values (?)");
				$ps->bindParam(1,$role->name);
				$ps->execute();
				$ps=null;
				$c=null;
				
			}
			catch(Exception $exception)
			{
				throw new  DAOException("RoleDAO : add : ".$exception->getMessage());
				
			}
		}


			public function update($role)
		{
			try
			{
				$c=DatabaseConnection::getConnection();
				if(self::exists($role->code)==false)
				{
				throw new  DAOException("RoleDAO : update : Invalid Role Code ".$role->code);				
				}
				$tempRole=null;
				$valid=true;
				try
				{
					$tempRole=self::getByName($role->name);
					if($tempRole->code!=$role->code)
					{
						$valid=false;
					}

				}
				catch(Exception $exception)
				{

				}
				if($valid==false)
				{
				throw new  DAOException("RoleDAO : update : Role with same name already exists ".$role->name);
				}
				$ps=$c->prepare("update tbl_role set name=? where code = ?");
				$ps->bindParam(1,$role->name);
				$ps->bindParam(2,$role->code);
				$ps->execute();
				$ps=null;
				$c=null;
				}		
			catch(Exception $exception)
			{
				throw new  DAOException("RoleDAO : add : ".$exception->getMessage());
				
			}
		}



		public function delete($code)
		{
			try
			{
				$c=DatabaseConnection::getConnection();
				if(self::exists($code)==FALSE)
				{
				throw new  DAOException("RoleDAO : delete : Invalid code ".code);				
				}
				$role=self::get($code);
				/*
				if(new MemberDAO().getCountByRole($role->name))
				{
				throw new  DAOException("RoleDAO : delete : Role used against some member(s) ".$role->name);	
				}
				*/
				$ps=$c->prepare("delete from tbl_role  where code = ?");
				$ps->bindParam(1,$role->code);
				$ps->execute();
				$ps=null;
				$c=null;
			}
			catch(Exception $exception)
			{
				throw new  DAOException("RoleDAO : delete : ".$exception->getMessage());
				
			}
		}	


		public function getByName($roleName)
		{
			try
			{
				$c=DatabaseConnection::getConnection();
				$ps=$c->prepare("select * from tbl_role where name=?");
				$ps->bindParam(1,$roleName);
				$rs=$ps->execute();
				$role=null;
				$x=0;
				foreach ($rs as $row) {
				$role=new Role();
				$role->code = $row["code"];
				$role->name = $row["name"];
				$x++;
				}
				if($x==0)
				{
				$rs=null;
				$ps=null;
				$c=null;
				throw new  DAOException("RoleDAO : getByName : Invalid name");				
				}
				$rs=null;
				$ps=null;
				$c=null;
				return $role;
			}
			catch(Exception $exception)
			{
				throw new  DAOException("RoleDAO : getByName : ".$exception->getMessage());
				
			}
		}	

		public function get($code)
		{
			try
			{
				$c=DatabaseConnection::getConnection();
				$rs=$c->query("select * from tbl_role where code = ".$code);
				$role=null;
				$x=0;
				foreach ($rs as $row) {
				$role=new Role();
				$role->code = $row["code"];
				$role->name = $row["name"];
				$x++;
				}
				if($x==0)
				{
				$rs=null;
				$c=null;
				throw new  DAOException("RoleDAO : get : Invalid code");				
				}
				$rs=null;
				$c=null;
				return $role;
			}
			catch(Exception $exception)
			{
				throw new  DAOException("RoleDAO : get : ".$exception->getMessage());
			}
		}

		public function exists($code)
		{
			try
			{
				$c=DatabaseConnection::getConnection();
				$rs=$c->query("select * from tbl_role where code =".$code);
				$x=0;
				foreach ($rs as $row) {
					$x++;
				}
				$rs=null;
				$c=null;
				if($x>0)
				{
					return TRUE;
				}
				return FALSE;
			}
			catch(Exception $exception)
			{
				throw new  DAOException("RoleDAO : exists : ".$exception->getMessage());
				
			}
		}	

		public function existsByName($roleName)
		{
			try
			{
				$c=DatabaseConnection::getConnection();
				$ps=$c->prepare("select * from tbl_role where name=?");
				$ps->bindParam(1,$roleName);
				$rs=$ps->execute();
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
				throw new  DAOException("RoleDAO : existsByName : ".$exception->getMessage());
				
			}
		}

	}

	?>