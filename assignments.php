<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>
      <div class="container">
         
    <!-- Navigation -->
<?php include "includes/navigation.php" ?>

          
          <br>
          
<!-- THIS IS THE CONTAINER FOR THE LISTING OF CREDITS -->
          <div class="view-window col-md-12 block">
                <table class="table table-striped table-hover">  
                  <thead>
                       <tr>
                        <th>Credit</th>
                        <th>Code Name</th> 
                        <th>Analyst</th>
                      </tr> 
                  </thead>
                  <tbody>
             
 <?php 
                

//BUILD QUERY
                      
        $query = "SELECT * FROM borrower";
        $select_borrowers_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_borrowers_query)){
            $borrower_id = $row['borrower_id'];
            $borrower_name = $row['borrower_name'];
            $borrower_code_name = $row['borrower_code_name'];
            $portfolio_analyst_ID = $row['portfolio_analyst_ID'];
            
                $query2 = "SELECT * FROM users WHERE user_id = $portfolio_analyst_ID";
                $select_user_name_query = mysqli_query($connection, $query2);
                    while($row = mysqli_fetch_assoc($select_user_name_query)){
                        $firstname = $row['first_name'];
                        $lastname = $row['last_name'];
                    }

?>

                      <tr>
                        <td><a href="borrower.php?b_id=<?php echo $borrower_id ; ?>" ><?php echo $borrower_name ; ?></a></td>
                        <td><?php echo $borrower_code_name ; ?></td> 
                        <td><?php echo $firstname . " " . $lastname ; ?></td>
                      </tr>

        <?php } ?>
                 
                  </tbody>
                </table>
          </div>

      </div>


<?php include "includes/footer.php" ?>