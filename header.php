<?php include("config.php");
if(! isset($_SESSION['breaknotes_id'])) {
    header("location: login.php");
    die;
}
$id_user = $_SESSION['breaknotes_id'];

if(isset($_GET['logout'])){
    logout();
    die;
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="apple-touch-icon" sizes="57x57" href="assets/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="assets/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

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
<!--  Prefered style  -->
<style type="text/css">
.linknotify{
    color:white;
    transition: all 0.2s ease;
    opacity: .7;
    cursor:pointer;
    transform: scale(0.8);
    margin-left:35;
}
.linknotify:hover{
    color:#fff;
    opacity: 1;
    transition: all 0.2s ease;
}.invites{cursor:pointer}
</style>
</head>
<body>

<div class="invitecoffee">
<?php
if(isset($_GET['invite'])){
    if($_GET['invite']=="coffee"){
        $conn->query("insert into notify values('', 'invite you to drink Coffee', $id_user, CURDATE(), CURTIME(), 'coffee', '#', '')");
    }  
}
?>
</div> 
<div class="confirmcoffee">
<?php
// fix
if(isset($_GET['confirm'])){
        $conn->query("insert into notify values('', 'confiremed your invitation <i class='fa fa-coffee'></i>', $id_user, CURDATE(), CURTIME(), 'info', '#', '')");
}
?>
</div>  
<div class="setseen">
<?php
if(isset($_GET['seen'])){
    $conn->query("update notify set seens=concat(seens, '|', '$id_user') where seens not like '%$id_user%'");
}
?>
</div>    

<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="assets/img/sidebar-5.jpg">

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="index.php" class="simple-text">
                   BreakNotes
                </a>
            </div>

            <ul class="nav">
                <li id="page_home">
                    <a href="index.php">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li id="page_profile">
                    <a href="profile.php">
                        <i class="pe-7s-user"></i>
                        <p>User Profile</p>
                    </a>
                </li>
                <li id="page_links">
                    <a href="links.php">
                        <i class="pe-7s-link"></i>
                        <p>My Links</p>
                    </a>
                </li>
                <li class="active-pro">
                    <a href="?logout=true">
                        <i class="pe-7s-door-lock"></i>
                        <p>Sign out</p>
                    </a>
                </li>
            </ul>
    	</div>
        <div class="execs"></div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="public.php"><i class="fa fa-globe"></i> Public Links</a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <p>
										Account
										<b class="caret"></b>
									</p>

                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="profile.php">Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="?logout=true">Log Out</a></li>
                              </ul>
                        </li>
						<li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>