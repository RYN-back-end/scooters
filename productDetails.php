<?php
require 'helper.php';
if (!isset($_SESSION)) {
    session_start();
}
$selectٍScootersSql = "SELECT * FROM scooter where scooter_id ='{$_GET["id"]}'";
$selectScootersResult = runQuery($selectٍScootersSql);
$selectScooterRow = $selectScootersResult->fetch_assoc();

if (isset($_POST['scooter_id'])) {
    checkLogin();

    $sql = "SELECT * FROM `reservations`  
        WHERE from_time <= '{$_POST['from_time']}' AND to_time >= '{$_POST['to_time']}' AND `reservation_date` = '{$_POST['reservation_date']}' AND `scooter_id` = '{$_POST['scooter_id']}' AND `status` NOT IN ('refused','ended')";
    if (runQuery($sql)->num_rows) {
        header("location:productDetails.php?id={$_POST['scooter_id']}&error=يرجي إختيار وقت اخر");
        die();
    }
    $totalPrice = calculateTotalPrice($selectScooterRow['price_per_hour'], "{$_POST['from_time']}", "{$_POST['to_time']}");
    $insertSql = "INSERT INTO `reservations` (`reservation_date`,`from_time`,`to_time`,`total_price`,`scooter_id`,`customer_id`) VALUES ('{$_POST['reservation_date']}','{$_POST['from_time']}','{$_POST['to_time']}','{$totalPrice}','{$_POST['scooter_id']}',{$_SESSION['user']['cust_id']})";
    runQuery($insertSql);
    header("location:MyBook.php");
}

$selectRatesSql = "SELECT * FROM evaluation WHERE `scooter_id` = '{$_GET['id']}'";
$selectRatesResult = runQuery($selectRatesSql);


function calculateTotalPrice($hourlyRate, $startTime, $endTime)
{
    // تحويل الوقت إلى أجزاء ساعة ودقيقة
    $startParts = explode(":", $startTime);
    $endParts = explode(":", $endTime);

    // تحويل الوقت إلى دقائق
    $startMinutes = intval($startParts[0]) * 60 + intval($startParts[1]);
    $endMinutes = intval($endParts[0]) * 60 + intval($endParts[1]);

    // حساب عدد الساعات
    $totalHours = ($endMinutes - $startMinutes) / 60;

    // حساب السعر الإجمالي
    $totalPrice = $totalHours * $hourlyRate;
    $totalPrice = abs($totalPrice);

    return round($totalPrice, 3);
}

?>

<!DOCTYPE html>
<html lang="ar">

