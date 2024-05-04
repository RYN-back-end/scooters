
<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="ar">

<head>

     <?php
    include_once 'layout/assets/css.php';
	include_once 'layout/assets/js.php';
    ?>
	    <title> Scooter > من نحـن </title>
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
					<li class="linkPage">من نحن</li>
                    
                </ul>
                <h1 class="title capitalize  text-center fs-r-48 fw-900  relative"> من نحن </h1>
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
                            </ul> <!-- btn -->
                     <?php
			             		if (!isset($_SESSION['user']['loggedin']) && $_SESSION['user']['loggedin'] == true) {
                             ?>
							<button class="btn btn-base round-6 mt-14 max-mb-10" type="button"
                                aria-label="on read"> <a href="signIn.php" class="px-14 py-5 fs-18 fw-700 "> انضم الينا
                                </a> </button>  
								<?php
                }
                ?>
                        </div>
                    </div> <!-- left-img -->
                    <div class="col-5-lg co-6-md col-12-sm">
                        <div class="imgContainer"> <img src="css/assets/images/About-Bbcypqxt_ARjoh.webp" alt="about img "
                                class="round-6" width="480" height="616" loading="lazy" decoding="async"> </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
   <?php
    include_once 'layout/inc/footer.php';
    ?>
</body>

</html>