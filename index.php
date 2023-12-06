<?php 
include('config.php');
$emailErr =$passErr = "";  
$email = $passw = $regMesg = "";  
  
//Input fields validation  
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    //Email Validation   
    if (empty($_POST["Email"])) {  
            $emailErr = "Email is required";  
          
    } else {  
            $email = input_data($_POST["Email"]);  
            // check that the e-mail address is well-formed  
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  
                $emailErr = "Invalid email format";  
            }  
     }  
    //Email Validation   
    if (empty($_POST["Password"])) {  
            $passErr = "Password is required";  
    } else {  
            $passw = input_data($_POST["Password"]);  
            // check that the e-mail address is well-formed  
      if (strlen($_POST["Password"]) < '4') {
            $passErr = "Your Password Must Contain At Least 4 Characters!";
        }
        elseif(!preg_match("#[0-9]+#",$passw)) {
            $passErr = "Your Password Must Contain At Least 1 Number!";
        }
        elseif(!preg_match("#[A-Z]+#",$passw)) {
            $passErr = "Your Password Must Contain At Least 1 Capital Letter!";
        }
        elseif(!preg_match("#[a-z]+#",$passw)) {
            $passErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
        }
     }  
     
    
if(isset($_POST['login'])) {  
if($emailErr == "" && $passErr == "" ) {  

$email = mysqli_real_escape_string($conn, $_POST['Email']);
$passw = mysqli_real_escape_string($conn, $_POST['Password']);


$record = "SELECT `user_id`, `user_n`, `user_pro`, `user_ledu`, `user_mob`,
`user_email`, `user_pass`, `user_pass`, `acc_tyep`, `acc_stuts`, `acc_memb`,
`is_admin`, `avtr`, `acc_date`  FROM `tbuser` WHERE `user_email`='".$email."' &&`user_pass`='".$passw."'
";
  $result = $conn->query($record);


  if($result->num_rows >= 1) { 
   session_start();
    while($row = $result -> fetch_assoc())
      {
        $_SESSION["user_id"] =$row['user_id'];
        $_SESSION["user_n"] =$row['user_n'];
        $_SESSION["user_email"] =$row['user_email'];
        $_SESSION["user_mob"] =$row['user_mob'];
        $_SESSION["is_admin"] =$row['is_admin'];
        $_SESSION["acc_stuts"] = $row['acc_stuts'];
        $_SESSION["acc_tyep"] = $row['acc_tyep'];
        $_SESSION["acc_date"] = $row['acc_date'];
        $_SESSION["acc_memb"] = $row["acc_memb"];
        $_SESSION["is_admin"] = $row["is_admin"];
      
      }
 
     if($_SESSION["acc_stuts"]== "ngc"){
      
      $loginMsg = "<div class='alert alert-danger'><p>Your email account not yet
      confirmed. pleas go to email inbox and confirm your email</p></div>"; 
     }elseif($_SESSION["is_admin"] == "yes"){
       header("location:admind.php");
     }else{
       header("location:publisher-home.php");
       
     }
          
    }else{
              $loginMsg= "<div class='container bg-danger text-center p-2 
              rounded-3' style='z-index:1000; color:white;'><p>The Email or
              Password You Enter is Incorect Pleas try again </p></div>";  
          }
          }  
}
}

