
drop table IF EXISTS tbl_role;
drop table IF EXISTS tbl_department;
drop table IF EXISTS tbl_member;

Create table tbl_role (
	code Int NOT NULL AUTO_INCREMENT,
	name Char(100) NOT NULL,
	UNIQUE (name),
 Primary Key (code)) ENGINE = InnoDB;


Create table tbl_department (
	code Int NOT NULL AUTO_INCREMENT,
	name Char(100) NOT NULL,
	UNIQUE (name),
 Primary Key (code)) ENGINE = InnoDB;

Create table tbl_member (
	code Int NOT NULL AUTO_INCREMENT,
	name Char(50) NOT NULL,
	role int NOT NULL,
	email Char(100) NOT NULL,
	phone Char(20) NOT NULL,
	dateOfBirth Date NOT NULL,
	gender char(1) NOT NULL,
	address Varchar(200) NOT NULL,
	institution Varchar(500) NOT NULL,
	department int NOT NULL,	
UNIQUE (code),
	UNIQUE (email),
 Primary Key (code)) ENGINE = InnoDB;



Alter table tbl_member add Constraint Relationship8 Foreign Key (role) references tbl_role (code) on delete  restrict on update  restrict;
Alter table tbl_member add Constraint Relationship9 Foreign Key (department) references tbl_department (code) on delete  restrict on update  restrict;

