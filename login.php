<?php
$email=$_POST['email'];
$pass1=$_POST['pass1'];

$host="localhost";
$dbusername="root";
$dbpassword="";
$dbname="project";

$conn =new mysqli($host,$dbusername,$dbpassword,$dbname);
if($conn->connect_error){
    die("Failed to connect:".$conn->connect_error);
}
else{
    $stmt=$conn->prepare("select * from register where email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt_result=$stmt->get_result();
    if(!empty($email)||!empty($pass1)){

        if($stmt_result->num_rows>0){
            $data=$stmt_result->fetch_assoc();
            if($data['pass']===$pass1){
                echo "Welcome Back";
            }else{
                echo "Wrong Password";
            }
    
        }else{
            echo "Invalid Email or Password";
            header('location:register.html');
        }
    }else{
        echo "All fields are Required";
    }
}

?>