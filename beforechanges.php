<?php
session_start();
$a = "";
$error = "";
$success = "";
$link = mysqli_connect("shareddb-y.hosting.stackcp.net","customers-313539e79c","sai1998sai","customers-313539e79c");

if(mysqli_connect_error()){
		$alert = die("<p>There was a problem connecting to your database.</p>");
		
	}


 if (array_key_exists("id", $_COOKIE) && $_COOKIE ['id']) {
        
        $_SESSION['id'] = $_COOKIE['id'];
     
     
        
    }

    if (array_key_exists("id", $_SESSION)) {
        

        
        $query = "SELECT * FROM `customers` WHERE id = '".$_COOKIE['id']."'";
				
				$result = mysqli_query($link,$query);
				
				$row = mysqli_fetch_array($result);
        
        $profilepicture = $row['profilepicture'];
        
        
        
        $query = "SELECT `username` FROM `customers` WHERE id = '".$_COOKIE['id']."'";
				
				$result = mysqli_query($link,$query);
				
				$row = mysqli_fetch_array($result);
        
        $username = $row['username'];
        
        
        if(isset($_POST['newmessagesubmit'])){
             $query = "SELECT `id` FROM `customers` WHERE username ='".$_POST['newmessageusername']."'";
            
            $result = mysqli_query($link, $query);
            
            $rows = mysqli_fetch_array($result);
    
            
            if ($rows['id']>0) {
                $file_name     = $_FILES["newmessagefiles"]["name"]; 
                $file_type     = $_FILES["newmessagefiles"]["type"]; 
                $file_size     = $_FILES["newmessagefiles"]["size"]; 
                $file_tmp_name = addslashes(file_get_contents($_FILES["newmessagefiles"]["tmp_name"])); 
                $file_error    = $_FILES["newmessagefiles"]["error"]; 
                date_default_timezone_set('Asia/Kolkata');
                $date = date("y-m-d");
                
                $time = date("h:i:s");
                if(empty($file_tmp_name)){
                $querya = "INSERT INTO `".mysqli_real_escape_string($link,$_POST['newmessageusername'])."inbox` (`username`,`subject`,`message`,`date`,`time`) VALUES ('".mysqli_real_escape_string($link,$username). "','".mysqli_real_escape_string($link,$_POST['newmessagesubject'])."','".mysqli_real_escape_string($link,$_POST['newmessagemessage'])."','".mysqli_real_escape_string($link,$date)."','".mysqli_real_escape_string($link,$time)."')";
                }else{
                    $querya = "INSERT INTO `".mysqli_real_escape_string($link,$_POST['newmessageusername'])."inbox` (`username`,`subject`,`message`,`file1`,`date`,`time`) VALUES ('".mysqli_real_escape_string($link,$username). "','".mysqli_real_escape_string($link,$_POST['newmessagesubject'])."','".mysqli_real_escape_string($link,_POST['newmessagemessage'])."','".mysqli_real_escape_string($link,$file_tmp_name)."','".mysqli_real_escape_string($link,$date)."','".mysqli_real_escape_string($link,$time)."')";
                }
                
                $queryb= "INSERT INTO `".mysqli_real_escape_string($link,$username)."sent` (`username`,`subject`,`message`,`file1`,`date`,`time`) VALUES ('".mysqli_real_escape_string($link,$_POST['newmessageusername'])."','".mysqli_real_escape_string($link,$_POST['newmessagesubject'])."','".mysqli_real_escape_string($link, $_POST['newmessagemessage'])."','".mysqli_real_escape_string($link,$file_tmp_name)."','".mysqli_real_escape_string($link,$date)."','".mysqli_real_escape_string($link,$time)."')";
                mysqli_query($link,$querya);
                mysqli_query($link,$queryb);
                
      
                
            }else{
                $error = "Please check the username and try again.";
            }
        }
       if(isset($_POST['profilepicturesubmit'])){
        
           
           if(!empty($_FILES['profilepicture']['name'])){
               
               if (isset($_FILES["profilepicture"]) && $_FILES["profilepicture"]["error"] == 0) { 
          
        $file_name     = $_FILES["profilepicture"]["name"]; 
        $file_type     = $_FILES["profilepicture"]["type"]; 
        $file_size     = $_FILES["profilepicture"]["size"]; 
        $file_tmp_name = addslashes(file_get_contents($_FILES["profilepicture"]["tmp_name"])); 
        $file_error    = $_FILES["profilepicture"]["error"]; 
                   
                       
               
            $dpquery = "UPDATE `customers` SET `profilepicture` ='".$file_tmp_name."' WHERE id = '".$_COOKIE['id']."'";
               
             if( mysqli_query($link,$dpquery)){
                 
                 
                 header("Location: loggedinpage.php");
             }
          
          
          
        
          
    } 
           
               
                
        
           }
           
       }
        
        
     
      
    } else {
        
        
        header("Location: loginform.php");
        
    }





