<?php



    session_start();

    $alert = '1';
    $gender = "";    

    if (array_key_exists("logout", $_GET)) {
        
        unset($_SESSION);
        
        setcookie("id", "", time() - 60*60*3);
       
       
        $_COOKIE["id"] = "";  
        
		session_destroy();
        header("Location: loginform.php");
        
    } else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {
        
        header("Location: loggedinpage.php");
        
    }
       


    if (isset($_POST['signupsubmit'])) {
		
		 
	$link = mysqli_connect("localhost","root","","customers-313539e79c");

		 
	mysqli_connect_error();
		 

	if(mysqli_connect_error()){
		$alert = die( "There was a problem connecting to your database.");
		
	}

	if($_POST['signupUserName']=='' || $_POST['signupPassword']==''){

		$alert = "Please don't leave the fields empty";

	} else {
			
			 $query = "SELECT `id` FROM `customers` WHERE username ='".$_POST['signupUserName']."'";
            
            $result = mysqli_query($link, $query);
            
            if (mysqli_num_rows($result) > 0) {
                
                $alert = "That username has already been taken.";
                
            } else {
                
				$protected = password_hash($_POST['signupPassword'],PASSWORD_DEFAULT);
				
                $query = "INSERT INTO `customers` (`username`,`password`) VALUES ('".$_POST['signupUserName']."', '".$protected."')";
                
                
                
                if (mysqli_query($link, $query)) {
                    
                    $query = "SELECT * FROM `customers` WHERE username = '".mysqli_real_escape_string($link,$_POST['loginUserName'])."'";
				
				$result = mysqli_query($link,$query);
				
				$row = mysqli_fetch_array($result);
					 
                    
					$_SESSION['id'] = $row['id'];
					
                  
					 
					  setcookie("id",$row['id'],time()+60*60*2);
					  
                    
                    $customerusername = $_POST['signupUserName'];
                     
                    
                    $sql = "CREATE TABLE `customers-313539e79c`.`".mysqli_real_escape_string($link,$customerusername)."inbox` ( `username` VARCHAR(50) NOT NULL , `subject` VARCHAR(255) NOT NULL , `message` LONGTEXT NOT NULL , `date` DATE NOT NULL , `time` TIME(6) NOT NULL ,`readorunread` VARCHAR(50) NOT NULL, `file1` MEDIUMBLOB NOT NULL , `file2` MEDIUMBLOB NOT NULL , `file3` MEDIUMBLOB NOT NULL , `id` INT NOT NULL AUTO_INCREMENT , PRIMARY KEY (`id`)); ";
                    $sql.= "CREATE TABLE `customers-313539e79c`.`".mysqli_real_escape_string($link,$customerusername)."sent` ( `username` VARCHAR(50) NOT NULL , `subject` VARCHAR(255) NOT NULL , `message` LONGTEXT NOT NULL , `date` DATE NOT NULL , `time` TIME(6) NOT NULL ,`readorunread` VARCHAR(50) NOT NULL, `file1` MEDIUMBLOB NOT NULL , `file2` MEDIUMBLOB NOT NULL , `file3` MEDIUMBLOB NOT NULL , `id` INT NOT NULL AUTO_INCREMENT , PRIMARY KEY (`id`)); ";
                    $sql.= "CREATE TABLE `customers-313539e79c`.`".mysqli_real_escape_string($link,$customerusername)."trash` ( `username` VARCHAR(50) NOT NULL , `subject` VARCHAR(255) NOT NULL , `message` LONGTEXT NOT NULL , `date` DATE NOT NULL , `time` TIME(6) NOT NULL ,`readorunread` VARCHAR(50) NOT NULL, `file1` MEDIUMBLOB NOT NULL , `file2` MEDIUMBLOB NOT NULL , `file3` MEDIUMBLOB NOT NULL , `id` INT NOT NULL AUTO_INCREMENT , PRIMARY KEY (`id`)); ";
                    $sql.= "CREATE TABLE `customers-313539e79c`.`".mysqli_real_escape_string($link,$customerusername)."fav` ( `username` VARCHAR(50) NOT NULL , `subject` VARCHAR(255) NOT NULL , `message` LONGTEXT NOT NULL , `date` DATE NOT NULL , `time` TIME(6) NOT NULL ,`readorunread` VARCHAR(50) NOT NULL, `file1` MEDIUMBLOB NOT NULL , `file2` MEDIUMBLOB NOT NULL , `file3` MEDIUMBLOB NOT NULL , `id` INT NOT NULL AUTO_INCREMENT , PRIMARY KEY (`id`));";
                    
                    
                  if(  mysqli_multi_query($link, $sql)){
                      $alert = "Registration successful .Please log in with your credentials.";
                          
                  }
                     
                    
                     
        
                  
                } else {
                    
                    $alert = "There was a problem signing you up - please try again later.";
                    
                }
                
        
		}



    }}

