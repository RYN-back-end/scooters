<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "scooters";
$conn = new mysqli($servername, $username, $password, $database);


if (!function_exists('runQuery')) {
    function runQuery($query)
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "scooters";
        $conn = new mysqli($servername, $username, $password, $database);
        $conn->set_charset("utf8");

        return $conn->query($query);
    }
}
if (!function_exists('runOneQuery')) {
    function runOneQuery($query)
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "scooters";
        $conn = new mysqli($servername, $username, $password, $database);
        return $conn->query($query)->fetch_assoc();
    }
}

if (!function_exists('checkLogin')) {
    function checkLogin()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
//        session_start();
        if (!isset($_SESSION['user']['loggedin'])) {
            if (!str_contains($_SERVER['REQUEST_URI'],'Login.php') &&
                !str_contains($_SERVER['REQUEST_URI'],'register.php')){
                header('Location: Login.php');
            }
        }elseif(str_contains($_SERVER['REQUEST_URI'],'Login.php') ||
            str_contains($_SERVER['REQUEST_URI'],'register.php')){
            header('Location: index.php');
        }
        if (isset($_SESSION['user']['loggedin']))
        {
            $checkMyUserSql = "SELECT * FROM customer WHERE cust_id = '{$_SESSION['user']['cust_id']}'";
            $checkMyUserResult = runQuery($checkMyUserSql);
            if ($checkMyUserResult->num_rows <= 0 && $_SESSION['user']['loggedin'] == true)
            {
                $_SESSION['user'] = [];
                header('Location: Login.php');
            }
        }
    }
}
if (!function_exists('checkAdminLogin')) {
    function checkAdminLogin()
    {
        session_start();
        if (!isset($_SESSION['admin']['loggedin'])) {
            if (!str_contains($_SERVER['REQUEST_URI'], 'admin/login.php')) {
                header('Location: login.php');
            }
//            die('39');
        } elseif (str_contains($_SERVER['REQUEST_URI'], 'admin/login.php')) {
            header('Location: index.php');
        }
//        die('44');

        if (isset($_SESSION['admin']['loggedin'])) {
            $checkMyUserSql = "SELECT * FROM admin WHERE id = '{$_SESSION['admin']['id']}'";
            $checkMyUserResult = runQuery($checkMyUserSql);
            if ($checkMyUserResult->num_rows <= 0 && $_SESSION['admin']['loggedin'] == true) {
                $_SESSION['admin'] = [];
                header('Location: login.php');
            }
        }
    }
}
if (!function_exists('checkEmployeeLogin')) {
    function checkEmployeeLogin()
    {
        session_start();
        if (!isset($_SESSION['employee']['loggedin'])) {
            if (!str_contains($_SERVER['REQUEST_URI'], 'employee/login.php')) {
                header('Location: login.php');
            }
//            die('39');
        } elseif (str_contains($_SERVER['REQUEST_URI'], 'employee/login.php')) {
            header('Location: index.php');
        }
//        die('44');

        if (isset($_SESSION['employee']['loggedin'])) {
            $checkMyUserSql = "SELECT * FROM rent_employee WHERE employee_id = '{$_SESSION['employee']['employee_id']}'";
            $checkMyUserResult = runQuery($checkMyUserSql);
            if ($checkMyUserResult->num_rows <= 0 && $_SESSION['employee']['loggedin'] == true) {
                $_SESSION['employee'] = [];
                header('Location: login.php');
            }
        }
    }
}

if (!function_exists('checkDriverLogin')) {
    function checkDriverLogin()
    {
        session_start();
        if (!isset($_SESSION['driver']['loggedin'])) {
            if (!str_contains($_SERVER['REQUEST_URI'], 'driver/login.php')) {
                header('Location: login.php');
            }
//            die('39');
        } elseif (str_contains($_SERVER['REQUEST_URI'], 'driver/login.php')) {
            header('Location: index.php');
        }
//        die('44');

        if (isset($_SESSION['driver']['loggedin'])) {
            $checkMyUserSql = "SELECT * FROM delivery WHERE delivery_id = '{$_SESSION['driver']['delivery_id']}'";
            $checkMyUserResult = runQuery($checkMyUserSql);
            if ($checkMyUserResult->num_rows <= 0 && $_SESSION['driver']['loggedin'] == true) {
                $_SESSION['driver'] = [];
                header('Location: login.php');
            }
        }
    }
}


if (!function_exists('checkRestaurantLogin')) {
    function checkRestaurantLogin()
    {
        session_start();
        if (!isset($_SESSION['restaurant']['loggedin'])) {
            if (!str_contains($_SERVER['REQUEST_URI'], 'restaurant/login.php')) {
                header('Location: login.php');
            }
//            die('39');
        } elseif (str_contains($_SERVER['REQUEST_URI'], 'restaurant/login.php')) {
            header('Location: index.php');
        }
//        die('44');

        if (isset($_SESSION['restaurant']['loggedin'])) {
            $checkMyUserSql = "SELECT * FROM restaurants WHERE restaurant_id = '{$_SESSION['restaurant']['restaurant_id']}'";
            $checkMyUserResult = runQuery($checkMyUserSql);
            if ($checkMyUserResult->num_rows <= 0 && $_SESSION['restaurant']['loggedin'] == true) {
                $_SESSION['restaurant'] = [];
                header('Location: login.php');
            }
        }
    }
}
if (!function_exists('checkCompanyLogin')) {
    function checkCompanyLogin()
    {
        session_start();
        if (!isset($_SESSION['company']['loggedin'])) {
            if (!str_contains($_SERVER['REQUEST_URI'], 'company/login.php')) {
                header('Location: login.php');
            }
//            die('39');
        } elseif (str_contains($_SERVER['REQUEST_URI'], 'company/login.php')) {
            header('Location: index.php');
        }
//        die('44');

        if (isset($_SESSION['company']['loggedin'])) {
            $checkMyUserSql = "SELECT * FROM companies WHERE id = '{$_SESSION['company']['id']}'";
            $checkMyUserResult = runQuery($checkMyUserSql);
            if ($checkMyUserResult->num_rows <= 0 && $_SESSION['company']['loggedin'] == true) {
                $_SESSION['company'] = [];
                header('Location: login.php');
            }
        }
    }
}

//$setting = runQuery("SELECT * FROM setting")->fetch_assoc();
