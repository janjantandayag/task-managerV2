          <div class="view-window col-md-12 block">
                <table class="table table-striped table-hover">  
                  <thead>
                       <tr>
                        <th>Task</th>
                        <th>Date</th>
                        <th>Completed</th>
                      </tr> 
                  </thead>
                  <tbody>
             
 <?php 
                
//BUILD QUERY
                      
        $query = "SELECT * FROM tasks WHERE borrower_id = $the_borrower_id";
        $select_tasks_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_tasks_query)){
            $task_id = $row['task_id'];
            $borrower_id = $row['borrower_id'];
            $task = $row['task'];
            $document = $row['document'];
            $reference = $row['reference'];
            $reminder_date = $row['reminder_date'];
            $due_date = $row['due_date'];
            $completed = $row['completed'];

                $query2 = "SELECT borrower_name FROM borrower WHERE borrower_id = $borrower_id";
                $select_borrower_name_query = mysqli_query($connection, $query2);
                    while($row = mysqli_fetch_assoc($select_borrower_name_query)){
                        $borrower = $row['borrower_name'];
                    }
?>

                      <tr>
                        <td><a href="task.php?t_id=<?php echo $task_id ?> "><?php echo $task ; ?></a></td>
                        <td><?php echo $reminder_date ; ?></td>
                        <td class="<?php if ($completed == 1) {echo "success";} ?>"><?php if ($completed == 1) {echo "YES";} else {echo "NO";} ?></td>
                      </tr>

        <?php } ?>
                 
                  </tbody>
                </table>
          </div>