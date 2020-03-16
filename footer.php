       <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="index.php">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="profile.php">
                                Profile
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="https://devcrawlers.com/">DevCrawlers</a>, made with <span style="color:red">&hearts;</span> by Crawlers
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

        	demo.initChartist();

    	});
	</script>
    
    <script type="text/javascript">
        function updateScene(){
            $(".notypanel").load("header.php .notypanel>*");
        }
        function inviteCoffee(){
            $(".execs").load("header.php?invite=coffee .invitecoffee");
            updateScene();
            var msg = "You have invited the members to drink Coffee";
            $.notify({
                icon: "pe-7s-coffee",
                message: msg

            },{
                type: type[3],
                timer: 3000
            });
        }
        function confirmCoffee(idSender){
            if(confirm("Do you confirm this invitation?")){
                $(".execs").load("header.php?confirm=coffee .confirmcoffee");
                updateScene();
                var msg = "Your request has been sent!";
                $.notify({
                    icon: "pe-7s-coffee",
                    message: msg

                },{
                    type: type[3],
                    timer: 3000
                });   
            }
        }
        function setSeen(){
            $(".execs").load("header.php?seen=true .setseen");
            updateScene();
        }
        // fix
        $(document).ready(function(){
            setInterval(function(){
                $(".nbnoty").load("header.php .nbnoty>*");  
            }, 50000); 
        })
    </script>
</html>
