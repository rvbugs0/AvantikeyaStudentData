<?php
class DatabaseConnection
{
 public static function getConnection()
 {
 $c=null;
 try
 {
 $c=new PDO("mysql:host=localhost;dbname=school","root","ailani");
 $c->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 }catch(PDOException $pe)
 {
 return null;
 }
 catch(Exception $e)
 {
 return null;
 }
 return $c;
 }
}
?>
