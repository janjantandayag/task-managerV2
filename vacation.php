<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>
   <?php

if(isset($_POST['submit'])){
    
    $user_id    = $_SESSION['username'];
    $req_title  = $_POST['title'];
    $start_date = $_POST['beg_date'];
    $end_date   = $_POST['end_date'];
    $description= $_POST['description'];
    $req_type       = $_POST['type'];
    $submitted_date = $_POST['submitted_date'];
    $status     = 'pending';
    
    if(!empty($user_id) && !empty($req_title) && !empty($start_date) && !empty($end_date) && !empty($description) && !empty($status) ){
    
    $user_id    = mysqli_real_escape_string($connection, $user_id);
    $req_title  = mysqli_real_escape_string($connection, $req_title);
    $start_date = mysqli_real_escape_string($connection, $start_date);
    $end_date   = mysqli_real_escape_string($connection, $end_date);
    $description= mysqli_real_escape_string($connection, $description);
    $status     = mysqli_real_escape_string($connection, $status);
    $req_type     = mysqli_real_escape_string($connection, $req_type);
    $submitted_date= mysqli_real_escape_string($connection, $submitted_date);
    
    $query = "INSERT INTO vacation (user_id, req_title, req_type, start_date, end_date, description, status, submitted_date) ";
    $query .= "VALUES('{$user_id}','{$req_title}','{$req_type}', '{$start_date}', '{$end_date}','{$description}','{$status}','{$submitted_date}')";
    $submit_vacation_query = mysqli_query($connection, $query);

        if(!$submit_vacation_query){
            die("QUERY FAILED " . mysqli_error($connection) . ' ' . mysqli_errno($connection));
        }
        
        
        $message = "<div class='alert alert-success'>Your vacation request has been submitted</div>";
        
        
} else {
        
        $message = "Field cannot be empty";
        
    }
    
} else {
        
        $message = "";
        
    }




?>
    
    

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Vacation/Out of Office Request</h1>
                <h6>Please fill out and submit this form to request approval for any vacation and out of office requests.</h6>
                    <form role="form" action="vacation.php" method="post" id="login-form" autocomplete="off">
                       
                       <h6 class="text-center"><?php echo $message; ?></h6>
                       
                         <div class="form-group">
                            <label for="title" class="sr-only">Request Title</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Memorable Request Title">
                        </div>
                         <div class="form-group">
                            <label for="type" class="sr-only">Request Type</label>
                            <select type="text" name="type" id="type" class="form-control" placeholder="Select Request Type">
                                       <option value="PTO/Vacation">PTO/Vacation</option>
                                       <option value="DD Trip/Field Visit">DD Trip/Field Visit</option>
                                       <option value="Other">Other</option>
                                   </select>
                        </div>
                         <div class="form-group">
                            <label for="beg_date" class="sr-only">Begining Date/Time</label>
                            <input type="datetime-local" name="beg_date" id="beg_date" class="form-control" placeholder="MM/DD/YYYY 11:59 PM">
                        </div>
                         <div class="form-group">
                            <label for="end_date" class="sr-only">Ending Date/Time</label>
                            <input type="datetime-local" name="end_date" id="end_date" class="form-control" placeholder="MM/DD/YYYY 11:59 PM">
                        </div>
                         <div class="form-group">
                            <label for="submitted_date" class="sr-only">Submitted Date/Time</label>
                            <input type="hidden" name="submitted_date" id="submitted_date" class="form-control" value="<?php $date = date('Y-m-d H:i:s'); echo $date;?>">
                        </div>
                        <div class="form-group">
                            <label for="description" class="sr-only">Description</label>
                            <textarea name="description" id="description" class="form-control" placeholder="Enter Description of Request"></textarea>
                        </div>
                        <input type="submit" name="submit" id="btn-vacation" class="btn btn-custom btn-lg btn-block btn-primary" value="Submit Request">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

        <hr>

        <h2>Historical Vacation Request/Approval Log</h2>
        
                <table class="table table-striped table-hover text-center">  
                  <thead>
                       <tr>
                        <th class="text-center">Title</th>
                        <th class="text-center">Type</th> 
                        <th class="text-center">Start Date/Time</th>
                        <th class="text-center">End Date/Time</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">status</th>
                      </tr> 
                  </thead>
                  <tbody>
                    <tr class="success">
                        <td>Trip 1</td>
                        <td>PTO</td>
                        <td>2017-12-24 11:59:59 PM PT</td>
                        <td>2017-12-30 11:59:59 PM PT</td>
                        <td>Home for the Holidays!</td>
                        <td>Approved</td>
                    </tr>
                    <tr class="warning">
                        <td>Beef 4</td>
                        <td>Out of Office</td>
                        <td>2017-12-24 11:59:59 PM PT</td>
                        <td>2017-12-30 11:59:59 PM PT</td>
                        <td>Aberdeen fto help the plant</td>
                        <td>Pending</td>
                    </tr>
                    <tr class="danger">
                        <td>Shenanigans</td>
                        <td>Out of Office</td>
                        <td>2017-12-24 11:59:59 PM PT</td>
                        <td>2017-12-30 11:59:59 PM PT</td>
                        <td>Goof off during the week instead of manage credits</td>
                        <td>Declined</td>
                    </tr>
                  </tbody>
                </table>
                  
                  
        <hr>

<?php include "includes/footer.php";?>
