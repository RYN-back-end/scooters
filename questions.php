<?php
require 'helper.php';
checkLogin();
$customer_id = $_SESSION['user']['cust_id']??'';
$selectQSql = "SELECT * FROM `questions` WHERE `customer_id` ='{$customer_id}'";;
$queryResult = runQuery($selectQSql);
$quetionRow = $queryResult->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="ar">

<head>

    <!-- Primary Meta Tags -->
    <title>Scooter > الرد على الاستفسارات </title>
    <meta name="title" content="Scooter > الرد على الاستفسارات ">
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
        <div class="imgContainer absolute "><img src="css/assets/images/breackjumb-G3h1X0WW_1obMTu.webp"
                                                 alt="breackjumb image" class="img-cover" width="1920" height="1199"
                                                 loading="lazy" decoding="async">
        </div>
        <div class="container ">
            <ul class="d-flex items-center justify-center relative">
                <li class="linkPage"> الرد على الاستفسارات</li>
                <li class="separator mx-4"> ></li>
                <li class="defPage "><a href="/" class=""> الرئيسية </a></li>
            </ul>
            <h1 class="title capitalize  text-center fs-r-48 fw-900  relative"> الرسائل </h1>
        </div>
    </section>
    <section class="book">
        <div class="container">
            <div class="btnFilters d-flex items-center justify-center pb-14">

            </div>
            <div class="mainHeading d-flex  justify-center items-center ">
                <h2 class="mainHead fs-r-36"> الاستفسارات </h2>
            </div>
            <table>
                <thead>
                <tr>
                    <td>الاسم</td>
                    <td>البريد الالكتروني</td>
                    <td>رقم الهاتف</td>
                    <td>موضوع الرسالة</td>
                    <td>محتوى الرسالة</td>
                    <td>تاريخ الارسال</td>
                    <td>الرد</td>
                </tr>
                </thead>
                <tbody class="now  active">
                <?php
                if ($queryResult->num_rows > 0) {
                    while ($quetionRow = $queryResult->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $quetionRow['customer_name'] ?> </td>
                            <td><?php echo $quetionRow['email'] ?> </td>

                            <td><?php echo $quetionRow['phone'] ?></td>
                            <td><?php echo $quetionRow['subject'] ?></td>
                            <td> <?php echo $quetionRow['question_content'] ?> </td>
                            <td> <?php echo $quetionRow['question_date'] ?> </td>
                            <td> <?php echo $quetionRow['question_answer'] ?> </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>

            </table>
        </div>
    </section>
</main>
<footer>
    <div class="container">
        <div class="row gap-row-1 items-start">
            <div class="col-3-lg col-6-md col-12-sm">
                <ul class="footerLinks"> <!-- img -->
                    <li class="imgContainer mb-8"><img src="css/assets/images/LogoFooter-VjNDGDik_Z864OD.webp"
                                                       alt="scooter logo" width="692" height="500" loading="lazy"
                                                       decoding="async"></li>
                    <li class="des line-big">
                        اول موقع في الوطن العربي يتح لك تاجير كافة انواع الاسكوتر بارخص
                        الاسعار
                    </li>
                </ul>
            </div>
            <div class="col-3-lg col-6-md col-12-sm">
                <ul class="footerLinks text-center">
                    <p class="title fs-24 fw-900 mb-8">روابط سريعة</p>
                    <li class="pb-5"><a href="/">الرئيسية</a></li>
                    <li class="pb-5"><a href="product.html">منتجاتنا</a></li>
                    <li class="pb-5"><a href="MyBook.html">جحوزاتي</a></li>
                    <li class="pb-5"><a href="AboutUs.html">من نحن</a></li>
                    <li class="pb-5"><a href="ContactUs.html">تواصل معنا</a></li>
                </ul>
            </div>
            <div class="col-3-lg col-6-md col-12-sm">
                <ul class="footerLinks text-center">
                    <p class="title fs-24 fw-900 mb-8"> تابعنا </p>
                    <li class="pb-5"><a href="#!">فيسبوك</a></li>
                    <li class="pb-5"><a href="#!">انستجرام</a></li>
                    <li class="pb-5"><a href="#!">تويتر</a></li>
                </ul>
            </div>
            <div class="col-3-lg col-6-md col-12-sm">
                <ul class="footerLinks text-center">
                    <p class="title fs-24 fw-900 mb-8"> تواصل معنا </p>
                    <li class="pb-5"><a href="#!">scooter@gmail.com</a></li>
                    <li class="pb-5"><a href="#!">scooterhelp@gmail.com</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</body>

</html>