<?php
require('database/config.php');
session_start();
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
if (isset($_SESSION['login'])) {
  $user_id = $_SESSION['login'];
  $sql_select = "SELECT * FROM users WHERE id = '$user_id'";
  $result_user = mysqli_fetch_array($conn->query($sql_select));
  $fullname = $result_user['firstname'] . ' ' . $result_user['lastname'];
}
// Visiter
$sql_selectvisiter = "SELECT * FROM visiter";
$result_visiter = mysqli_fetch_array($conn->query($sql_selectvisiter));
$sql_visitupdate = "UPDATE visiter SET count_visiter = count_visiter + 1  ";
$conn->query($sql_visitupdate);

// People
$sql_selectcountuser = "SELECT COUNT(id) AS countid FROM users";
$result_countuser = mysqli_fetch_array($conn->query($sql_selectcountuser));


?>
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>Flavor Shop</title>
  <link rel="icon" href="images/logo.png">
  <!-- Slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />
  <!-- Bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css" />
  <!-- Fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="assets/css/style.css" rel="stylesheet" />
  <!-- Responsive style -->
  <link href="assets/css/responsive.css" rel="stylesheet" />
  <!-- JQ cdn -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- owl-carousel cdn -->
  <link rel="stylesheet" href="https://rawgit.com/LeshikJanz/libraries/master/Bootstrap/baguetteBox.min.css">
  <link rel="stylesheet" href="assets/css/owl.theme.default.css">
  <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
  <!-- toastr cdn -->
  <link rel="stylesheet" href="assets/css\toast.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <!-- Icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  <!-- AngularJS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.3/angular.min.js"></script>
</head>

