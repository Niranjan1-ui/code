<?php
$conn=new
mysqli("localhost","root","","college");
if($conn->connect_error){
    die("Connection Failed:" .
    $conn->connect_error);
}
if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $stmt=$conn->prepare("INSERT INTO students(name,email) VALUES(?,?)"
        );
        if(!$stmt){
            die("Query preparation failed:".$conn->error);
        }
        $stmt->bind_param("ss",$name,$email);
        if($stmt->execute()) {
            echo"Registration Successful!";
        }else{
            echo"Error:".$stmt->error;
        }
            $stmt->close();
}
            $conn->close();
?>
