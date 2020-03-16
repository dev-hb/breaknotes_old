<?php
include("config.php");
if(isset($_SESSION['breaknotes_id'])){
    header("location: index.php");
    exit;
}

$msg = "";
if(isset($_POST['doregister'])){
    if($_POST['nom']=="" || $_POST['prenom']=="" || $_POST['email']=="" || $_POST['pwd']=="" || $_POST['repwd']=="" || $_POST['username']==""){
        $msg = "<div class='alert alert-danger'>Please fill all the fields before register</div>";
    }else{
       if($_POST['pwd']!=$_POST['repwd']){
           $msg = "<div class='alert alert-danger'>Seems like the passwords are not the same</div>";
       }else{
           if(mysqli_num_rows($conn->query("select * from users where email_user='{$_POST['email']}' or username='{$_POST['username']}'"))>0){
               $msg = "<div class='alert alert-danger'>Username/Email already exists, try another one</div>";
           }else{
               $pwd = md5($_POST['pwd']);
               $res = $conn->query("insert into users (nom_user, prenom_user, email_user, pwd_user, username, avatar_user) values ('{$_POST['nom']}', '{$_POST['prenom']}', '{$_POST['email']}', '$pwd', '{$_POST['username']}', 'assets/img/avatars/avatar.png')");
               if($res){
                   $msg = "<div class='alert alert-success'>Your account has been created successfully, <a href='login.php'>Sign In Now</a></div>";
               }else{
                   $msg = "<div class='alert alert-danger'>Error while processing data, please try again</div>";
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

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>

    <link href="assets/css/demo.css" rel="stylesheet" />

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
                <div class="row" style="margin-top:150px;">
                    <div class="col-md-6 col-md-offset-3">
                        <?php echo $msg;?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Create a new Account</h4>
                                <p class="category"></p>
                            </div>
                            <div class="content">
                                <form method="post">
                                    <div>
                                        <input type="text" class="form-control" name="nom" placeholder="Last Name" required>
                                    </div>
                                    <div style="margin-top:8px;">
                                        <input type="text" class="form-control" name="prenom" placeholder="First Name" required>
                                    </div>
                                    <div style="margin-top:8px;">
                                        <input type="text" class="form-control" name="username" placeholder="Username" required>
                                    </div>
                                    <div style="margin-top:8px;">
                                        <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                                    </div>
                                    <div style="margin-top:8px;">
                                        <input type="password" class="form-control" name="pwd" placeholder="Password" required>
                                    </div>
                                    <div style="margin-top:8px;margin-bottom:10px;">
                                        <input type="password" class="form-control" name="repwd" placeholder="Re-type password" required>
                                    </div>
                                    <div>
                                        <button type="reset" class="btn btn-default pull-left">Reset</button>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-primary pull-right" name="doregister">Register</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>

                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        I already have an account, <a href="login.php">Sign In</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



<?php include("footer.php"); ?>