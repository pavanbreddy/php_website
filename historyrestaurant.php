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
<html class="no-js">
    
    <head>
        <title><?php echo $row['userEmail']; ?></title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
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
			    <li>
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

	<?php 
		$servername = "127.0.0.1";
		$username = "root";
		$password = "";
		$dbname = "dbtest";
		$user = $row['userEmail'];

		// Create connection
		$connect = mysql_connect($servername, $username, $password);
		// Check connection
		if (!$connect) {
		    echo 'Could not connect to mysql';
		    exit;
		}
		if (!mysql_select_db($dbname, $connect)) {
		    echo 'Could not select database';
		    exit;
		}
		$sql = "SELECT * from restaurantBook where userID='$user'";
		//$connect->query($sql);
		$result = mysql_query($sql, $connect);
		
		if (!$result) {
		    echo "DB Error, could not query the database\n";
		    echo 'MySQL Error: ' . mysql_error();
		    exit;
		}
		echo "<table>";
		    echo "<tr>";
			echo "<th>Booking Time</th>";
			echo "<th>Restaurant Name</th>";
			echo "<th>Restaurant Address</th>";
			echo "<th>Cost</th>";
			echo "<th>Booking Details</th>";
		    echo "</tr>";
		while ($row = mysql_fetch_assoc($result)) {
		    echo "<tr>";
			echo "<td>" . $row['bookingtime'] . "</td>";
		        echo "<td>" . $row['restaurantName'] . "</td>";
		        echo "<td>" . $row['restaurantAddr'] . "</td>";
		        echo "<td>" . $row['cost'] . "</td>";
		        echo "<td>" . $row['rest_booking'] . "</td>";
		    echo "</tr>";
		}
		echo "</table>";
		mysql_free_result($result);

		//$connect->close();
	
	?>

</body>
</html>