?>






<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      
     

    <title>Connect</title>
      
      
      <style>
          body,.row{
              height: 100vh;
              width: 100%;
             
              
              
              
          }
          #fullemailtextarea{
              outline: none;
          }
          #fullemailtextareaactive{
              outline: none;
          }
              
                                        
      
          .sidebar{
              background-color: #1C2237;
              text-align: center;
              
              color: aliceblue;
          }
          .emailsList{
              background-color: #161D31;
              padding:0;
              overflow-x: hidden;
              overflow-y: scroll;
              max-height: 100vh;
              color: aliceblue;
          }
          .fullEmailDisplay{
              background-color: #FFFFFF;
              padding:0;
              overflow-x: hidden;
              overflow-y: scroll;
              max-height: 100vh;
          }
          #sidebarItems{
             margin-top: 20px;
          }
          
          .sidebarItembutton{
              
              cursor: pointer;
              text-decoration: none ;
             font-size: 15px;
             font-weight: 500;
             text-transform: capitalize;
             display: inline-block;
              border: none;
              margin-top: 10px;
             background-color: transparent;
             color: aliceblue;
             padding: 1rem 2rem;
             height: 50px;
             width: 150px;
              outline: none;
          }
           .sidebarItembutton:hover{
              
              opacity: 0.5;
               outline: none;
               
              
          }
          
          
          
 
 @media screen and (max-width: 768px) {
	 
}
 .container {
	 background-color: #9191e9;
	 display: flex;
	 align-items: center;
	 justify-content: center;
	 width: 100vw;
	 height: 100vh;
}
 .button {
     
	 text-decoration: none ;
	 font-size: 0.875rem;
	 font-weight: 500;
	 text-transform: capitalize;
	 display: inline-block;
	 border-radius: 3px;
	 background-color: #9191e9;
	 color: aliceblue;
	 padding: 1rem 2rem;
     height: 50px;
     width: 150px;
     
     
}
          
      
          .button:hover{
              text-decoration: none;
              color: antiquewhite;
          }
 .popup {
	 display: flex;
	 align-items: center;
	 justify-content: center;
	 position: fixed;
	 width: 100vw;
	 height: 100vh;
	 bottom: 0;
	 right: 0;
	 background-color: rgba(0, 0, 0, .80);
	 z-index: 2;
	 visibility: hidden;
	 opacity: 0;
	 overflow: hiden;
	 transition: 0.64s ease-in-out;
}
 .popup-inner {
	 position: relative;
	 bottom: -100vw;
	 right: -100vh;
	 display: flex;
	 align-items: center;
	 max-width: 800px;
	 max-height: 600px;
	 width: 60%;
	 height: 80%;
	 background-color: #fff;
	 transform: rotate(32deg);
	 transition: 0.64s ease-in-out;
}
 .popup__photo {
	 display: flex;
	 justify-content: flex-end;
	 align-items: flex-end;
	 width: 40%;
	 height: 100%;
	 overflow: hidden;
}
 .popup__photo img {
	 width: auto;
	 height: 100%;
}
 .popup__text {
	 display: flex;
	 flex-direction: column;
	 justify-content: center;
	 width: 60%;
	 height: 100%;
	 padding: 4rem;
}
 .popup__text h1 {
	 font-size: 2rem;
	 font-weight: 600;
	 margin-bottom: 2rem;
	 text-transform: uppercase;
	 color: #0a0a0a;
}
 .popup__text p {
	 font-size: 0.875rem;
	 color: #686868;
	 line-height: 1.5;
}
 .popup:target {
	 visibility: visible;
	 opacity: 1;
}
 .popup:target .popup-inner {
	 bottom: 0;
	 right: 0;
	 transform: rotate(0);
}
 .popup__close {
	 position: absolute;
	 right: -1rem;
	 top: -1rem;
	 width: 3rem;
	 height: 3rem;
	 font-size: 0.875rem;
	 font-weight: 300;
	 border-radius: 100%;
	 background-color: #0a0a0a;
	 z-index: 4;
	 color: #fff;
	 line-height: 3rem;
	 text-align: center;
	 cursor: pointer;
	 text-decoration: none;
}
          

