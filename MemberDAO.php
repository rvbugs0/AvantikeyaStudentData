
	<?php
	/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	*/
	require_once("DatabaseConnection.php");
	require_once("DAOException.php");
	require_once("Member.php");
	class MemberDAO 
	{

		public function getAll()
		{
			$c=DatabaseConnection::getConnection();
			try
			{
				$sql="select phone,role as role_code,department as department_code,email,institution,address,gender, dateOfBirth ,tbl_member.code as code ,tbl_member.name as name , tbl_role.name as role_name , tbl_department.name as department_name from tbl_member inner join tbl_department  on tbl_department.code = tbl_member.department inner join tbl_role  on tbl_role.code = tbl_member.role ;";
				$rs=$c->query($sql);
				$x=0;
				$members=[];
				foreach ($rs as $row ) 
				{
					$member=new Member();
					$member->code = trim($row["code"]);
					$member->name = trim($row["name"]);
					$member->role= trim($row["role_code"]);
					$member->roleName= trim($row["role_name"]);
					$member->email = trim($row["email"]);
					$member->phone = trim($row["phone"]);
					$member->dateOfBirth = trim($row["dateOfBirth"]);
					$member->gender= trim($row["gender"]);
					$member->address = trim($row["address"]);
					$member->institution= trim($row["institution"]);	
					$member->department= trim($row["department_code"]);
					$member->departmentName= trim($row["department_name"]);	
					$members[$x]=$member;
					$x++;
				}
				if($x==0)
				{
				$rs=null;
				$ps=null;
				$c=null;
				throw new DAOException("MemberDAO : getAll : No records ");
				}
				$rs=null;
				$ps=null;
				$c=null;
				return $members;
			}
			catch(Exception $exception)
			{
				throw new DAOException("MemberDAO : getAll() : ".$exception->getMessage());
			}
		}

		public function add($member)
		{
			try
			{
				$c=DatabaseConnection::getConnection();
				if(self::existsByEmail($member->email)==true)
				{
				throw new  DAOException("MemberDAO : add : Member Already exists ".$member->email);				
				}
				$ps=$c->prepare("insert into tbl_member (name,role,email,phone,dateOfBirth,gender,address,institution,department) values (?,?,?,?,?,?,?,?,?)");
				$ps->bindParam(1,$member->name);
				$ps->bindParam(2,$member->role);
				$ps->bindParam(3,$member->email);
				$ps->bindParam(4,$member->phone);
				$ps->bindParam(5,$member->dateOfBirth);
				$ps->bindParam(6,$member->gender);
				$ps->bindParam(7,$member->address);
				$ps->bindParam(8,$member->institution);
				$ps->bindParam(9,$member->department);	
				$ps->execute();
				$ps=null;
				$c=null;
				
			}
			catch(Exception $exception)
			{
				throw new  DAOException("MemberDAO : add : ".$exception->getMessage());
			}
		}


			public function update($member)
		{
			try
			{
				$c=DatabaseConnection::getConnection();
				if(self::exists($member->code)==false)
				{
				throw new  DAOException("MemberDAO : update : Invalid Member Code ".$member->code);				
				}
				$tempMember=null;
				$valid=true;
				try
				{
					$tempMember=self::getByName($member->name);
					if($tempMember->code!=$member->code)
					{
						$valid=false;
					}

				}
				catch(Exception $exception)
				{

				}
				if($valid==false)
				{
				throw new  DAOException("MemberDAO : update : Member with same name already exists ".$member->name);
				}
				$ps=$c->prepare("update tbl_member set name=? where code = ?");
				$ps->bindParam(1,$member->name);
				$ps->bindParam(2,$member->code);
				$ps->execute();
				$ps=null;
				$c=null;
				}		
			catch(Exception $exception)
			{
				throw new  DAOException("MemberDAO : add : ".$exception->getMessage());
				
			}
		}



		public function delete($code)
		{
			try
			{
				$c=DatabaseConnection::getConnection();
				if(self::exists($code)==false)
				{
				throw new  DAOException("MemberDAO : delete : Invalid code ".$code);				
				}
				$ps=$c->prepare("delete from tbl_member  where code = ?");
				$ps->bindParam(1,$code);
				$ps->execute();
				$ps=null;
				$c=null;
			}
			catch(Exception $exception)
			{
				throw new  DAOException("MemberDAO : delete : ".$exception->getMessage());
				
			}
		}	



				public function getByEmail($memberEmail)
		{
			try
			{
				$c=DatabaseConnection::getConnection();
				$ps=$c->prepare("select * from tbl_member where email=?");
				$ps->bindParam(1,$memberEmail);
				$rs=$ps->execute();
				$member=null;
				$x=0;
				foreach ($rs as $row) {
				$member=new Member();
				$member->code = $row["code"];
				$member->name = $row["name"];
				$member->$role= $row["role"];
				$member->email = $row["email"];
				$member->phone = $row["phone"];
				$member->dateOfBirth = $row["dateOfBirth"];
				$member->gender= $row["gender"];
				$member->address = $row["address"];
				$member->department=$row["department"];		
				$member->institution=$row["institution"];	
				$x++;
				}
				if($x==0)
				{
				$rs=null;
				$ps=null;
				$c=null;
				throw new  DAOException("MemberDAO : getByEmail : Invalid Email");				
				}
				$rs=null;
				$ps=null;
				$c=null;
				return $member;
			}
			catch(Exception $exception)
			{
				throw new  DAOException("MemberDAO : getByEmail : ".$exception->getMessage());
				
			}
		}	

		public function get($code)
		{
			try
			{
				$c=DatabaseConnection::getConnection();
				$ps=$c->prepare("select * from tbl_member where code=?");
				$ps->bindParam(1,$code);
				$rs=$ps->execute();
				$member=null;
				$x=0;
				foreach ($rs as $row) {
				$member=new Member();
				$member->code = $row["code"];
				$member->name = $row["name"];
				$member->$role= $row["role"];
				$member->email = $row["email"];
				$member->phone = $row["phone"];
				$member->dateOfBirth = $row["dateOfBirth"];
				$member->gender= $row["gender"];
				$member->address = $row["address"];
				$member->institution=$row["institution"];	
						$member->department=$row["department"];					
				$x++;
				}
				if($x==0)
				{
				$rs=null;
				$ps=null;
				$c=null;
				throw new  DAOException("MemberDAO : get : Invalid code");				
				}
				$rs=null;
				$ps=null;
				$c=null;
				return $member;
			}
			catch(Exception $exception)
			{
				throw new  DAOException("MemberDAO : get : ".$exception->getMessage());
				
			}
		}

		public function exists($code)
		{
			try
			{
				$c=DatabaseConnection::getConnection();
				$rs=$c->query("select * from tbl_member where code = ".$code);
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
				throw new  DAOException("MemberDAO : exists : ".$exception->getMessage());
				
			}
		}	

		public function existsByemail($memberEmail)
		{
			try
			{
				$c=DatabaseConnection::getConnection();
				$ps=$c->prepare("select * from tbl_member where email=?");
				$ps->bindParam(1,$memberEmail);
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
				throw new  DAOException("MemberDAO : existsByEmail : ".$exception->getMessage());
				
			}
		}

	}

	?>