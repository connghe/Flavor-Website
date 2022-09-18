
<div class="hero_area">
  <!-- slider section -->
  <section class=" slider_section position-relative">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="slider_item-box">
            <div class="slider_item-container">
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <div class="slider_item-detail">
                      <div>
                        <h1>
                          Welcome to <br />
                          Our Flavor Shop
                        </h1>
                        <p>
                          We are committed to using fresh ingredients!
                        </p>
                        <div class="d-flex mb-5">
                          <a href="?page=product" class="text-uppercase custom_orange-btn mr-3">
                            Shop Now
                          </a>
                          <a href="?page=contact" class="text-uppercase custom_dark-btn">
                            Contact Us
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="slider_img-box" style="height:300px">
                      <img src="images/saffaron2.png" style="height:100%; object-fit:contain;" alt="" class="" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="slider_item-box">
            <div class="slider_item-container">
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <div class="slider_item-detail">
                      <div>
                        <h1>
                          Welcome to <br />
                          Our Flavor Shop
                        </h1>
                        <p>
                          We are committed to using fresh ingredients!
                        </p>
                        <div class="d-flex mb-5">
                          <a href="?page=product" class="text-uppercase custom_orange-btn mr-3">
                            Shop Now
                          </a>
                          <a href="?page=contact" class="text-uppercase custom_dark-btn">
                            Contact Us
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="slider_img-box" style="height:300px">
                      <img src="images/slide2.png" style="height:100%; object-fit:contain;" alt="" class="" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="slider_item-box">
            <div class="slider_item-container">
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <div class="slider_item-detail">
                      <div>
                        <h1>
                          Welcome to <br />
                          Our Flavor Shop
                        </h1>
                        <p>
                          We are committed to using fresh ingredients!
                        </p>
                        <div class="d-flex mb-5">
                          <a href="?page=product" class="text-uppercase custom_orange-btn mr-3">
                            Shop Now
                          </a>
                          <a href="?page=contact" class="text-uppercase custom_dark-btn">
                            Contact Us
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="slider_img-box" style="height:300px">
                      <img src="images/slide3.png" style="height:100%; object-fit:contain;" alt="" class="" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="custom_carousel-control">
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
  </section>

  <!-- end slider section -->
</div>

<!-- Start Product Section -->
<div class="">
    <div class="product-section">
        <div class="container">
            <div class="row">

                <!-- Start Column 1 -->
                <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                    <h2 class="mb-4 section-title">New Products</h2>
                    <p class="mb-4">We are constantly updating new products</p>
                    <p><a href="?page=product" class="btn_home">Explore</a></p>
                </div>
                <!-- End Column 1 -->
                <?php
                $sql_selectnewproduct = "SELECT * FROM products ORDER BY id DESC LIMIT 3";
                $result_selectnewproduct = executeResult($sql_selectnewproduct);
                foreach ($result_selectnewproduct as $value_selectnewproduct) :
                    ?>
                    <!-- Start Column 2 -->
                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                        <a class="product-item" href="?page=productdetail&id=<?php echo $value_selectnewproduct['id'] ?>">
                            <img src="images/<?php echo  $value_selectnewproduct['products_image'] ?>" class="img-fluid product-thumbnail">
                            <h3 class="product-title"><?php echo $value_selectnewproduct['name']?></h3>
                            <strong class="product-price">$<?php echo $value_selectnewproduct['price']?></strong>

                            <span class="icon-cross">
								<img src="images/cross.svg" class="img-fluid">
							</span>
                        </a>
                    </div>
                    <!-- End Column 2 -->
                <?php endforeach; ?>


            </div>
        </div>
    </div>
</div>
<!-- End Product Section -->

<!-- Start Why Choose Us Section -->
<div class="why-choose-section bg-light">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <h2 class="section-title">Why Choose Us</h2>
                <p>The things we make you trust us more !</p>

                <div class="row my-5">
                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="images/truck.svg" alt="Image" class="imf-fluid">
                            </div>
                            <h3>Fast &amp; Free Shipping</h3>
                            <p>Fast delivery and free shipping.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="images/bag.svg" alt="Image" class="imf-fluid">
                            </div>
                            <h3>Easy to Shop</h3>
                            <p>Easy shopping with on-site sales and online sales.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="images/support.svg" alt="Image" class="imf-fluid">
                            </div>
                            <h3>24/7 Support</h3>
                            <p>Customer support all the time.</p>
                        </div>
                    </div>

                    <div class="col-6 col-md-6">
                        <div class="feature">
                            <div class="icon">
                                <img src="images/return.svg" alt="Image" class="imf-fluid">
                            </div>
                            <h3>Hassle Free Returns</h3>
                            <p>Exchange and return products quickly.</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-5">
                <div class="img-wrap">
                    <img src="images/banner/banner2.jpg" alt="Image" class="img-fluid" style="height: 25rem">
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Why Choose Us Section -->

