<?php
include_once 'session.php';
include 'database.php';

 class user{
     private $db;

     public function __construct()
     {
         $this->db = new database();

     }


     public function userRegistration($data){
         $name = $data['name'];
         $username = $data['username'];
         $email = $data['email'];
         $password = $data['password'];


         $email_chk = $this->emailCheck($email);

         if($name == "" OR $username=="" OR $email=="" OR $password==""){
             $msg = "<div class='alert alert-danger'> <strong>error !</strong> Field must not be empty. <div/>";
             return $msg;
         }
         if (strlen($username) < 4){
             $msg = "<div class='alert alert-danger'> <strong>error !</strong> User Name too Short. <div/>";
             return $msg;
         }elseif (preg_match('/[^a-z0-9_-]+/i' ,$username)){
             $msg = "<div class='alert alert-danger'> <strong>error !</strong> userName must be alphanumarical,dashes,underscore!<div/>";
             return $msg;
         }
         if (filter_var($email , FILTER_VALIDATE_EMAIL) == false){
             $msg = "<div class='alert alert-danger'> <strong>error !</strong> Email Address is not valid. <div/>";
             return $msg;
         }
         if ($email_chk == true){
             $msg = "<div class='alert alert-danger'> <strong>error !</strong> Email already used.<div/>";
             return $msg;
         }
         $password = md5($data['password']);

         $sql = "INSERT INTO tbl_user(name,username,email,password) VALUES (:name,:username,:email,:password)";

         $query = $this->db->pdo->prepare($sql);
         $query->bindValue(':name' ,$name);
         $query->bindValue(':username' ,$username);
         $query->bindValue(':email' ,$email);
         $query->bindValue(':password' ,$password);
         $result =$query->execute();

         if ($result){
             $msg = "<div class='alert alert-success'> <strong>Success !</strong> Registration succesfully complete....<div/>";
             return $msg;
         }
         else{
             $msg = "<div class='alert alert-danger'> <strong>error !</strong> Sorry. Problem Occured...<div/>";
             return $msg;
         }


     }

     public function emailCheck($email){
         $sql = "SELECT email FROM tbl_user WHERE email = :email";
         $query = $this->db->pdo->prepare($sql);
         $query->bindValue(':email' ,$email);
         $query->execute();

         if ($query->rowCount() >0){
             return true;
         }else{
             return false;
         }
     }

     public function getLoginUser($email,$password){
         $sql = "SELECT * FROM tbl_user WHERE email = :email AND password = :password LIMIT 1";
         $query = $this->db->pdo->prepare($sql);
         $query->bindValue(':email' ,$email);
         $query->bindValue(':password' ,$password);
         $query->execute();
         $result = $query->fetch(PDO::FETCH_OBJ);
         return $result;
     }

     public function userLogin($data){
         $email = $data['email'];
         $password = md5($data['password']);

         $email_chk = $this->emailCheck($email);

         if( $email=="" OR $password==""){
             $msg = "<div class='alert alert-danger'> <strong>error !</strong> Field must not be empty. <div/>";
             return $msg;
         }
         if (filter_var($email , FILTER_VALIDATE_EMAIL) == false){
             $msg = "<div class='alert alert-danger'> <strong>error !</strong> Email Address is not valid. <div/>";
             return $msg;
         }
         if ($email_chk == false){
             $msg = "<div class='alert alert-danger'> <strong>error !</strong> Email not exist.<div/>";
             return $msg;
         }

         $result = $this->getLoginUser($email,$password);

         if ($result){
             session::init();
             session::set("login",true);
             session::set("id",$result->id);
             session::set("name",$result->name);
             session::set("username",$result->username);
             session::set("loginMsg","<div class='alert alert-success'> <strong>Success !</strong> You are login..!<div/>");
             header("Location:index.php");
         }else{
             $msg = "<div class='alert alert-danger'> <strong>error !</strong> data not found!<div/>";
             return $msg;
         }
     }

     public function getUserData(){
         $sql = "SELECT * FROM tbl_user ORDER BY id ASC ";
         $query = $this->db->pdo->prepare($sql);
         $query->execute();
         $result = $query->fetchAll();
         return $result;
     }

     public function getUserById($id){
         $sql = "SELECT * FROM tbl_user WHERE id = :id LIMIT 1";
         $query = $this->db->pdo->prepare($sql);
         $query->bindValue(':id' ,$id);
         $query->execute();
         $result = $query->fetch(PDO::FETCH_OBJ);
         return $result;
     }

     public function userUpdate($id,$data){
         $name = $data['name'];
         $username = $data['username'];
         $email = $data['email'];


         if($name == "" OR $username=="" OR $email==""){
             $msg = "<div class='alert alert-danger'> <strong>error !</strong> Field must not be empty. <div/>";
             return $msg;
         }
         if (strlen($username) < 4){
             $msg = "<div class='alert alert-danger'> <strong>error !</strong> User Name too Short. <div/>";
             return $msg;
         }elseif (preg_match('/[^a-z0-9_-]+/i' ,$username)){
             $msg = "<div class='alert alert-danger'> <strong>error !</strong> userName must be alphanumarical,dashes,underscore!<div/>";
             return $msg;
         }
         if (filter_var($email , FILTER_VALIDATE_EMAIL) == false){
             $msg = "<div class='alert alert-danger'> <strong>error !</strong> Email Address is not valid. <div/>";
             return $msg;
         }


         $sql = " UPDATE tbl_user set
            
            name=:name,
            username=:username,
            email=:email
            WHERE id =:id";

         $query = $this->db->pdo->prepare($sql);
         $query->bindValue(':name' ,$name);
         $query->bindValue(':username' ,$username);
         $query->bindValue(':email' ,$email);
         $query->bindValue(':id' ,$id);
         $result =$query->execute();

         if ($result){
             $msg = "<div class='alert alert-success'> <strong>Success !</strong> Update Successfully....<div/>";
             return $msg;
         }
         else{
             $msg = "<div class='alert alert-danger'> <strong>error !</strong> Not Updated. Problem Occured...<div/>";
             return $msg;
         }
     }

     public function checkPass($id,$old_pass){
         $password = md5($old_pass);
         $sql = "SELECT password FROM tbl_user WHERE id = :id AND password = :password";
         $query = $this->db->pdo->prepare($sql);
         $query->bindValue(':id' ,$id);
         $query->bindValue(':password' ,$password);
         $query->execute();

         if ($query->rowCount() >0){
             return true;
         }else{
             return false;
         }

     }

     public function passUpdate($id,$data){
         $old_pass = $data['old_pass'];
         $new_pass = $data['new_pass'];
         $check_pass = $this->checkPass($id,$old_pass);

         if ($old_pass == "" OR $new_pass == ""){
             $msg = "<div class='alert alert-danger'> <strong>error !</strong> Field must not be empty.. <div/>";
             return $msg;
         }


         if ($check_pass == false){
             $msg = "<div class='alert alert-danger'> <strong>error !</strong> Old Password not match. <div/>";
             return $msg;
         }

         if (strlen($new_pass) < 4){
             $msg = "<div class='alert alert-danger'> <strong>error !</strong> Password is too Short. <div/>";
             return $msg;
         }

         $password = md5($new_pass);

         $sql = " UPDATE tbl_user set
            
            password=:password
            
            WHERE id =:id";

         $query = $this->db->pdo->prepare($sql);
         $query->bindValue(':password' ,$password);
         $query->bindValue(':id' ,$id);
         $result =$query->execute();

         if ($result){
             $msg = "<div class='alert alert-success'> <strong>Success !</strong>Password Update Successfully....<div/>";
             return $msg;
         }
         else{
             $msg = "<div class='alert alert-danger'> <strong>error !</strong>Password Not Updated. Problem Occured...<div/>";
             return $msg;
         }

     }


 }


?>