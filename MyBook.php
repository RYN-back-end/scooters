<?php
require('helper.php');
checkLogin();

if (isset($_GET['id']) && isset($_GET['method'])) {
    if ($_GET['method'] == 'UPDATE') {
        $updateSql = "UPDATE `reservations` SET `status` = 'confirmed' WHERE `reservation_id` = '{$_GET['id']}'";
        runQuery($updateSql);
        header("location:MyBook.php");
    }
    if ($_GET['method'] == 'DELETE') {
        $updateSql = "DELETE FROM `reservations`  WHERE `reservation_id` = '{$_GET['id']}'";
        runQuery($updateSql);
        header("location:MyBook.php");
    }
    die();
}

if (isset($_POST['scooter_id']) && isset($_POST['rate'])) {

    $insert = "INSERT INTO `evaluation` (`rate`,`comment`,`scooter_id`,`customer_id`) VALUES ('{$_POST['rate']}','{$_POST['comment']}','{$_POST['scooter_id']}',{$_SESSION['user']['cust_id']})";
    runQuery($insert);

    $updateSql = "UPDATE `reservations` SET `rated` = 1 WHERE `reservation_id` = '{$_POST['reservation_id']}'";
    runQuery($updateSql);
    header("location:MyBook.php");


    die();
}

$selectNewReservationsSql = "SELECT * FROM `reservations` WHERE `customer_id` = '{$_SESSION['user']['cust_id']}'   AND `status` IN ('new','accepted','confirmed', 'handed','received')";
$selectNewReservationsResult = runQuery($selectNewReservationsSql);

$selectOldReservationsSql = "SELECT * FROM `reservations` WHERE `customer_id` = '{$_SESSION['user']['cust_id']}' AND `status`  IN ('ended','refused')";
$selectOldReservationsResult = runQuery($selectOldReservationsSql);

?>

<!DOCTYPE html>
<html lang="ar">

<head>

    <!-- Primary Meta Tags -->
    <title>Scooter > حجوزاتي </title>
    <meta name="title" content="Scooter > حجوزاتي ">
    <?php
    include_once 'layout/assets/css.php';
    include_once 'layout/assets/js.php';
    ?>
