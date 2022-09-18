<?php
include('../database/config.php');
session_start();
if (!isset($_SESSION['admin'])) {
  header('location:content/admin-login.php');
}
$idadmin = $_SESSION['admin'];
$sql_selectadmin = "SELECT * FROM adminuser";
$result = mysqli_fetch_array($conn->query($sql_selectadmin));
$firstnameadmin = $result['firstname'];
$lastnameadmin = $result['lastname'];
$imgadmin = $result['avatar'];

if (isset($_GET['admin']) && $_GET['admin'] == "logout") {
  session_unset();
  header('location:content/admin-login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">
  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- icon -->
  <link rel="icon" href="../images/logo.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav ">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="../" class="nav-link"><i class="fas fa-share-square"></i> Website</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li><a href="?admin=logout" class="btn btn-outline-danger">Log Out</a></li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="?admin=home" class="brand-link">
        <img src="../images/logo.png" alt="flavor Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">FLAVOR</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../images/Admin/<?php echo $imgadmin; ?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo $firstnameadmin;
                                                      echo ' ';
                                                      echo $lastnameadmin;  ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
              <a href="?admin=home" class="nav-link <?php if ($_GET['admin'] == 'home') {
                                                      echo 'active';
                                                    } else {
                                                      echo '';
                                                    } ?>">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Home
                </p>
              </a>
            </li>

            <li class="nav-item menu-open">
              <a class="nav-link <?php if ($_GET['admin'] == 'product' || $_GET['admin'] == 'addproduct' || $_GET['admin'] == 'addcategory' || $_GET['admin'] == 'addpacking' || $_GET['admin'] == 'editproduct') {
                                    echo 'active';
                                  } else {
                                    echo '';
                                  } ?>">
                <i class="nav-icon fas fa-store-alt"></i>
                <p>
                  Products
                </p>
                <i class="right fas fa-angle-left"></i>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="?admin=product" class="nav-link <?php if ($_GET['admin'] == 'product') {
                                                              echo 'active';
                                                            } else {
                                                              echo '';
                                                            } ?>">
                    <i class="fas fa-list-alt nav-icon"></i>
                    <p>List Product</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="?admin=addproduct" class="nav-link <?php if ($_GET['admin'] == 'addproduct') {
                                                                echo 'active';
                                                              } else {
                                                                echo '';
                                                              } ?>">
                    <i class="fas fa-plus nav-icon"></i>
                    <p>Add product</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="?admin=addcategory" class="nav-link <?php if ($_GET['admin'] == 'addcategory') {
                                                                  echo 'active';
                                                                } else {
                                                                  echo '';
                                                                } ?> ">
                    <i class="fas fa-plus nav-icon"></i>
                    <p>Add category</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="?admin=addpacking" class="nav-link <?php if ($_GET['admin'] == 'addpacking') {
                                                                echo 'active';
                                                              } else {
                                                                echo '';
                                                              } ?>">
                    <i class="fas fa-plus nav-icon"></i>
                    <p>Add packing</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="?admin=order" class="nav-link <?php if ($_GET['admin'] == 'order') {
                                                        echo 'active';
                                                      } else {
                                                        echo '';
                                                      } ?>">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                  Orders Management
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="?admin=contactus" class="nav-link <?php if ($_GET['admin'] == 'contactus') {
                                                            echo 'active';
                                                          } else {
                                                            echo '';
                                                          } ?>">
                <i class="nav-icon fas fa-comment-alt"></i>
                <p>
                  Contact message list
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="?admin=user" class="nav-link <?php if ($_GET['admin'] == 'user') {
                                                      echo 'active';
                                                    } else {
                                                      echo '';
                                                    } ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  User Management
                </p>
              </a>
            </li>
          </ul>
      </div>
      <!-- /.sidebar -->
    </aside>
    <?php
    if (isset($_GET['admin'])) {
      switch ($_GET['admin']) {
        case 'home':
          include_once('content/admin-home.php');
          break;
        case 'product':
          include_once('content/admin-product.php');
          break;
        case 'addproduct':
          include_once('content/admin-addproduct.php');
          break;
        case 'editproduct':
          include_once('content/admin-editproduct.php');
          break;
        case 'addcategory':
          include_once('content/admin-addcategory.php');
          break;
        case 'addpacking':
          include_once('content/admin-addpacking.php');
          break;
        case 'profile':
          include_once('content/admin-profile.php');
          break;
        case 'contactus':
          include_once('content/admin-listcontact.php');
          break;
        case 'order':
          include_once('content/admin-order.php');
          break;
        case 'user':
          include_once('content/admin-user.php');
          break;
      };
    } else {
      echo '
            <script>
              $( document ).ready(function() {
                window.location = "?admin=home";
              });
            </script>
          ';
    }
    ?>
    <footer class="main-footer d-flex justify-content-end">
      <b class="">eProject-Team3</b>
    </footer>
  </div>
  <!-- ./wrapper -->
</body>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Admin App -->
<script src="assets/dist/js/adminlte.js"></script>

</html>