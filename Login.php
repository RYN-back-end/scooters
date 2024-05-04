<?php
require 'helper.php';
checkLogin();
if (isset($_POST['userEmail']) && isset($_POST['userPassword'])) {
    $sql = "SELECT * FROM `customer` WHERE `user_name` =  '{$_POST['userEmail']}'";
    $data = runQuery($sql);
    if ($data->num_rows > 0) {
	
	
        $row = $data->fetch_assoc();
        if (password_verify($_POST['userPassword'], $row['password'])) {
            $_SESSION['user']['cust_id'] = $row['cust_id'];
            $_SESSION['user']['cust_name'] = $row['cust_name'];
            $_SESSION['user']['user_name'] = $row['user_name'];
            $_SESSION['user']['address'] = $row['address'];
            $_SESSION['user']['phone'] = $row['phone'];
            $_SESSION['user']['loggedin'] = true;
            header('Location: index.php');
        } else {
            header('Location: login.php?error=The password is incorrect');
        }
    } else {
        header('Location: login.php?error=The user name not found not found');
    }
    die();
}
?>

<!DOCTYPE html>
<html lang="ar">

<head>
   
    <!-- Primary Meta Tags -->
    <title>Scooter > تسجيل دخول </title>
    <meta name="title" content="Scooter > تسجيل دخول ">
	  <link rel="icon" type="image/svg+xml" href="favicon.svg">
     <?php
    include_once 'layout/assets/css.php';
	include_once 'layout/assets/js.php';
    ?>
</head>

<body>
     <?php
    include_once 'layout/inc/header.php';
    ?>
    <main>
        <section class="breadcrumb d-flex items-center justify-center relative overflow-hidden">
            <div class="imgContainer absolute "> <img src="css/assets/images/breackjumb-G3h1X0WW_1obMTu.webp"
                    alt="breackjumb image" class="img-cover" width="1920" height="1199" loading="lazy" decoding="async">
            </div>
            <div class="container ">
                <ul class="d-flex items-center justify-center relative">
                    <li class="defPage "> <a href="/" class=""> الرئيسية </a> </li>
                    <li class="separator mx-4"> > </li>
					<li class="linkPage"> تسجيل دخول </li>
                    
                </ul>
                <h1 class="title capitalize  text-center fs-r-48 fw-900  relative"> تسجيل دخول </h1>
            </div>
        </section>
        <section class="Auth login">
            <div class="container">
                <div class="mainHeading d-flex  justify-center items-center ">
                    <h2 class="mainHead fs-r-36"> تسجيل الدخول </h2>
                </div>
				   <?php
                if (isset($_GET['error'])) {
                    ?>
                    <div class="Auth login" role="alert" style="text-align: right">
                        <?php echo $_GET['error']; ?>
                        <button type="button" style="float: left" class="close" data-bs-dismiss="alert"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                }
                if (isset($_GET['success'])) {
                    ?>
                    <div class="Auth login" role="alert" style="text-align: right">
                        <?php echo $_GET['success']; ?>
                        <button type="button" style="float: left" class="close" data-bs-dismiss="alert"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?php
                }
                ?>
                <form action="" class="mx-auto round-6" method="post">
                   
				   <div class="formGroup relative mb-7 d-flex"> <label for="userEmail" class=""> البريد الالكتروني
                        </label> 
						
						<input type="email" name="userEmail" id="userEmail" class="round-4 pr-5 pl-5 undefined"
                            placeholder="ادخل  البريد الالكتروني"> </div>
                    <div class="formGroup relative mb-7 d-flex"> <label for="userPassword" class=""> كلمة المرور
                        </label> 
						
						<input type="password" name="userPassword" id="userPassword"
                            class="round-4 pr-5 pl-5 undefined" placeholder="ادخل   كلمة المرور"> </div>
                    <p class="py-6">ليس لدي حساب ؟ <a href="register.php" class="fw-700">انشاء حساب</a></p>
                    <div class="mx-auto d-flex items-center justify-center"> <button
                            class="btn btn-base round-4 px-12 py-5 mt-10 mb-6" type="submit" aria-label="login in">
                            تسجيل </button> </div>
                </form>
            </div>
        </section>
    </main>
  <?php
    include_once 'layout/inc/footer.php';
    ?>
</body>

</html>