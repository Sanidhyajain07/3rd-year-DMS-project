<!DOCTYPE html>

<html>
<head>
<title>MPUAT</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>



<style>
body {margin:0;}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: right;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
    background-color: #4CAF50;
    color: white;
}
* {box-sizing:border-box}
body {font-family: Verdana,sans-serif;}


</style>



<body background="images/3.jpg">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->

<div style="background-image: url(im.jpg)">
    <br>
    <h1 style="text-align:center;color:red;font-size:250%">MAHARANA PRATAP UNIVERSITY OF AGRICULTURE AND TECHNOLOGY</h1>
    <br><br><br><br><br><br><br><br><br><br>
</div>

      <div class="topnav">
        <a href="student_login.php">Student Result</a>
         <a href="admin_login.php"> Admin Logout</a>
        <a href="index.php">Home</a>
      </div>
<br>
<!-- End Top Background Image Wrapper -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3"><br><br>

<?php
//error_reporting( 0 );
$conn=mysqli_connect("Localhost","root","","result") or die(mysql_error());
//mysql_select_db("result",$conn);
$table="subject";

echo "<!DOCTYPE html>
<html>
<head lang='en'>
    <meta charset='UTF-8'>

    <title>show database data</title>

	<style type='text/css'>

		#name
		{
			//border:2px red ridge;
			position:fixed;
			top:40px;
			left:350px;
			font-size:24px;
			color:blue;
		}

		#show
		{
			//border:2px red ridge;
			position:absolute;
			top:250px;
			left:100px;
			//font-size:23px;
			//height:400px;
			width:97%;

		}
		table
		{
		position:relative;
		left:-40px;
		border:3px solid  black;
		border-collapse: collapse;
		width:80%;
		height:80px;

		}

		th, td {		font-weight:normal;
							border: 1px dashed white;
							border-collapse: collapse;
						}
		th, td {
					padding: 2px;
				}
		#tr1 {
					font-weight:bold;
							border: 1px solid black;
							border-collapse: collapse;
					padding: 5px;
				}
		#tr2 {
					font-weight:bold;
							border: 3px solid black;
							border-collapse: collapse;
					padding: 5px;
				}



	</style>

</head>
<body>

";
echo "<br><br>";
echo "<div id='show'>";
$stu=mysqli_query($conn,"select * from $table order by Sno");
echo "<table>";
echo " <tr id='tr2'>";
echo "<th id='tr2' colspan='14' align='center'>SUBJECT TABLE</th>";
echo "</tr>";

$f=mysqli_query($conn,"desc $table");
echo "<tr id='tr1'>";
while($pr=mysqli_fetch_array($f))
	{
		echo "<th id='tr1'>".$pr[0]."</th>";
	}
echo "</tr >";






while($p=mysqli_fetch_array($stu))
{
echo "<tr >";
for($i=0;$i<14;$i++)
{echo "<th>".$p[$i]."</th>";}


echo "</tr>";

}
echo "</table>";

print "</div>";
echo "</body> </html>";
?>
</div>
<br>
<footer style="background-color:black">
  <br>
    <!-- ################################################################################################ -->
    <p style="text-align:center;color:white">Copyright &copy; 2020 - All Rights Reserved - <a href="#" style="color:#FFFFFF;">www.mpuat.ac.in</a></p>

    <!-- ################################################################################################ -->
<br>
</footer>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
<!-- IE9 Placeholder Support -->
<script src="layout/scripts/jquery.placeholder.min.js"></script>
<!-- / IE9 Placeholder Support -->
</body>
</html>
