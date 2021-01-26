<?php
// Initialize the session
  session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: index.php");
  exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password1 = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    $username=mysqli_real_escape_string($link,$_POST['username']);
	$password=mysqli_real_escape_string($link,$_POST['password']);
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id  FROM user WHERE username = '$username' and password='$password'";
        $result=mysqli_query($link,$sql);
        $num=mysqli_num_rows($result);
      if($num==1){
                      
        $value = mysqli_fetch_object($result);
        $_SESSION['id'] = $value->id;
            
        // Store data in session variables
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;                            
        echo $_SESSION['id'];
         echo $username;
        // Redirect user to welcome page
          header("location: index.php");
      }else{
        ?>
        <script>    
         alert("password or username is not matching");
        </script>
        <?php
      }
    
    
    
    
    }
                 else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            
                mysqli_close($link);
        }
     
?>

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap"rel="stylesheet">    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<section class="my-5">
    <div class="py-5">
         <h2 class="text-center" id="contact">Login</h2>
         <p  class="text-center" >Please fill in your credentials to login.</p>
        </div>
      <div class="w-50 m-auto">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
          <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" autocomplete="off" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" autocomplete="off" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>           
    </div>
</section> 

</body>
</html>