if (isset($_POST['loginsubmit'])) {
		
		 
	$link = mysqli_connect("localhost","root","","customers-313539e79c");

		 
	mysqli_connect_error();
		 

	if(mysqli_connect_error()){
		$alert = "<p>There was a problem connecting to your database.</p>";
		
	}

	if($_POST['loginUserName']=='' || $_POST['loginPassword']==''){

		$alert= "<p>enter your your details</p>";

	} else {
		
		 $query = "SELECT `id` FROM `customers` WHERE username = '".mysqli_real_escape_string($link, $_POST['loginUserName'])."'";
            
            $result = mysqli_query($link, $query);
            
            if (mysqli_num_rows($result) > 0) {
				
       			$query = "SELECT * FROM `customers` WHERE username = '".mysqli_real_escape_string($link,$_POST['loginUserName'])."'";
				
				$result = mysqli_query($link,$query);
				
				$row = mysqli_fetch_array($result);
				
                if(password_verify($_POST['loginPassword'],$row['password'])){
					
					 $_SESSION['id'] = $row['id'];
					
                  
					 
					  setcookie("id",$row['id'],time()+60*60*2);
                    
					  
				  
					
					header("Location: loggedinpage.php");
				}else{
					$alert = "Incorrect password. Please try again.";
				
				}
                
            }else{
				
				$alert = "You are not registered yet. Please sign up first.";
				
			}
		
	}



	}

  
?>




<html lang="en">
  <head>
 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      

    

   <title>Connect</title>
	
	
	<style type="text/css" >
        
        body {
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	
	background-color: #5356ad;
	overflow: hidden;
}

.table {
	display: table;
	width: 100%;
	height: 100%;
}

.table-cell {
	display: table-cell;
	vertical-align: middle;
    transition: all 0.5s;
}

.container {
	position: relative;
	width: 600px;
	margin: 30px auto 0;
	height:400px;
	background-color: #999ede;
	top: 40%;
	margin-top: -160px;
    transition: all 0.5s;
}

.box {
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	overflow: hidden;
}

.box:before {
	content: " ";
	position: absolute;
	left: 152px;
	top: 50px;
	background-color: #9297e0;
	transform: rotateX(52deg) rotateY(15deg) rotateZ(-38deg);
	width: 300px;
	height: 285px;
    transition: all 0.5s;
}



.container-forms {
	position: relative;
}

.btn {
	cursor: pointer;
	text-align: center;
	margin:0 auto;
	width: 90px;
	color: #fff;
    border-style: none;
	
	
    transition: all 0.5s;
    
}

 .btn:hover {
	opacity: 0.7;
     
}

.btn,  input {
	padding: 10px 15px;
}

 input {
     
	margin: 0 auto 15px;
	
	width: 220px;
    transition: all 0.3s;
     display: block;
     cursor: pointer;
}

 .container-forms .container-info {
	text-align: left;
	font-size: 0;
}

.container-forms .container-info .info-item {
	text-align: center;
	font-size: 16px;
	width: 300px;
	height: 320px;
	display: inline-block;
	vertical-align: top;
	color: #fff;
	opacity: 1;
    transition: all 0.3s;
}

 .container-forms .container-info .info-item p {
	font-size: 20px;
	margin: 20px;
}