<body>
  <!-- header section strats -->
  <header class="header_section sticky-top bg-warning">
    <div class="container">
      <nav class="navbar navbar-expand-lg custom_nav-container pt-3">
        <a class="navbar-brand" href="?page=home">
          <img src="images/logo.png" alt="" /><span>
            Flavor
          </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link home" href="?page=home">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item ">
                <a class="nav-link product" href="?page=product"> Product</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link gallery" href="?page=gallery"> Gallery </a>
              </li>
              <li class="nav-item ">
                <a class="nav-link about" href="?page=about">About us</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link contact" href="?page=contact">Contact us</a>
              </li>
              <li class="nav-item cart align-items-center">
                <a href="?page=cartitem" class="text-dark">
                  <span class="count">
                    <?php
                    if (isset($_SESSION['cart'])) {
                      $quantity_productcart = count($_SESSION['cart']);
                      echo $quantity_productcart;
                    } else {
                      echo 0;
                    }
                    ?>
                  </span>
                  <i class="bi bi-cart4 material-icons"></i>
                </a>
              </li>
            </ul>
          </div>
          <!-- IF no login -->
          <div class="ml-0 ml-lg-4 justify-content-center <?php if (!isset($_SESSION['login'])) {
                                                            echo 'd-flex';
                                                          } else {
                                                            echo 'd-none';
                                                          } ?>">
            <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bi bi-person-circle"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item <?php if (isset($_GET['page']) && $_GET['page'] == 'login') {
                                          echo 'active';
                                        } ?>" href="?page=login"><i class="bi bi-box-arrow-in-right"></i> | Login</a>
                <a class="dropdown-item <?php if (isset($_GET['page']) && $_GET['page'] == 'register') {
                                          echo 'active';
                                        } ?>" href="?page=register"><i class="bi bi-person-plus"></i> | Register</a>
              </div>
            </div>
          </div>
          <!-- IF logined -->
          <div class="ml-0 ml-lg-4 justify-content-center <?php if (isset($_SESSION['login'])) {
                                                            echo 'd-flex';
                                                          } else {
                                                            echo 'd-none';
                                                          } ?>">
            <div class="dropdown">
              <button class="dropdown-toggle border border-0 rounded bg-warning" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="images/<?php echo $result_user['avatar']; ?>" alt="ava" style="width:40px;">
              </button>
              <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="dropdownMenuButton">
                <span class="dropdown-item text-warning"><?php if (isset($fullname)) {
                                                            echo $fullname;
                                                          } ?></span>
                <a class="dropdown-item" href="?page=profile">My Profile</a>
                <a class="dropdown-item" href="?page=logout">Logout</a>
              </div>
            </div>
          </div>
          <!-- SEARCH -->
          <div ng-app="myApp" ng-controller="searchController" class="dropdown ">
            <?php
            $sql_searchproduct = "SELECT products.id , products.products_image , products.name FROM products";
            $result_searchproduct = executeResult($sql_searchproduct);
            ?>

            <div ng-init="list = [
              <?php foreach ($result_searchproduct as $val_searchproduct) : ?>
              {id:'<?php echo $val_searchproduct['id'] ?>',img:'<?php echo $val_searchproduct['products_image'] ?>',name:'<?php echo $val_searchproduct['name'] ?>'},
              <?php endforeach ?>
              ]">
            </div>

            <button class="btn btn-success dropdown-toggle nav_search-btn " type="button" id="searchMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="bi bi-search"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right search_input" aria-labelledby="searchMenuButton">
              <div class="ml-2 mr-2">
                <input type="search" class="form-control rounded" placeholder="Search" ng-model="$parent.searchText">
              </div>
              <div class="overflow-auto" style="height: 450px">
                <div class="" ng-repeat="list_product in list | filter:searchText ">
                  <a class="dropdown-item" ng-hide="$parent.searchText == ''" href="?page=productdetail&id={{list_product.id}}"><img src="images/{{list_product.img}}" style="width: 40px;" alt="">{{list_product.name}}</a>
                </div>
              </div>
            </div>
          </div>
          <!-- /END SEARCH -->
        </div>
      </nav>
    </div>
  </header>
  <!-- end header section -->
  <?php
  if (isset($_GET['page'])) {
    switch ($_GET['page']) {
      case '':
        include_once('page/page-home.php');
        break;
      case 'home':
        include_once('page/page-home.php');
        echo "<script>
        $('.home').addClass('active');
        </script>";
        break;
      case 'product':
        include_once('page/page-product.php');
        echo "<script>
          $('.product').addClass('active');
          </script>";
        break;
      case 'gallery':
        include_once('page/page-gallery.php');
        echo "<script>
              $('.gallery').addClass('active');
              </script>";
        break;
      case 'about':
        include_once('page/page-about.php');
        echo "<script>
              $('.about').addClass('active');
              </script>";
        break;
      case 'contact':
        include_once('page/page-contact.php');
        echo "<script>
              $('.contact').addClass('active');
              </script>";
        break;
      case 'cartitem':
        include_once('page/page-cartitem.php');
        break;
      case 'detail':
        include_once('page/productdetail.php');
        break;
      case 'login':
        include_once('page/page-login.php');
        break;
      case 'register':
        include_once('page/page-register.php');
        break;
      case 'success':
        include_once('page/page-success.php');
        break;
      case 'logout':
        include_once('page/page-logout.php');
        break;
      case 'productdetail':
        include_once('page/page-productdetail.php');
        break;
      case 'profile':
        include_once('page/page-profile.php');
        break;
      case 'changepassword':
        include_once('page/page-changepassword.php');
        break;
      case 'forgotpassword':
        include_once('page/page-forgotpassword.php');
        break;
      default:
        include_once('page/page-home.php');
        break;
    }
  } else {
    echo '
      <script>
        $(document).ready(function(){
          window.location="?page=home";
        })
      </script>
    ';
  }
  ?>


  <!-- footer section -->
  <div class="bg-dark">
    <div class="container text-light">
      <div class="row">
        <div class="col-sm bg-dark text-center mb-3 mt-3 mr-3">
          <i class="bi bi-arrow-clockwise" style="font-size: 30px ;"></i>
          <h5 class="font-weight-bold">3 days to return the product</h5>
          <span>If you don't like it, you can return it.</span>
        </div>

        <div class="col-sm bg-dark text-center mb-3 mt-3 mr-3">
          <i class="bi bi-telephone-outbound" style="font-size: 30px ;"></i>
          <h5 class="font-weight-bold">Hotline 123 456 789</h5>
          <span>8h00 - 21h00</span>
          <span>Monday through Friday except holidays.</span>
        </div>

        <div class="col-sm bg-dark text-center mb-3 mt-3 mr-3">
          <i class="bi bi-truck" style="font-size: 30px ;"></i>
          <h5 class="font-weight-bold">Delivery in 3 days</h5>
          <span>Professional shipping.</span>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid bg-warning footer  wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
      <div class="row g-5">
        <div class="col-lg-3 col-md-6">
          <a class="navbar-brand" href="?page=home">
            <img src="images/logo.png" alt="" /><span>
              Flavor
            </span>
          </a>

          <div class="d-flex pt-2">
            <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-twitter"></i></a>
            <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-facebook-f"></i></a>
            <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-youtube"></i></a>
            <a class="btn btn-square btn-outline-light rounded-circle me-0" href=""><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <h4 class="text-light mb-4">Address</h4>
          <p><i class="fa fa-map-marker-alt me-3"></i> 285 Đội Cấn, Liễu Giai, Ba Đình, Hà Nội</p>
          <p><i class="fa fa-phone-alt me-3"></i> +84 123456789</p>
          <p><i class="fa fa-envelope me-3"></i> flavor@example.com</p>
        </div>
        <div class="col-lg-3 col-md-6">
          <h4 class="text-light mb-4">Quick Links</h4>
          <a class="btn btn-link" href="?page=about">About Us</a>
          <a class="btn btn-link" href="?page=contact">Contact Us</a>
          <a class="btn btn-link" href="?page=gallery">Our gallery</a>
          <a class="btn btn-link" href="?page=product">Our Products</a>


        </div>
        <div class="col-lg-3 col-md-6">
          <h4 class="text-light mb-4">Newsletter</h4>
          <p>Submit your email to hear more from us</p>
          <div class="position-relative mx-auto" style="max-width: 400px;">
            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
            <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid copyright">
      &copy; <a href="?page=home">Flavor</a>, All Right Reserved.
    </div>
  </div>
  <!-- footer section -->
  <!-- clock and geo location -->
  <div class="clock fixed-bottom ms-5 px-2 d-none d-md-block" style="right:auto; bottom: 0.75rem; opacity: 0.7;">
    <div id="Date" class="text-align-left fw-bold"></div>
    <ul class="ultime px-0 my-0">
      <li class="idtime d-inline-block fw-bold" id="hours"></li>
      <li class="idtime d-inline-block fw-bold" id="point">:</li>
      <li class="idtime d-inline-block fw-bold" id="min"></li>
      <li class="idtime d-inline-block fw-bold" id="point">:</li>
      <li class="idtime d-inline-block fw-bold" id="sec"></li>
    </ul>
    <div class="toggle-btn-clock" style="display:none;">
      <b><i class="bi bi-clock"></i></b>
    </div>
  </div>
  <!-- end clock -->

  <!-- Scroll To Top -->
  <div class="col-sm-12">
    <button class="back-top" onclick="myFunction()">
      <i class="fa-solid fa-arrow-up" aria-hidden="true"></i>
    </button>
  </div>