.search__input {
        width: 90%;
        margin-left: 20px;
        margin-top: 10px;
        padding: 12px 24px;

        background-color: aliceblue;
        transition: transform 250ms ease-in-out;
        font-size: 14px;
        line-height: 18px;
        
        color: #575756;
        background-color: transparent;
/*         background-image: url(http://mihaeltomic.com/codepen/input-search/ic_search_black_24px.svg); */
 
      background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24'%3E%3Cpath d='M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z'/%3E%3Cpath d='M0 0h24v24H0z' fill='none'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-size: 18px 18px;
        background-position: 95% center;
        border-radius: 50px;
        border: 1px solid #575756;
        transition: all 250ms ease-in-out;
        backface-visibility: hidden;
        transform-style: preserve-3d;
    }



.search__input::placeholder {
            color: rgba(87, 87, 86, 0.8);
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }



.search__input:hover,
        .search__input:focus {
            padding: 12px 0;
            outline: 0;
            border: 1px solid transparent;
            border-bottom: 1px solid #575756;
            border-radius: 0;
            background-position: 100% center;
        }
          
                    textarea{
                
                height: 150px;
                        resize: none;
             
            }
        
        .form__group {
  position: relative;
  padding: 15px 0 0;
  margin-top: 10px;
  width: 100%;
}

.form__field {
  font-family: inherit;
  width: 90%;
    
  border: 0;
  border-bottom: 2px solid #9b9b9b;
  outline: 0;
  font-size: 1.3rem;
  color: #fff;
  padding: 7px 0;
  background: transparent;
  transition: border-color 0.2s;
}
.form__field::placeholder {
  color: transparent;
}
.form__field:placeholder-shown ~ .form__label {
  font-size: 1.3rem;
  cursor: text;
  top: 20px;
}

.form__label {
  position: absolute;
  top: 0;
  display: block;
  transition: 0.2s;
  font-size: 1rem;
  color: #9b9b9b;
}

