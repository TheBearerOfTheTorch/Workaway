<?php
session_start();
//connect to database
$db = mysqli_connect('localhost', 'root', '','workaway');
// variable declaration
if(isset($_POST['registeerC'])){
  register();
}

function register(){ 

  //call these variables with the global keyword to make them available in the function
  global $db ,$errors, $Cname, $email, $password;

  //receive all input values from the form. call the e() function
  //defined below to escape from values

  $Cname =e( $_POST['name']);
  $email= e($_POST['email']);
  $password_1= e($_POST['password_1']);
  $password_2= e($_POST['password_2']);


  // form validation: ensure that the form is correcttly filled

if(empty($Cname)){
  array_push($errors, "Username is required");
}

if (empty($email)){
  array_push($errors, "Email is required");
}

if (empty($password_1)){
  array_push($errors, "password is required");
}
if($password_1 != $password_2){

  array_push($errors, "the passwords does not match");
}

//register users if there are no errors in the form
if(count($errors)==0){
  $password =md5($password_1);//encrypt the password before saving in the database


  $q3=mysqli_query($db,"INSERT INTO companys VALUES  ( '','$Cname' ,  '$email' ,'$password')");
if($q3)
{
      
      
      session_start();

      
      header ('location:index.php');
      
      

  }
}
}
function e($val){
    global $db ;
    return mysqli_real_escape_string($db, trim($val));
  
  }
  function display_error() {
    global $errors;
  
    if (count($errors) > 0){
        echo '<div class="error">';
            foreach ($errors as $error){
                echo $error .'<br>';
            }
        echo '</div>';
    }
  
  
  
  
  }
  



?>