<head>

    <!-- Primary Meta Tags -->
    <title>Scooter > تفاصيل المنتج</title>
    <meta name="title" content="Scooter > تفاصيل المنتج">
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
                                                 loading="lazy" decoding="async"></div>
        <div class="container ">
            <ul class="d-flex items-center justify-center relative">
                <li class="defPage "><a href="/" class=""> الرئيسية </a></li>

                <li class="separator mx-4"> ></li>
                <li class="linkPage"> تفاصيل المنتج</li>

            </ul>
            <h1 class="title capitalize  text-center fs-r-48 fw-900  relative"> تفاصيل المنتج </h1>
        </div>
    </section>
    <section class="ProDetails">
        <div class="container">
            <div class="row gap-row-1 items-start"> <!-- left side gallery -->
                <div class="col-5-lg col-6-md col-12-sm">
                    <div class="gallery">
                        <div class="main-img mb-6"><img
                                    src="<?php echo $selectScooterRow['scooter_image'] ?>"
                                    alt="pro main image" class="round-6" width="933"
                                    height="622" loading="lazy" decoding="async">
                        </div>

                    </div>
                    <div class="review mt-10">
                        <p class="fs-24 fw-900 pb-8">التقييمات</p>
                        <?php
                        if ($selectRatesResult->num_rows > 0) {
                            while ($row = $selectRatesResult->fetch_assoc()) {
                                $selectUserSql = "SELECT * FROM customer where cust_id = '{$row['customer_id']}'";
                                $selectUserResult = runQuery($selectUserSql);
                                if ($selectUserRow = $selectUserResult->fetch_assoc()) {
                                    ?>
                                    <div class="userReview py-6 px-10 round-4 mb-6">
                                        <div
                                                class="userRate d-flex items-center justify-between">
                                            <div class="userName fw-700 fs-18 pb-5"> <?php echo $selectUserRow['cust_name'] ?></div>
                                            <div class="star d-flex">
                                                <svg width="1em"
                                                     height="1em" viewBox="0 0 24 24"
                                                     data-icon="rate">
                                                    <use
                                                            xlink:href="#ai:local:rate">
                                                    </use>
                                                </svg>
                                                <svg width="1em" height="1em"
                                                     viewBox="0 0 24 24"
                                                     data-icon="rate">
                                                    <use
                                                            xlink:href="#ai:local:rate">
                                                    </use>
                                                </svg>
                                                <svg width="1em" height="1em"
                                                     viewBox="0 0 24 24"
                                                     data-icon="rate">
                                                    <use
                                                            xlink:href="#ai:local:rate">
                                                    </use>
                                                </svg>
                                                <svg width="1em" height="1em"
                                                     viewBox="0 0 24 24"
                                                     data-icon="rate">
                                                    <use
                                                            xlink:href="#ai:local:rate">
                                                    </use>
                                                </svg>
                                                <svg width="1em" height="1em"
                                                     viewBox="0 0 24 24"
                                                     data-icon="rate">
                                                    <use
                                                            xlink:href="#ai:local:rate">
                                                    </use>
                                                </svg>
                                            </div>
                                        </div>
                                        <p class="userComment fw-700"><?php echo $row['comment'] ?></p>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        ?>

                    </div>
                </div> <!-- right side -->
                <div class="col-7-lg col-6-md col-12-sm">
                    <div class="details"> <!-- rate -->
                        <div class="rate d-flex item-center mb-6">
                            <div class="star d-flex">
                                <svg width="1em" height="1em"
                                     viewBox="0 0 24 24" data-icon="rate">
                                    <symbol id="ai:local:rate">
                                        <path fill="currentColor"
                                              d="m5.825 21 2.325-7.6L2 9h7.6L12 1l2.4 8H22l-6.15 4.4 2.325 7.6L12 16.3z"/>
                                    </symbol>
                                    <use xlink:href="#ai:local:rate"></use>
                                </svg>
                                <svg width="1em" height="1em"
                                     viewBox="0 0 24 24" data-icon="rate">
                                    <use xlink:href="#ai:local:rate"></use>
                                </svg>
                                <svg width="1em" height="1em"
                                     viewBox="0 0 24 24" data-icon="rate">
                                    <use xlink:href="#ai:local:rate"></use>
                                </svg>
                                <svg width="1em" height="1em"
                                     viewBox="0 0 24 24" data-icon="rate">
                                    <use xlink:href="#ai:local:rate"></use>
                                </svg>
                                <svg width="1em" height="1em"
                                     viewBox="0 0 24 24" data-icon="rate">
                                    <use xlink:href="#ai:local:rate"></use>
                                </svg>
                            </div>
                            <div class="numReview items-center pr-5 fs-18 fw-700">1
                                مراجعة
                            </div>
                        </div> <!-- title -->
                        <h2 class="fw-900 fs-30"><?php echo $selectScooterRow['scooter_name'] ?></h2> <!-- price -->
                        <p class="fs-28 fw-900 price mb-6">
                            <?php echo $selectScooterRow['price_per_hour'] ?><span class="fs-16 fw-700">ر.س</span><span
                                    class="fs-16 fw-700">/ساعة</span></p>
                        <hr class="mb-6"> <!-- full des -->
                        <p class="des py-6 fs-18 fw-700 line-big">
                            <?php echo $selectScooterRow['description'] ?>
                        </p>
                        <hr class="my-6"> <!-- color -->
                        <ul class="d-flex items-center py-6">
                            <li class="color fw-700 fs-18">اللون:</li>
                            <li class="isColor fw-700 ml-14"><?php echo $selectScooterRow['scooter_color'] ?></li>
                            <li class="color fw-700 fs-18">الحالة:</li>
                            <li class="isColor fw-700 ml-14"> <?php echo $selectScooterRow['availability'] ? 'متاح' : 'غير متاح' ?></li>
                            <li class="color fw-700 fs-18">موديل:</li>
                            <li class="isColor fw-700"><?php echo $selectScooterRow['scooter_model'] ?></li>
                        </ul>
                        <hr class="my-6"> <!-- Rental Policy -->
                        <ul class="RentalPolicy py-6">
                            <p class="fs-24 fw-700 pb-6">سياسة الإيجار</p>
                            <li class="fw-700 pb-6">ادفع 15% فقط الآن والباقي في
                                الوجهة.
                            </li>
                            <li class="fw-700 pb-6">
                                قم بالإلغاء حتى 48 ساعة قبل الاستلام واسترد
                                أموالك بالكامل
                            </li>
                            <li class="fw-700 pb-6">
                                هذه السيارة تتطلب رخصة فئة A1 أو ما يعادلها.
                            </li>
                            <li class="fw-700 pb-6">
                                يجب أن يكون عمرك 18 عامًا على الأقل لتتمكن من
                                استئجارها مع خبرة
                                قيادة مدتها 12 شهرًا
                            </li>
                            <li class="fw-700 pb-6">
                                يلزم تقديم وديعة تأمين قابلة للاسترداد (بطاقة
                                خصم بقيمة 24 ر.س)
                                عند الاستلام.
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="myModal" class="modal" style="display: none">

                    <span class="close">&times;</span>

                    <div class="modal-content">
                        <form action="" method="post">
                            <input type="hidden" name="scooter_id"
                                   value="<?php echo $selectScooterRow['scooter_id'] ?>">
                            <div class="col-12-lg col-12-md col-12-sm">
                                <div class="formGroup relative mb-7 d-flex">
                                    <label for="dateOFDay" class="">تاريخ
                                        الحجز</label> <input type="date" style="width: 100%"
                                                             name="reservation_date" id="dateOFDay"
                                                             class="round-4 pr-5 pl-5 undefined"
                                                             placeholder="d-m-y" required
                                                             value=""></div>
                            </div>

                            <div class="col-12-lg col-12-md col-12-sm">
                                <div class="formGroup relative mb-7 d-flex">
                                    <label for="startHouer" class=""> وقت
                                        بداية الحجز</label> <input
                                            type="time" name="from_time" required style="width: 100%"
                                            id="startHouer"
                                            class="round-4 pr-5 pl-5 undefined"
                                            placeholder="d-m-y"></div>
                            </div>
                            <div class="col-12-lg col-12-md col-12-sm">
                                <div class="formGroup relative mb-7 d-flex">
                                    <label for="endHouer" class=""> وقت
                                        نهاية الحجز</label> <input
                                            type="time" name="to_time" style="width: 100%"
                                            id="endHouer"
                                            class="round-4 pr-5 pl-5 undefined"
                                            placeholder="d-m-y"></div>
                            </div>

                            <div class="d-flex items-center justify-center mx-auto pt-14">

                                <button data-modal="myModal"
                                        class="btn btn-base px-12 py-5 round-6 fw-700 " type="submit"> احجز الان
                                </button>

                            </div>
                        </form>

                    </div>

                </div>

                <div class="d-flex items-center justify-center mx-auto pt-14">
                    <?php
                    if ($selectScooterRow['availability']) {
                        ?>
                        <button data-modal="myModal"
                                class="btn btn-base px-12 py-5 round-6 fw-700 openModal" type="button"> احجز الان
                        </button>
                        <?php
                    }
                    ?>
                    <div class="BookNowModel">
                        <div class="modelForm mx-auto round-6 relative">
                            <form action="/" class="">
                                <div class="formGroup relative mb-7 d-flex">
                                    <label for="dateOFDay" class="">تاريخ
                                        الحجز</label> <input type="date"
                                                             name="dateOFDay" id="dateOFDay"
                                                             class="round-4 pr-5 pl-5 undefined"
                                                             placeholder="d-m-y"
                                                             value="2024-04-15"></div>
                                <div class="formGroup relative mb-7 d-flex">
                                    <label for="startHouer" class=""> وقت
                                        بداية الحجز</label> <input
                                            type="time" name="startHouer"
                                            id="startHouer"
                                            class="round-4 pr-5 pl-5 undefined"
                                            placeholder="d-m-y"></div>
                                <div class="formGroup relative mb-7 d-flex">
                                    <label for="endHouer" class=""> وقت
                                        نهاية الحجز</label> <input
                                            type="time" name="endHouer"
                                            id="endHouer"
                                            class="round-4 pr-5 pl-5 undefined"
                                            placeholder="d-m-y"></div>
                                <div class="formGroup relative mb-7 d-flex">
                                    <label for="Houer" class="">عدد
                                        الساعات</label> <input
                                            type="text" name="Houer"
                                            id="Houer"
                                            class="round-4 pr-5 pl-5 undefined"
                                            placeholder="ادخل عدد ساعات الحجز"
                                            value="1"></div>
                                <div class="formGroup relative mb-7 d-flex">
                                    <label for="cost" class="">التكلفة في
                                        الساعة</label> <input
                                            type="text" name="cost"
                                            id="cost"
                                            class="round-4 pr-5 pl-5 undefined"
                                            placeholder="تكلفة الحجز في الساعة"
                                            value="50" disabled></div>
                                <div
                                        class="relative d-flex items-center justify-center">
                                    <button class="btn btn-base px-14 py-5 mt-8 fw-700 round-4"
                                            type="button"
                                            aria-label="احجز الان"> حجز
                                    </button>
                                </div>
                                <button
                                        class="btn btn-close px-5 py-4 round-6"
                                        type="button" aria-label="close model"
                                        id="closeBookModel">
                                    <svg width="1em"
                                         height="1em" viewBox="0 0 24 24"
                                         data-icon="close">
                                        <symbol id="ai:local:close">
                                            <path fill="none"
                                                  stroke="currentColor"
                                                  stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M6 18 18 6m0 12L6 6"/>
                                        </symbol>
                                        <use
                                                xlink:href="#ai:local:close">
                                        </use>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
include_once 'layout/inc/footer.php';
?>
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