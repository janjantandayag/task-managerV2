<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

    <!-- Navigation -->
<?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php 
    
    
    if(isset($_GET['u_id'])){
        
        $the_user_id = $_GET['u_id'];
                        
        $query = "SELECT * FROM people WHERE ID = $the_user_id ";
        $select_user_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_user_query)){
            $user_id = $row['ID'];
            $firstName = $row['firstName'];
            $lastName = $row['lastName'];
            $officePhone = $row['officePhone'];
            $cellPhone = $row['cellPhone'];
            $email = $row['email'];
            $role = $row['role'];



            ?>
            
            
            
                 <h1 class="page-header">
                    <?php echo $firstName . " " . $lastName; ?>
                </h1>

                <!-- Task -->
                    <table class="table table-striped table-hover">  
<!--
                      <thead>
                           <tr>
                            <th class="text-center"></th>
                            <th class="text-center">Credit</th> 
                            <th class="text-center">Due Date</th>
                            <th class="text-center">Document Reference</th>
                            <th class="text-center">Status</th>
                          </tr> 
                      </thead>
-->
                          <tr>
                            <td>Office Phone:</td>
                            <td><?php echo $officePhone; ?></td>
                          </tr>
                          <tr>
                            <td>Cell Phone:</td>
                            <td><?php echo $cellPhone; ?></td>
                          </tr>
                          <tr>
                            <td>Email Address:</td>
                            <td><?php echo $email; ?></td>
                          </tr>
                          <tr>
                            <td>Role:</td>
                            <td><?php echo $role; ?></td>
                          </tr>
                    </table>
                    
                    <hr>
                    
                    
                    
<?php
            //Will look up all the relevant roles that this person is attached to.
            
                $query2 = "SELECT * FROM positions WHERE peopleId = $user_id";
                $select_positions_query = mysqli_query($connection, $query2);
                    while($row = mysqli_fetch_assoc($select_positions_query)){
                        $entitiesId = $row['entitiesId'];
                        $role_description = $row['description'];
                        $title = $row['title'];
                
            
                $query3 = "SELECT nickName FROM entities WHERE ID = $entitiesId";
                $select_entity_query = mysqli_query($connection, $query3);
                    while($row = mysqli_fetch_assoc($select_entity_query)){
                        $entity_name = $row['nickName'];

                        
?>
                     <h2>
                         <?php echo $title . " at " ?> <a href="./entity.php?e_id=<?php echo $entity_name ?>"><?php echo $entity_name ; ?></a>
                    </h2>


                <hr>

        <?php                     }
            
                }
        }
                
                } else {
        
        header("Location: index.php");
    }
                
                
                
                ?>
            
            
            
                <!-- Blog Comments -->
                
                <?php
                if(isset($_POST['create_comment'])){
                    
                $task_id = $_GET['t_id'];
                $comment_author = $_SESSION['username'];
                $comment_text = $_POST['comment'];
                $comment_status = "Posted";
                    
if(!empty($comment_author) && !empty($comment_text)){
                        
                $query = "INSERT INTO task_comments (comment, postDate, status, taskId, author )";
                
                $query .= "VALUES ( '{$comment_text}', now(), '{$comment_status}', '{$task_id}', '{$_SESSION['username']}' )";
                    
                    
                    
                $create_comment_query = mysqli_query($connection, $query);
                    
                    if(!$create_comment_query){
                        die("QUERY FAILED " . mysqli_error($connection));
                    }

                                     
                } else {
    
    echo "<script>alert('Fields cannot be empty')</script>";
}
                        
                    }
                    
                    

                    
                    

                
                ?>
                
                
                

                <!-- Comments Form -->
                <div class="well">
                    <form action="" method="post" role="form">
                         <div class="form-group">
                           <label for="comment">Notepad</label>
                            <textarea name="comment" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Thoughts on the people - should only be seen by author/supervising manager -->
                  
                  
                   <?php
//                   $query = "SELECT * FROM task_comments WHERE taskId = {$the_task_id} ";
//                    $query .= "ORDER BY ID DESC ";
//                    $select_comment_query = mysqli_query($connection, $query);
//                    if(!$select_comment_query){
//                        
//                        die("QUERY FAILED" . mysqli_error($connection));
//                    }
//                    while ($row = mysqli_fetch_array($select_comment_query)){
//                        
//                        $comment_date = $row['postDate'];
//                        $comment_content = $row['comment'];
//                        $comment_author = $row['author'];
//                        
                    ?>  

                <!-- Comment Input -->
                <div class="media">                   
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>
                
                    <?php //  } ?>


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "./includes/people/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php" ?>
