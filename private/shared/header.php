<?php
if (!isset($page_title)) {
  $page_title = 'TradesLink';
}
unset($_SESSION['message']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php echo h($page_title); ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="<?php echo url_for('/css/open-iconic-bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?php echo url_for('./css/animate.css') ?>">

  <link rel="stylesheet" href="<?php echo url_for('/css/owl.carousel.min.css') ?>">
  <link rel="stylesheet" href="<?php echo url_for('/css/owl.theme.default.min.css') ?>">
  <link rel="stylesheet" href="<?php echo url_for('/css/magnific-popup.css') ?>">

  <link rel="stylesheet" href="<?php echo url_for('/css/aos.css') ?>">

  <link rel="stylesheet" href="<?php echo url_for('/css/ionicons.min.css') ?>">

  <link rel="stylesheet" href="<?php echo url_for('/css/bootstrap-datepicker.css') ?>">
  <link rel="stylesheet" href="<?php echo url_for('/css/jquery.timepicker.css') ?>">


  <link rel="stylesheet" href="<?php echo url_for('/css/flaticon.css') ?>">
  <link rel="stylesheet" href="<?php echo url_for('/css/icomoon.css') ?>">
  <link rel="stylesheet" href="<?php echo url_for('/css/style.css') ?>">
  <style rel="stylesheet">
    #slider {
      position: relative;
      overflow: hidden;
      margin: 0 auto 0 auto;
      border-radius: 4px;
    }

    #slider ul {
      position: relative;
      margin: 0;
      padding: 0;
      /* height: 200px; */
      list-style: none;
    }

    #slider ul li {
      position: relative;
      display: block;
      float: left;
      margin: 0;
      padding: 0;
      width: 500px;
      height: 345px;
      /* background: #ccc; */
      text-align: center;
      line-height: 300px;
    }

    #slider_account ul li {
      position: relative;
      display: block;
      float: left;
      margin: 0;
      padding: 0;
      width: 600px;
      height: 505px;
      /* background: #ccc; */
      text-align: center;
      line-height: 300px;
    }

    a.control_prev,
    a.control_next {
      position: absolute;
      bottom: 1%;
      z-index: 999;
      display: block;
      padding: 4% 3%;
      width: auto;
      height: auto;
      background: #2a2a2a;
      color: #fff;
      text-decoration: none;
      font-weight: 600;
      font-size: 18px;
      opacity: 0.8;
      cursor: pointer;
    }

    a.control_prev:hover,
    a.control_next:hover {
      opacity: 1;
    }

    a.control_prev {
      border-radius: 0 2px 2px 0;
    }

    a.control_next {
      right: 0;
      border-radius: 2px 0 0 2px;
    }

    .slider_option {
      position: relative;
      margin: 10px auto;
      width: 160px;
      font-size: 18px;
    }

    /* Popup container - can be anything you want */
    .popup {
      position: relative;
      display: inline-block;
      cursor: pointer;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    /* The actual popup */
    .popup .popuptext {
      visibility: hidden;
      width: auto;
      background-color: #555;
      color: #fff;
      text-align: center;
      border-radius: 6px;
      padding: 8px 5px;
      position: absolute;
      z-index: 1;
      bottom: 125%;
      left: 50%;
      margin-left: -80px;
    }

    /* Popup arrow */
    .popup .popuptext::after {
      content: "";
      position: absolute;
      top: 100%;
      left: 50%;
      margin-left: -5px;
      border-width: 5px;
      border-style: solid;
      border-color: #555 transparent transparent transparent;
    }

    /* Toggle this class - hide and show the popup */
    .popup .show {
      visibility: visible;
      -webkit-animation: fadeIn 1s;
      animation: fadeIn 1s;
    }

    table {
      table-layout: fixed;
    }

    td {
      width: 20%;
    }

    .today {
      background: yellow;
    }

    /* Add animation (fade in the popup) */
    @-webkit-keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }
  </style>

</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container-fluid">
      <a class="display-4 font-weight-bold" href="<?php echo url_for('/index.php') ?>"> <img src="<?php echo url_for('/images/TLLogo.png') ?>" width="30%" halt="" /></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item cta mr-md-2">
            <?php if (isset($_SESSION['user_id'])) {
              $user_id = $_SESSION['user_id'];
            ?>
              <!-- <a href="index.php" class="nav-link"></a> -->
              <div class="dropdown show">
                <a class="btn btn-primary dropdown-toggle mr-5" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo $_SESSION['first_name']; ?>
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="<?php echo url_for('/account/my_account/user_account.php?id=' . h(u($user_id))); ?>">My Account</a>
                  <a class="dropdown-item" href="<?php echo url_for('/booking/show_booking_user.php'); ?>">Bookings</a>
                  <a class="dropdown-item" href="<?php echo url_for('/account/logout.php') ?>">Logout</a>
                </div>
              </div>
          </li>
          <li class="nav-item cta mr-md-2">
          <?php } elseif (isset($_SESSION['provider_id'])) {

              $provider_id = $_SESSION['provider_id'];
          ?>
            <!-- <a href="index.php" class="nav-link"></a> -->
            <div class="dropdown show">
              <a class="btn btn-primary dropdown-toggle mr-5" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['business_name']; ?>
              </a>

              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="<?php echo url_for('/account/my_account/provider_account.php?id=' . h(u($provider_id))); ?>">My Account</a>
                <a class="dropdown-item" href="<?php echo url_for('/booking/show_booking_provider.php'); ?>">Bookings</a>
                <a class="dropdown-item" href="<?php echo url_for('/account/logout.php') ?>">Logout</a>
              </div>
            </div>
          </li>
        <?php
            } else {
        ?>
          <li class="nav-item cta mr-md-2">
            <a href="<?php echo url_for('/account/login.php') ?>" class="nav-link">Login</a>
          </li>
        <?php
            }
        ?>
        </ul>
      </div>
    </div>
  </nav>

  <!-- END nav -->