<?php
include_once "./includes/head.php";
if(isset($_POST['changepass'])){
    $op=$_POST['op'];
    $np=$_POST['np'];
    $cp=$_POST['cp'];

    if($op==$cp){
        $msg="Please Enter Different Password";
    }else if($np!=$cp){
        
        $msg="Please Match New And Confirm Password";
    }else{

        // check password with db
        $check_user_sql="select * from users where email='$login_user_email'";

        $check_user_query=mysqli_query($conn,$check_user_sql);

        if(mysqli_num_rows($check_user_query) > 0){
            $get_user_info=mysqli_fetch_assoc($check_user_query);

            if(password_verify($op,$get_user_info['password'])){
                $password=password_hash($cp,PASSWORD_BCRYPT);
                $upd_pass_sql="update users set password='$password' where email='$login_user_email'";

                $upd_query=mysqli_query($conn,$upd_pass_sql);

                if($upd_query){
                    header("location:logout.php");
                }else{
                    $msg="Please Try Again";
                }

            }else{
                $msg="Please Enter Correct Password";
            }


        }else{
            header("location:logout.php");
        }


    }
}
?>

<div class="container">
    <h1 class="text-center my-5">Profile</h1>
    <div class="row">
        <div class="col-sm-6">Hey</div>
        <div class="col-sm-6">
            <h2 class="text-center my-3">Change Password</h2>
            <form method="post">
                <div class="form-group">
                    <label for="">Old Password</label>
                    <input type="text" name="op" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">New Password</label>
                    <input type="text" name="np" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="text" name="cp" class="form-control">
                </div>
                <h3 class="text-danger"><?=$msg?></h3>
                <button type="submit" name="changepass" class="btn btn-warning">Change Password</button>
            </form>
        </div>
    </div>
</div>
<?php
include_once "./includes/footer.php";
?>