<?php
$showalert=false;
$showerror=false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'partials/_dbconnect.php';
    $username=$_POST["username"];
    $password=$_POST["password"];
    $cpassword=$_POST["cpassword"];
    //$exist=false;
    $existsql="SELECT * FROM `users` WHERE username='$username'";
    $result=mysqli_query($con,$existsql);
    $numexistrows=mysqli_num_rows($result);
    if($numexistrows>0){
        //$exist=true;
        $showerror="username already exist";
    }else{
        $exist=false;
    
    if(($password==$cpassword)){
      $hash=password_hash($password,PASSWORD_DEFAULT);
        $sql="INSERT INTO `users` ( `username`, `password`, `date`) VALUES ( '$username', '$hash', current_timestamp())";
        $result=mysqli_query($con,$sql);
        if($result){
            $showalert=true;
        }
    }else{
        $showerror="Password does not match";
     }
   }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>signup</title>
  </head>
  <body>
    <?php require 'partials/_nav.php'?>
    <?php
         if($showalert){
            echo' <div class="alert alert-success alert-dismissible fade show" role="alert">
           <strong>Success!</strong> Your account has been created.
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>';
             }
             if($showerror){
                echo' <div class="alert alert-danger alert-dismissible fade show" role="alert">
               <strong>Error!</strong> '.$showerror.'
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>';
                 }
   
      ?>
</div>
    <div class="container">
        <h1 class="text-center">please sign in our page</h1>
  <form action="/loginsystem/signin.php" method="POST" >
  <div class="form-group col-md-6">
    <label for="password">username</label>
    <input type="text" maxlength="11" class="form-control" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter your name">
    <small id="emailHelp" class="form-text text-muted">We will never share your email with anyone else.</small>
  </div>
 
  <div class="form-group col-md-6">
    <label for="password">Password</label>
    <input type="password" maxlength="23" class="form-control" id="Password" name="password" placeholder="Password">
  </div>
  <div class="form-greoup col-md-6">
    <label for="cpassword">confirm Password</label>
    <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Password">
    <small id="emailHelp" class="form-text text-muted">Make sure to type the same password.</small>
  </div>
  <button type="submit" class="btn btn-primary col-md-6">signup</button>
</form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>