<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) ) {
		header("Location: index.php");
		exit;
	}
	// select loggedin users detail
	$res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
	$userRow=mysql_fetch_array($res);
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Welcome - <?php echo $userRow['userName']; ?></title>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<link rel="stylesheet" href="css/style2.css" type="text/css" />
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="home.php">Home</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="view.php">View Uploads</a></li>
            <li><a href="upload.php">Upload File</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['userName']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 
<div id="body"><br><br><br>
 <table width="80%" border="1">
    <tr>
    <th colspan="5"> My Uploads <br><label><a href="upload.php">Upload New Files...</a></label></th>
    </tr>
    <tr>
	<td><b>Time</b></td>
    <td><b>File Name</b></td>
    <td><b>File Type</b></td>
    <td><b>File Size(KB)</b></td>
    <td><b>View</b></td>
    </tr>
    <?php
 $sql="SELECT * FROM tbl_uploads where userId=".$_SESSION['user'];
 $result_set=mysql_query($sql);
 while($row=mysql_fetch_array($result_set))
 {
	 
	$file = $row['file'];
	$ext = pathinfo($file, PATHINFO_EXTENSION);


  ?>
        <tr>
		<td><?php echo $row['time'] ?></td>
        <td><?php echo $row['file'] ?></td>
        <td><?php echo strtoupper($ext); ?></td>
        <td><?php echo $row['size'] ?></td>
        <td><a href="uploads/<?php echo $row['file'] ?>" target="_blank">View File</a></td>
        </tr>
        <?php
 }
 ?>
    </table>
    
</div>

 <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>