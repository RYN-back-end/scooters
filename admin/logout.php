<?php

include __DIR__ . '../system/core.php';
require('../helper.php');
checkAdminLogin();
$_SESSION['admin'] = [];
header('Location: login.php');