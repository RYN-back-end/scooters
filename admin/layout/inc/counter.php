<?php
$sqlAllScooters = "SELECT COUNT(scooter_id) AS countAllScooters FROM scooter";
$countAllScootersResult = runQuery($sqlAllScooters);
$countAllScooters = 0;

if ($countAllScootersResult->num_rows > 0) {
    $row = $countAllScootersResult->fetch_assoc();
    $countAllScooters = $row['countAllScooters'];
}

$sqlAllCustomers = "SELECT COUNT(cust_id) AS countAllCustomers FROM customer";
$countAllCustomersResult = runQuery($sqlAllCustomers);
$countAllCustomers = 0;

if ($countAllCustomersResult->num_rows > 0) {
    $custrow = $countAllCustomersResult->fetch_assoc();
    $countAllCustomers = $custrow['countAllCustomers'];
}

$sqlAllReservations = "SELECT COUNT(reservation_id) AS countAllReservations FROM reservations";
$countAllReservationsResult = runQuery($sqlAllReservations);
$countAllReservations = 0;

if ($countAllReservationsResult->num_rows > 0) {
    $reserveRow = $countAllReservationsResult->fetch_assoc();
    $countAllReservations = $reserveRow['countAllReservations'];
}


$sqlAllEmp = "SELECT COUNT(employee_id) AS countAllEmps FROM rent_employee";
$countAllEmpsResult = runQuery($sqlAllEmp);
$countAllEmps = 0;

$sqlAllQuestions = "SELECT * FROM questions ";
$countAllQuesResult = runQuery($sqlAllQuestions);
$questions = [];
while ($quesRow = $countAllQuesResult->fetch_assoc()) {
    $questions[] = $quesRow;
}


if ($countAllEmpsResult->num_rows > 0) {

    $row = $countAllEmpsResult->fetch_assoc();
    $countAllEmps = $row['countAllEmps'];
}
?>
<section class="statisticsSection">
    <div class="row g-4">
        <a href="index.php" class="statistic col-sm-6 col-md-4 col-lg-3">
            <h5 class="top">
                <i class="fa-solid fa-motorcycle"></i>
                ادارة الاسكوتر
            </h5>
            <div class="body">
                <h1 class="odometer"
                    data-count="<?php echo $countAllScooters; ?>"><?php echo $countAllScooters; ?></h1>
            </div>
        </a>
        <a href="rentEmployee.php" class="statistic col-sm-6 col-md-4 col-lg-3">
            <h5 class="top">
                <i class='fas fa-user-tie' style='font-size:24px'></i>
                ادارة موظفين التأجير
            </h5>
            <div class="body">
                <h1 class="odometer" data-count="<?php echo $countAllEmps ?? 0; ?>"><?php echo $countAllEmps ?? 0; ?></h1>
            </div>
        </a>
        <a href="questions.php" class="statistic col-sm-6 col-md-4 col-lg-3">
            <h5 class="top">
                <i class="fa fa-question-circle" aria-hidden="true"></i>

                ادارة الاستفسارات
            </h5>
            <div class="body">
                <h1 class="odometer"
                   data-count="<?php echo $countAllQuesResult->num_rows ?? 0; ?>"><?php echo $countAllQuesResult->num_rows ?? 0; ?></h1>
            </div>
        </a>
		     <a href="customers.php" class="statistic col-sm-6 col-md-4 col-lg-3">
            <h5 class="top">
               <i class='fas fa-users' style='font-size:24px'></i>

                ادارة العملاء
            </h5>
            <div class="body">
                <h1 class="odometer"
                    data-count="<?php echo $countAllCustomers;?>"><?php echo $countAllCustomers; ?></h1>
            </div>
        </a>
		  <a href="reservation.php" class="statistic col-sm-6 col-md-4 col-lg-3">
            <h5 class="top">
                <i class="fa-solid fa-motorcycle"></i>
                حجوزات العملاء
            </h5>
            <div class="body">
                <h1 class="odometer"
                    data-count="<?php echo $countAllReservations; ?>"><?php echo $countAllReservations; ?></h1>
            </div>
        </a>
    </div>
</section>
