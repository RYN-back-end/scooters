<?php
require('helper.php');
checkLogin();

    if (isset($_POST['register_user']))
    {
            $checkExistsSql = "SELECT * FROM customer WHERE user_name = '{$_POST['userEmail']}'";

        $checkExistsResult = runQuery($checkExistsSql);
        if ($checkExistsResult->num_rows > 0) {
            header("Location: signIn.php?error=البريد الإلكترونى مستخدم من قبل");
        }

        $imagePath = null;
        if (isset($_FILES['image'])) {
            $errors = array();
            $file_name = (time() * 2) . '.jpg';
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $imagePath = "uploads/customers/" . $file_name;
            if ($file_size > 2097152) {
                header("Location: signIn.php?error=يجب ان يكون حجم الصورة اقل من 2MB");
            }
            move_uploaded_file($file_tmp, $imagePath);
        }
        $password = password_hash($_POST['userPassword'], PASSWORD_DEFAULT);

            $insertSql = "INSERT INTO `customer`(`cust_name`, `user_name`, `password`, `image`,`phone` ,`address` ) VALUES 
                                                         ('{$_POST['userName']}','{$_POST['userEmail']}','{$password}','{$imagePath}','{$_POST['userphone']}','{$_POST['userAddress']}')";
            $getLastIdSql = "SELECT * FROM `customer` order by cust_id DESC";
        runQuery($insertSql);
        $result = runQuery($getLastIdSql);
        $row = $result->fetch_assoc();
        $_SESSION['user']['custid'] = $row['cust_id'];
        $_SESSION['user']['cust_name'] = $_POST['userName'];
        $_SESSION['user']['user_name'] = $_POST['userEmail'];
        $_SESSION['user']['phone'] = $_POST['userphone'];
        $_SESSION['user']['image'] = $imagePath;
        $_SESSION['user']['loggedin'] = true;
        print_r($_SESSION['user']);
        die($_SESSION);
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="ar">

<head>
  
  <!-- Primary Meta Tags -->
  <title>Scooter > انشاء حساب </title>
  <meta name="title" content="Scooter > انشاء حساب ">
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
          alt="breackjumb image" class="img-cover" width="1920" height="1199" loading="lazy" decoding="async"> </div>
      <div class="container ">
        <ul class="d-flex items-center justify-center relative">
         <li class="defPage "> <a href="/" class=""> الرئيسية </a> </li>         
		 
          <li class="separator mx-4"> > </li>
		  <li class="linkPage"> انشاء حساب </li>
          
        </ul>
        <h1 class="title capitalize  text-center fs-r-48 fw-900  relative"> انشاء حساب </h1>
      </div>
    </section>
    <section class="Auth signIn">
      <div class="container">
        <div class="mainHeading d-flex  justify-center items-center ">
          <h2 class="mainHead fs-r-36"> انشاء حساب </h2>
        </div>
        <form action="" class="mx-auto round-6" method="POST">
		
          <div class="formGroup relative mb-7 d-flex"> 
		  <input type="file" name="image" id="userName"
              class="round-4 pr-5 pl-5 undefined" placeholder=""> </div>
			  
          <div class="formGroup relative mb-7 d-flex"> <label for="userName" class=""> الاسم بالكامل </label> 
		  <input
              type="text" name="userName" id="userName" class="round-4 pr-5 pl-5 undefined"
              placeholder="ادخل  الاسم بالكامل"> </div>
          
		  <div class="formGroup relative mb-7 d-flex"> <label for="userEmail" class=""> البريد الالكتروني </label>
            <input type="email" name="userEmail" id="userEmail" class="round-4 pr-5 pl-5 undefined"
              placeholder="ادخل  البريد الالكتروني"> </div>
          
		  <div class="formGroup relative mb-7 d-flex"> <label for="userPassword" class=""> كلمة المرور </label> <input
              type="password" name="userPassword" id="userPassword" class="round-4 pr-5 pl-5 undefined"
              placeholder="ادخل   كلمة المرور"> </div>
			  
			  <div class="formGroup relative mb-7 d-flex"> <label for="userEmail" class=""> العنوان </label>
            <input type="text" name="userAddress" id="userEmail" class="round-4 pr-5 pl-5 undefined"
              placeholder="ادخل العنوان"> </div>
			  
			   <div class="formGroup relative mb-7 d-flex"> <label for="userEmail" class=""> رقم الهاتف </label>
            <input type="text" name="userphone" id="userEmail" class="round-4 pr-5 pl-5 undefined"
              placeholder="ادخل رقم الهاتف"> </div>
			  
          <p class="py-6"> اذا كان لديك حساب بالفعل؟ <a href="Login.php" class="fw-700"> تسجيل الدخول </a></p>
          
		   
			  
		  <div class="mx-auto d-flex items-center justify-center"> 
		  <button
              class="btn btn-base round-4 px-12 py-5 mt-10 mb-6" type="submit" aria-label="login in" name="register_user"> انشاء حساب
            </button> </div>
        </form>
      </div>
    </section>
  </main>
 <?php
    include_once 'layout/inc/footer.php';
    ?>
</body>

</html>