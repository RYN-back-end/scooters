<?php

require 'helper.php';
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_GET['from_time'])) {
    $selectAllٍScootersSql = "SELECT * FROM scooter
        WHERE scooter_id NOT IN (
            SELECT scooter_id FROM reservations
            WHERE reservation_date = '{$_GET['reservation_date']}'
            AND from_time <= '{$_GET['to_time']}' 
            AND to_time >= '{$_GET['from_time']}'
            AND status NOT IN ('refused', 'ended')
        )";
    if (isset($_GET['sort'])) {
        if ($_GET['sort'] == 'OldestFirst'){
            $selectAllٍScootersSql .=" ORDER BY scooter_id DESC";
        }if ($_GET['sort'] == 'big'){
            $selectAllٍScootersSql .=" ORDER BY price_per_hour DESC";
        }if ($_GET['sort'] == 'small'){
            $selectAllٍScootersSql .=" ORDER BY price_per_hour ASC";
        }
    }
//    die($selectAllٍScootersSql);
    $selectAllScootersResult = runQuery($selectAllٍScootersSql);

} else {
    $selectAllٍScootersSql = "SELECT * FROM scooter ORDER BY scooter_id  DESC";
    $selectAllScootersResult = runQuery($selectAllٍScootersSql);
}


?>

<!DOCTYPE html>
<html lang="ar">

