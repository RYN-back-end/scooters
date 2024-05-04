<?php
require 'helper.php';
if (!isset($_SESSION)) {
    session_start();
 
}



require 'helper.php';
$selectAllٍScootersSql = "SELECT * FROM scooter ORDER BY scooter_id  DESC";
$selectAllScootersResult = runQuery($selectAllٍScootersSql);


?>

<!DOCTYPE html>
<html lang="ar">

<head>
  
    <!-- Primary Meta Tags -->
    <title>Scooter | الصفحة الرئيسية</title>
    <meta name="title" content="Scooter > الصفحة الرئيسية">
  
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
        <section class="hero relative ">
            <div class="imgContainer"> <img src="css/assets/images/hero-D1I4HtEm_1tGicX.webp" alt="hero img bg"
                    class="img-cover" width="1920" height="1280" loading="lazy" decoding="async"> </div>
            <div class="container">
                <div class="row items-center">
                    <div class="col-6-lg col-6-md col-12-sm">
                        <div class="boxText relative">
                            <h1 class="fs-r-60 fw-900 line-normal">بدأ رحلتك مع سكوتي</h1>
                            <p class="fs-18 mt-5 line-relaxed">
                                استمتع بتجربة المدينة كما لم يحدث من قبل من خلال استئجار واحدة من دراجاتنا
                                البخارية الأنيقة والصديقة للبيئة. سواء كنت تتنقل إلى العمل، أو تستكشف
                                الجواهر المخفية، أو ببساطة تستمتع برحلة ممتعة، فإن دراجاتنا البخارية توفر
                                وسيلة النقل المثالية لأي مناسبة.
                            </p> 
						<!--	<?php
					if (isset($_SESSION['user']['loggedin']) && $_SESSION['user']['loggedin'] != true) {
                    ?>
							<button class="btn btn-base mt-14  round-6 join-btn" type="button"
                                aria-label="انضم الينا"> <a href="Login.php" class="px-14 py-6 fs-18 fw-700">انضم
                                    الينا</a> </button>
				


				                
			<?php
            }
            ?>
				-->
                        </div>
                    </div> <!-- right-FilterModel -->
                    <div class="col-6-lg col-6-md col-12-sm">
                        <div class="modelForm mx-auto round-6 relative">
                            <form action="product.php" class="">
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
                    </div>
                </div> <!-- left box text -->
            </div>
        </section>
        <section class="about">
            <div class="container">
                <div class="row "> <!-- right-text -->
                    <div class="col-7-lg co-6-md col-12-sm">
                        <div class="aboutDetails">
                            <div class="mainHeading d-flex  justify-center items-start ">
                                <p class="subHead d-flex items-center fs-20"> اعرف عنا <svg width="1em" height="1em"
                                        viewBox="0 0 128 128" class="mr-4" data-icon="scooter">
                                        <symbol id="ai:local:scooter">
                                            <path fill="#ea6c3a"
                                                d="M109.4 59.1h8.8c2 0 3.5 1.6 3.5 3.5 0 2-1.6 3.5-3.5 3.5h-8.8z" />
                                            <path fill="#fac136"
                                                d="M29.6 25.3c-.4 2.8-1.1 8.1-1.5 10.9-.2 1.1-1.4 1.8-2.4 1.3-2.9-1.4-4.7-4.5-4.2-7.8s3.1-5.8 6.2-6.4c1.1-.2 2.1.8 1.9 2" />
                                            <circle cx="19.4" cy="90.2" r="17.5" fill="#2f2f2f" />
                                            <circle cx="19.4" cy="90.2" r="9.7" fill="#65878d" />
                                            <circle cx="97.7" cy="90.2" r="17.5" fill="#2f2f2f" />
                                            <circle cx="97.7" cy="90.2" r="9.7" fill="#65878d" />
                                            <path fill="#47c0e5"
                                                d="M95.7 54.7h.2c2.1.1 31.3 2.8 31.3 34.6 0 1.9-1.6 3.5-3.5 3.5H51.6c-7.6 0-14.7-3.3-19.7-9l-9.6-11.1c-1.3-1.5-1.8-3.5-1.4-5.5 2-9.1 5.9-17.7 11.6-25.2l1.8-2.4h7.5l-7 28.9c.5 8.7 7.8 15.5 16.5 15.6h12.3c5.6 0 10.1-4.5 10.1-10.1 0-3.5-1.8-6.7-4.8-8.6L63 61.7c-1.2-.8-2-2.2-2-3.6v-3.5h34.7z" />
                                            <path fill="#bae9f3"
                                                d="M94.6 62.1c-.1 0-.1 0 0 0-.8 0-1.4.7-1.4 1.4 0 .8.6 1.4 1.4 1.4 12.3 0 22.2 9.9 22.2 22.2 0 .8.6 1.4 1.4 1.4.8 0 1.4-.6 1.4-1.4 0-13.8-11.2-25-25-25" />
                                            <path fill="#2f2f2f"
                                                d="M66.2 58.5 61 56.1c-.8-.4-1.3-1.2-1.3-2 0-4.7 3.8-8.6 8.6-8.6h14.5c4.9 0 9.9-.3 14.8-1 4.8-.4 8.8 3.4 8.8 8.2v3.4c0 1.1-.9 2.1-2.1 2.1l-30.8 1.3c-2.5.5-5 .1-7.3-1m43.5-31.1-.1.2c-1.8 2.7-2.8 5.8-2.8 9v2c0 .9.6 1.8 1.5 2.1l1.2.4c1.1.3 2.3-.3 2.7-1.4l3-9.9c.4-1.2-.3-2.4-1.5-2.7l-1.7-.5c-.9-.3-1.8 0-2.3.8" />
                                            <path fill="#2f2f2f"
                                                d="M115.5 30c.6.2.9.8.7 1.4l-5.7 20.2c-.5 1.9-2 3.5-3.8 4.2l-2.5 1v-2.5l.6-.2c2-.7 3.5-2.3 4.1-4.4l5.2-19c.2-.5.8-.9 1.4-.7" />
                                            <path fill="#47c0e5"
                                                d="M42.7 37.4 44 33c.4-1.2 0-2.6-1-3.4L38.8 26c-1.7-1.4-3.8-2.3-6-2.5l-6.5-.5c-.5 0-.9.2-1.1.6l-.8 1.8c-1.3 2.9-1.9 6-1.7 9.1l.1 1.7c0 .5.4.9.9 1l4.3.6c3.4.5 5.5 4 4.2 7.3l8.6-1.7z" />
                                            <path fill="#2f2f2f"
                                                d="M38.4 26s-1.8-.8-2.8 1.7c-1 2.4 1.1 4.6 1.1 4.6l7.5 2.5c1.5.5 3.1-.5 3.4-2.1.2-1.1-.4-2.2-1.4-2.7z" />
                                            <path fill="#47c0e5"
                                                d="M3 83.7h4.5c10.3.1 20.3 3.4 28.8 9.4 1.4 1 3.3-.1 3.2-1.9-.1-2.2-.5-5.2-1.6-8.3-2-6-6.2-11.3-12.8-13.1-13.7-3.7-21 5.5-23.9 10.6-.7 1.6.3 3.3 1.8 3.3" />
                                            <path fill="none" stroke="#bae9f3" stroke-linecap="round"
                                                stroke-miterlimit="10" stroke-width="2.5"
                                                d="M15 74.4s7.2-2.4 13.1 2.1c4 3 5.3 7.3 5.3 7.3" />
                                        </symbol>
                                        <use xlink:href="#ai:local:scooter"></use>
                                    </svg> </p>
                                <h2 class="mainHead fs-r-36"> خدمة تأجير الدراجات سهلة </h2>
                            </div> <!-- des -->
                            <p class="py-10 fs-16 fw-700 line-big">
                                استكشف المدينة دون عناء مع خدمة تأجير السكوتر لدينا. بأسعار معقولة
                                وموثوقة ومريحة، نحن نقدم أسطولًا من الدراجات البخارية التي يتم
                                صيانتها جيدًا لمغامرة حضرية لا تُنسى.
                            </p> <!-- ul -->
                            <ul>
                                <li class="fw-900 fs-18 pb-8 pr-11"> إلغاء الحجز مجاني لمدة تصل إلى 15 ساعة </li>
                                <li class="fw-900 fs-18 pb-8 pr-11"> أكثر من 350.000 عميل راضٍ </li>
                                <li class="fw-900 fs-18 pb-8 pr-11"> نحن نقدم المساعدة في تأجير الطرق على مدار الساعة
                                    طوال أيام الأسبوع </li>
                                <li class="fw-900 fs-18 pb-8 pr-11"> أسطول يضم أكثر من 8000 دراجة نارية ودراجة نارية
                                    جديدة </li>
                            </ul> <!-- btn --> <button class="btn btn-base round-6 mt-14 max-mb-10" type="button"
                                aria-label="on read"> <a href="AboutUs.php" class="px-14 py-5 fs-18 fw-700 "> واصل
                                    القراءة </a> </button>
                        </div>
                    </div> <!-- left-img -->
                    <div class="col-5-lg co-6-md col-12-sm">
                        <div class="imgContainer"> <img src="css/assets/images/About-Bbcypqxt_ARjoh.webp" alt="about img "
                                class="round-6" width="480" height="616" loading="lazy" decoding="async"> </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="products">
            <div class="mainHeading d-flex  justify-center items-center ">
                <p class="subHead d-flex items-center fs-20"> منتجاتنا <svg width="1em" height="1em"
                        viewBox="0 0 128 128" class="mr-4" data-icon="scooter">
                        <use xlink:href="#ai:local:scooter"></use>
                    </svg> </p>
                <h2 class="mainHead fs-r-36"> أسطول الإيجار لدينا </h2>
            </div>
            <div class="container">
                <div class="row gap-row-1">
				 <?php
                    if ($selectAllScootersResult->num_rows > 0) {
                        while ($row = $selectAllScootersResult->fetch_assoc()) {
                            ?>
                                                <div class="col-6-lg col-6-md col-12-sm">
                                <div class="card round-6 mb-10">
                                    <div class="imgContainer relative"> <img
                                            src="<?php echo $row['scooter_image']?>"
                                            alt="card image scooter " class="img-cover" width="933" height="622"
                                            loading="lazy" decoding="async">
                                        <p class="model fs-14 px-5 py-3 round-4"> <?php echo $row['scooter_model']?>   </p>
                                        <p class="status fs-14 px-5 py-3 round-4  <?php echo $row['availability']?'available':'notAvailable'?>"> <?php echo $row['availability']?'متاح':'غير متاح'?> </p>
                                    </div> <!-- card body -->
                                    <div class="cardBody round-6"> <!-- rate -->
                                        <div class="rate d-flex items-center py-5"> <svg width="1em" height="1em"
                                                viewBox="0 0 24 24" data-icon="rate">
                                                <symbol id="ai:local:rate">
                                                    <path fill="currentColor"
                                                        d="m5.825 21 2.325-7.6L2 9h7.6L12 1l2.4 8H22l-6.15 4.4 2.325 7.6L12 16.3z" />
                                                </symbol>
                                                <use xlink:href="#ai:local:rate"></use>
                                            </svg> <svg width="1em" height="1em" viewBox="0 0 24 24" data-icon="rate">
                                                <use xlink:href="#ai:local:rate"></use>
                                            </svg> <svg width="1em" height="1em" viewBox="0 0 24 24" data-icon="rate">
                                                <use xlink:href="#ai:local:rate"></use>
                                            </svg> <svg width="1em" height="1em" viewBox="0 0 24 24" data-icon="rate">
                                                <use xlink:href="#ai:local:rate"></use>
                                            </svg> <svg width="1em" height="1em" viewBox="0 0 24 24" data-icon="rate">
                                                <use xlink:href="#ai:local:rate"></use>
                                            </svg> </div> <!-- title -->
                                        <h3 class="fs-24 fw-700"><?php echo $row['scooter_name']?></h3> <!-- price -->
                                        <p class="fs-28 fw-900 price"> <?php echo $row['price_per_hour']?><span class="fs-16 fw-700">ر.س</span><span
                                                class="fs-16 fw-700">/ساعة</span> </p> <!-- line -->
                                        <hr class="my-6"> <!-- des -->
                                        <p class="des fw-700 line-norma"><?php echo $row['description']?></p>
                                        <!-- color -->
                                        <ul class="d-flex items-center my-6">
                                            <li class="color fw-700 fs-18">اللون:</li>
                                            <li class="isColor fw-700"><?php echo $row['scooter_color']?></li>
                                        </ul> <!-- buttons -->
                                        <div class="card-btn py-5 d-flex items-center justify-center">  <button class="btn btn-base round-4" type="button"
                                                aria-label="احجز الان"> <a href="productDetails.php?id=<?php echo $row['scooter_id']?>"
                                                    class="fs-16 fw-700 px-14 py-4">
                                                    التفاصيل
                                                </a> </button> </div>
                                    </div>
                                </div>
                            </div>
							        <?php
                        }
                    }
                    ?>
                           
                            
                </div>
            </div>
        </section>
    </main>
  <?php
    include_once 'layout/inc/footer.php';
    ?>
</body>


</html>