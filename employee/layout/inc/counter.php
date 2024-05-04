<?php
$sqlAllscooters = "SELECT COUNT(scooter_id) AS countAllScooters FROM scooter";
$countAllScootersResult = runQuery($sqlAllscooters);
$countAllScooters = 0;

if ($countAllScootersResult->num_rows > 0) {
    $row = $countAllScootersResult->fetch_assoc();
    $sqlAllscooters = $row['countAllScooters'];
}
$sqlAllReservations = "SELECT COUNT(reservation_id ) AS countAllReservations FROM reservations";
$countAllReservationsResult = runQuery($sqlAllReservations);
$countAllReservations = 0;

if ($countAllReservationsResult->num_rows > 0) {
    $row = $countAllReservationsResult->fetch_assoc();
    $countAllReservations = $row['countAllReservations'];
	
}





?>
<section class="statisticsSection">
    <div class="row g-4">
        <a href="index.php" class="statistic col-sm-6 col-md-4 col-lg-3">
            <h5 class="top">
                <i class="fa-solid fa-motorcycle"></i>
                اتاحة الاسكوتر
            </h5>
            <div class="body">
                <h1 class="odometer"
                    data-count="<?php echo $sqlAllscooters; ?>"><?php echo $sqlAllscooters; ?></h1>
            </div>
        </a>
        <a href="reservation.php" class="statistic col-sm-6 col-md-4 col-lg-3">
            <h5 class="top">
                <i class='fas fa-user-tie' style='font-size:24px'></i>
                ادارة طلبات الحجز
            </h5>
            <div class="body">
                <h1 class="odometer" data-count="<?php echo $countAllReservations ?? 0; ?>"><?php echo $countAllReservations ?? 0; ?></h1>
            </div>
        </a>
       
		   
		
    </div>
</section>
