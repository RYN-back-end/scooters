<?php

include __DIR__ . 'system/core.php';
require('helper.php');
checkLogin();

$_SESSION['user'] =[];
header('Location: login.php?success=تم تسجيل الخروج بنجاح');