<!-- service section -->

<section class="service_section layout_padding">
  <div class="container mb-5">
    <h1 class="text-center mt-4 mb-0">Our Achievements </h1>
    <hr style="width:30%" , size="3">
    <div class=" layout_padding2">
      <div class="card-deck">
        <div class="card">
          <i class="bi bi-people" style="font-size:50px ;"></i>
          <div class="card-body">
            <h5 class="text-warning">Visiter</h5>
            <h5 class="card-title"><?php echo $result_visiter['count_visiter'] ?></h5>
            <p class="card-text">
              There are many variations of passages of Lorem Ipsum
              available, but the majority have suffered alteration in some
              form, by injected humour, or randomised words which don't look
              even slightly believable.
            </p>
          </div>
        </div>
        <div class="card">
          <i class="bi bi-person-check" style="font-size:50px ;"></i>
          <div class="card-body">
            <h5 class="text-warning">People Register</h5>
            <h5 class="card-title"><?php echo $result_countuser['countid'] ?></h5>
            <p class="card-text">
              There are many variations of passages of Lorem Ipsum
              available, but the majority have suffered alteration in some
              form, by injected humour, or randomised words which don't look
              even slightly believable.
            </p>
          </div>
        </div>
        <div class="card">
          <i class="bi bi-shop" style="font-size:50px ;"></i>
          <div class="card-body">
            <h5 class="text-warning">Quantities of shop</h5>
            <h5 class="card-title">5</h5>
            <p class="card-text">
              There are many variations of passages of Lorem Ipsum
              available, but the majority have suffered alteration in some
              form, by injected humour, or randomised words which don't look
              even slightly believable.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
    <!-- Feature Start -->
    <section id="feature">
        <div class=" bg-icon py-6 bg-light">
            <div class="container">
                <div class="section-header text-center mx-auto mb-5 "  style="max-width: 500px;">
                    <h1 class="display-5 mb-3">Our Features</h1>
                    <hr style="width:100%" , size="3">
                </div>
                <div class="row g-4 d-flex justify-content-center">
                    <div class="card col-lg col-md-6 " >
                        <div class="bg-white text-center h-100 p-4 p-xl-5">
                            <img class="img-fluid mb-4" src="images\icon-1.png" alt="">
                            <h4 class="mb-3">Natural Process</h4>
                            <p class="mb-4">All our product are created by a complicated process </p>
                            <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill" href="?page=about">Read More</a>
                        </div>
                    </div>
                    <div class="card  col-lg col-md-6 " >
                        <div class="bg-white text-center h-100 p-4 p-xl-5">
                            <img class="img-fluid mb-4" src="images/icon-2.png" alt="">
                            <h4 class="mb-3">Organic Products</h4>
                            <p class="mb-4">All our product produced by using natural resources</p>
                            <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill" href="?page=about">Read More</a>
                        </div>
                    </div>
                    <div class="card  col-lg col-md-6" >
                        <div class="bg-white text-center h-100 p-4 p-xl-5">
                            <img class="img-fluid mb-4" src="images/icon-3.png" alt="">
                            <h4 class="mb-3">Biologically Safe</h4>
                            <p class="mb-4">Our product not using any chemical substance</p>
                            <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill" href="?page=about">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature End -->
</section>
<!-- end service section -->



<!-- gallery section -->
<section id="gallery">
  <h1 class="text-center mt-4 mb-0">Our Gallery</h1>
  <hr style="width:30%" , size="3">
  <div class="slider">
    <div class="owl-carousel gallery-carousel">
      <?php
      $sql_selectproduct = "SELECT products_image FROM products where id<11";
      foreach (executeResult($sql_selectproduct) as $product) :
      ?>
        <div class="slider-card">
          <img src="images/<?php echo $product['products_image'] ?>">
        </div>
      <?php endforeach ?>
    </div>
    <a href="?page=gallery" class="d-flex justify-content-center"><button class="view">View more</button></a>
  </div>
 
