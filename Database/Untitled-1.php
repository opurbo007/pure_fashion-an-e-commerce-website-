<!-- <?php

session_start();

// database contection

define('DB_SERVER','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','Pure_login');

// Try to conncted database
$con= mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

// Check the connection

if($con==true){
echo('Successfully connceted');
}

$username ="";
$password ="";
$confirm_password ="";
$email ="";
$address ="";
$phone ="";
$error=array();

if(isset($_POST['submit'])){
    
$username= mysqli_real_escape_string($con, $_POST['username']);
$email= mysqli_real_escape_string($con, $_POST['email']);
$phone= mysqli_real_escape_string($con, $_POST['phone']);
$address= mysqli_real_escape_string($con, $_POST['address']);
$password= mysqli_real_escape_string($con, $_POST['password']);
$confirm_password= mysqli_real_escape_string($con, $_POST['confirm_password']);

// for form validation 
// for username validation
if(empty(trim($username))){
    array_push($error,"Username cannot be blank");
}

// for email validation
if(empty(trim($email))){
    array_push($error,"email cannot be blank");
}
// for address validation
if(empty(trim($address))){
    array_push($error,"address cannot be blank");
}
// for phone validation
if(empty(trim($phone))){
    array_push($error,"phone cannot be blank");
}
// for password validation
if(empty(trim($password))){
    array_push($error,"password cannot be blank");
}
// for password validation
if(empty(trim($confirm_password!=$password))){
    array_push($error,"confirm password must match");
}

$user_check="SELECT * FROM user WHERE username= '$username' or email='$email'LIMIT 1";

$result=mysqli_query($con,$user_check);
$user=mysqli_fetch_assoc($result);

if($user){

    if($user['username']=== $username)
    {
         array_push($error,"Username already taken");  
    }

    if($user['email']=== $email)
    {
        array_push($error,"email already taken");
    }
}

//if no error found then

if(count($error)==0){

   $query="INSERT INTO user(username,email,address,phone,password) VALUES ('[$username]','[$email]','[$address]','[$phone]','[$password]')"; 
    
   mysqli_query($con,$query);
   $_SESSION['usrname']=$username;
   $_SESSION['success']="Thank you for Regestation";
   header('location:singin.php');

}

}


?> -->