</head>
<style>
    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 3; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 10% auto; /* 10% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 35%; /* Could be more or less, depending on screen size */
        border-radius: 10px; /* Rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Box shadow */
    }

    /* Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

</style>

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
                <li class="linkPage"> حجوزاتي</li>
                <li class="separator mx-4"> ></li>
                <li class="defPage "><a href="/" class=""> الرئيسية </a></li>
            </ul>
            <h1 class="title capitalize  text-center fs-r-48 fw-900  relative"> حجوزاتي </h1>
        </div>
    </section>
    <section class="book">
        <div class="container">
            <div class="btnFilters d-flex items-center justify-center pb-14">
                <button
                        class="btn btn-filter fw-700 round-4 px-8 py-3 active" type="button" aria-label="now" id="Now">
                    حجوزاتي الحالية
                </button>
                <button class="btn btn-filter mr-5 fw-700 round-4 px-8 py-3" type="button"
                        aria-label="now" id="prev">
                    حجوزاتي السابقة
                </button>
            </div>
            <div class="mainHeading d-flex  justify-center items-center ">
                <h2 class="mainHead fs-r-36"> حجوزاتي الحالية </h2>
            </div>
            <table>
                <thead>
                <tr>
                    <td>الاسم</td>
                    <td>تاريخ الحجز</td>
                    <td>وقت البدء</td>
                    <td>وقت الإنهاء</td>
                    <td>السعر الإجمالى</td>
                    <td>العمليات</td>
                </tr>
                </thead>
                <tbody class="now  active">
                <?php
                if ($selectNewReservationsResult->num_rows > 0) {
                    while ($newRow = $selectNewReservationsResult->fetch_assoc()) {
                        $scooter = runQuery("SELECT * FROM `scooter` WHERE `scooter_id`='{$newRow['scooter_id']}'")->fetch_assoc();
                        ?>
                        <tr>
                            <td><?php echo $scooter['scooter_name'] ?></td>
                            <td><?php echo $newRow['reservation_date'] ?></td>
                            <td><?php echo date("h:i A", strtotime($newRow['from_time'])) ?></td>
                            <td><?php echo date("h:i A", strtotime($newRow['to_time'])) ?></td>
                            <td><?php echo round($newRow['total_price'], 3) ?> ر.س</td>

                            <td>
                                <?php
                                $status='';
                                if ($newRow['status'] == 'new') {
                                    ?>
                                    <a href="?method=DELETE&id=<?php echo $newRow['reservation_id'] ?>"
                                       class="btn btn-base px-8 py-3 round-4" type="button" aria-label="sure btn">
                                        إلغاء
                                    </a>


                                    <a href="?method=UPDATE&id=<?php echo $newRow['reservation_id'] ?>&status=confirmed"
                                       class="btn btn-base px-8 py-3 round-4" type="button" aria-label="sure btn">
                                        تاكيد
                                    </a>

                                    <?php

                                }
                                elseif ($newRow['status'] == 'accepted') {
                                    $status = '<i class="fa-solid fa-circle-check correct"></i> تم القبول';
                                    echo $status;
                                }
                                elseif ($newRow['status'] == 'handed') {
                                    $status = '<i class="fa-solid fa-circle-check correct"></i> تم تسليم الاسكوتر';
                                    echo $status;
                                    }
                                elseif ($newRow['status'] == 'received') {
                                    $status = '<i class="fa-solid fa-circle-check correct"></i> تم استلام الاسكوتر';
                                    echo $status;
                                }
                                elseif ($newRow['status'] == 'ended') {
                                    $status = '<i class="fa-solid fa-circle-check correct"></i> تم انهاء الحجز';
                                    echo $status;
                                }
                                else {
                                    $status = '<i class="fa-solid fa-circle-check correct"></i> تم رفض الحجز';
                                    echo $status;
                                }
                                    ?>

                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
                <tbody class="prev">
                <?php
                if ($selectOldReservationsResult->num_rows > 0) {
                    while ($oldRow = $selectOldReservationsResult->fetch_assoc()) {
                        $scooter = runQuery("SELECT * FROM `scooter` WHERE `scooter_id`='{$oldRow['scooter_id']}'")->fetch_assoc();
                        ?>
                        <tr>
                            <td><?php echo $scooter['scooter_name'] ?></td>
                            <td><?php echo $oldRow['reservation_date'] ?></td>
                            <td><?php echo date("h:i A", strtotime($oldRow['from_time'])) ?></td>
                            <td><?php echo date("h:i A", strtotime($oldRow['to_time'])) ?></td>
                            <td><?php echo round($oldRow['total_price'], 3) ?> ر.س</td>

                            <td>
                                <?php
                                if ($oldRow['status'] == 'confirmed') {
                                    ?>
                                    تم التأكيد
                                    <?php
                                } else {
                                    ?>
                                    <button
                                            class="btn btn-base px-8 py-3 round-4" type="button" aria-label="sure btn">
                                        تم الإنهاء
                                    </button>
                                    <?php
                                    if ($oldRow['rated'] == false) {
                                        ?>
                                        <button
                                                class="btn btn-base px-8 py-3 round-4 openModal"
                                                data-modal="myModal<?php echo $oldRow['reservation_id'] ?>"
                                                type="button">
                                            قيمنا
                                        </button>


                                        <div id="myModal<?php echo $oldRow['reservation_id'] ?>" class="modal"
                                             style="display: none">

                                            <span class="close">&times;</span>

                                            <div class="modal-content">
                                                <form action="" method="post">
                                                    <input type="hidden" name="scooter_id"
                                                           value="<?php echo $oldRow['scooter_id'] ?>">
                                                    <input type="hidden" name="reservation_id"
                                                           value="<?php echo $oldRow['reservation_id'] ?>">
                                                    <div class="col-12-lg col-12-md col-12-sm">
                                                        <div class="formGroup relative mb-7 d-flex">
                                                            <label for="dateOFDay" class="">عدد النجوم</label> <input
                                                                    type="number" maxlength="1" max="5" minlength="1"
                                                                    min="1" style="width: 100%"
                                                                    name="rate" id="dateOFDay"
                                                                    class="round-4 pr-5 pl-5 undefined"
                                                                    placeholder="عدد النجوم" required
                                                                    value=""></div>
                                                    </div>

                                                    <div class="col-12-lg col-12-md col-12-sm">
                                                        <div class="formGroup relative mb-7 d-flex">
                                                            <label for="endHouer" class="">تعليق</label> <textarea
                                                                    type="time" name="comment" style="width: 100%"
                                                                    id="endHouer"
                                                                    class="round-4 pr-5 pl-5 undefined"
                                                                    placeholder="تعليق"></textarea></div>
                                                    </div>

                                                    <div class="d-flex items-center justify-center mx-auto pt-14">
                                                        <button data-modal="myModal"
                                                                class="btn btn-base px-12 py-5 round-6 fw-700 "
                                                                type="submit">ضع تقييمك
                                                        </button>
                                                    </div>
                                                </form>

                                            </div>

                                        </div>

                                    <?php
                                }else{?>
                                        <button
                                                class="btn btn-base px-8 py-3 round-4" type="button" aria-label="sure btn">
                                            تم التقييم
                                        </button>
                                <?php
                                }
                                }
                                ?>
                            </td>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    var activeModal = null;
    $(document).on('click', '.openModal', function () {
        $('.modal').css('display', 'none')
        var modal = $(this).data('modal');
        $(`#${modal}`).css('display', 'block')
        activeModal = document.getElementById(`${modal}`);
    })

    window.onclick = function (event) {
        if (event.target == activeModal) {
            activeModal.style.display = "none";
        }
    }
</script>
</body>

</html>