.form__field:focus {
  padding-bottom: 6px;
  font-weight: 400;
  border-width: 3px;
  border-image: linear-gradient(to right, #11998e, #38ef7d);
  border-image-slice: 1;
}
.form__field:focus ~ .form__label {
  position: absolute;
  top: 0;
  display: block;
  transition: 0.2s;
  font-size: 1rem;
  color: #11998e;
  font-weight: 400;
}

/* reset input */
.form__field:required, .form__field:invalid {
  box-shadow: none;
}
.emailsList::-webkit-scrollbar {
  display: none;
}
.fullEmailDisplay::-webkit-scrollbar {
  display: none;

          
          }
      
      
      </style>
      
      
      
  </head>
  <body >
     
    
   
        <div class="row ">
          <div class="sidebar col-md-2">
              
              
              
              <?php 
              
              if(empty($profilepicture)){
                echo  "<img src='nodp.png' alt='HelPic' style='height:80px;width:80px; border-radius:50%;box-shadow: 0px 0px 5px #000;margin:20px auto 20px auto;cursor:pointer;' id='profilepicimage'>";
              }else{
                 echo "<img src='data:image/jpeg;base64,".base64_encode( $profilepicture )."' alt='HelPic' style='height:80px;width:80px; border-radius:50%;box-shadow: 0px 0px 5px #000;margin:20px auto 20px auto;cursor:pointer;' id='profilepicimage'>";
              }
              
              
              
              ?>
              
              
             
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" style="display:none;" id="bootstrapmodal"  >Small modal</button>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="color:black;">
      <h1 >Update your profile picture...</h1>
        <br>
        <hr>
         <form method="post"  enctype="multipart/form-data">
             
              <input type="file" name="profilepicture"   id="profilepicture">
        <br>
             <button type="submit" name="profilepicturesubmit" class="btn btn-success" style="margin:20px auto 30px auto;" id="profilepicturesubmit">Go</button>
        </form>
      
    </div>
  </div>
</div>
              <h4 style="margin:0 auto 20px auto;color:white;"><em><?php echo $username; ?></em></h4>
            
                <a class="button" href="#popup">Compose</a>
    <div class="popup" id="popup">
      <h3 style="margin-right: 5px;">New Message</h3>
    <div class="popup-inner">
        <div class="col-md-12" style="">
            <form method="post" autocomplete="off" enctype="multipart/form-data">
      <div class="form__group field">
              <input type="input" style="color: black;" class="form__field" placeholder="Name" name="newmessageusername" id='newmessageusername' required autocomplete="off" />
              <label for="newmessageusername" class="form__label" style="margin-left: 40px;">User Name</label>
            </div>
            <div class="form__group field">
              <input type="input" style="color: black;" class="form__field" placeholder="Name" name="newmessagesubject" id='newmessagesubject' required autocomplete="off" />
              <label for="newmessagesubject" class="form__label" style="margin-left: 40px;">Subject</label>
            </div>
            <div class="form__group field">
              <textarea type="input" style="color: black;" class="form__field" placeholder="Name" name="newmessagemessage" id='name' required autocomplete="off" ></textarea>
              <label for="newmessagemessage" class="form__label" style="margin-left: 40px;">Message</label>
            </div>
            <div class="form__group field">
            <input type="file" style="float: left;margin-left: 40px; color: black" multiple name="newmessagefiles">
            </div>
                 <div style="margin-top:70px;margin-bottom:30px;">
               <button class="btn" type="submit" style="float:right;width:100px; margin-right:50px;background-color:#4955F8;padding:8px 20px 8px 20px" name="newmessagesubmit" id="newmessagesubmit">Send</button>
                   
               </div>
                
      </form>
      
              </div>
        <a class="popup__close" href="">X</a>
            
    </div>
  </div>
              <div id="sidebarItems">
              
                  <button class="sidebarItembutton" id="inbox" style="margin:auto;"> <a href="loggedinpage.php" style="text-decoration:none;font-weight:700;color: aliceblue;"><span style="color:yellow">⚡</span>&nbsp;Inbox</a></button>
                  <button class="sidebarItembutton" id="sent" style="margin:auto;" ><span style="color:orange;transform: rotate(20deg);">&#10146;</span>&nbsp;Sent</button>
                  <button class="sidebarItembutton" id="fav" style="margin:auto;" ><span >&#10084;</span>&nbsp;Fav</button>
                  <button class="sidebarItembutton" id="trash" style="margin:auto;" ><span>🗑️</span>&nbsp;Trash</button>
                  <button class="sidebarItembutton" id="settings" style="margin:auto;" ><span>⚙️</span>&nbsp;Settings</button>
                  <a href="loginform.php?logout=1"><button class="sidebarItembutton" id="logout" style="margin:auto;" >Logout</button></a>
                  
                  
              </div>
             
              
              

            </div>

          <div class="emailsList col-md-4" >
                 <div class="search__container">
    
    <input class="search__input" type="text" placeholder="Search" style="color:white;">
</div>

              <div class="allemails" style="margin-top:20px;" id="inboxemailslist">
                  
                  <button type="button" class="btn btn-primary optionssmallmodal"  style="display:none" data-toggle="modal" data-target=".bd-example-modal-lglg">Small modal</button>

                <div class="modal fade bd-example-modal-lglg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                    <p>  <button class="btn btn-danger" style="float:left;width:150px;margin:30px 0px 30px 20px;">Move to Trash</button>
                        
                        <button class="btn btn-success" style="float:right;width:150px;margin:30px 20px 30px 0px;">Add to favourites</button></p>
                    </div>
                  </div>
                </div>
                  
                  <?php
                  
                   $displayinboxitemsquery = "SELECT * FROM `".$username."inbox` ORDER BY `id` DESC";
                  
                
                $inboxresult = mysqli_query($link, $displayinboxitemsquery);
                  
                  $inboxrows = mysqli_fetch_array($inboxresult);
                 
                  
                
                   
                      foreach($inboxresult as $inboxrows) {
                          
                          
                          
                           $inboxmessage[$inboxrows['id']] = $inboxrows['message'];
                          $inboxsubject[$inboxrows['id']] = $inboxrows['subject'];
                          $inboxusername[$inboxrows['id']] = $inboxrows['username'];
                          $inboxdate[$inboxrows['id']] = $inboxrows['date'];
                          
                          
	               echo '<div class="eachinboxemail col-md-12" style="color:white;height:80px; background-color:#1F2740; cursor:pointer;"id="'.$inboxrows['id'].'">
                      
                     <div class="eachinboxemailbody" style="position:relative;top:10px;">
                         
                      <h6 style="margin-left:15px; margin-top:2px;text-transform: capitalize;"><span id="inboxemaillistsubject">'.substr($inboxrows['subject'], 0, 40).'</span> ...<span style="float:right;margin-right:15px; cursor: pointer;" class="hellip">&hellip;</span></h6>
                         
                      
                      <p style="color:grey; margin-left:15px;font-size:75%;text-transform: capitalize;"><span id="inboxemaillistusername">'.substr($inboxrows['username'], 0, 40).'</span><span style="float:right;margin-right:15px;" id="inboxemaillisttime">'.substr($inboxrows['time'], 0, 5).'</span> <span style="float:right;margin-right:15px;" id="inboxemaillistdate">'.substr($inboxrows['date'], 0, 10).'</span><span style="display:none">'.$inboxrows['message'].'</span></p>
                        
                  
                  </div> 
                  
                  </div>';
}
                  
                  
                  
                  
                  ?>
                  
                  
              
                  
               
                 
                 
                
              
              </div>
               <div class="allemails" style="margin-top:20px;" id="sentemailslist">
                  
                  <?php
                  
                   $displayinboxitemsquery = "SELECT * FROM `".$username."sent` ORDER BY `id` DESC";
                
                $inboxresult = mysqli_query($link, $displayinboxitemsquery);
                  
                  $inboxrows = mysqli_fetch_array($inboxresult);
                   
                   
                      
                      foreach($inboxresult as $inboxrows) {
                          
                           $sentmessage[$inboxrows['id']] = $inboxrows['message'];
                          $sentsubject[$inboxrows['id']] = $inboxrows['subject'];
                          $sentusername[$inboxrows['id']] = $inboxrows['username'];
                          $sentdate[$inboxrows['id']] = $inboxrows['date'];
	              echo '<div class="eachsentemail col-md-12" style="color:white;height:80px; background-color:#1F2740; cursor: pointer;" id="'.$inboxrows['id'].'">
                      
                     <div class="eachemailbody" style="position:relative;top:10px;">
                         
                      <h6 style="margin-left:15px; margin-top:2px;text-transform: capitalize;" >'.substr($inboxrows['subject'], 0, 40).' ...<span style="float:right;margin-right:15px; cursor: pointer;">&hellip;</span></h6>
                         
                      
                      <p style="color:grey; margin-left:15px;font-size:75%;text-transform: capitalize;">'.substr($inboxrows['username'], 0, 30).'<span style="float:right;margin-right:15px;">'.substr($inboxrows['time'], 0, 5).'</span> <span style="float:right;margin-right:15px;">'.substr($inboxrows['date'], 0, 10).'</span></p>
                        
                  
                  </div> 
                  
                  </div>';
}
                  
                  
                  
                  
                  ?>
                  
                  
              
                
               
                  
               
                 
                 
                
              
              </div>
               <div class="allemails" style="margin-top:20px;" id="trashemailslist">
                  
                  <?php
                  
                   $displayinboxitemsquery = "SELECT * FROM `".$username."trash` ORDER BY `id` DESC";
                
                $inboxresult = mysqli_query($link, $displayinboxitemsquery);
                  
                  $inboxrows = mysqli_fetch_array($inboxresult);
                   
                   
                      
                      foreach($inboxresult as $inboxrows) {
                          
                          $trashmessage[$inboxrows['id']] = $inboxrows['message'];
                          $trashsubject[$inboxrows['id']] = $inboxrows['subject'];
                          $trashusername[$inboxrows['id']] = $inboxrows['username'];
                          $trashdate[$inboxrows['id']] = $inboxrows['date'];
                          
                         
                          
	              echo '<div class="eachtrashemail col-md-12" style="color:white;height:80px; background-color:#1F2740; cursor: pointer;" id="'.$inboxrows['id'].'">
                      
                     <div class="eachemailbody" style="position:relative;top:10px;">
                         
                      <h6 style="margin-left:15px; margin-top:2px;text-transform: capitalize;" >'.substr($inboxrows['subject'], 0, 40).' ...<span style="float:right;margin-right:15px; cursor: pointer;">&hellip;</span></h6>
                         
                      
                      <p style="color:grey; margin-left:15px;font-size:75%;text-transform: capitalize;">'.substr($inboxrows['username'], 0, 30).'<span style="float:right;margin-right:15px;">'.substr($inboxrows['time'], 0, 5).'</span> <span style="float:right;margin-right:15px;">'.substr($inboxrows['date'], 0, 10).'</span></p>
                        
                  
                  </div> 
                  
                  </div>';
}
                  
                  
                  
                  
                  ?>
                  
                  
              
                
               
                  
               
                 
                 
                
              
              </div>
               <div class="allemails" style="margin-top:20px;" id="favemailslist">
                  
                  <?php
                  
                   $displayinboxitemsquery = "SELECT * FROM `".$username."fav` ORDER BY `id` DESC";
                   
                
                $inboxresult = mysqli_query($link, $displayinboxitemsquery);
                  
                  $inboxrows = mysqli_fetch_array($inboxresult);
                      
                      foreach($inboxresult as $inboxrows) {
                          $favmessage[$inboxrows['id']] = $inboxrows['message'];
                          $favsubject[$inboxrows['id']] = $inboxrows['subject'];
                          $favusername[$inboxrows['id']] = $inboxrows['username'];
                          $favdate[$inboxrows['id']] = $inboxrows['date'];
	               echo '<div class="eachfavemail col-md-12" style="color:white;height:80px; background-color:#1F2740; cursor: pointer;" id="'.$inboxrows['id'].'">
                      
                     <div class="eachemailbody" style="position:relative;top:10px;">
                         
                      <h6 style="margin-left:15px; margin-top:2px;text-transform: capitalize;" >'.substr($inboxrows['subject'], 0, 40).' ...<span style="float:right;margin-right:15px; cursor: pointer;">&hellip;</span></h6>
                         
                      
                       <p style="color:grey; margin-left:15px;font-size:75%;text-transform: capitalize;">'.substr($inboxrows['username'], 0, 30).'<span style="float:right;margin-right:15px;">'.substr($inboxrows['time'], 0, 5).'</span> <span style="float:right;margin-right:15px;">'.substr($inboxrows['date'], 0, 10).'</span></p>
                        
                        
                  
                  </div> 
                  
                  </div>';
                         
}
                  
                   
                   
                  
                  
                  
                  ?>
                  
                  
       
              </div>


              
              
            </div>
            
            
            
            
           <div class="fullEmailDisplay col-md-6"  style="padding-bottom:30px;">
                <div class="col-md-12" style="margin-left:20px;margin-right:20px;margin-top:35px;">
               
               <img src="https://i.pinimg.com/originals/7b/3d/fe/7b3dfedb05221a208068492f6aa951e2.jpg" alt="HelPic" style="height:60px;width:60px; border-radius:50%;float:left;"> <p style="position:relative;left:20px; font-weight:600;text-transform: capitalize;" id="fullemaillistusername">Zaara Shaikh </p>
                    <p style="color:grey;font-size:80%;position:relative;left:20px;top:-15px; font-weight:500;" id="fullemaillistdate">17 Oct 2020</p>
               <p style="font-size:40px;font-weight:400;clear: both;" id="fullemaillistsubject">Beautiful memories & my love</p>
                    
                
               

               </div>
               
               <div class="col-md-12" style="margin-left:20px;margin-right:20px;margin-top:35px;color:#989eaa;font-weight:500;" >
                   
                 <div id="fullemaillistmessage">  <p >In the heart of the French Alps, in the north east of the Rhone Alps region lies the village of Les Houches, Nestled at one end of the Chamonix valley in the Mont Blanc region of the Haute Savoie Les</p>
                   <p>Houches had long been the considered a mere satellite village of its much more illustrious neighbour Chamonix - the world capital of skiing and mountaineering. Of course the locals knew better and many high mountain guides, ski intructors and pisteurs had long since.</p>
                   <p>Perhaps, by it's magnificent setting at the foot of Mont Blanc, it's peace, tranquility and traditional ambience as its more affordable property.</p>
                   <p>I love you,<br>Julia</p>
                   </div>
                   
                   
                   
               
               </div>
               
               <div class="col-md-12" style="margin-top:20px;margin-bottom:30px;">
                   <textarea placeholder="Write something cool..." style="resize:none; height:70px;width:100%;margin-top:20px; background-color:#F0F3F9; border:none;padding-left:15px;padding-top:10px;" id="fullemailtextarea"></textarea>
               <button class="btn" style="float:right;width:100px; margin-right:50px;background-color:#4955F8;padding:8px 20px 8px 20px">Reply</button>
                   <button class="btn" style="float:right;width:130px;margin-right:20px;background-color:transperant;padding:8px 20px 8px 20px" id="attachfilesbutton">Attach Files</button>
                   <input type="file" multiple style="display:none" id="attachfilesinput">
               
               </div>
               



            </div>
        </div>
      
      
      
      
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
      
     
  
      
    
     
      <script type="text/javascript">
     
       
  

          
          $('#inbox').css("opacity","0.5");
           $('#inboxemailslist').css("display","block");
              $('#sentemailslist').css("display","none");
              $('#trashemailslist').css("display","none");
              $('#favemailslist').css("display","none");
		
          
           var error = "<?php     echo $error;              ?>" ;
        
        if(error != ''){
         alert(error);
        }
          
           
          
          
          $("#fullemailtextarea").click(function(){
                                        $("#fullemailtextarea").css("outline","none");
              
                                        })
          $(".sidebarItembutton").click(function(){
                                        $(".sidebarItembutton").css("outline","none");
              
                                        })
          
          $("#sent").click(function(){
		
		$('#sent').css("opacity","0.5");
		$('#inbox').css("opacity","1");
		$('#trash').css("opacity","1");
		$('#fav').css("opacity","1");
        $('#settings').css("opacity","1");
              $('#inboxemailslist').css("display","none");
              $('#sentemailslist').css("display","block");
              $('#trashemailslist').css("display","none");
              $('#favemailslist').css("display","none");
		
		
	})
	$("#inbox").click(function(){
		
		$('#sent').css("opacity","1");
		$('#inbox').css("opacity","0.5");
		$('#trash').css("opacity","1");
		$('#fav').css("opacity","1");
        $('#settings').css("opacity","1");
        
        $('#inboxemailslist').css("display","block");
              $('#sentemailslist').css("display","none");
              $('#trashemailslist').css("display","none");
              $('#favemailslist').css("display","none");
		
	})
	$("#trash").click(function(){
		
		$('#sent').css("opacity","1");
		$('#inbox').css("opacity","1");
		$('#trash').css("opacity","0.5");
		$('#fav').css("opacity","1");
        $('#settings').css("opacity","1");
        $('#inboxemailslist').css("display","none");
              $('#sentemailslist').css("display","none");
              $('#trashemailslist').css("display","block");
              $('#favemailslist').css("display","none");
		

		
	})
	$("#fav").click(function(){
		
		$('#sent').css("opacity","1");
		$('#inbox').css("opacity","1");
		$('#trash').css("opacity","1");
		$('#fav').css("opacity","0.5");
		$('#settings').css("opacity","1");
        
        $('#inboxemailslist').css("display","none");
              $('#sentemailslist').css("display","none");
              $('#trashemailslist').css("display","none");
              $('#favemailslist').css("display","block");
	})
          $("#settings").click(function(){
		
		$('#sent').css("opacity","1");
		$('#inbox').css("opacity","1");
		$('#trash').css("opacity","1");
		$('#fav').css("opacity","1");
        $('#settings').css("opacity","0.5");
		
	})
          $("#attachfilesbutton").click(function(){
              
              $("#attachfilesinput").click();
          })
          
          $("#profilepicimage").click(function(){
              $("#bootstrapmodal").click();
             
          })
          
          $(".hellip").click(function(){
              $(".optionssmallmodal").click();
          })
       
      
           $(".eachinboxemail").click(function(){
              
             var individualid  = $(this).attr('id');
               var inboxmessagesarray = <?php echo json_encode($inboxmessage); ?>;
               var inboxusernamearray = <?php echo json_encode($inboxusername); ?>;
               var inboxsubjectsarray = <?php echo json_encode($inboxsubject); ?>;
               var inboxdatesarray = <?php echo json_encode($inboxdate); ?>;
               var fulldate = inboxdatesarray[$(this).attr('id')];
               
               
               var year = fulldate.substring(0,4);
               var month = fulldate.substring(5,7);
               var day = fulldate.substring(8,10);
               switch(month) {
                  case '01':
                    month = "Jan";
                    break;
                  case '02':
                    month = "Feb";
                    break;
                case '03':
                    month = "March";
                    break;
                  case '04':
                    month = "April";
                    break;
                       case '05':
                    month = "May";
                    break;
                  case '06':
                    month = "June";
                    break;
                       case '07':
                    month = "July";
                    break;
                   case '08':
                       month = "Aug";
                       break;
                   case '09':
                    month = "Sept";
                    break;
                       case '10':
                    month = "Oct";
                    break;
                       case '11':
                    month = "Nov";
                    break;
                  
                       case '12':
                    month = "Dec";
                    break;
                  
                  default:
                    break;
                }

               
               $("#fullemaillistmessage").html(inboxmessagesarray[$(this).attr('id')]);
               $("#fullemaillistsubject").html(inboxsubjectsarray[$(this).attr('id')]);
               $("#fullemaillistusername").html(inboxusernamearray[$(this).attr('id')]);
               $("#fullemaillistdate").html(day+" "+ month+" "+year);
              
               
               
          
              
             
          })
          $(".eachsentemail").click(function(){
              
             var individualid  = $(this).attr('id');
               var inboxmessagesarray = <?php echo json_encode($sentmessage); ?>;
               var inboxusernamearray = <?php echo json_encode($sentusername); ?>;
               var inboxsubjectsarray = <?php echo json_encode($sentsubject); ?>;
               var inboxdatesarray = <?php echo json_encode($sentdate); ?>;
               var fulldate = inboxdatesarray[$(this).attr('id')];
               
               var year = fulldate.substring(0,4);
               var month = fulldate.substring(5,7);
               var day = fulldate.substring(8,10);
               switch(month) {
                  case '01':
                    month = "Jan";
                    break;
                  case '02':
                    month = "Feb";
                    break;
                case '03':
                    month = "March";
                    break;
                  case '04':
                    month = "April";
                    break;
                       case '05':
                    month = "May";
                    break;
                  case '06':
                    month = "June";
                    break;
                       case '07':
                    month = "July";
                    break;
                   case '08':
                       month = "Aug";
                       break;
                   case '09':
                    month = "Sept";
                    break;
                       case '10':
                    month = "Oct";
                    break;
                  case '11':
                    month = "Nov";
                    break;
                       case '12':
                    month = "Dec";
                    break;
                  
                  default:
                    break;
                }

               
               $("#fullemaillistmessage").html(inboxmessagesarray[$(this).attr('id')]);
               $("#fullemaillistsubject").html(inboxsubjectsarray[$(this).attr('id')]);
               $("#fullemaillistusername").html(inboxusernamearray[$(this).attr('id')]);
               $("#fullemaillistdate").html(day+" "+ month+" "+year);
              
               
               
          
              
             
          })
          $(".eachtrashemail").click(function(){
              
             var individualid  = $(this).attr('id');
               var inboxmessagesarray = <?php echo json_encode($trashmessage); ?>;
               var inboxusernamearray = <?php echo json_encode($trashusername); ?>;
               var inboxsubjectsarray = <?php echo json_encode($trashsubject); ?>;
               var inboxdatesarray = <?php echo json_encode($trashdate); ?>;
               var fulldate = inboxdatesarray[$(this).attr('id')];
               
               var year = fulldate.substring(0,4);
               var month = fulldate.substring(5,7);
               var day = fulldate.substring(8,10);
               switch(month) {
                  case '01':
                    month = "Jan";
                    break;
                  case '02':
                    month = "Feb";
                    break;
                case '03':
                    month = "March";
                    break;
                  case '04':
                    month = "April";
                    break;
                       case '05':
                    month = "May";
                    break;
                  case '06':
                    month = "June";
                    break;
                       case '07':
                    month = "July";
                    break;
                   case '08':
                       month = "Aug";
                       break;
                   case '09':
                    month = "Sept";
                    break;
                       case '10':
                    month = "Oct";
                    break;
                  case '11':
                    month = "Nov";
                    break;
                       case '12':
                    month = "Dec";
                    break;
                  
                  default:
                    break;
                }

               
               $("#fullemaillistmessage").html(inboxmessagesarray[$(this).attr('id')]);
               $("#fullemaillistsubject").html(inboxsubjectsarray[$(this).attr('id')]);
               $("#fullemaillistusername").html(inboxusernamearray[$(this).attr('id')]);
               $("#fullemaillistdate").html(day+" "+ month+" "+year);
              
               
               
          
              
             
          })
          $(".eachfavemail").click(function(){
              
             var individualid  = $(this).attr('id');
               var inboxmessagesarray = <?php echo json_encode($favmessage); ?>;
               var inboxusernamearray = <?php echo json_encode($favusername); ?>;
               var inboxsubjectsarray = <?php echo json_encode($favsubject); ?>;
               var inboxdatesarray = <?php echo json_encode($favdate); ?>;
               var fulldate = inboxdatesarray[$(this).attr('id')];
               
               var year = fulldate.substring(0,4);
               var month = fulldate.substring(5,7);
               var day = fulldate.substring(8,10);
               switch(month) {
                  case '01':
                    month = "Jan";
                    break;
                  case '02':
                    month = "Feb";
                    break;
                case '03':
                    month = "March";
                    break;
                  case '04':
                    month = "April";
                    break;
                       case '05':
                    month = "May";
                    break;
                  case '06':
                    month = "June";
                    break;
                       case '07':
                    month = "July";
                    break;
                   case '08':
                       month = "Aug";
                       break;
                   case '09':
                    month = "Sept";
                    break;
                       case '10':
                    month = "Oct";
                    break;
                  case '11':
                    month = "Nov";
                    break;
                       case '12':
                    month = "Dec";
                    break;
                  
                  default:
                    break;
                }

               
               $("#fullemaillistmessage").html(inboxmessagesarray[$(this).attr('id')]);
               $("#fullemaillistsubject").html(inboxsubjectsarray[$(this).attr('id')]);
               $("#fullemaillistusername").html(inboxusernamearray[$(this).attr('id')]);
               $("#fullemaillistdate").html(day+" "+ month+" "+year);
              
               
        
              
             
          })
          
                    $('#profilepicturesubmit').click(function(){  
           var image_name = $('#profilepicture').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#profilepicture').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#profilepicture').val('');  
                     return false;  
                }  
           }  
      });   
          
      
      </script>
      
      
      
  </body>
</html>
