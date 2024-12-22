<?php 

include 'db.php';

if(isset($_POST['signUp'])){
    $id==$_POST['id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $created_at=$_POST['created_at'];
    // $password=md5($password);
    // $phone=$_POST['phone'];
    // $driver_license=$_POST['driverlicense'];

     $checkEmail="SELECT * From customers where email='$email'";
     $result=$conn->query($checkEmail);
     if($result->num_rows>0){
        echo "Email Address Already Exists !";
     }
     else{
        $insertQuery = "INSERT INTO customers (id, `name`, email, created_at ) 
        VALUES ('$id', '`$name`', '$email', '$created_at')";

            if($conn->query($insertQuery)==TRUE){
                header("location: index.php");
            }
            else{
                echo "Error:".$conn->error;
            }
     }
   

}

if(isset($_POST['signIn'])){
   $email=$_POST['email'];
   $password=$_POST['password'];
   // $password=md5($password) ;
   
   $sql="SELECT * FROM customers WHERE email='$email' AND  password='$password'";
   $result=$conn->query($sql);
   if (!$result) {
      die("Query Failed: " . $conn->error); // Debug the error
  }
   if($result->num_rows>0){
    session_start();
    $row=$result->fetch_assoc();
    $_SESSION['email']=$row['email'];
     header("Location: index.php");
    exit();
   }
   else{
    echo "Not Found, Incorrect Email or Password";
   }

}
?>