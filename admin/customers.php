<?php
include __DIR__ . '/../system/core.php';
require('../helper.php');
checkAdminLogin();

$selectUsersSql = 'SELECT * FROM customer order by cust_id DESC';
$selectUsersResult = runQuery($selectUsersSql);


if (isset($_GET['method']) && $_GET['method'] == 'DELETE' && isset($_GET['id']))
{
    $deleteID = $_GET['id'];
    $sql = "DELETE FROM customer WHERE cust_id = '{$deleteID}'";
    runQuery($sql);
    header('Location: customers.php');
}

?>
<!doctype html>
<html lang="ar" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
      data-sidebar-image="none">
<head>
    <meta charset="utf-8"/>
    <title>العملاء</title>
    <?php
    include_once 'layout/assets/css.php';
    ?>
<body>
<div class="back">
    <a href="logout.php" class="btn"> تسجيل الخروج </a>
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
     <section class="tableSection">
        <div class="tableHead">
            <h6>العملاء</h6>
            
        </div>

        <div class="tableDiv">
            <table id="table" class="table datatable table-bordered dt-responsive nowrap table-striped align-middle">
                <thead>
                <tr>
                    <th>الاسم</th>
                    <th>البريد الإلكترونى</th>
                    <th>العنوان</th>
					<th>رقم الهاتف</th>
                    <th>الصورة</th>
                    <th>حذف</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($selectUsersResult->num_rows > 0) {
                    while ($row = $selectUsersResult->fetch_assoc()) {
                       ?>

                        <tr>
                            <th><?php echo $row['cust_name']?></th>
                            <th><?php echo $row['user_name']?></th>
							<th><?php echo $row['address']?></th>
                            <th><?php echo $row['phone']?></th>
                        
                            <th><img src="../<?php echo $row['image']?>" style="width: 100px;"></th>
                            <th><a href="?method=DELETE&id=<?php echo $row['cust_id']?>" class="btn btn-danger confirmation"><i class="fa-light fa-trash"></i></a></th>
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
