                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Title</th>
                                        <th>Email</th>
                                        <th>Desk Phone</th>
                                        <th>Cell Phone</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                               <tbody>
                                   
                                 <?php 
    
    
$query = "SELECT * FROM users";
$select_users = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_users)){
$user_id = $row['user_id'];
$user_firstname = $row['first_name'];
$user_lastname = $row['last_name'];
$user_title = $row['title'];
$user_email = $row['email'];
$user_desk_phone = $row['desk_phone'];
$user_cell_phone = $row['cell_phone'];
$user_role = $row['role'];


echo "<tr>";
    echo "<td>{$user_id}</td>";
    echo "<td>{$user_firstname}</td>";
    echo "<td>{$user_lastname}</td>";
    echo "<td>{$user_title}</td>";
    echo "<td>{$user_email}</td>";
    echo "<td>{$user_desk_phone}</td>";
    echo "<td>{$user_cell_phone}</td>";
    echo "<td>{$user_role}</td>";    

    echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
    echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
    echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
    echo "<td><a onClick=\"javascript: return confirm('Are you sure you wnat to delete this post?') \" href='users.php?delete={$user_id}'>Delete</a></td>";
echo "</tr>";  
    
}
    
    
    ?>
                                      

    
                               </tbody>
                            </table>
                            
        
                  
                 <?php

if(isset($_GET['change_to_admin'])){
    
        $the_user_id = $_GET['change_to_admin'];
    
        $query = "UPDATE users SET user_role = 'admin' WHERE user_id =  $the_user_id";
        $change_to_admin_query = mysqli_query($connection, $query);
        header("Location: users.php");
        
    
}




if(isset($_GET['change_to_sub'])){
    
        $the_user_id = $_GET['change_to_sub'];
    
        $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id =  $the_user_id";
        $change_to_sub_query = mysqli_query($connection, $query);
        header("Location: users.php");
        
    
}













if(isset($_GET['delete'])){
    
        $the_user_id = $_GET['delete'];
    
        $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
        $delete_user_query = mysqli_query($connection, $query);
        header("Location: users.php");
        
    
}



?>