<?php
require(__DIR__ . '/../../helper.php');
if (!isset($_SESSION)) {
    session_start();
}
?>
<!-- =====  HEADER START  ===== -->
    <header>
        <div class="container">
            <nav class="d-flex items-center py-4 justify-between"> <button class="btn icon-nav-base" type="button"
                    aria-label="open menu" aria-expanded="false"> <span></span><span></span><span></span> </button> <a
                    href="index.php" class="logo"> <img src="css/assets/images/Logo-B9yU1TGn_Z29EQ9k.webp" alt="scooter logo"
                        width="692" height="500" loading="lazy" decoding="async"> </a>
                <ul class="link-list d-flex mx-auto normalMenu client ">
                    <li class="navItems"> <a href="index.php" class="navLink fw-700 relative"> الرئيسية </a> </li>
                    <li class="navItems"> <a href="product.php" class="navLink fw-700 relative"> منتجاتنا </a> </li>
                    
                    <li class="navItems"> <a href="AboutUs.php" class="navLink fw-700 relative"> من نحن </a> </li>
					
					
				
					<?php
					if (isset($_SESSION['user']['loggedin']) && $_SESSION['user']['loggedin'] == true) {
                    ?>
                   <li class="navItems"> <a href="MyBook.php" class="navLink fw-700 relative"> حجوزاتى </a> </li>
                    <li class="navItems"> <a href="ContactUs.php" class="navLink fw-700 relative"> تواصل معنا </a>
                    </li>
					 <li ><a href="" class="navLink fw-700 relative"> <?php echo $_SESSION['user']['cust_name'] ?? '' ?> </a>

					
					<li ><a href="questions.php" class="navLink fw-700 relative">الأسئلة
                                </a>
                            </li>
					<li ><a href="logout.php" class="navLink fw-700 relative"> تسجيل الخروج
                                </a>
                            </li>

                    <?php
            }else{
                ?>
                 
                                       
                <li class="navItems"> <a href="Login.php" class="navLink fw-700 relative"> انضم إلينا</a> </li>
                <?php
            } 
                ?>
               
					
                </ul> <button class="btn btn-certain  relative round-6 " type="button" aria-label="احجز الان"> <a
                        href="product.php" class="fs-18 fw-700 px-10 py-4">احجز الان</a> </button>
						
						
            </nav>
        </div>
    </header>
<!-- =====  HEADER END  ===== -->