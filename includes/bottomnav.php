<!-- THIS IS THE CONTAINER FOR TEH BOTTOM SECTION -->
  <div class="col-md-12 ">
      

      <div class="deal-nav col-md-offset-2">
          <ul id="bottomnav" class="nav nav-pills">
             
 <?php 
$borrower_selected = "";
              
//logic for selecting active credit
 if(isset($_GET['b_id'])) {
        $the_borrower_id = $_GET['b_id'];
        }
//logic forquery extension
              if(isset($the_user_id)){
                  $extension = "WHERE portfolio_analyst_ID = " . $the_user_id;
              } else {
                  $extension = "";
              }
              
              
              
              
        $query = "SELECT * FROM borrower $extension";
        $select_all_borrowers_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_all_borrowers_query)){
            $borrower_id = $row['borrower_id'];
            $borrower_name = $row['borrower_name'];
            $borrower_code_name = $row['borrower_code_name'];
            $portfolio_analyst_ID = $row['portfolio_analyst_ID'];
            $borrower_contact_person = $row['borrower_contact_person'];
            $borrower_contact_email = $row['borrower_contact_email'];
            $borrower_contact_phone = $row['borrower_contact_phone'];


if (isset($the_borrower_id) && $borrower_id == $the_borrower_id) {$borrower_selected = $borrower_name;} else {;} ?>

<!--******* THIS IS WHERE I WILL PUT THE LOGIC TO SHOW THE AVAILABLE DOCUMENTS THAT HAVE DATE EVENTS ON THEM *****************-->


<!--                 <li role="presentation" class="-->
                     <?php //if ($borrower_id == $the_borrower_id) {// echo "active"; 
              //  $borrower_selected = $borrower_name;} ?>
<!--                 ">-->
<!--                             <a href="main.php?b_id=-->
                                 <?php // echo $borrower_id ?>
<!--                             ">-->
                                 <?php // echo $borrower_name . " (" . $borrower_code_name . ")" ; ?>
<!--                             </a>-->
<!--                 </li>-->

        <?php } ?>

                  </ul>
              </div>
              <div class="col-md-3"><h3><?php echo $borrower_selected; ?></h3></div>
          </div>