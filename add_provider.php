<?php

include 'session.php';

include 'config.php';


if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $adress = mysqli_real_escape_string($conn, $_POST['adress']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $company_name = mysqli_real_escape_string($conn, $_POST['company_name']);
    $services_offered = mysqli_real_escape_string($conn, $_POST['services_offered']);
    $description  = mysqli_real_escape_string($conn, $_POST['description']);
    
    // Check if the user already exists based on the email or username
    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   
    if (mysqli_num_rows($select_users) > 0) {
        $message[] = 'User already exists!';
        
    } else {

            // Insert the user's data into the database with the hashed password
            mysqli_query($conn, "INSERT INTO `users`(name, last_name, email, number, adress) VALUES('$name', '$last_name', '$email', '$number', '$adress' )") or die('query failed');

            $user_id = mysqli_insert_id($conn);

            mysqli_query($conn, "INSERT INTO `providers` (UserID, company_name, contact_info, services_offered,  description) VALUES ('$user_id', '$company_name', '$services_offered',  '$description')") or die('Query failed');

            $message[] = 'User and Provider added successfully!';
          
        
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Add Employee</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  
  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

 
</head>

<body>


<?php
if (isset($message)) {
   foreach ($message as $msg) {
      echo '
      <div class="message">
         <span>' . $msg . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>



  <!-- ======= Header ======= -->
  <?php include 'header.php'; ?>
  <!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php include 'side_bar.php'; ?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Employee</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">G R H</li>
          <li class="breadcrumb-item active">Add employee</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Infos</h5>

              <!-- General Form Elements -->
              <form  class="row g-3"  action="" name="add_provider" method="post" enctype="multipart/form-data" novalidate>
                <div class="col-md-6">
                  <input type="text" class="form-control" placeholder="Name" name="name" required >
                </div>
                <div class="col-md-6">
                <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                </div>
                
                <div class="col-md-6">
                  <input type="email" name="email" class="form-control" placeholder="Email" value="" required>
                </div>
                <div class="col-md-6">
                <input type="text" name="company_name" class="form-control" placeholder="Company Name" required>
                </div>
                
               
                <div class="col-md-12">
                  <input type="tel" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" name="number"  class="form-control" placeholder="Phone Number" >
                </div>
               
                <div class="col-md-6">
                    <textarea name="services_offered" class="form-control" placeholder="Services Offered" required></textarea>
                </div>

                <div class="col-md-6">
                  <textarea name="description" class="form-control" placeholder="Description" required></textarea>
                </div>

               
                  <div  class="col-md-12">
                    <select class="form-select" aria-label="Default select example" name="role">
                      <option selected>Role...</option>
                      <option value="1">Admin</option>
                      <option value="2">Employee</option>
                      <option value="3">Provider</option>
                      <option value="4">Client</option>
                      <option value="5">Other</option>
                     
                    </select>
                  </div>
              
                  <div class="text-center">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" name="reset" class="btn btn-secondary">Reset</button>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>
      
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'footer.php'; ?>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>