<?php

if(isset($_POST['checkBoxArray'])) {
    
    foreach($_POST['checkBoxArray'] as $postValueId){
        
        $bulk_options = $_POST['bulk_options'];
        
        switch($bulk_options){
                
            case 'published':
                
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
                $update_to_published_status = mysqli_query($connection,$query);
                
                confirm($update_to_published_status);
                    
                break;
            
            case 'draft':
                
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
                $update_to_draft_status = mysqli_query($connection,$query);
                
                confirm($update_to_draft_status);
                    
                break;   
                
            case 'delete':
                
                $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";
                $update_to_delete_status = mysqli_query($connection,$query);
                
                confirm($update_to_delete_status);
                    
                break;      
                
            case 'clone':
                
                $query = "SELECT * FROM posts WHERE post_id = {$postValueId} ";
                $select_post_query = mysqli_query($connection,$query);
                
                while ($row = mysqli_fetch_array($select_post_query)){
                    
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_date = $row['post_date']; 
                $post_author = $row['post_author'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_content = $row['post_content'];
                    
                }
                
                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status)";
                
                $query .= "VALUES('{$post_category_id}', '{$post_title}', '{$post_author}', '{$post_date}', '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_tags}')";
                $copy_query = mysqli_query($connection, $query);
                
                if(!$copy_query){
                    
                    die("QUERY FAILED" . mysqli_error($connection));
                    
                }
                    
                    
                break;  
                
        }
        
    }
    
}


?>
  

  <form action="" method="post">
   <table class="table table-bordered table-hover">
                               
                               <div id="bulkOptionContainer" class="col-xs-4" style="padding:0px;">
                                  
                                   <select class="form-control" name="bulk_options" id="">
                                       <option value="">Select Options</option>
                                       <option value="published">Approve</option>
                                       <option value="draft">Discuss</option>
                                       <option value="delete">Not Approved</option>
                                   </select>
                                   
                               </div>
                               
                               <div>
                                   <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply">
        <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
                                   </div>
                                </div>
                               
                               
                               
                                <thead>
                                    <tr>
                                        <th><input id="selectAllBoxes" type="checkbox"></th>
                                        <th>Status</th>
                                        <th>User</th>
                                        <th>Request Title</th>
                                        <th>Request Type</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Submitted Date</th>
                                        <th>Reviewed Date</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                               <tbody>
                                   
                                 <?php 
    
    
$query = "SELECT * FROM vacation ORDER BY req_id DESC";
$select_vacation = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_vacation)){
$req_id = $row['req_id'];
$user_id = $row['user_id'];
$req_title = $row['req_title'];
$req_type = $row['req_type'];
$start_date = $row['start_date'];
$end_date = $row['end_date'];
$description = $row['description'];
$status = $row['status'];
$submitted_date = $row['submitted_date'];

echo "<tr>";
    ?>
    
    <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $req_id; ?>'></td>
    
    <?php
    echo "<td>{$status}</td>";
    echo "<td>{$user_id}</td>";
    echo "<td>{$req_title}</td>";
    echo "<td>{$req_type}</td>";
    echo "<td>{$start_date}</td>";
    echo "<td>{$end_date}</td>";
    echo "<td>{$submitted_date}</td>";
    echo "<td>Reviewed Date</td>";
    echo "<td>{$description }</td>";

    
echo "</tr>";  
    
}
    
    
    ?>
                                      

    
                               </tbody>
                            </table>
                            
                           </form>
                          
                         
                        
                       
                      
                     
                    
                   
                  
                 <?php

if(isset($_GET['delete'])){
    
        $the_post_id = $_GET['delete'];
    
        $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: posts.php");
    
}

if(isset($_GET['reset'])){
    
        $the_post_id = $_GET['reset'];
    
        $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['reset']) . " ";
        $reset_query = mysqli_query($connection, $query);
        header("Location: posts.php");
    
}


?>