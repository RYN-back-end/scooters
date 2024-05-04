<?php
include __DIR__ . '/../system/core.php';
require('../helper.php');
checkEmployeeLogin();
$selectٍScootersSql = 'SELECT * FROM scooter order by scooter_id  DESC';

$selectScootersResult = runQuery($selectٍScootersSql);


if (isset($_POST['type']) && isset($_POST['scooter_id']) && $_POST['type'] == 'edit') {
	   $availability = isset($_POST['availability']) ? 1 : 0;	
    $updateSql = "UPDATE scooter SET `availability` = '{$availability}' WHERE `scooter_id` = '{$_POST['scooter_id']}' ";

     runQuery($updateSql);
    header("Location: index.php");
}


?>

<!doctype html>
<html lang="ar" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
      data-sidebar-image="none">
<head>
    <meta charset="utf-8"/>
    <title>ادارة الاسكوتر</title>
    <?php
    include_once 'layout/assets/css.php';
    ?>
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
            <h6>ادارة الاسكوتر</h6>
            
        </div>
        <div class="tableDiv">
            <table id="table" class="table datatable table-bordered dt-responsive nowrap table-striped align-middle">
                <thead>
                <tr>
                    <th>اسم الاسكوتر</th>
                    <th>نوع الاسكوتر</th>
                    <th>موديل الاسكوتر</th>
                    <th>لون الاسكوتر</th>
					 <th>ماركة الاسكوتر</th>
					 <th>سعر الساعة</th>
					 <th>الوصف</th>
					 <th>متاح</th>
					 <th>الصورة</th>
                     <th>Delete</th>
                </tr>
                </thead>
             
			  <tbody>
				
				
				
                <?php
                if ($selectScootersResult->num_rows > 0) {
                    while ($row = $selectScootersResult->fetch_assoc()) {
                    
                        ?>

                        <tr>
					
                            <th><?php echo $row['scooter_name'] ?></th>
                            <th><?php echo $row['scooter_type'] ?></th>
                            <th><?php echo $row['scooter_model'] ?></th>
							<th><?php echo $row['scooter_color'] ?></th>
                            <th><?php echo $row['scooter_brand'] ?></th>
							<th><?php echo $row['price_per_hour'] ?></th>
							<th><?php echo $row['description'] ?></th>
							<th>  <?php echo $row['availability']?'متاح':'غير متاح'?></th>
                            <th><img src="../<?php echo $row['scooter_image'] ?>" style="width: 100px;"></th>
                            <th>
                                <button class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#editModal<?php echo $row['scooter_id'] ?>"><i
                                            class="fa-light fa-edit"></i></button>
                               
                            </th>
                        </tr>


                        <div class="modal fade" id="editModal<?php echo $row['scooter_id'] ?>" tabindex="-1"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">تغيير اتاحة الاسكوتر </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">
										<input type="hidden" name="type" value="edit">
                                            <input type="hidden" name="scooter_id" value="<?php echo $row['scooter_id']?>">
                                           
										   
										   
                                            <div class="row">
                                                
													
							                        
                                                         <div class="form-check form-switch mt-3">
                                                            <label class="form-check-label"
                                                                   for="flexSwitchCheckDefault<?php echo $row['scooter_id'] ?>">غير
                                                                متاح</label>
                                                            <input class="form-check-input" type="checkbox"
                                                                   role="switch"
                                                                   name="availability" <?php echo $row['availability'] ? 'checked' : '' ?>
                                                                   value="1"
                                                                   id="flexSwitchCheckDefault<?php echo $row['scooter_id'] ?>">
                                                            <label class="form-check-label"
                                                                   for="flexSwitchCheckDefault<?php echo $row['scooter_id'] ?>">متاح</label>
                                                        </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


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
