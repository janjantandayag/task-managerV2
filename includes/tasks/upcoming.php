          <div class="view-window col-md-12">
                <table class="table table-striped table-hover text-center">  
                  <thead>
                       <tr>
                        <th class="text-center">Task</th>
                        <th class="text-center">Due Date</th>
                        <th class="text-center">Status</th>
                      </tr> 
                  </thead>
                  <tbody>
             
 <?php 
                
//GET INFO FROM URL TO POULATE QUERY               
        if(isset($_GET['u_id']) && isset($_GET['b_id'])) {
            $the_user_id = $_GET['u_id'];
            $the_borrower_id = $_GET['b_id'];
            $query_extension = "WHERE user_id = $the_user_id AND dealGroupId = $the_borrower_id";
        } elseif (isset($_GET['b_id'])) {
            $the_borrower_id = $_GET['b_id'];
            $query_extension = "WHERE dealGroupId = $the_borrower_id";
        } elseif (isset($_GET['u_id'])) {
            $the_user_id = $_GET['u_id'];
            $query_extension = "WHERE user_id = $the_user_id";
        } else {
            $query_extension = "";
        }

//BUILD QUERY
                      
        $query = "SELECT * FROM tasks $query_extension ORDER BY dueDate ASC LIMIT 30";
        $select_tasks_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_tasks_query)){
            $task_id = $row['ID'];
            $borrower_id = $row['dealGroupId'];
            $task = $row['title'];
            $due_date = $row['dueDate'];
            $completed = $row['status'];

                $query2 = "SELECT groupName FROM deal_group WHERE ID = $borrower_id";
                $select_borrower_name_query = mysqli_query($connection, $query2);
                    while($row = mysqli_fetch_assoc($select_borrower_name_query)){
                        $borrower = $row['groupName'];
                    }
?>

                      <tr>
                        <td><a href="task.php?t_id=<?php echo $task_id ?> "><?php echo $task ; ?></a></td>
                        <td><?php echo $due_date ; ?></td> 

                        <td class="<?php if ($completed == 1) {echo "success";} else {echo "danger";} ?>"><?php if ($completed == 1) {echo "Completed";} else {echo "Not Complete";} ?></td>
                      </tr>

        <?php } ?>
                 
                  </tbody>
                </table>
          </div>