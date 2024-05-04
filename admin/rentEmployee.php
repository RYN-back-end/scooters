<?php
include __DIR__ . '/../system/core.php';
require('../helper.php');
checkAdminLogin();
$selectEmployeeSql = 'SELECT * FROM rent_employee order by employee_id DESC';
$selectEmployeeResult = runQuery($selectEmployeeSql);


if (isset($_POST['type']) && isset($_POST['employee_id']) && $_POST['type'] == 'edit') {
    $updateSql = "UPDATE rent_employee SET `employee_name` = '{$_POST['employee_name']}' ,`employee_address` = '{$_POST['employee_address']}' 
                     
                     ,`employee_phone` = '{$_POST['employee_phone']}' , `employee_mail` = '{$_POST['employee_mail']}' ";

    if (isset($_POST['employee_password'])) {
        if ($_POST['employee_password'] != '') {
            $password = password_hash($_POST['employee_password'], PASSWORD_DEFAULT);
            $updateSql .= ", `employee_password` = '{$password}'";
        }
    }

    $updateSql .= "WHERE `employee_id` = '{$_POST['employee_id']}'";

    runQuery($updateSql);
    header("Location: rentEmployee.php");
}

if (isset($_POST['type']) && $_POST['type'] == 'new') {

    $password = password_hash($_POST['employee_password'], PASSWORD_DEFAULT);

    $insertSql = "INSERT INTO `rent_employee`(`employee_name`, `employee_address`, `employee_phone`, `employee_mail`, `employee_password`) VALUES ('{$_POST['employee_name']}','{$_POST['employee_address']}','{$_POST['employee_phone']}','{$_POST['employee_mail']}','{$password}')";
    runQuery($insertSql);
    header("Location: rentEmployee.php");
}

if (isset($_GET['method']) && $_GET['method'] == 'DELETE' && isset($_GET['id'])) {
    $deleteID = $_GET['id'];
    $sql = "DELETE FROM rent_employee WHERE employee_id = '{$deleteID}'";
    runQuery($sql);
    header('Location: rentEmployee.php');
}


?>
<!doctype html>
<html lang="ar" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
      data-sidebar-image="none">
<head>
    <meta charset="utf-8"/>
    <title>موظفين التأجير</title>
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
            <h6>موظفين التأجير</h6>
            <button class="btn customBtn" data-bs-toggle="modal" data-bs-target="#createModal">اضافة موظف تأجير جديد</button>
        </div>
        <div class="tableDiv">
            <table id="table" class="table datatable table-bordered dt-responsive nowrap table-striped align-middle">
                <thead>
                <tr>
                    <th> اسم الموظف </th>
                    <th>العنوان</th>
                    <th> رقم الهاتف </th>
                    <th> اسم المستخدم </th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($selectEmployeeResult->num_rows > 0) {
                    while ($row = $selectEmployeeResult->fetch_assoc()) {
                        
                        ?>

                        <tr>
                            <th><?php echo $row['employee_name'] ?></th>
                            <th><?php echo $row['employee_address'] ?></th>
                            <th><?php echo $row['employee_phone'] ?></th>
                            <th><?php echo $row['employee_mail'] ?></th>
                            <th>
                                <button class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#editModal<?php echo $row['employee_id'] ?>"><i
                                            class="fa-light fa-edit"></i></button>
                                <a href="?method=DELETE&id=<?php echo $row['employee_id'] ?>"
                                   class="btn btn-danger confirmation"><i class="fa-light fa-trash"></i></a>
                            </th>
                        </tr>


                        <div class="modal fade" id="editModal<?php echo $row['employee_id'] ?>" tabindex="-1"
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
                                            <input type="hidden" name="employee_id"
                                                   value="<?php echo $row['employee_id'] ?>">
                                            <div class="row">
                                                <div class="col-sm-6 col-lg-4">
                                                    <div class="inputFeild">
                                                        <label for=""> اسم موظف التأجير </label>
                                                        <input name="employee_name" type="text" class="form-control"
                                                               required value="<?php echo $row['employee_name'] ?>"
                                                               placeholder="Name">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-lg-4">
                                                    <div class="inputFeild">
                                                        <label for=""> العنوان </label>
                                                        <input name="employee_address" type="text"
                                                               class="form-control" required
                                                               value="<?php echo $row['employee_address'] ?>"
                                                               placeholder="Address">
                                                    </div>
                                                </div>
                                                <div class="col-sm- col-lg-4">
                                                    <div class="inputFeild">
                                                        <label for=""> رقم الهاتف </label>
                                                        <input name="employee_phone" type="text"
                                                               class="form-control" required
                                                               value="<?php echo $row['employee_phone'] ?>"
                                                               placeholder="Phone">
                                                    </div>
                                                </div>
                                                 <div class="col-sm- col-lg-4">
                                                    <div class="inputFeild">
                                                        <label for=""> اسم المستخدم </label>
                                                        <input name="employee_mail" type="text"
                                                               class="form-control" required
                                                               value="<?php echo $row['employee_mail'] ?>"
                                                               placeholder="Phone">
                                                    </div>
                                                </div>

                                             
                                                <div class="col-sm-4 col-lg-4">
                                                    <div class="inputFeild">
                                                        <label for=""> Password </label>
                                                        <input name="employee_password" type="password"
                                                               class="form-control"
                                                               value=""
                                                               placeholder="Password">
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
                    <h5 class="modal-title" id="exampleModalLabel"> اضافة موظف التأجير </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="type" value="new">
                        <div class="row">
                            <div class="col-sm-6 col-lg-4">
                                <div class="inputFeild">
                                    <label for=""> اسم موظف التأجير </label>
                                    <input name="employee_name" type="text" class="form-control"
                                           required value=""
                                           placeholder="Name">
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="inputFeild">
                                    <label for=""> العنوان </label>
                                    <input name="employee_address" type="text"
                                           class="form-control" required
                                           value=""
                                           placeholder="Address">
                                </div>
                            </div>
                            <div class="col-sm-4 col-lg-4">
                                <div class="inputFeild">
                                    <label for=""> Phone </label>
                                    <input name="employee_phone" type="text"
                                           class="form-control" required
                                           value=""
                                           placeholder="Phone">
                                </div>
                            </div>
                            
                            <div class="col-sm-4 col-lg-4">
                                <div class="inputFeild">
                                    <label for=""> اسم المستخدم </label>
                                    <input name="employee_mail" type="text"
                                           class="form-control" required
                                           value=""
                                           placeholder="User Name">
                                </div>
                            </div>
                            <div class="col-sm-4 col-lg-4">
                                <div class="inputFeild">
                                    <label for=""> Password </label>
                                    <input name="employee_password" type="password"
                                           class="form-control"
                                           required
                                           value=""
                                           placeholder="Password">
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
