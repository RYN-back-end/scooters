<?php
include __DIR__ . '/../system/core.php';
require('../helper.php');
checkAdminLogin();
$selectQuestionsSql = 'SELECT * FROM questions order by question_id  DESC';

$selectQuestionsResult = runQuery($selectQuestionsSql);


if (isset($_POST['type']) && isset($_POST['question_id']) && $_POST['type'] == 'edit')
{
    $insertSql = "UPDATE questions SET `question_answer` = '{$_POST['question_answer']}' WHERE `question_id` = '{$_POST['question_id']}'";
    runQuery($insertSql);
    header("Location: questions.php");
}

if (isset($_GET['method']) && $_GET['method'] == 'DELETE' && isset($_GET['question_id']))
{
    $deleteID = $_GET['question_id'];
    $sql = "DELETE FROM questions WHERE question_id = '{$deleteID}'";
    runQuery($sql);
    header('Location: questions.php');
}

?>
<!doctype html>
<html lang="ar" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
      data-sidebar-image="none">
<head>
    <meta charset="utf-8"/>
    <title>Questions</title>
    <?php
    include_once 'layout/assets/css.php';
    ?>
<body>
<div class="back">
    <a href="logout.php" class="btn"> logout </a>
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
            <h6>الاستفسارات</h6>
            
        </div>
        <div class="tableDiv">
            <table id="table" class="table datatable table-bordered dt-responsive nowrap table-striped align-middle">
                <thead>
                <tr>
				`
                    <th>اسم العميل</th>
					<th>الايميل</th>
					<th>رقم الهاتف</th>
					<th>موضوع الرسالة</th>
					<th>محتوى الرسالة</th>
					<th>تاريخ الرسالة</th>
                    <th>الرد</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
				<?php
                if ($selectQuestionsResult->num_rows > 0) {
                    while ($row = $selectQuestionsResult->fetch_assoc()) {
                    
                        ?>

                        <tr>
                            <th><?php echo $row['customer_name']?></th>
                             <th><?php echo $row['email']?></th>
							 <th><?php echo $row['phone']?></th>
							 <th><?php echo $row['subject']?></th>
							 <th><?php echo $row['question_content']?></th>
							 <th><?php echo $row['question_date']?></th>
							
							<th><button class="btn btn-info"  data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['question_id']?>"><i class="fa-light fa-edit"></i></button></th>
                            <th><a href="?method=DELETE&question_id=<?php echo $row['question_id']?>" class="btn btn-danger confirmation"><i class="fa-light fa-trash"></i></a></th>
                        </tr>
						
                        <div class="modal fade" id="editModal<?php echo $row['question_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                     

									 <h5 class="modal-title" id="exampleModalLabel">الرد </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="" method="POST">
                                        <div class="modal-body">
                                            <input type="hidden" name="type" value="edit">
										
                                             <input type="hidden" name="question_id" value="<?php echo $row['question_id']?>">
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="inputFeild">
                                                    <label for=""> الرد </label>
                                                    <input name="question_answer" type="text" class="form-control" required value="<?php echo $row['question_answer']?>"  placeholder="الرد">
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

                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>
</content>
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add City</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="type" value="new">
                    <div class="col-sm-12 col-lg-12">
                        <div class="inputFeild">
                            <label for="">Name</label>
                            <input name="city_name" type="text" class="form-control" required id="" placeholder="Name">
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

<?php
include_once 'layout/assets/js.php';
?>
</body>
</html>
