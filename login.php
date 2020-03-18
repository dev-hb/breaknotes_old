<?php
include("config.php");

if(isset($_COOKIE['breaknoter'])){
    if($_COOKIE['breaknoter'] > 0){
        $_SESSION['breaknotes_id'] = $_COOKIE['breaknoter'];
        header("location: index.php");
        exit;
    }
}

if(isset($_SESSION['breaknotes_id'])){
    header("location: index.php");
    exit;
}

$msg = "";
if(isset($_POST['dologin'])){
    if($_POST['username']=="" || $_POST['pwd']==""){
        $msg = "<div class='alert alert-danger'>Please fill in all the fields then Sign In</div>";
    }else{
        if(mysqli_num_rows($conn->query("select * from users where username='{$_POST['username']}' or email_user='{$_POST['username']}'")) <= 0){
               $msg = "<div class='alert alert-danger'>Username/Email deos not exist</div>";
        }else{
            $pwd = md5($_POST['pwd']);
            if(mysqli_num_rows($conn->query("select * from users where pwd_user='$pwd' and (username='{$_POST['username']}' or email_user='{$_POST['username']}')")) <= 0){
                $msg = "<div class='alert alert-danger'>Email/Password Incorrect, Please try again</div>";
            }else{
                $res = $conn->query("select * from users where pwd_user='$pwd' and (username='{$_POST['username']}' or email_user='{$_POST['username']}')")->fetch_array();   
                if($res){
                    $_SESSION['breaknotes_id'] = $res['id_user'];
                    setcookie("breaknoter", $res['id_user'], time()+3600*60*24, "/");
                    header("location: index.php");
                    exit;
                }else{
                    $msg = "<div class='alert alert-danger'>Error fetching results, try later</div>";
                }
            }
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Break Notes</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet" />

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet" />


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>

<body>

    <div class="wrapper">
        <div class="sidebar" data-color="blue" data-image="assets/img/sidebar-5.jpg">

            <div class="sidebar-wrapper">
                <div class="logo">
                    <a href="index.php" class="simple-text">
                        BreakNotes
                    </a>
                </div>

                <ul class="nav">
                    <li class="">
                        <a href="login.php">
                            <i class="pe-7s-user"></i>
                            <p>Login</p>
                        </a>
                    </li>
                    <li class="">
                        <a href="register.php">
                            <i class="pe-7s-add-user"></i>
                            <p>Register</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">


            <div class="content">
                <div class="container-fluid">
                    <center>
                        <h1>
                            Share what you have
                        </h1>
                    </center>
                    <div class="row" style="margin-top:100px;">
                        <div class="col-md-6 col-md-offset-3">
                            <?php echo $msg;?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="card ">
                                <div class="header">
                                    <h4 class="title">Login To Your Account</h4>
                                    <p class="category"></p>
                                </div>
                                <div class="content">
                                    <form method="post">
                                        <div>
                                            <input type="text" class="form-control" name="username"
                                                placeholder="Username or Email" required>
                                        </div>
                                        <div style="margin-top:8px;margin-bottom:8px;">
                                            <input type="password" class="form-control" name="pwd"
                                                placeholder="Password" required>
                                        </div>
                                        <div>
                                            <button type="reset" class="btn btn-default pull-left">Reset</button>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-primary pull-right" name="dologin">Sign
                                                In</button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </form>

                                    <div class="footer">
                                        <hr>
                                        <div class="stats">
                                            <a href="register.php"><i class="fa fa-user"></i> Create New Account</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <?php include("footer.php"); ?>