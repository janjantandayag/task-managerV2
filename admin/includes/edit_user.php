<?php 



if(isset($_GET['edit_user'])){
    
    $the_user_id = $_GET['edit_user'];
    
    $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
    $select_users_query = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_users_query)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
    
    }
    
    
}

if(isset($_POST['edit_user'])){
    

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    
//    $post_image = $_FILES['image']['name'];
//    $post_image_temp = $_FILES['image']['tmp_name'];
                               
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
//    $post_date = date('d-m-y');
                               
                               
//        move_uploaded_file($post_image_temp, "../images/$post_image");
    
    $query = "SELECT randSalt FROM users";
    $select_randslat_query = mysqli_query($connection, $query);
    if (!$select_randslat_query){
        die("query Failed" . mysqli_error($connection));
        }
    $row = mysqli_fetch_array($select_randslat_query);
    $salt = $row['randSalt'];
    $hased_password = crypt($user_password, $salt);
    
    
    $query = "UPDATE users SET ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "username = '{$username}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$hased_password}' ";

    $query .= "WHERE user_id = {$the_user_id} ";
        
        $edit_user_query = mysqli_query($connection, $query);
    
        confirm($edit_user_query);
        
    }

   

   ?>
   
<form action="" method="post" enctype="multipart/form-data">
    
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname">
    </div>    
    
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname">
    </div>
    
    <div class="form-group">
        <label for="user_role">User Role: </label>
        <select name="user_role" class="form-control" id="">
           
         <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
           
               <?php
            
            if($user_role == 'admin'){
                
                echo "<option value='subscriber'>subscriber</option>";
                
            } else {
            
                echo "<option value='admin'>admin</option>";
                
            }
   
            ?>

            
        </select>
    </div>
    
<!--
    <div class="form-group">
        <label for="post_category">Post Image</label>
        <input type="file" class="form-control" name="image">
    </div>
-->
    
    <div class="form-group">
        <label for="post_category">Username</label>
        <input type="text" value="<?php echo $username; ?>" class="form-control" name="username">
    </div>        
    
    <div class="form-group">
        <label for="post_category">Email</label>
        <input type="text" value="<?php echo $user_email; ?>" class="form-control" name="user_email">
    </div>
    
    <div class="form-group">
        <label for="post_category">Password</label>
        <input type="password" value="<?php echo $user_password; ?>" class="form-control" name="user_password">
    </div>
        
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Update User">
    </div>  
        
</form>