<?php
include __DIR__ . '/../system/core.php';
require('../helper.php');
checkAdminLogin();
$selectٍScootersSql = 'SELECT * FROM scooter order by scooter_id  DESC';

$selectScootersResult = runQuery($selectٍScootersSql);


if (isset($_POST['type']) && isset($_POST['scooter_id']) && $_POST['type'] == 'edit') {


    $availability = isset($_POST['availability']) ? 1 : 0;

    $updateSql = "UPDATE scooter SET `scooter_name` = '{$_POST['scooter_name']}' ,`scooter_type` = '{$_POST['scooter_type']}' 
                     
                     ,`scooter_model` = '{$_POST['scooter_model']}' , `scooter_color` = '{$_POST['scooter_color']}' ,`scooter_brand` = '{$_POST['scooter_brand']}' ,`price_per_hour` = '{$_POST['price_per_hour']}' ,`description` = '{$_POST['description']}' ,`availability`={$availability} ";


    $imagePath = "";
    if (isset($_FILES['scooter_image']) && $_FILES['scooter_image']) {
        $errors = array();
        $file_name = (time() * 2) . '.jpg';
        $file_size = $_FILES['scooter_image']['size'];
        $file_tmp = $_FILES['scooter_image']['tmp_name'];
        $file_type = $_FILES['scooter_image']['type'];
        if ($file_size > 2097152) {
            header("Location: index.php?error=The image size must be less than 2MB");
        }
        if (move_uploaded_file($file_tmp, "../uploads/scooters/" . $file_name)) {
            $imagePath = "uploads/scooters/" . $file_name;
            $updateSql .= ", `scooter_image` = '{$imagePath}'";
        }
    }
    $updateSql .= "WHERE `scooter_id` = '{$_POST['scooter_id']}'";

    runQuery($updateSql);
    header("Location: index.php");
}

if (isset($_POST['type']) && $_POST['type'] == 'new') {
    $imagePath = "";
    if (isset($_FILES['scooter_image']) && $_FILES['scooter_image']) {
        $errors = array();
        $file_name = (time() * 2) . '.jpg';
        $file_size = $_FILES['scooter_image']['size'];
        $file_tmp = $_FILES['scooter_image']['tmp_name'];
        $file_type = $_FILES['scooter_image']['type'];
        if ($file_size > 2097152) {
            header("Location: index.php?error=The image size must be less than 2MB");
        }
        if (move_uploaded_file($file_tmp, "../uploads/scooters/" . $file_name)) {
            $imagePath = "uploads/scooters/" . $file_name;
        }
    }
    $availability = isset($_POST['availability']) ? 1 : 0;



    $insertSql = "INSERT INTO `scooter`(`scooter_name`, `scooter_type`, `scooter_model`, `scooter_color`, `scooter_brand`,  `price_per_hour`, `description`, `availability`,`scooter_image`) VALUES ('{$_POST['scooter_name']}','{$_POST['scooter_type']}','{$_POST['scooter_model']}','{$_POST['scooter_color']}','{$_POST['scooter_brand']}','{$_POST['price_per_hour']}','{$_POST['description']}','{$availability}','{$imagePath}')";
    runQuery($insertSql);
    header("Location: index.php");
}

