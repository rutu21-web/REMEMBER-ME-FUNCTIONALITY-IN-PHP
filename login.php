<?php

include('config.php');
if(isset($_COOKIE["username"]) && $_COOKIE["password"])
{
    $id=$_COOKIE["username"];
    $pass=$_COOKIE["password"];
}else
 {
     $id="";
     $pass="";
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script>
       function validate()
       {
           let username=document.forms['form']['username']; 
           let password=document.forms['form']['password']; 
           let error=document.getElementById('error');

            
           if(username.value=='' && password.value=='')
             {
                 error.innerHTML="Form is Empty";
                 error.style.display="block";
                 return false;
             }



           if(username.value=='')
            {
                //alert('Username cannot be empty');
                error.innerHTML="Username field is empty";
                error.style.display="block";
                return false;
            }
            
           
            if(password.value=='')
             {
                error.innerHTML="Enter the Password";
                error.style.display="block";
                return false;
             }

           
            if(password.value=='password')
             {
                error.innerHTML="Password cannot be password";
                error.style.display="block";
                return false;
                
             }


             return true;
       }
   </script>
</head>
<body>
    <div class="loginform">
        <h2>Member Login</h2>
        <form name="form" method="POST" onsubmit="return validate()">
       <div class="input-field">
        <i class="fa fa-user" aria-hidden="true"></i>
        <input type="text" placeholder="Username" name="username" value="<?php echo $id; ?>">
       </div>
       <div class="input-field">
        <i class="fa fa-lock" aria-hidden="true"></i>
        <input type="text" placeholder="Password" name="password" value="<?php echo $pass; ?>">
       </div>
      
       <div id="error">

       </div>
       <div class="input-field">
        <label>
           <input type="checkbox" name="remember_me">Remeber Me!
    </label>          
        </div>

       <button type="submit" name="submit">Sign In</button>
       <div class="extra">
           <a href="#">Forgot Password?</a>
           <a href="#">Create Account</a>
       </div>
        </form>
    </div>
   

<?php

if(isset($_POST['submit']))
 {
    
    $query = "SELECT * FROM `login` WHERE `username`='$_POST[username]' AND `password`='$_POST[password]'";
    $result=mysqli_query($conn,$query);

    if(mysqli_num_rows($result)==1)
     { 
         session_start();
         $_SESSION['username']=$_POST['username'];
         if(isset($_POST["remember_me"]))
         {
           setcookie('username',$_POST["username"],time() + (60*60*24));
           setcookie('password',$_POST["password"],time() + (60*60*24));
         }else
        {
            setcookie('username','',time() - (60*60*24));
            setcookie('password','',time() - (60*60*24));
        }
        header("location: panel.php");
         
     }else
     {
          echo "<script>alert('Incorrect Password');</script>";
     }


 }




?>



</body>
</html>

