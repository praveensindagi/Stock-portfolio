<?php
session_start();// Include config file
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	header("location: index.php");
	exit;
  }
   
require_once "config.php";
 $password=$confirm_password="";
$email_err=$username_err=$password_err=$mobile_err=$confirm_password_err="";
// Define variables and initialize with empty values
// Processing form data when form is submittedc
if(isset($_POST['submit'])){
	//$fname = isset($_GET['firstname']) ? $_GET['firstname'] : '';
	$fname=mysqli_real_escape_string($link,$_POST['firstname']);
   $lname=mysqli_real_escape_string($link,$_POST['lastname']);
  // $lname = isset($_GET['lastname']) ? $_GET['lastname'] : '';
   $mobile=mysqli_real_escape_string($link,$_POST['mobile']);
	//$location=mysqli_real_escape_string($link,$_POST['location']);
    $address=mysqli_real_escape_string($link,$_POST['address']);
    $email=mysqli_real_escape_string($link,$_POST['email']);
    $username=mysqli_real_escape_string($link,$_POST['username']);
    $password=mysqli_real_escape_string($link,$_POST['password']);
    $gender=mysqli_real_escape_string($link,$_POST['gender']);

	$confirm_password=mysqli_real_escape_string($link,$_POST['confirm_password']);
//	echo $password.$confirm_password;
	//echo $fname.$lname.$mobile.$address.$email.$username.$password.$gender;
   //$pass=password_hash($password,PASSWORD_BCRYPT);
  

   $len=strlen($mobile);
   if($len==10){
   //$confirm_pass=password_hash($confirm_password,PASSWORD_BCRYPT);
   $emailquery="select * from user where email='$email' ";
   //echo $emailquery;
   $query=mysqli_query($link,$emailquery);
   $emailcount=mysqli_num_rows($query);
     echo "  ".$emailcount;
   if($emailcount>0){
       $email_err="this email alreay exist";
       echo '<script> alert("email already exist")</script>';
   }
   else{
      $userquery="select * from user where username='$username' ";
	  $result=mysqli_query($link,$userquery);
      $usercount=mysqli_num_rows($result);
     // echo "".$usercount;
	   if($usercount >0){
           $username_err="this username already exist";
           echo '<script> alert("username already exist")</script>';

		}else{
			if($password===$confirm_password){
              //  echo "matche";
               // echo $fname.$lname;
           $iquery="insert into user( fname, lname, gender, mobile, address,email, username, password)
           values('$fname','$lname' ,'$gender','$mobile','$address','$email','$username','$password')";
            mysqli_query($link,$iquery);
            
        
          //  echo "successfull";
               //  INSERT INTO `user`( `fname`, `lname`, `gender`, `mobile`, `address`, `email`, `username`, `password`)
          // VALUES ([$fname],[$lname],[$gender],[$mobile],[$address],[$email],[$username],[$password])
           
           header("location: login.php");
		  
		
		}
			else{
                $password_err="password is r matching";
                echo '<script> alert("password are not matching")</script>';

			}
		}

	
	
	}

    mysqli_close($link);




   }else{
       $mobile_err="mobile number is not correct";
       echo '<script> alert("mobile number is not correct")</script>';

   }



}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap"rel="stylesheet">    
    <style type="text/css">
      
      
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<section class="my-5">
    <div class="py-5">
         <h2 class="text-center" id="contact">Sign Up</h2>
         <p  class="text-center" >Please fill this form to create an account.</p>
        </div>
      <div class="w-50 m-auto">
    
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
                 <label> fname</label>              
                 <input type="text" name="firstname" autocomplete="off"  class="form-control" placeholder="enter your first name" required>
             </div>
            
             <div class="form-group">
                 <label> lname</label>              
                 <input type="text" name="lastname" autocomplete="off" required placeholder="enter your last name" class="form-control" required>
             </div>
           

             <div class="form-group">
             <label>Gender:</label>
               <select class="form-control"  name="gender"   required>
               <option disabled selected value="">Please select Gender</option>
               <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
              </select>
           </div> 

             
             <div class="form-group <?php echo (!empty($mobile_err)) ? 'has-error' : ''; ?>">
                 <label> mobile</label>              
				 <input type="text" name="mobile" autocomplete="off"  required placeholder="enter your mobile number" class="form-control" required>
				 <span class="help-block"><?php echo $mobile_err; ?></span>
             </div>
                     

             
             
           
             
             <div class="form-group">
                 <label> address</label> 
                 <textarea name="address" id="address" placeholder="enter your addresss"  class="form-control" required></textarea>             
             </div>
			
			 <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                 <label> Email</label>              
				 <input type="email" name="email"  placeholder="enter your email" autocomplete="off" class="form-control" required>
				 <span class="help-block"><?php echo $email_err; ?></span>
             </div>
            
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" placeholder="enter your username" class="form-control" >
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group ">
                <label>Password</label>
                <input type="password" name="password" placeholder="enter your password" class="form-control">
             </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" placeholder="confirm your password" class="form-control" >
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit"  name="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
           <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>  
</section>
    
    
</body>
</html>