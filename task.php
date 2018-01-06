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
    
    
    if(isset($_GET['t_id'])){
        
        $the_task_id = $_GET['t_id'];
                        
        $query = "SELECT * FROM tasks WHERE ID = $the_task_id ";
        $select_task_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_task_query)){
            $borrower_id = $row['dealGroupId'];
            $task = $row['title'];
            $due_date = $row['dueDate'];
            $document = $row['sourceDoc'];
            $reference = $row['reference'];
            $language = $row['language'];
            $completed = $row['status'];

            
                $query2 = "SELECT * FROM deal_group WHERE ID = $borrower_id";
                $select_borrower_name_query = mysqli_query($connection, $query2);
                    while($row = mysqli_fetch_assoc($select_borrower_name_query)){
                        $borrower_name = $row['groupName'];
                        $borrower_code_name = $row['codeName'];
                    }
            
                $query3 = "SELECT * FROM documents WHERE ID = $document";
                $select_document_query = mysqli_query($connection, $query3);
                    while($row = mysqli_fetch_assoc($select_document_query)){
                        $document_name = $row['name'];
                        $document_link = $row['link'];
                    }
            ?>
            
            
            
                 <h1 class="page-header">
                    <a href="borrower.php?b_id=<?php echo $borrower_id ?> "><?php echo $borrower_name ?></a>
                    <small>(<?php echo $borrower_code_name ?>)</small>
                </h1>

                <!-- Task -->
                <h2>
	                    <?php echo $task ?>
	                </h2>
	                <p class="lead">
                        Source Document: <a href="<?php echo $document_link; ?>"> <?php echo $document_name ?></a> - <em><?php echo $reference; ?></em>
	                    <div class="alert alert-<?php if($completed == 1){ echo "success";} else { echo "danger";} ?>" role="alert">
	                    Completed: 
	                    	<?php if($completed == 1){ echo "Yes - Changed to completed by: Kyle Landau";} else { echo "No";} ?>
	                    	 </div>
	                </p>
             
                <p><div class="alert alert-<?php if($completed == 1){ echo "success";} else { echo "danger";} ?>" role="alert"><span class="glyphicon glyphicon-time"></span> Due by <?php echo " " . $due_date ?></div></p>
                <hr>
                <p><?php echo $language ?></p>


                <hr>

        <?php }
                
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

                <!-- Posted Comments -->
                   <?php
                   $query = "SELECT * FROM task_comments WHERE taskId = {$the_task_id} ";
                    $query .= "ORDER BY ID DESC ";
                    $select_comment_query = mysqli_query($connection, $query);
                    if(!$select_comment_query){
                        
                        die("QUERY FAILED" . mysqli_error($connection));
                    }
                    while ($row = mysqli_fetch_array($select_comment_query)){
                        
                        $comment_date = $row['postDate'];
                        $comment_content = $row['comment'];
                        $comment_author = $row['author'];
                        
                    ?>  

                <!-- Comment -->
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
                
                    <?php } ?>
                
                
                
                



            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php" ?>
