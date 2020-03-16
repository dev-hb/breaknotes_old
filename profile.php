<?php include("header.php");

$msg = "";
if(isset($_POST['doupdate'])){
    if($_POST['username']=="" || $_POST['pwd']==""){
        $msg = "<font color=red>Username & password are required</font>";
    }else{
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $username = $_POST['username'];
        $pwd = md5($_POST['pwd']);
        $city = $_POST['city'];
        $zip = $_POST['zip'];
        $country = $_POST['country'];
        $address = $_POST['address'];
        $about = $_POST['about'];
        $res = $conn->query("update users set nom_user='$nom', prenom_user='$prenom', username='$username', pwd_user='$pwd', city_user='$city',country_user='$country',address_user='$address',about_user='$about', zip_user='$zip' where id_user=$id_user");
        if($res){
            $msg = "<font color=green>Your profile has been edited successfully</font>";
        }else{
            $msg = "<font color=red>Cannot edit the profile, please try again</font>";
        }
    }
}
$user = $conn->query("select * from users where id_user=$id_user")->fetch_array();
?>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="content">
                                <form method="post">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Company (disabled)</label>
                                                <input type="text" class="form-control" name="company" disabled placeholder="Company" value="<?php echo $user['company_user'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo $user['username'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Password</label>
                                                <input type="password" class="form-control" name="pwd" value="" placeholder="Password">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" name="prenom" placeholder="Company" value="<?php echo $user['prenom_user'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" name="nom" placeholder="Last Name" value="<?php echo $user['nom_user'];?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input type="text" class="form-control" name="address" placeholder="Home Address" value="<?php echo $user['address_user']?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" class="form-control" name="city" placeholder="City" value="<?php echo $user['city_user'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <input type="text" class="form-control" name="country" placeholder="Country" value="<?php echo $user['country_user'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Postal Code</label>
                                                <input type="number" class="form-control" name="zip" placeholder="ZIP Code" value="<?php echo $user['zip_user'];?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>About Me</label>
                                                <textarea rows="5" class="form-control" name="about" placeholder="Here can be your description"><?php echo $user['about_user'];?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <label class="pull-left"><?php echo $msg;?></label>
                                    <button type="submit" class="btn btn-info btn-fill pull-right" name="doupdate">Update Profile</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="image">
                                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                     <a href="#">
                                    <img class="avatar border-gray" src="assets/img/avatars/avatar.png" alt="..."/>

                                      <h4 class="title"><?php echo $user['prenom_user'].' '.$user['nom_user'];?><br />
                                         <small><?php echo $user['username'];?></small>
                                      </h4>
                                    </a>
                                </div>
                                <p class="description text-center"> <?php echo $user['about_user'];?>
                                </p>
                            </div>
                            <hr>
                            <div class="text-center">
                                <button href="#" class="btn btn-simple"><i class="fa fa-facebook-square"></i></button>
                                <button href="#" class="btn btn-simple"><i class="fa fa-twitter"></i></button>
                                <button href="#" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></button>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    $('#page_profile').attr('class', 'active');
})
</script>

</html>
