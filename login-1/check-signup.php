<?php
include("../public/connect.php");


$connect=connect_db('localhost','my_shop','root','');



function check_signUp($pdo,$username,$password,$email){

    $sql="SELECT count(id) FROM `users` where username=?";
    $query=$pdo->prepare($sql);
    $query->bindValue(1,$username);
    $result=$query->execute();

    $num=$query->fetch(PDO::FETCH_COLUMN);
    if($num==1){
        header('location:login.php?error=2030');
    }
    else{

    $sql="INSERT INTO `users` (`id`, `username`, `password`, `email`, `admin`) VALUES (NULL, ?, ?, ?, NULL);";

        $query=$pdo->prepare($sql);
        $query->bindValue(1,$username);
        $query->bindValue(2,$password);
        $query->bindValue(3,$email);
        $result=$query->execute();

        if($result){
            setcookie("user", $username, time() + (86400 * 365), "/");
            header('location:../index.php');
        }
        else{
            header('location:login.php');
        }
    }
}
check_signUp($connect,$_POST["username"],$_POST["password"],$_POST["email"]);




//$_POST["submit"]



