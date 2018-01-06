<?php include "db.php"; ?>
<?php session_start(); ?>


<?php

if(isset($_POST['login'])){
    
$email = $_POST['email'];
$password = $_POST['password'];

$email = mysqli_real_escape_string($connection, $email);
$password = mysqli_real_escape_string($connection, $password);
    
    $query = "SELECT * FROM users WHERE email = '{$email}' ";
    $select_user_query = mysqli_query($connection, $query);

    if(!$select_user_query) {
        
        die("QUERY FAILED". mysqli_error($connection));
        
    }
    
    while($row = mysqli_fetch_array($select_user_query)){
        
        $db_email = $row['email'];
        $db_user_password = $row['password'];
        $db_user_firstname = $row['first_name'];
        $db_user_lastname = $row['last_name'];
        $db_user_role = $row['role'];

        
    }
    
    $password = crypt($password, $db_user_password);
    
    
    if($email == $db_email && $password == $db_user_password){
        
        $_SESSION['username'] = substr($db_user_firstname, 0, 1) . $db_user_lastname;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname'] = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;     
        
        header("Location: ../admin");
        
    } else {
        
        header("Location: ../index.php");
        
    }
    
}






?>