<?php
$errors = [];
if (isset($_POST['contactsubmit'])) {
  $name = htmlspecialchars($_POST['name']);
  $name = $conn->real_escape_string($name);
  $phone = htmlspecialchars($_POST['phone']);
  $phone = $conn->real_escape_string($phone);
  $email = htmlspecialchars($_POST['email']);
  $email = $conn->real_escape_string($email);
  $title = htmlspecialchars($_POST['title']);
  $title = $conn->real_escape_string($title);
  $message = htmlspecialchars($_POST['message']);
  $message = $conn->real_escape_string($message);
  if (empty($name)) {
    $errors['name'] = "Name cannot empty !";
  }
  if (empty($phone)) {
    $errors['phone'] = "Phone cannot empty !";
  }
  if (empty($email)) {
    $errors['email'] = "Email cannot empty !";
  }
  if (empty($title)) {
    $errors['title'] = "Title cannot empty !";
  }
  if (empty($message)) {
    $errors['message'] = "Message cannot empty !";
  }
  if (empty($errors)) {
    $sql = "INSERT INTO contactus (name,phone,title,email,message) VALUES (N'$name','$phone','$title','$email',N'$message')";
    $result = mysqli_query($conn, $sql);
    $status = 'success'; 
            $statusMsg = 'Thank you! Your message has submitted successfully, we will get back to you soon.';  
        } 
  }

?>


<div class="header container-fluid page-header" style=" background-image: url(images/banner/banner7.jpg)  ;">
        <div class="hello container">
            <h1 class="display-3 mb-3">Contact Us</h1>
            <nav aria-label="breadcrumb ">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-body" href="?page=home">Home</a></li>
                    <li class="breadcrumb-item  active" aria-current="page">Contact Us</li>
                </ol>
            </nav>
        </div>
    </div>


<!-- contact section -->
<section class="contact_section layout_padding" style="display:flex; flex-direction:column; min-height: 85vh">
  <div class="container">
    <?php if(!empty($statusMsg)){ ?>
        <div class="status-msg <?php echo $status; ?>"><?php echo $statusMsg; ?></div>
    <?php } ?>
    <div class="row">
      <div class="col-md-8 mr-auto">
        <form action="" method="POST">
          <div class="contact_form-container">
            <div>
              <div>
                <input type="text" name="name" placeholder="Name">
              </div>
              <div class="mb-3">
                <?php
                if (isset($errors['name'])) {
                  echo '<span class="text-danger">' . $errors['name'] . '</span>';
                }
                ?>
              </div>
              <div>
                <input type="text" name="phone" placeholder="Phone Number">
              </div>
              <div class="mb-3">
                <?php
                if (isset($errors['phone'])) {
                  echo '<span class="text-danger">' . $errors['phone'] . '</span>';
                }
                ?>
              </div>
              <div>
                <input type="email" name="email" placeholder="Email">
              </div>
              <div class="mb-3">
                <?php
                if (isset($errors['email'])) {
                  echo '<span class="text-danger">' . $errors['email'] . '</span>';
                }
                ?>
              </div>
              <div>
                <input type="text" name="title" placeholder="Title">
              </div>
              <div class="mb-3">
                <?php
                if (isset($errors['title'])) {
                  echo '<span class="text-danger">' . $errors['title'] . '</span>';
                }
                ?>
              </div>
              <div class="mt-5">
                <input type="text" name="message" placeholder="Message">
              </div>
              <div class="mb-3">
                <?php
                if (isset($errors['message'])) {
                  echo '<span class="text-danger">' . $errors['message'] . '</span>';
                }
                ?>
              </div>
              <div class="mt-5">
                <button name="contactsubmit" type="submit">
                  SEND
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- end contact section -->


