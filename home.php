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
                    <a class="brand" href="#">Member Home</a>
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
                                        <a tabindex="-1" href="history.php">History</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav">
                            <li class="active">
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
        
	<form class="form-signin" method="post">
        <h2 class="form-signin-heading">My Project</h2><hr />
        <input type="url" class="input-block-level" placeholder="Enter a url of item you wanna purchase" name="urlpurchase" required />
     	<hr />
        <button class="btn btn-large btn-primary" type="submit" name="btn-urlpurchase">Go for it!!</button>
        </form>

	<?php

	if(isset($_POST['btn-urlpurchase']))
	{
		$file = trim($_POST['urlpurchase']);
		$ch = curl_init();
		echo $file;
		curl_setopt($ch, CURLOPT_URL, $file);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
		$result = curl_exec($ch);
		$fp = fopen("/home/pavanreddy/Desktop/Codeforces/MyFile1.txt", 'w+'); // Create a new file, or overwrite the existing one.
		fwrite($fp, $result);
		fclose($fp);
		curl_close($ch);
		echo $result;	
		$user_home->redirect($file);		
		//$user_home->redirect('itempurchase.php');
	}
	
	?>

        <!--/.fluid-container-->
        <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/scripts.js"></script>
        
    </body>

</html>
