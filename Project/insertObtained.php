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

<div class="wrapper row3"><br><br>
<h2 align="center">Upload Obtained Marks Record CSV File Format </h2>
<br>

	<?php
error_reporting( 0 );
$conn=mysqli_connect("Localhost","root","","result") or die(mysql_error());

echo "<!Doctype html>
<head>

	<meta charset='utf-8'>
	<title>Untitled</title>
	<link rel='stylesheet' type='text/css'/>
    <style type='text/css'>

        #name
        {
        //border:2px red ridge;
            position:absolute;
            top:40px;
            left:350px;
            font-size:24px;
            color:blue;
        }
        #links
        {
        //border:2px red ridge;
            position:absolute;
            top:150px;
            left:400px;
            font-size:20px;
        }
        #values
        {
        //border:2px red ridge;
            position:absolute;
            top:420px;
            left:400px;
            font-size:20px;
        }
        #label
        {
        //border:2px red ridge;
            position:absolute;
            top:240px;
            left:400px;
            font-size:23px;

        }
        #upload_file
        {
            position: absolute;
            top:400px;
            left: 300px;
        }
		#status
		{
			position:absolute;
			top:300px;
			left:700px;
			color:red;

		}

    </style>

</head>


<body>

        <center><form method='post' action='#' enctype='multipart/form-data'>
					<input type='text'&nbsp &nbsp/><input type='file' name='file' value='file' />
					<br/>
            <br/>

					<input type='submit' name='insert'  value='insert obtained_marks data'/>
					<input type='submit' name='cancel'  value='cancel'/>



			</form></center>

	<div id='status'>
	";
if(isset($_POST['insert']))
	{


		$file=$_FILES['file']['name'];


		if($file==NULL)
			{
			echo "please choose a file";
			}
		else if($file=="obtained.csv")
		{
		echo "file name:=".$file."<br/>";
		$handle=fopen($file,"r");
		//echo $handle;
		//print_r("<br/>");

		$count=0;
		$ct=0;
		$err=0;
		while(($fileop = fgetcsv($handle,1000,","))!==false)
			{
					if($count==0)
							{
								if($fileop[0]=='RollNo'&&$fileop[1]=='E_no'&&$fileop[2]=='Name'&&$fileop[3]=='Course_No'&& $fileop[4]=='Obtained_sem'&&$fileop[5]=='Obtained_mid'&&$fileop[6]=='Obtained_practical'&&$fileop[7]=='Year'&&$fileop[8]=='Semester')
									{
										$count=1;
										$ct++;
										continue;
									}
								else
									{
										echo "<br/>please enter valid data in file ";
										break;
									}
							}
		 $sql=mysqli_query($conn,"INSERT INTO obtained_marks(RollNo,E_no,Name,Course_No,Obtained_sem,Obtained_mid,Obtained_practical,Year,Semester)values($fileop[0],'$fileop[1]','$fileop[2]','$fileop[3]',$fileop[4],$fileop[5],$fileop[6],'$fileop[7]','$fileop[8]')");
			$ct++;
			 if($sql)
					{
						if($err==0)
						{
							echo 'data uplaoded successfully';
							header('location:ObtainCal.php');
						}
						else
						{
							echo "data entered from ".$ct ." no row of your csv file<br/>";
						}
					}
			else
					{
						$err++;
						echo "data duplicasy occur at ".$ct ." no row of your csv file<br/>";
					}

			}
	 }
	 }
else if(isset($_POST['cancel']))
	{
			header("location:upload_data.php");
	}



echo "</div></body>";

?>

</div>
<br>
<br>
<footer style="background-color:black">
  <br>
    <!-- ################################################################################################ -->
    <p style="text-align:center;color:white">Copyright &copy; 2020 - All Rights Reserved - <a href="#" style="color:#FFFFFF;">www.mpuat.ac.in</a></p>

    <!-- ################################################################################################ -->

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