<head>

    <title>Scooter > منتجاتنا </title>
    <meta name="title" content="Scooter > منتجاتنا ">
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
                <li class="defPage "><a href="/" class=""> الرئيسية </a></li>

                <li class="separator mx-4"> ></li>
                <li class="linkPage">منتجاتنا</li>
            </ul>
            <h1 class="title capitalize  text-center fs-r-48 fw-900  relative"> منتجاتنا </h1>
        </div>
    </section>
    <section class="proPageSection">
        <div class="container">
            <div class="row items-start gap-row-1 "> <!-- right  pro-->
                <div class="col-8-lg col-7-md col-12-sm">
                    <div class="rightTop d-flex items-center justify-between mb-10"><select name="" id="sort-products"
                                                                                            class="round-6 px-5">
                            <option value="" selected disabled>ترتيب حسب</option>
                            <option value="NewestFirst" >الأحدث أولاً</option>
                            <option value="OldestFirst" >الأقدم أولا</option>
                            <option value="big">الإعلى سعر</option>
                            <option value="small" >الأقل سعر</option>
                        </select>
                    </div>
                    <div class="row gap-row-1">
                        <?php
                        if ($selectAllScootersResult->num_rows > 0) {
                            while ($row = $selectAllScootersResult->fetch_assoc()) {
                                ?>
                                <div class="col-6-lg col-6-md col-12-sm">
                                    <div class="card round-6 mb-10">
                                        <div class="imgContainer relative"><img
                                                    src="<?php echo $row['scooter_image'] ?>"
                                                    alt="card image scooter " class="img-cover" width="933" height="622"
                                                    loading="lazy" decoding="async">
                                            <p class="model fs-14 px-5 py-3 round-4"> <?php echo $row['scooter_model'] ?>   </p>
                                            <p class="status fs-14 px-5 py-3 round-4  <?php echo $row['availability'] ? 'available' : 'notAvailable' ?>"> <?php echo $row['availability'] ? 'متاح' : 'غير متاح' ?> </p>
                                        </div> <!-- card body -->
                                        <div class="cardBody round-6"> <!-- rate -->
                                            <div class="rate d-flex items-center py-5">
                                                <svg width="1em" height="1em"
                                                     viewBox="0 0 24 24" data-icon="rate">
                                                    <symbol id="ai:local:rate">
                                                        <path fill="currentColor"
                                                              d="m5.825 21 2.325-7.6L2 9h7.6L12 1l2.4 8H22l-6.15 4.4 2.325 7.6L12 16.3z"/>
                                                    </symbol>
                                                    <use xlink:href="#ai:local:rate"></use>
                                                </svg>
                                                <svg width="1em" height="1em" viewBox="0 0 24 24" data-icon="rate">
                                                    <use xlink:href="#ai:local:rate"></use>
                                                </svg>
                                                <svg width="1em" height="1em" viewBox="0 0 24 24" data-icon="rate">
                                                    <use xlink:href="#ai:local:rate"></use>
                                                </svg>
                                                <svg width="1em" height="1em" viewBox="0 0 24 24" data-icon="rate">
                                                    <use xlink:href="#ai:local:rate"></use>
                                                </svg>
                                                <svg width="1em" height="1em" viewBox="0 0 24 24" data-icon="rate">
                                                    <use xlink:href="#ai:local:rate"></use>
                                                </svg>
                                            </div> <!-- title -->
                                            <h3 class="fs-24 fw-700"><?php echo $row['scooter_name'] ?></h3>
                                            <!-- price -->
                                            <p class="fs-28 fw-900 price"> <?php echo $row['price_per_hour'] ?><span
                                                        class="fs-16 fw-700">ر.س</span><span
                                                        class="fs-16 fw-700">/ساعة</span></p> <!-- line -->
                                            <hr class="my-6"> <!-- des -->
                                            <p class="des fw-700 line-norma"><?php echo $row['description'] ?></p>
                                            <!-- color -->
                                            <ul class="d-flex items-center my-6">
                                                <li class="color fw-700 fs-18">اللون:</li>
                                                <li class="isColor fw-700"><?php echo $row['scooter_color'] ?></li>
                                            </ul> <!-- buttons -->
                                            <div class="card-btn py-5 d-flex items-center justify-center">
                                                <button class="btn btn-base round-4" type="button"
                                                        aria-label="احجز الان"><a
                                                            href="productDetails.php?id=<?php echo $row['scooter_id'] ?>"
                                                            class="fs-16 fw-700 px-14 py-4">
                                                        التفاصيل
                                                    </a></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>


                    </div>

                </div> <!-- left aside -->
                <div class="col-4-lg col-5-md col-12-sm">
                    <aside>
                        <div class="modelForm mx-auto round-6 relative">
                            <div class="headModel ">
                                <p class="title fw-700 fs-18">ابحث عن الاسكوتر</p>
                            </div>
                            <form action="" class="">
                                <div class="formGroup relative mb-7 d-flex"><label for="dateOFDay" class="">تاريخ
                                        الحجز</label> <input type="date" name="reservation_date"
                                                             value="<?php echo $_GET['reservation_date'] ?? '' ?>"
                                                             id="dateOFDay"
                                                             class="round-4 pr-5 pl-5 undefined" required
                                                             value="2024-04-15">
                                </div>
                                <div class="formGroup relative mb-7 d-flex"><label for="startHouer" class=""> وقت
                                        بداية الحجز</label> <input type="time" name="from_time"
                                                                   value="<?php echo $_GET['from_time'] ?? '' ?>"
                                                                   required id="startHouer"
                                                                   class="round-4 pr-5 pl-5 undefined"
                                                                   placeholder="d-m-y"></div>
                                <div class="formGroup relative mb-7 d-flex"><label for="endHouer" class=""> وقت
                                        نهاية الحجز</label> <input type="time" name="to_time" id="endHouer"
                                                                   class="round-4 pr-5 pl-5 undefined" required
                                                                   placeholder="d-m-y"
                                                                   value="<?php echo $_GET['to_time'] ?? '' ?>"></div>
                                <div class="relative d-flex items-center justify-center">
                                    <button
                                            class="btn btn-base px-14 py-5 mt-8 fw-700 round-4" type="submit"
                                            aria-label="احجز الان"> بحث
                                    </button>
                                </div>
                            </form>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
include_once 'layout/inc/footer.php';
?>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
<script>
    $(document).on('change', '#sort-products', function () {
        if ($(this).val().length) {
            var newUrl = updateQueryStringParameter(window.location.href, 'sort', $(this).val());

            window.location.href = newUrl;
        } else {
            var newUrl = removeParam('sort');
            window.location.href = newUrl;

        }

    })

    function removeParam(key) {
        var url = window.location.href;
        var urlParts = url.split('?');

        if (urlParts.length >= 2) {
            var prefix = encodeURIComponent(key) + '=';
            var params = urlParts[1].split(/[&;]/g);

            // Iterate through the parameters and remove the one with the given key
            for (var i = params.length; i-- > 0;) {
                if (params[i].lastIndexOf(prefix, 0) !== -1) {
                    params.splice(i, 1);
                }
            }

            // Reconstruct the URL without the parameter
            url = urlParts[0] + (params.length > 0 ? '?' + params.join('&') : '');

            return url;
        }
    }

    function updateQueryStringParameter(uri, key, value) {
        var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
        var separator = uri.indexOf('?') !== -1 ? "&" : "?";
        if (uri.match(re)) {
            return uri.replace(re, '$1' + key + "=" + value + '$2');
        } else {
            return uri + separator + key + "=" + value;
        }
    }
</script>
</body>

</html>