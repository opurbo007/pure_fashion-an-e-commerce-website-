<?php

session_start();
$username = "";
$email    = "";
$errors = array(); 

// Try to conncted database 
$db = mysqli_connect('localhost', 'root', '', 'pure_login');
// Check the connection
if($db==true){
  // echo('Successfully connceted'); 
  }

//  *----------------This is for regestration-----*

if (isset($_POST['reg'])) {
  // Taking input values from the singup page

  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);

// for form validation 
// for username validation

  if (empty($username)){
     array_push($errors, "Username cannot be empty"); 
 }

  // for email validation
  if (empty($email)) {
    array_push($errors, "Email cannot be empty");
  }

  // for password validation
  if (empty($password_1)){
     array_push($errors, "Password cannot be empty"); 
  }

  // for password match
  if ($password_1 != $password_2) {
	array_push($errors, "confirm password should be match to Password");
  }
  // this is for address
  if (empty($address)) {
    array_push($errors, "address cannot be empty");
  } 
  // this is for phone
  if (empty($phone)) {
    array_push($errors, "phone cannot be empty");
  }
  // check email & username already exist or not
  $user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  // if user exist
  if ($user) { 
    if ($user['username'] === $username) {
      array_push($errors, "Username already exist");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exist");
    }
  }

  // If there are no error found
  if (count($errors) == 0) {
    
    //This is for password encyption
    $password = md5($password_1);
    
    //Insert data in database
  	$query = "INSERT INTO user (username, email, password,address,phone) 
  			  VALUES('$username', '$email', '$password', '$address', '$phone')";
  	mysqli_query($db, $query);
    $_SESSION['username'] = $username;
    //if all operation success
    $_SESSION['success'] = "You are now logged in";
    //After regestation copmplete redirect to this page
  	header('location: index.php');
  }
}

// *--------------------This is for login --------------*

if (isset($_POST['log'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

// for username validation
  if (empty($username)) {
  	array_push($errors, "Username cannot be empty");
  }
  // for password validation
  if (empty($password)) {
  	array_push($errors, "Password cannot be empty");
  }
// if everything okey then
  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
   
    if (mysqli_num_rows($results)==1)
    {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You can logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Username or Password incorrect");
  	}
  }
}

// this is for aadmin login
if(isset($_POST["admin_log"]))
{

  $res=mysqli_query($db,"SELECT * from admin WHERE  username='$_POST[username]' && password='$_POST[password]'");
    if($row=mysqli_fetch_array($res)){

      header('location:./admin/admin.php');

    }
    else{
      header('location:signin.php');
    }
}


// this is for product upload

if(isset($_POST["admin"])){
 $v1=rand(1000,5555);
 $v2=rand(1000,5555);
$v3=$v1.$v2;

  $v3=md5($v3);
$fnm=$_FILES["pimg"]["name"];
$dst="./img2/".$fnm;
move_uploaded_file($_FILES["pimg"]["tmp_name"],$dst);

mysqli_query($db,"INSERT into product VALUES('','$_POST[pnm]',$_POST[ppr],'$dst','$_POST[pcat]','$_POST[pdes]') ");

}


?>