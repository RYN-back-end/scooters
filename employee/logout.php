<?php

include __DIR__ . '../system/core.php';
require('../helper.php');
checkEmployeeLogin();
$_SESSION['employee'] = [];
header('Location: login.php');