function input_data($data) {  
  $data = trim($data);  
  $data = stripslashes($data);  
  $data = htmlspecialchars($data);  
  return $data;  
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Peer Shre -HOME</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css"/>

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


  <!-- =======================================================
  * Template Name: Mentor
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.html">Peer Share</a></h1>
      
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="active" href="index.html">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="courses.html">Publication</a></li>
          <li><a href="trainers.html">Publishers</a></li>
          <li><a href="events.html">Events</a></li>
          <li><a href="pricing.html">Pricing</a></li>

          <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <!-- .navbar -->

    <button class="btn get-started-btn" onclick="openForm()">Login</button>

   <!--   <a href="courses.html" class="get-started-btn">login</a>-->

    </div>
  </header>
  <!-- End Header -->


  


  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex justify-content-evenly flex-column align-items-center">

    <div class="container  position-relative" data-aos="zoom-in" data-aos-delay="100">
        <div class="container-fluid d-flex flex-row justify-content-start" data-aos="zoom-in" data-aos-delay="100">
            <img class="w-25 h-25" src="assets/img/logops.png" alt="">
        </div> 
      <h1>Search, Share,<br>And get what you deserve</h1>
      <h2>We made the place where you find >10k educational references and where you can
      also share your's for money in ETHIOPIA</h2>
      <a href="asstudent.php" class="btn-get-started">Join as Student</a>
      <a href="aspublisher.php" class="btn-get-started">Join as Publisher</a>
    </div>
    <br>
    
    <?php
    echo ($loginMsg);
    ?>
  <!-- ======= Login form Section ======= -->
    <div class="login-form-popup " id="myForm" data-aos="fade-up">
      <form method="POST" action="<?php echo
      htmlspecialchars($_SERVER["PHP_SELF"]); ?>"class="login-form-container"  >
          <div class="container text-white">   
           </div> 
          <div class="container text-white d-flex flex-column pt-0 justify-content-center w-100%  align-items-center">
           <div class="container pt-0 ">
            <p class="text-start text-white"><?php echo $emailErr; ?> </p>
 
            <input class="form-control"type="text" name="Email" placeholder="Enter Email" >
          </div>
            <div class="container pt-0">
            <p class="text-start text-white"><?php echo $passErr; ?> </p>
            
            <input class="form-control" type="Password" name="Password" placeholder="Enter Password ">
         </div>
            <div class="container p-2 d-flex ">
              <button type="submit" value="login" name="login" class="btn input-group" >Login</button>
              <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </div>
            <span> <p class="forgot">Forgot <a href="#" class="text-warning">password?</a></p></span>
            <span><p class="forgot"> Don't you have an account?<a class="text-warning" href="Uregistration.php"> Creat account.</a></p></span>
          </div>
      </form>
    </div>
  <!-- ======= end Login form Section ======= -->
  </section><!-- End Hero -->

    <section id="features" class="features mb-0">
      <div class="container" data-aos="fade-up">

      </div>
    </section>  

  <main id="main">
<a href="publication-home.php">htmlppppp</a>
<a href="test.php">htmlppppp</a>

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="assets/img/gc.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3>More than 10k qualified professionals in different fields are
            ready to share you their original educational reference</h3>
            <p class="fst-italic">
             The first platform that you can find indigenous educational reference for your study and also you can make money online in ethiopia
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i>Thesis research and
              proposals for post and undergraduate students</li>
              <li><i class="bi bi-check-circle"></i>Articel review projects paper and assignments for college and university students</li>
              <li><i class="bi bi-check-circle"></i>Illustration examples and solved question for different level of students</li>
            </ul>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts section-bg">
      <div class="container">

        <div class="row counters">

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="1232" data-purecounter-duration="1" class="purecounter"></span>
            <p>Reserach and proposal</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="6489" data-purecounter-duration="1" class="purecounter"></span>
            <p>Business plan and projects</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="4002" data-purecounter-duration="1" class="purecounter"></span>
            <p>Illustration and explanation</p>
          </div>

          <div class="col-lg-3 col-6 text-center">
            <span data-purecounter-start="0" data-purecounter-end="10955" data-purecounter-duration="1" class="purecounter"></span>
            <p>Templets and examples</p>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-4 d-flex text-center align-items-stretch">
            <div class="content">

              <h3>Online job in Ethioia</h3>
              <div class="container d-flex flex-row justify-content-center">
               <i class="fa-solid fa-sack-dollar" style=" font-size:5rem; color: #fff25e;"></i>
              </div>
              <h3>Upload references and get paid per view</h3>
              <p>
              The first online job in Ethiopia with realistic business model. It requires only very simple requirements to get started, 
              you can do it anywhere and anytime, and it offers a variety of
              reliable cash pay-out options.
              </p>
              <div class="text-center">
                <a href="learn.php" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-8 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="fa-brands fa-nfc-directional" style="color: #081461;"></i>
                    <h4>Simple</h4>
                    <p>It need simple requirements to start the job and simple to do it</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-cube-alt"></i>
                    <h4>Un-bound</h4>
                    <p>You can do it anywhere and anytime as long as you are in need of extra online job</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-images"></i>
                    <h4>Reliabel</h4>
                    <p>It is based on realistic business model with reliable option of cash pay-out for your earning</p>
                  </div>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Features Section ======= 
    <section id="features" class="features">
      <div class="container" data-aos="fade-up">

        <div class="row" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-lg-3 col-md-4">
            <div class="icon-box">
              <i class="ri-store-line" style="color: #ffbb2c;"></i>
              <h3><a href="">Lorem Ipsum</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="ri-bar-chart-box-line" style="color: #5578ff;"></i>
              <h3><a href="">Dolor Sitema</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
            <div class="icon-box">
              <i class="ri-calendar-todo-line" style="color: #e80368;"></i>
              <h3><a href="">Sed perspiciatis</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4 mt-lg-0">
            <div class="icon-box">
              <i class="ri-paint-brush-line" style="color: #e361ff;"></i>
              <h3><a href="">Magni Dolores</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-database-2-line" style="color: #47aeff;"></i>
              <h3><a href="">Nemo Enim</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              
              <i class="ri-gradienter-line" style="color: #ffa76e;"></i>
              <h3><a href="">Eiusmod Tempor</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-file-list-3-line" style="color: #11dbcf;"></i>
              <h3><a href="">Midela Teren</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-price-tag-2-line" style="color: #4233ff;"></i>
              <h3><a href="">Pira Neve</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-anchor-line" style="color: #b2904f;"></i>
              <h3><a href="">Dirada Pack</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-disc-line" style="color: #b20969;"></i>
              <h3><a href="">Moton Ideal</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-base-station-line" style="color: #ff5828;"></i>
              <h3><a href="">Verdo Park</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="ri-fingerprint-line" style="color: #29cc61;"></i>
              <h3><a href="">Flavor Nivelanda</a></h3>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Features Section -->

    <!-- ======= Resent Publication Section ======= -->
    
    <section id="popular-courses" class="courses">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Publication</h2>
          <p>Recent publication</p>
        </div>
      <div class="row" data-aos="zoom-in" data-aos-delay="100">

       <?php
          $query = "SELECT `upload_id`, `up_status`, `up_view`, `up_date`,
          `publ_id`, `up_status`, `up_content`, `file`, `titel`, `filds` FROM `tbuploads`
          WHERE  `up_status` = 'A' LIMIT 4";
          $result = mysqli_query($conn, $query);
          if (mysqli_num_rows($result) > 0){
            foreach ($result as $data) {?>
            
        
              <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
              
                    <div class="course-item">
                      <img src="assets/img/course-1.jpg" class="img-fluid" alt="...">
                      <div class="course-content">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                          <h4><?= $data['filds']; ?></h4>
                          <p class="price">$169</p>
                        </div>
        
                        <h3><a href="course-details.html"><?= $data['up_content']; ?></a></h3>
                        <p><?= $data['titel']; ?></p>
                        <div class="trainer d-flex justify-content-between align-items-center">
                          <div class="trainer-profile d-flex align-items-center">
                            <img src="assets/img/trainers/trainer-1.jpg" class="img-fluid" alt="">
                            <span>Antonio</span>
                          </div>
                          <div class="trainer-rank d-flex align-items-center">
                            <i class="bx bx-user"></i>&nbsp;50
                            &nbsp;&nbsp;
                            <i class="bx bx-heart"></i>&nbsp;65
                          </div>
                        </div>
                      </div>
                    </div>
                  </div> <!-- End Course Item-->
                  
                <?php
                            
                 }
                 }else{
                   ?>
                   
                     <p colspan="4"class="table-danger text-center text-muted">There is no
                     recent publication yet!</p>
                   
                   <?
                 }
                        
                ?>
        
        
                </div>
        
              </div>
    </section><!-- End Popular Courses Section -->

    <!-- ======= Trainers Section ======= -->
    <section id="trainers" class="trainers">
      <div class="container" data-aos="fade-up">

        <div class="row" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <img src="assets/img/Ceo.jpg" class="img-fluid" alt="">
              <div class="member-content">
                <h4>Samson Aklilu</h4>
                <span>CEO</span>
                <p>
                  Msc in Accounting and finance with 11 relevant work experience in different mideal and higer managment position</p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <img src="assets/img/Mgr.jpg" class="img-fluid" alt="">
              <div class="member-content">
                <h4>Sarah Jhinson</h4>
                <span>Marketing</span>
                <p>
                  Repellat fugiat adipisci nemo illum nesciunt voluptas repellendus. In architecto rerum rerum temporibus
                </p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <img src="assets/img/trainers/trainer-3.jpg" class="img-fluid" alt="">
              <div class="member-content">
                <h4>William Anderson</h4>
                <span>Content</span>
                <p>
                  Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et laborum toro des clara
                </p>
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Trainers Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Mentor</h3>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>Mentor</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/ -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  
<script>
  $(document).ready(function () {
    $(document).on('click', '#loadBtn', function () {
      var row = Number($('#row').val());
      var count = Number($('#postCount').val());
      var limit = 3;
      row = row + limit;
      $('#row').val(row);
      $("#loadBtn").val('Loading...');
 
      $.ajax({
        type: 'POST',
        url: 'loadmore-data.php',
        data: 'row=' + row,
        success: function (data) {
          var rowCount = row + limit;
          $('.postList').append(data);
          if (rowCount >= count) {
            $('#loadBtn').css("display", "none");
          } else {
            $("#loadBtn").val('Load More');
          }
        }
      });
   });
  });
</script>
</body>

</html>