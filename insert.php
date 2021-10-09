<?php
$username = $_POST['signupUserName'];
$password = $_POST['signupPassword'];
if(!empty($username) || !empty($password)){
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "connectlogin";
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if(mysqli_connect_error()){
        die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());

    }else{
        $SELECT = "SELECT  username From 'login' Where username = ? Limit 1";
        $INSERT = "INSERT Into 'login' ('username', 'password') values('?','?')";
        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $stmt->bind_result($username);
        $stmt->store_result();
        $rnum = $stmt->num_rows;
        if ($rnum==0) {
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ss",$username,$password);
            $stmt-> execute();
            header('Location:project.html');
            
        }else{
            header("Location: index.php?error= Username already exists");
            exit();
        }
        $stmt->close();
        $conn->close();
    }

}else{
    if(empty($username)){
        header("Location: index.php?error= User Name is required");
        exit();

    }else if(empty($password)){
        header("LOcation: index.php?error= Password is required");
        exit();
    }

}
?>