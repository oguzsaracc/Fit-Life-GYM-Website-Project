<?php
require_once 'db.php';

// init session data
session_start();

?>
<nav class="navbar navbar-expand-md navbar-light fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="img/fitlife.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav ml-auto">

        <li class="nav-item">
          <a class="nav-link" href="index.php">Homepage</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="registration.php">Registration</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="class.php">Class</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact_us.php">Contact us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="testimonial.php">Testimonial</a>
        </li>
        <li class="nav-item">
          <!-- Show Login or Logout Button -->
          <?php
          if (isset($_SESSION['userType']) && ($_SESSION['userType'] == 'admin' || $_SESSION['userType'] == 'member')) {
            echo '<a class="nav-link" href="javascript:logout()">Logout</a>';
          } else {
            echo '<a class="nav-link" href="javascript:login()">Login</a>';
          }
          ?>
        </li>
      </ul>
    </div>

  </div>
</nav>