</section>




<!-- end gallery section -->

 <!-- review Start -->
 <section id="feedback">
  <div class=" bg-icon py-6 bg-light">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5"  style="max-width: 500px;">
                <h1 class="display-5 mb-3">Customer Review</h1>
                <hr style="width:100%" , size="3">
            </div>
            <?php 
              $sql = "SELECT products.name,reviews.product_id,users.firstname,users.lastname,reviews.date,reviews.content,users.avatar FROM reviews INNER JOIN users ON users.id = reviews.user_id INNER JOIN products ON reviews.product_id = products.id ";
              $reviewlist = executeResult($sql);
            ?>
             
            <div class="owl-carousel testimonial-carousel" >
              <?php foreach ($reviewlist as $reviewdetail) : ?>
                <div class="testimonial-item position-relative bg-white p-5 mt-4" > 
                    <h4 class="mb-4"><?php echo $reviewdetail['name']; ?></h4>              
                    <p class="mb-4"><?php echo $reviewdetail['content']; ?></p>
                    <div class="d-flex align-items-center">
                        <img class="flex-shrink-0 rounded-circle mr-2" src="images/<?php echo $reviewdetail['avatar']; ?>" alt="">
                        <div class="ms-3">
                            <h5 class="mb-1"><?php echo $reviewdetail['firstname'];
                                                echo " ";
                                                echo $reviewdetail['lastname']; ?></h5>
                            <span>Customer</span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
 </section>
 
    
    <!-- review End -->

     <!-- Recipe Start -->
<section id="Recipe">
  <div class=" bg-icon py-6">
          <div class="container mt-5">
              <div class="section-header text-center mx-auto mb-5 "  style="max-width: 500px;">
                  <h1 class="display-5 mb-3">Recipe </h1>
                  <h5>(Coming Soon)</h5>
                  <hr style="width:100%" , size="3">
              </div>
              <div id="clockdiv" class="d-flex justify-content-center">
                <div>
                  <span class="days"></span>
                  <div class="smalltext">Days</div>
                </div>
                <div>
                  <span class="hours"></span>
                  <div class="smalltext">Hours</div>
                </div>
                <div><span class="minutes"></span>
                  <div class="smalltext">Minutes</div>
                </div>
                <div><span class="seconds"></span>
                  <div class="smalltext">Seconds</div>
                </div>
              </div>
          </div>
      </div>
</section>
<script>
    function getTimeRemaining(endtime) {
      var t = Date.parse(endtime) - Date.parse(new Date());
      var seconds = Math.floor((t / 1000) % 60);
      var minutes = Math.floor((t / 1000 / 60) % 60);
      var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
      var days = Math.floor(t / (1000 * 60 * 60 * 24));
      return {
        'total': t,
        'days': days,
        'hours': hours,
        'minutes': minutes,
        'seconds': seconds
      };
    }


    function initializeClock(id, endtime) {
      var clock = document.getElementById(id);
      var daysSpan = clock.querySelector('.days');
      var hoursSpan = clock.querySelector('.hours');
      var minutesSpan = clock.querySelector('.minutes');
      var secondsSpan = clock.querySelector('.seconds');

      function updateClock() {
        var t = getTimeRemaining(endtime);

        daysSpan.innerHTML = ('0' + t.days).slice(-2);
        hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
        minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
        secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

        if (t.total <= 0) {
          clearInterval(timeinterval);
        }
      }

      updateClock(); 
      var timeinterval = setInterval(updateClock, 1000);
    }
    var deadline = new Date(Date.parse(new Date()) + 20 * 24 * 60 * 60 * 1000);  
    initializeClock('clockdiv', deadline);


</script>

    



    <script>
  $(document).ready(function() {
    $(".gallery-carousel").owlCarousel({
      loop: true,
      margin: 10,
      autoplay: true,
      autoplayTimeout: 3000,
      autoplayHoverPause: true,
      center: true,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 3
        },
        1000: {
          items: 5
        }
      }
    });

    $(".testimonial-carousel").owlCarousel({
        autoplay:false,
        smartSpeed: 1000,
        margin: 25,
        loop: true,
        center: true,
        dots: false,
        nav: true,
        navText : [
            '<i class="bi bi-chevron-left"></i>',
            '<i class="bi bi-chevron-right"></i>'
        ],
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            }
        }
    });
  });
</script>