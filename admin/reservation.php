<?php
include __DIR__ . '/../system/core.php';
require('../helper.php');
checkAdminLogin();
$selectٍReservationsSql = 'SELECT `scooter`.`scooter_name`, `customer`.`cust_name`, `reservations`.`reservation_id`,
 `reservations`.`reservation_date`, `reservations`.`from_time`, `reservations`.`to_time`, 
 `reservations`.`total_price`, `reservations`.`status` FROM `reservations` , `customer`, `scooter`
 WHERE `reservations`.`customer_id` = `customer`.`cust_id` and
 `reservations`.`scooter_id`= `scooter`.`scooter_id` order by `reservations`.`reservation_id` DESC';

$selectReservationsResult = runQuery($selectٍReservationsSql);


if (isset($_GET['method']) && isset($_GET['reservation_id']) && isset($_GET['status'])) {
    $updateSql = "UPDATE reservations SET status='{$_GET['status']}' WHERE reservation_id = '{$_GET['reservation_id']}'";
    runQuery($updateSql);
    header('Location: reservation.php?success=تم التعديل بنجاح');
}

$selectAllOrdersSql = "SELECT * FROM reservations order by reservation_id DESC ";
$selectAllOrdersResult = runQuery($selectAllOrdersSql);
?>
<!doctype html>
<html lang="ar" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
      data-sidebar-image="none">
<head>
    <meta charset="utf-8"/>
    <title>reservations</title>
    <?php
    include_once 'layout/assets/css.php';
    ?>
    <style>
        <
        style >
        .table-modal {
            display: table;
            width: 100%; /* Set the width to 100% */
            border-collapse: collapse;
        }

        .table-row {
            display: inline-table;
        }

        .table-cell {
            display: table-cell;
            border: 1px solid #000;
            padding: 8px;
        }
    </style>
<body>
<div class="back">
    <a href="logout.php" class="btn"> Logout </a>
</div>
<div class="loader-ajax" style="display: none  ; ">
    <div class="lds-grid">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div>
        </div>
    </div>
</div>
<div class="lds-hourglass"></div>

<content>
    <?php
    include_once 'layout/inc/counter.php';
    ?>
    <!--control -->
    <section class="tableSection">
        <div class="tableHead">
            <h6>الحجوزات</h6>
        </div>
        <div class="tableDiv">
            <table id="table" class="table datatable table-bordered dt-responsive nowrap table-striped align-middle">
                <thead>
                <tr>
                    <th>اسم العميل</th>
                    <th>اسم الاسكوتر</th>
                    <th>تاريخ الحجز</th>
                    <th>بداية الحجز</th>
                    <th>نهاية الحجز</th>
                    <th>السعر الاجمالي</th>
                    <th>حالة الحجز</th>
                </tr>
                </thead>

                <tbody>
                <?php
                if ($selectAllOrdersResult->num_rows > 0) {
                    while ($row = $selectAllOrdersResult->fetch_assoc()) {
                        $selectUserSql = "SELECT * from customer WHERE cust_id = '{$row["customer_id"]}'";
                        $selectUserResult = runQuery($selectUserSql);
                        $selectProductSql = "SELECT * from scooter WHERE scooter_id = '{$row["scooter_id"]}'";
                        $selectProductResult = runQuery($selectProductSql);
                        $status = '';
                        if ($row['status'] == 'new') {
                            $status = 'حجز معلق';
                        } elseif ($row['status'] == 'accepted') {
                            $status = 'تم القبول';
                        } elseif ($row['status'] == 'refused') {
                            $status = 'تم الرفض';
                        } else {
                            $status = '<i class="fa-solid fa-circle-check correct"></i> تم الاستلام';
                        }
                        $userRow = $selectUserResult->fetch_assoc();
                        $scooterRow = $selectProductResult->fetch_assoc();

                        ?>

                        <tr>
                            <th><?php echo $userRow['cust_name'] ?></th>
                            <th><?php echo $scooterRow['scooter_name'] ?></th>
                            <th><?php echo $row['reservation_date'] ?></th>
                            <th><?php echo $row['from_time'] ?></th>
                            <th><?php echo $row['to_time'] ?></th>

                            <th><?php echo $row['total_price'] ?></th>

                            <td class="stats">
                                <?php echo $status; ?>
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


</content>

<?php
include_once 'layout/assets/js.php';
?>
</body>
</html>
