<?php
        require 'conn.php';
   
    $email=mysqli_real_escape_string($db,$_POST['email']);
    $regex_email="/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
    if(!preg_match($regex_email,$email)){
        echo "Incorrect email. Redirecting you back to login page...";
        ?>
        <meta http-equiv="refresh" content="2;url=index.php" />
        <?php
    }
    $password=md5((mysqli_real_escape_string($db,$_POST['password'])));
    if(strlen($password)<3){
        echo "Password should have atleast 6 characters. Redirecting you back to login page...";
        ?>
        <meta http-equiv="refresh" content="2;url=index.php" />
        <?php
    }
    $user_authentication_query="select * from companys where email='$email' and password='$password'";
    $user_authentication_result=mysqli_query($db,$user_authentication_query) or die(mysqli_error($db));
    $rows_fetched=mysqli_num_rows($user_authentication_result);
    if($rows_fetched==0){
        //no user
        //redirecting to same login page
        ?>
        <script>
            window.alert("Wrong username or password");
        </script>
        <meta http-equiv="refresh" content="1;url=index.php"/>
        <?php
        //header('location: login');
        //echo "Wrong email or password.";
    }else{
        $row=mysqli_fetch_array($user_authentication_result);
        $_SESSION['email']=$email;
        $_SESSION['id']=$row['id'];  //user id
        header('location: admin.php');
    }
    
 ?>