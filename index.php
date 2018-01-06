<?php include "includes/db.php" ?>
<?php include "includes/header.php" ?>

    <!-- Navigation -->
<?php include "includes/navigation.php" ?>

<div class="container">

          <br>
          
<!-- THIS IS THE CONTAINER FOR THE MIDDLE SECTION -->
          <div class="col-md-12">
                <?php include "includes/rightnav.php" ?>
              <br> 
                <?php include "includes/tasks.php" ?>
          </div>
              <br>
                <?php include "includes/bottomnav.php" ?>

      </div>
      
<?php if(!isset($_SESSION['username'])){
	include "includes/login_box.php";

} ?>
      
      
<?php include "includes/footer.php" ?>
