<?php
$name1=$_POST['name1'];
$email=$_POST['email'];
$pass=$_POST['pass'];
$cpass=$_POST['cpass'];


if(!empty($name1)||!empty($email)||!empty($pass)||!empty($cpass)){
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
    if($pass===$cpass){

    $host="localhost";
    $dbusername="root";
    $dbpassword="";
    $dbname="project";

    $conn =new mysqli($host,$dbusername,$dbpassword,$dbname);
    if(mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
    }
    else{
        $SELECT ="SELECT email FROM register WHERE email=? LIMIT 1";
        $INSERT="INSERT INTO register(name1,email,pass,cpass)values(?,?,?,?)";

        $stmt=$conn->prepare($SELECT);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum=$stmt->num_rows;
        if($rnum==0){
            $stmt->close();
            $stmt=$conn->prepare($INSERT);
            $stmt->bind_param("ssss",$name1,$email,$pass,$cpass);
            $stmt->execute();
            echo "Register Successfully";
        }else{
            echo "Someone already registered using this email";
            header('location:login.html');
        }
        $stmt->close();
        $conn->close();    
    }
    }else{
        echo "Please enter a correct password";
    }
}else{
    echo "Enter a Valid Email";
}
}else{
    echo "All fields are required";
    die();
}
?>