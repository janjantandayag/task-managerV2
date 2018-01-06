<!-- THIS IS THE right NAVIGATION -->
             <div class="col-md-3">
             <ul class="nav nav-pills nav-stacked">
             
 <?php 
   
//logic for selecting active user
 if(isset($_GET['u_id'])) {
        $the_user_id = $_GET['u_id'];
        }
              
                 
                 
        $query = "SELECT * FROM people WHERE role='Portfolio Management Analyst' ";
        $select_people_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_people_query)){
            $user_id = $row['ID'];
            $first_name = $row['firstName'];
            $last_name = $row['lastName'];
//            $title = $row['title'];
//            $email = $row['email'];
//            $desk_phone = $row['desk_phone'];
//            $cell_phone = $row['cell_phone'];

?>

                 <li role="presentation" class="<?php if ($user_id == $the_user_id) {echo "active";} ?>">
                       <a href="index.php?u_id=<?php echo $user_id ?> "><?php echo $first_name . " " . $last_name ; ?>
                            <span data-toggle="collapse" href="#collapse<?php echo $user_id ?>" class="badge">
                            	<?php $result = mysqli_query($connection, "SELECT * FROM deal_group");
                                      $deal_count = mysqli_num_rows($result);
                                echo $deal_count; ?>
                            </span>
                       </a>
                 </li>
                 
                 <div id="collapse<?php echo $user_id ?>" class="panel-collapse collapse">
                 
                                      <?php 

                    //borrowers for each analyst

                            $query = "SELECT * FROM deal_group WHERE portfolioManager = $user_id";
                            $select_borrwer_by_analyst_query = mysqli_query($connection, $query);

                            while($row = mysqli_fetch_assoc($select_borrwer_by_analyst_query)){
                                $borrower_id = $row['ID'];
                                $borrower_name = $row['groupName'];
                                $borrower_code_name = $row['codeName'];
//                                $portfolio_analyst_ID = $row['portfolio_analyst_ID'];
//                                $borrower_contact_person = $row['borrower_contact_person'];
//                                $borrower_contact_email = $row['borrower_contact_email'];
//                                $borrower_contact_phone = $row['borrower_contact_phone'];

                    ?>
                        <ul>
                               <li role="presentation" class="<?php if ($borrower_id == $the_borrower_id) {echo "active";} ?>">
                                <a href="index.php?b_id=<?php echo $borrower_id ?> ">
                                    <?php echo $borrower_name . " (" . $borrower_code_name . ")" ; ?>
                                </a>
                            </li>
                        </ul>

        <?php } ?>
        
                    </div>
        
        <?php } ?>

              </ul>
          </div>