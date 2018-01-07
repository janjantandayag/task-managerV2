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
    
    
    if(isset($_GET['b_id'])){
        
        $the_borrower_id = $_GET['b_id'];
                        
        $query = "SELECT * FROM deal_group WHERE ID = $the_borrower_id ";
        $select_borrower_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_borrower_query)){
            $borrower_id = $row['ID'];
            $borrower_name = $row['groupName'];
            $borrower_code_name = $row['codeName'];
            $portfolio_analyst_ID = $row['portfolioManager'];
            $underwriter_ID = $row['underwriterId'];
            $originator_ID = $row['originatorId'];
            $borrowerContactId = $row['borrowerContact'];


            
                $query2 = "SELECT * FROM people WHERE ID = $portfolio_analyst_ID";
                $select_user_name_query = mysqli_query($connection, $query2);
                    while($row = mysqli_fetch_assoc($select_user_name_query)){
                        $pm_first_name = $row['firstName'];
                        $pm_last_name = $row['lastName'];
                        $pm_user_role = $row['role'];
                    }
            
                $query3 = "SELECT * FROM people WHERE ID = $underwriter_ID";
                $select_user_name_query = mysqli_query($connection, $query3);
                    while($row = mysqli_fetch_assoc($select_user_name_query)){
                        $uw_first_name = $row['firstName'];
                        $uw_last_name = $row['lastName'];
                        $uw_user_role = $row['role'];
                    }
            
                $query4 = "SELECT * FROM people WHERE ID = $originator_ID";
                $select_user_name_query = mysqli_query($connection, $query4);
                    while($row = mysqli_fetch_assoc($select_user_name_query)){
                        $o_first_name = $row['firstName'];
                        $o_last_name = $row['lastName'];
                        $o_user_role = $row['role'];
                    }
            
                $query5 = "SELECT * FROM people WHERE ID = $borrowerContactId";
                $select_user_name_query = mysqli_query($connection, $query5);
                    while($row = mysqli_fetch_assoc($select_user_name_query)){
                        $contact_first_name = $row['firstName'];
                        $contact_first_name = $row['lastName'];
                        $contact_emial = $row['email'];
                        $contact_phone = $row['officePhone'];
                        $contact_mobile = $row['cellPhone'];
                    }
            ?>
            
            
            
                 <h1 class="page-header">
                    <?php echo $borrower_name ?>
                    <small>(<?php echo $borrower_code_name ?>)</small>
                </h1>

                <!-- Task -->
                <h3>Deal Team:</h3>
                	<div class="well">
                        <h5><?php echo $pm_user_role . " - " . $pm_first_name . " " . $pm_last_name ?></h5>
                	    <h5><?php echo $uw_user_role . " - " . $uw_first_name . " " . $uw_last_name ?></h5>
                	    <h5><?php echo $o_user_role . " - " . $o_first_name . " " . $o_last_name ?></h5>
                    </div>
	            <h3><?php echo $borrower_name ?> Team:</h3>    
	                <p class="well">
	                    Company Contact: <?php echo $contact_first_name . " " . $contact_first_name ; ?>
	                    <br>
	                    Contact Email: <?php echo $contact_emial ; ?>
	                    <br>
	                    Contact Office Phone: <?php echo $contact_phone ; ?>
	                    <br>
	                    Contact Mobile Phone: <?php echo $contact_mobile ; ?>
	                </p>

                <hr>

        <?php }
                
                } else {
        
        header("Location: index.php");
    }
                
                
                
                ?>
            
            
            
                <!-- Blog Comments -->
                
                <?php
                
                if(isset($_POST['create_comment'])){
                    
                $task_id = $_GET['b_id'];
                $comment_author = $_SESSION['username'];
                $comment_text = $_POST['comment'];
                $comment_status = "Posted";
                    
                    
if(!empty($comment_author) && !empty($comment_text)){
                        
                $query = "INSERT INTO borrower_comments (borrowerGroupId, comment, status, postDate, author)";
                
                $query .= "VALUES ($the_borrower_id, '{$comment_text}', '{$comment_status}', now(), '{$_SESSION['username']}')";
                    
                    
                    
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
                   $query = "SELECT * FROM borrower_comments WHERE borrowerGroupId = {$the_borrower_id} ";
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
                        <div class="col-md-4">
               
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Key Deal Metrics</h4>
                    <h6>Date Funded: xx/xx/xxxx</h6>
                    <h6>current LTM EBIRDA: $xx MM</h6>
                </div>
                
                                
                
                
                
               
                <!-- Blog Categories Well -->
                <div class="well">
                   
   <?php

    $query = "SELECT * FROM key_documents WHERE borrower_id = $the_borrower_id";
    $select_key_documents_sidebar = mysqli_query($connection, $query) or die(mysqli_error($connection));

   ?>
                   
                    <h4>Key Documents</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                               
    <?php

    while($row = mysqli_fetch_assoc($select_key_documents_sidebar)){
    $doc_name = $row['document_name'];
    $doc_url = $row['document_url'];

    echo "<li><a target='blank' href='$doc_url'>{$doc_name}</a></li>";

    }


    ?>

                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
               
<!-- Side Widget Well -->
<?php include "includes/tasks_small.php" ?>

            </div>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php" ?>
