<?php
$sql = "SELECT products.id FROM products ORDER BY products.update_date DESC LIMIT 10;";
$result = executeResult($sql);
$listnew = array();
foreach ($result as $value) {
  $listnew[] = $value['id'];
}
$sql = "SELECT orderdetail.product_id FROM `orderdetail` GROUP BY orderdetail.product_id ORDER BY COUNT(orderdetail.quantity) DESC;";
$result = executeResult($sql);
$listbest = array();
foreach ($result as $value) {
  $listbest[] = $value['product_id'];
}
$sql = "SELECT products.id FROM products WHERE NOT products.sale = 0 ORDER BY products.sale DESC LIMIT 10;";
$result = executeResult($sql);
$listhot = array();
foreach ($result as $value) {
  $listhot[] = $value['id'];
}
?>

<div class="header container-fluid page-header" style=" background-image: url(images/banner/banner7.jpg)  ;">
        <div class="hello container">
            <h1 class="display-3 mb-3">Product</h1>
            <nav aria-label="breadcrumb ">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-body" href="?page=home">Home</a></li>
                    <li class="breadcrumb-item  active" aria-current="page">Product</li>
                </ol>
            </nav>
        </div>
    </div>


<section class="productsec mt-5 mb-5">
  <div class="container mx-auto mt-4">
    <div class="row">
      <!-- CATEGORY LIST -->
      <p class="h5 align-self-center">Category list:</p>
      <div class="cate-list d-flex align-items-center">
        <ul class="pl-0">
          <li class="btn btn-outline-warning active ml-2" data-filters="*">All</li>
          <li class="btn btn-outline-warning ml-2" data-filters=".best">Top 10 Best Sellers</li>
          <li class="btn btn-outline-warning ml-2" data-filters=".new">Top 10 New Arrivals</li>
          <li class="btn btn-outline-warning ml-2" data-filters=".hot">Top 10 Hot Deals</li>
          <?php
          $sql_selectcate = "SELECT * FROM category";
          foreach (executeResult($sql_selectcate) as $category) :
          ?>
            <li class="btn btn-outline-warning ml-2" data-filters=".cate<?php echo $category['id']; ?>"><?php echo $category['name']; ?></li>
          <?php endforeach ?>
        </ul>
      </div>
    </div>
    <!-- DISPLAY ITEMS -->
    <div class="row d-flex justify-content-between cate-item" style="min-height: 75vh">
      <?php
      $sql_selectproduct = "SELECT products.id, products.name, products.price, products.quantity, products.sale, products.cateid, products.products_image, SUM(orderdetail.quantity) AS quantitysold FROM products LEFT JOIN orderdetail ON orderdetail.product_id = products.id GROUP BY products.id, products.name, products.price, products.quantity, products.cateid, products.sale, products.products_image;";
      foreach (executeResult($sql_selectproduct) as $product) :
      ?>
        <div class="item col-md-4 cate<?php
                                      echo $product['cateid'];
                                      if (in_array($product['id'], $listnew)) {
                                        echo " ";
                                        echo "new";
                                      }
                                      if (in_array($product['id'], $listbest)) {
                                        echo " ";
                                        echo "best";
                                      }
                                      if (in_array($product['id'], $listhot)) {
                                        echo " ";
                                        echo "hot";
                                      }
                                      ?>">
          <div class="card ml-auto mr-auto" style="width: 18rem;">
            <a href="?page=productdetail&id=<?php echo $product['id'] ?>" class="position-relative" style="width: 100%; height: 15rem;">
              <img src="images/<?php echo $product['products_image'] ?>" class="card-img-top" style="height:100%; object-fit:fill" alt="...">
              <div class="position-absolute" style="bottom: 1px; right: 0px;">
                <?php
                if (in_array($product['id'], $listnew)) {
                  echo '<div class="d-block bg-success text-center text-light mb-1 rounded-left" style="width: 60px">NEW <i class="bi bi-emoji-laughing"></i></div>';
                }
                if (in_array($product['id'], $listhot)) {
                  echo '<div class="d-block bg-warning text-center text-light mb-1 rounded-left" style="width: 60px">SALE <i class="bi bi-tags"></i></div>';
                }
                if (in_array($product['id'], $listbest)) {
                  echo '<div class="d-block bg-danger text-center text-light mb-1 rounded-left" style="width: 60px">HOT <i class="bi bi-fire"></i></div>';
                }
                ?>
              </div>
            </a>
            <div class="card-body">
              <h5 class="card-title"><?php echo $product['name'] ?></h5>
              <h6 class="card-subtitle mb-2"><?php
                                              echo $product['quantity'] - $product['quantitysold'] . ' in stock';
                                              echo " ";
                                              echo $product['quantitysold'] == NULL ? '(0 Sold)' : '(' . $product['quantitysold'] . ' Sold)';
                                              ?></h6>
              <h6 class="card-subtitle mb-3 text-muted">$<?php
                                                          if ($product['sale'] == 0) {
                                                            echo $product['price'];
                                                          } else {
                                                            echo number_format($product['price'] - $product['price'] / 100 * $product['sale'], 2);
                                                            echo " ";
                                                            echo '<span class="line-through">($' . $product['price'] . ')</span>';
                                                          }
                                                          ?></h6>
              <a href="?page=productdetail&id=<?php echo $product['id'] ?>" class="btn_product mr-2"> Buy now</a>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</section>