</body>

</html>

<script src="assets/js/owl.carousel.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.js"></script>
<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script src="assets/js/main.js"></script>
<!-- Clock -->
<script>
  // Scroll To Top
  $(window).scroll(function() {
    var sticky = $('.back-top'),
      scroll = $(window).scrollTop();

    if (scroll >= 10) sticky.addClass('button-show');
    else sticky.removeClass('button-show');
  });

  function myFunction() {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    })
  };

  //clock and location button
  $('.clock').on('click', () => {
    $(".geo").toggle();
    $('#Date').toggle();
    $('.ultime').toggle();
    $('.toggle-btn-clock').toggle();

  })
  //clock function
  $(document).ready(function() {

    // Create two variable with the names of the months and days in an array
    var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]

    // Create a newDate() object
    var newDate = new Date();
    // Extract the current date from Date object
    newDate.setDate(newDate.getDate());
    // Output the day, date, month and year   
    $('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

    setInterval(function() {
      // Create a newDate() object and extract the seconds of the current time on the visitor's
      var seconds = new Date().getSeconds();
      // Add a leading zero to seconds value
      $("#sec").html((seconds < 10 ? "0" : "") + seconds);
    }, 1000);

    setInterval(function() {
      // Create a newDate() object and extract the minutes of the current time on the visitor's
      var minutes = new Date().getMinutes();
      // Add a leading zero to the minutes value
      $("#min").html((minutes < 10 ? "0" : "") + minutes);
    }, 1000);

    setInterval(function() {
      // Create a newDate() object and extract the hours of the current time on the visitor's
      var hours = new Date().getHours();
      // Add a leading zero to the hours value
      $("#hours").html((hours < 10 ? "0" : "") + hours);
    }, 1000);
  });

  //map footer
  $('.mapopen').on('click', () => {
    $(".maptoggle").toggle();
  })
</script>

<!-- Clock end -->

<script>
  let app = angular.module('myApp', []);
  app.controller('searchController', function($scope) {

  })
</script>