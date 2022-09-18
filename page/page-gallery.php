

<div class="header container-fluid page-header" style=" background-image: url(images/banner/banner7.jpg)  ;">
        <div class="hello container">
            <h1 class="display-3 mb-3">Gallery</h1>
            <nav aria-label="breadcrumb ">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-body" href="?page=home">Home</a></li>
                    <li class="breadcrumb-item  active" aria-current="page">Gallery</li>
                </ol>
            </nav>
        </div>
    </div>


<section id="gallery-page">
  
  <div class="container">
    <h1 class="text-center mt-4 mb-0">Gallery</h1>
    <hr class="mt-2 mb-5">
    <div class=" row text-center text-lg-start gallery">
      <div class="row">
      <?php
      $sql_selectproduct = "SELECT products_image FROM products";
      foreach (executeResult($sql_selectproduct) as $product) :
    ?>
        <div class="col-lg-4 col-md-6">
            <a class="d-block mb-4 h-100" href="images/<?php echo $product['products_image'] ?>">
                <img src="images/<?php echo $product['products_image'] ?>" >
            </a>
        </div>
        <?php endforeach ?>
      </div>
    </div>
  </div>
  
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script>
    baguetteBox.run('.gallery',{
      animation: 'fadeIn',
    });
</script>

