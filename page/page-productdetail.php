<?php
$id_product = $_GET['id'];
$sql = "SELECT products.id, products.name, products.price, products.quantity, products.products_image, products.detail, products.update_date, products.sale,packing.type, category.name AS catename 
FROM products 
JOIN category ON category.id = products.cateid 
JOIN packing ON packing.id = products.packingid HAVING id='$id_product'";
$product = mysqli_fetch_array($conn->query($sql));

if (isset($_GET['success']) && $_GET['success'] == 'true') {
    echo '
        <script>
        toastr.success("add successful")
        </script>
    ';
}

if (isset($_POST['addtocart'])) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];

        $img_product = $_POST['imgproduct'];
        $name_product = $_POST['nameproduct'];
        $quantity_product = $_POST['quantityproduct'];
        $price_product = $_POST['priceproduct'];

        $addtocart = [$img_product, $name_product, $quantity_product, $price_product, $id_product];

        $_SESSION['cart'][] = $addtocart;
        echo '
            <script>
                $(document).ready(function(){
                    window.location="?page=productdetail&id=' . $_GET['id'] . '&success=true";
                })
            </script>
        ';
    } else {
        $img_product = $_POST['imgproduct'];
        $name_product = $_POST['nameproduct'];
        $quantity_product = $_POST['quantityproduct'];
        $price_product = $_POST['priceproduct'];

        $checkcart = 0;
        for ($i = 0; $i < count($_SESSION['cart']); $i++) {
            if ($_SESSION['cart'][$i][1] == $name_product) {
                $checkcart = 1;
                $quantity_product_new = $quantity_product + $_SESSION['cart'][$i][2];
                $_SESSION['cart'][$i][2] = $quantity_product_new;
            }
        }

        if ($checkcart == 0) {
            $addtocart = [$img_product, $name_product, $quantity_product, $price_product, $id_product];
            array_push($_SESSION['cart'], $addtocart);
        }

        echo '
            <script>
                $(document).ready(function(){
                    window.location="?page=productdetail&id=' . $_GET['id'] . '&success=true";
                })
            </script>
        ';
    }
}
//Review:
if (isset($_POST['addreview'])) {
    $review = htmlspecialchars($_POST['review']);
    $review = $conn->real_escape_string($review);
    if (empty($review)) {
        $empty = "Review cannot be empty!!!";
    }
    if (!isset($empty)) {
        $sql = "INSERT INTO reviews (product_id,user_id,content) VALUES ($id_product,$user_id,'$review');";
        $result = $conn->query($sql);
    }
}

//Query to get review:
$sql = "SELECT reviews.product_id,users.firstname,users.lastname,reviews.date,reviews.content,users.avatar FROM reviews INNER JOIN users ON users.id = reviews.user_id HAVING reviews.product_id = $id_product";
$reviewlist = executeResult($sql);
//Count review:
$sql = "SELECT COUNT(product_id) as count FROM reviews WHERE product_id=$id_product";
$reviewcount = mysqli_fetch_array($conn->query($sql));
?>
<!-- Shop Detail Start -->
<div class="container py-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 pb-5">
            <img class="w-100 h-100" src="images/<?php echo $product['products_image'] ?>" style="object-fit:fill" alt="Image">
        </div>

        <div class="col-lg-7 pb-5">
            <!-- Form -->
            <form method="post">
                <input type="hidden" name="imgproduct" value="<?php echo $product['products_image'] ?>">
                <h3 class="font-weight-semi-bold text-danger"><?php echo ($product['name']);
                                                                echo '<h5>' . $product['quantity'] . ' ' . $product['type'] . ' left.</h5>' ?>
                </h3>
                <input type="hidden" name="nameproduct" value="<?php echo $product['name'] ?>">
                <h3 class="font-weight-semi-bold mb-4">$<?php
                                                        if ($product['sale'] == 0) {
                                                            echo $product['price'];
                                                        } else {
                                                            echo number_format($product['price'] - $product['price'] / 100 * $product['sale'], 2);
                                                            echo " ";
                                                            echo '<span class="line-through">($' . $product['price'] . ')</span>';
                                                        }
                                                        ?></h3>
                <input type="hidden" name="priceproduct" value="<?php if ($product['sale'] == 0) {
                                                                    echo $product['price'];
                                                                } else {
                                                                    echo number_format($product['price'] - $product['price'] / 100 * $product['sale'], 2);
                                                                } ?>">
                <div class="mb-3">
                    <h4 class="text-danger">Product detail :</h4>
                </div>
                <p class="mb-4"><?php echo ($product['detail']) ?></p>
                <div class="mb-4">
                    <h4 class="text-danger">Packing :</h4><?php echo $product['type'] ?>
                </div>
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-link btn-minus" onclick="decrementValue()">
                                <i class="bi bi-dash"></i>
                            </button>
                        </div>
                        <input id="number" type="text" name="quantityproduct" class="form-control text-center" value="1">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-link btn-plus" onclick="incrementValue()">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button name="addtocart" class="btn btn-warning px-3 ml-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="nav nav-tabs justify-content-start border-secondary mb-4">
                <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Reviews (<?php echo $reviewcount['count']; ?>)</a>
            </div>
            <div class="tab-content">
                <div class="tab-pane show active" id="tab-pane-1">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4 d-inline"><?php echo $reviewcount['count']; ?> review for "</h4>
                            <h4 class="text-danger d-inline"><?php echo ($product['name']); ?></h4>
                            <h4 class="d-inline">"</h4>
                            <?php foreach ($reviewlist as $reviewdetail) : ?>
                                <div class="media mb-4">
                                    <img src="images/<?php echo $reviewdetail['avatar']; ?>" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                    <div class="media-body">
                                        <h6><?php echo $reviewdetail['firstname'];
                                                echo " ";
                                                echo $reviewdetail['lastname']; ?><small> - <i><?php echo $reviewdetail['date']; ?></i></small></h6>
                                        <p><?php echo $reviewdetail['content']; ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-md-6">
                            <?php if (isset($_SESSION['login'])) : ?>
                                <h4 class="mb-4">Leave a review</h4>
                                <form method="POST">
                                    <div class="form-group">
                                        <label for="message">Your Review *</label>
                                        <textarea name="review" id="message" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                    <?php if (isset($empty)) {
                                            echo '<span class="text-danger">' . $empty . '</span>';
                                        }; ?>
                                    <div class="form-group mt-1 mb-0">
                                        <input type="submit" value="Leave Your Review" name="addreview" class="btn btn-primary px-3">
                                    </div>
                                </form>
                            <?php else : ?>
                                <h4 class="mb-4">You have to login to leave a review for this product</h4>
                                <p><a href="?page=login">Login</a> or <a href="?page=register">Register</a> Now</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->

<script>
    function incrementValue() {
        var value = document.getElementById('number').value;
        value++;
        document.getElementById('number').value = value;
    }

    function decrementValue() {
        var value = document.getElementById('number').value;
        value--;
        if (value < 0) {
            value = 0;
        }
        document.getElementById('number').value = value;
    }
</script>