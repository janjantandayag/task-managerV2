<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

   <?php

if(isset($_POST['submit'])){
    
    $firstname  = $_POST['first_name'];
    $lastname   = $_POST['last_name'];
    $title      = $_POST['title'];
    $email      = $_POST['email'];
    $o_phone    = $_POST['desk_phone'];
    $c_phone    = $_POST['cell_phone'];
    $password   = $_POST['password'];
    $role       = "Portfolio Management";
    
    if(!empty($firstname) && !empty($lastname) && !empty($title) && !empty($email) && !empty($o_phone) && !empty($c_phone) && !empty($password)){
    
    $firstname  = mysqli_real_escape_string($connection, $firstname);
    $lastname   = mysqli_real_escape_string($connection, $lastname);
    $title      = mysqli_real_escape_string($connection, $title);
    $o_phone    = mysqli_real_escape_string($connection, $o_phone);
    $c_phone    = mysqli_real_escape_string($connection, $c_phone);
    $password   = mysqli_real_escape_string($connection, $password);
    $role       = mysqli_real_escape_string($connection, $role);

    
    $query = "SELECT randSalt FROM users";
    $select_randsalt_query = mysqli_query($connection, $query);
    
    if(!$select_randsalt_query) {
        die("Query Failed" . mysqli_error($connection));
    }
        
        $row = mysqli_fetch_array($select_randsalt_query);
        
        $salt = $row['randSalt'];
        
        $password = crypt($password, $salt);
        
        $query = "INSERT INTO users (password, first_name, last_name, title, email, desk_phone, cell_phone, role) ";
        $query .= "VALUES('{$password}','{$firstname}', '{$lastname}', '{$title}','{$email}','{$o_phone}', '{$c_phone}', '{$role}')";
        $register_user_query = mysqli_query($connection, $query);
        if(!$register_user_query){
            die("QUERY FAILED " . mysqli_error($connection) . ' ' . mysqli_errno($connection));
        }
        
        
        $message = "Your registration has been submitted";
        
        
} else {
        
        $message = "Field cannot be empty";
        
    }
    
} else {
        
        $message = "";
        
    }




?>
    
    

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                       
                       <h6 class="text-center"><?php echo $message; ?></h6>
                       
                        <div class="form-group">
                            <label for="first_name" class="sr-only">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter First Name">
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="sr-only">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter Last Name">
                        </div>
                         <div class="form-group">
                            <label for="title" class="sr-only">Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="klandau@whiteoaksf.com">
                        </div>
                        <div class="form-group">
                            <label for="desk_phone" class="sr-only">Desk Phone</label>
                            <input type="tel" name="desk_phone" id="desk_phone" class="form-control" placeholder="Enter Desk Phone">
                        </div>
                        <div class="form-group">
                            <label for="cell_phone" class="sr-only">Cell Phone</label>
                            <input type="tel" name="cell_phone" id="cell_phone" class="form-control" placeholder="Enter Cell Phone">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
