<?php

include_once "includes/db.php";
$msg="";



if(isset($_SESSION['email'])){
    header("location:dashboard.php");
}


if(isset($_POST['login'])){
    $email=$_POST['email'];
    $password=$_POST['password'];

    $login_user_sql="select * from users where email='$email'";

    $login_user_query=mysqli_query($conn,$login_user_sql);

    if(mysqli_num_rows($login_user_query) > 0){

        $login_user=mysqli_fetch_assoc($login_user_query);
        if(password_verify($password,$login_user['password'])){
            $_SESSION['email']=$email;
            header("location:dashboard.php");
        }else{
            $msg="Please Try Again";
        }

    }else{
        $msg="Please Try Again";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Hello, world!</title>
  </head>
  <body>

    <div class="jumbotron text-center text-white gr-bg">
        <h1>Admin Panel</h1>
        <h2>Login</h2>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <form method="post">
                    <div class="form-group">
                        <label for="">Email</label>
                        <input name="email" type="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="text" name="password" class="form-control">
                    </div>
                    <h4 class="text-danger">
                        <?=$msg?>
                    </h4>
                    <button name="login" type="submit" class="btn btn-outline-info">Login</button>
                </form>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

  </body>
</html>
