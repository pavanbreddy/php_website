<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Login | Coding Cage</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
<body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="home.php">Member Home</a>
                    <div class="nav-collapse collapse">
                       <ul class="nav pull-right">
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> 
								<?php echo $row['userEmail']; ?> <i class="caret"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a tabindex="-1" href="logout.php">Logout</a>
                                    </li>
				    <li>
                                        <a tabindex="-2" href="history.php">History</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li>
                                <a href="http://127.0.0.1/signup-email-verification/home.php">Enter URL to Purchase</a>
                            </li>
			    <li class="active">
                                <a href="http://127.0.0.1/signup-email-verification/hotels.php">Hotels</a>
                            </li>
			    <li>
                                <a href="http://127.0.0.1/signup-email-verification/restaurantbook.php">Restaurant</a>
                            </li>
			    <li>
                                <a href="http://127.0.0.1/signup-email-verification/ticketbook.php">Ticket</a>
                            </li>
			    <li>
                                <a href="http://127.0.0.1/signup-email-verification/walletrech.php">Wallet</a>
                            </li>
                        </ul>
                    </div>
                    <!--/.nav-collapse -->
                </div>
            </div>
        </div>
	

	<form class="form-signin" method="post">
        <h2 class="form-signin-heading">Book a Hotel</h2><hr />
        Hotel Name: <input type="text" class="input-block-level" placeholder="Enter the name of hotel you wanna book" name="hotelname" required />
	Address of hotel: <input type="text" class="input-block-level" placeholder="Enter address of hotel you wanna book" name="hoteladdr" required />
	Cost: <input type="number" class="input-block-level" placeholder="Enter estimated cost of booking" name="cost" required />
	Details of booking: <input type="text" class="input-block-level" placeholder="Enter details of booking" name="booking" required />
     	<hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-hotelbook">Go for it!!</button>
        </form>

	<?php
	
	if(isset($_POST['btn-hotelbook']))
	{	
		$servername = "127.0.0.1";
		$username = "root";
		$password = "";
		$dbname = "dbtest";
		$user = $row['userEmail'];

		// Create connection
		$connect = mysqli_connect($servername, $username, $password, $dbname);
		// Check connection
		if (!$connect) {
		    die("Connection failed: " . mysqli_connect_error());
		}
		$hotelname = $_POST['hotelname'];
		$hoteladdr = $_POST['hoteladdr'];
		$booking = $_POST['booking'];
		$cost = $_POST['cost'];
		date_default_timezone_set('Asia/Kolkata');
		$bookingtime = date('Y/m/d a h:i:s', time());
		mysqli_query($connect,"INSERT INTO hotelBook (userid,hotelName,hotelAddr,booking,cost,bookingtime)
		        VALUES ('$user','$hotelname','$hoteladdr','$booking','$cost','$bookingtime')");
				
		if(mysqli_affected_rows($connect) > 0){
			echo "<p>Order Added</p>";
			echo "<a href='bookingsuccess.php'>Go Back</a>";
			$user_home->redirect('bookingsuccess.php');
		} else {
			echo "Order NOT Added<br />";
			echo mysqli_error ($connect);
			//$user_home->redirect('hotels.php');
		}
	}
	
	?>
   </body>
</html>