.container-forms .container-info .info-item .btn {
	background-color: transparent;
	border: 1px solid #fff;
}

 .container-forms .container-info .info-item .table-cell {
	padding-right: 35px;
}

 .container-forms .container-info .info-item:nth-child(2) .table-cell {
	padding-left: 35px;
	padding-right: 0;
}

 .container-form {
	overflow: hidden;
	position: absolute;
	left: 30px;
	top: -30px;
	width: 305px;
	height: 450px;
	background-color: #fff;
	box-shadow: 0 0 15px 0 rgba(0, 0, 0, 0.2);
    transition: all 0.5s;
}

 .container-form:before {
	content: "✔";
	position: absolute;
	left: 160px;
	top: -50px;
	color: #5356ad;
	font-size: 130px;
	opacity: 0;
    transition: all 0.5s;
}

.container-form .btn {
	position: relative;
	
	margin-top: 30px;
}

 .form-item {
	position: absolute;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	opacity: 1;
transition: all 0.5s;
}

 .form-item.sign-up {
	position: absolute;
	left: -100%;
	opacity: 0;
}

.log-in .box:before {
	position: absolute;
	left: 180px;
	top: 62px;
	height: 265px;
}
.log-in .box:after {
	top: 22px;
	left: 192px;
	width: 324px;
	height: 220px;
}

.log-in .container-form {
	left: 265px;
}

.log-in .container-form .form-item.sign-up {
	left: 0;
	opacity: 1;
}

.log-in .container-form .form-item.log-in {
	left: -100%;
	opacity: 0;
}




    


        
        
		
		
	
	</style>
	  </head>



	<body>
        
        <div class="logo">
            
                <img src="logo5.png" style="height:150px;width:200px;margin-left:10px;">
            </div>
        
        <div class="container" style="position:relative;top:180px;">
            
            <div class="box">
            <div class=" container-forms">
                <div class="container-info">
                    <div class="info-item">
                        <div class="table">
                            <div class="table-cell">
                                <p>Have an account?</p>
                                <p  class="btn" style="font-size: 15px; margin-left: 60px;">Log in</p>
                            
                            
                            </div>
                        
                        </div>
                    
                    </div>
                    <div class="info-item">
                        <div class="table">
                            <div class="table-cell">
                                <p>Dont have an account?</p>
                                <p class="btn"  style="font-size: 15px; margin-left: 40px;">Sign up</p>
                            
                            
                            </div>
                        
                        </div>
                    
                    </div>
                </div>
            <form method="post">
                <div class="container-form">
                    <div class="form-item log-in">
                        <div class="table">
                            <div class="table-cell"> 
                                <input type="text" class="form-control" id="loginUserName" name="loginUserName" aria-describedby="emailHelp" style="width: 80%;cursor: pointer;" placeholder="User Name">
                                <input type="password" class="form-control" id="loginPassword"  name="loginPassword" style="width: 80%;cursor: pointer;" placeholder="Password">
                                <button type="submit" name="loginsubmit" class="btn btn-info" style="margin-left: 100px;" id="loginsubmit">Log in</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-item sign-up">
                        <div class="table">
                            <div class="table-cell">
                                <input type="text" class="form-control" id="signupUserName" name="signupUserName"  aria-describedby="emailHelp" style="width: 80%;cursor: pointer;" placeholder="User Name">
                                <input type="password" class="form-control" id="signupPassword" name="signupPassword"  style="width: 80%;cursor: pointer;" placeholder="Password">
                                <button type="submit" name="signupsubmit" id="signupsubmit" class="btn btn-success" style="margin-left: 100px;">Sign Up</button>
                            </div>
                        </div>
                    </div>
                
                </div>
                </form>
            
            </div>
        
            </div>
        </div>
       
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script type="text/javascript">
        
        var error = "<?php     echo $alert;              ?>" ;
        
        if(error != '1'){
         alert(error);
        }
        
        $(".info-item .btn").click(function(){
    $(".container").toggleClass("log-in");
        });
        $(".container-form .btn").click(function(){
    $(".container").addClass("active");
        });
        
   
        
        
        
        </script>
      
  </body>

    

</html>