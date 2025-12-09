<?php
session_start();
include 'connect.php';

//user register
if(isset($_POST['register'])){

    $user=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $role=$_POST['role'];
    $pass=password_hash($password,PASSWORD_DEFAULT);

    $checkEmail="SELECT * FROM users WHERE user_email='$email'";
    $result=$conn->query($checkEmail);
    if($result->num_rows>0){
        $_SESSION['register_error']='Email Is Already Registered!';
        $_SESSION['active_form']='register';
    }
    else{
        $insert="INSERT INTO users(user_name,user_email,user_pass,user_role)
                 VALUES('$user','$email','$pass','$role')";
        $conn->query($insert);
        }
    header("location: signIn.php");
    exit();
}

//user login 
if(isset($_POST['login'])){

    $email=$_POST['email'];
    $password=$_POST['password'];

    $sql="SELECT * FROM users WHERE user_email='$email'";
    $result=$conn->query($sql);
    if($result->num_rows>0){
        $row=$result->fetch_assoc();
        if(password_verify($password,$row['user_pass'])){
            $_SESSION['user_id']=$row['user_id'];
            $_SESSION['user']=$row['user_name'];
            $_SESSION['email']=$row['user_email'];
            $_SESSION['role']=$row['user_role'];
            header("location: ../homepage/home.php");
            exit();
        }  
    }
    $_SESSION['login_error']='Incorrect Email or Password';
    $_SESSION['active_form']='login';
    header("location: signIn.php");
    exit();
}
?>