if (isset($_GET['method']) && $_GET['method'] == 'DELETE' && isset($_GET['id'])) {
    $deleteID = $_GET['id'];
    $sql = "DELETE FROM scooter WHERE scooter_id = '{$deleteID}'";
    runQuery($sql);
    header('Location: index.php');
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
            <button class="btn customBtn" data-bs-toggle="modal" data-bs-target="#createModal"> اضافة اسكوتر جديد
            </button>
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
                                <a href="?method=DELETE&id=<?php echo $row['scooter_id'] ?>"
                                   class="btn btn-danger confirmation"><i class="fa-light fa-trash"></i></a>
                            </th>
                        </tr>


                        <div class="modal fade" id="editModal<?php echo $row['scooter_id'] ?>" tabindex="-1"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <input type="hidden" name="type" value="edit">
                                            <input type="hidden" name="scooter_id"
                                                   value="<?php echo $row['scooter_id'] ?>">
                                            <div class="row">
                                                <div class="col-sm-6 col-lg-4">
                                                    <div class="inputFeild">
                                                        <label for=""> اسم الاسكوتر </label>
                                                        <input name="scooter_name" type="text" class="form-control"
                                                               required value="<?php echo $row['scooter_name'] ?>"
                                                               placeholder="اسم الاسكوتر">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-lg-4">
                                                    <div class="inputFeild">
                                                        <label for=""> نوع الاسكوتر </label>
                                                        <input name="scooter_type" type="text"
                                                               class="form-control" required
                                                               value="<?php echo $row['scooter_type'] ?>"
                                                               placeholder="نوع الاسكوتر">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-lg-4">
                                                    <div class="inputFeild">
                                                        <label for=""> موديل الاسكوتر </label>
                                                        <input name="scooter_model" type="text"
                                                               class="form-control" required
                                                               value="<?php echo $row['scooter_model'] ?>"
                                                               placeholder="موديل الاسكوتر">
                                                    </div>
                                                </div>


                                                <div class="col-sm-12 col-lg-6">
                                                    <div class="inputFeild">
                                                        <label for=""> لون الاسكوتر </label>
                                                        <input name="scooter_color" type="text"
                                                               class="form-control" required
                                                               value="<?php echo $row['scooter_color'] ?>"
                                                               placeholder="لون الاسكوتر">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-lg-6">
                                                    <div class="inputFeild">
                                                        <label for=""> ماركة الاسكوتر </label>
                                                        <input name="scooter_brand" type="text"
                                                               class="form-control"
                                                               value="<?php echo $row['scooter_brand'] ?>"
                                                               placeholder="ماركة الاسكوتر">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-lg-6">
                                                    <div class="inputFeild">
                                                        <label for=""> سعر الساعة </label>
                                                        <input name="price_per_hour" type="number"
                                                               class="form-control" required
                                                               value="<?php echo $row['price_per_hour'] ?>"
                                                               placeholder="سعر ساعة التأجير">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-lg-6">
                                                    <div class="inputFeild">
                                                        <label for=""> الوصف </label>
                                                        <input name="description" type="text"
                                                               class="form-control" required
                                                               value="<?php echo $row['description'] ?>"
                                                               placeholder="الوصف">
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-lg-6 ">
                                                    <div class="inputFeild">
                                                        <!--                                                        <input name="availability" type="text"-->
                                                        <!--                                                               class="form-control" required-->
                                                        <!--                                                               value="-->
                                                        <?php //echo $row['availability'] ?><!--"-->
                                                        <!--                                                               placeholder="متاح">-->
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
                                                <div class="col-sm-12 col-lg-6">
                                                    <div class="inputFeild">
                                                        <label for=""> الصورة </label>
                                                        <input name="scooter_image" type="file"
                                                               class="form-control">
                                                    </div>
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

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">اضافة الاسكوتر</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="type" value="new">
                        <div class="row">
                            <div class="col-sm-6 col-lg-4">
                                <div class="inputFeild">
                                    <label for=""> اسم الاسكوتر </label>
                                    <input name="scooter_name" type="text" class="form-control"
                                           required value=""
                                           placeholder="اسم الاسكوتر">
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="inputFeild">
                                    <label for=""> نوع الاسكوتر </label>
                                    <input name="scooter_type" type="text"
                                           class="form-control" required
                                           value=""
                                           placeholder="نوع الاسكوتر">
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <div class="inputFeild">
                                    <label for=""> موديل الاسكوتر </label>
                                    <input name="scooter_model" type="text"
                                           class="form-control" required
                                           value=""
                                           placeholder="موديل الاسكوتر">
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="inputFeild">
                                    <label for=""> لون الاسكوتر</label>
                                    <input name="scooter_color" type="text"
                                           class="form-control" required
                                           value=""
                                           placeholder="لون الاسكوتر">
                                </div>
                            </div>

                            <div class="col-sm-12 col-lg-6">
                                <div class="inputFeild">
                                    <label for=""> ماركة الاسكوتر </label>
                                    <input name="scooter_brand" type="text"
                                           class="form-control" required
                                           value=""
                                           placeholder="ماركة الاسكوتر">
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="inputFeild">
                                    <label for=""> سعر الساعة </label>
                                    <input name="price_per_hour" type="number"
                                           class="form-control"
                                           required
                                           value=""
                                           placeholder="سعر ساعة التأجير">
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="inputFeild">
                                    <label for=""> الوصف </label>
                                    <input name="description" type="text"
                                           class="form-control"
                                           required
                                           value=""
                                           placeholder="الوصف">
                                </div>
                            </div>
                            <div class="col-sm12- col-lg-6">
                                <div class="inputFeild">
                                    <div class="form-check form-switch mt-3">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">غير متاح</label>
                                        <input class="form-check-input" type="checkbox" role="switch"
                                               name="availability" value="1" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">متاح</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="inputFeild">
                                    <label for=""> الصورة </label>
                                    <input name="scooter_image" required type="file" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</content>

<?php
include_once 'layout/assets/js.php';
?>
</body>
</html>
