<?php 

include 'connect.php';

if(isset($_POST['signUp'])){
    $Name=$_POST['Name'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);

     $checkEmail="SELECT * From users where email='$email'";
     $result=$conn->query($checkEmail);
     if($result->num_rows>0){
        echo "Email Address Already Exists !";
     }
     else{
        $insertQuery="INSERT INTO users(Name,username,email,password)
                       VALUES ('$Name','$username','$email','$password')";
            if($conn->query($insertQuery)==TRUE){
                header("location:http://localhost/log/login.html");
            }
            else{
                echo "Error:".$conn->error;
            }
     }
}

if(isset($_POST['signIn'])){
   $username=$_POST['username'];
   $password=$_POST['password'];
   $password=md5($password) ;
   
   $sql="SELECT * FROM users WHERE username='$username' and password='$password'";
   $result=$conn->query($sql);
   if($result->num_rows>0){
    session_start();
    $row=$result->fetch_assoc();
    $_SESSION['username']=$row['ussername'];
    header("Location:http://127.0.0.1:5500/index.html");
    exit();
   }
   else{
    echo "Not Found, Incorrect Email or Password";
   }

}
?>