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

<br><br>


<h2 align="center">Upload Subject Record CSV File Format </h2>
        <div id='upload_file'><center>
        <form method='post' action='#' enctype='multipart/form-data'>
					<input type="text"><input type='file' name='file' value='file' />
					<br/>

					<input type='submit' name='insert'  value='insert subject data'/>
					<input type='submit' name='cancel'  value='cancel'/>
					<input type='submit' name='skip'  value='skip'/>


			</form></center>
	</div>

	<div id='status'>

<?php

error_reporting( 0 );
$conn=mysqli_connect("Localhost","root","","result") or die(mysql_error());


if(isset($_POST['insert']))
	{


		$file=$_FILES['file']['name'];


		if($file==NULL)
			{
			echo "please choose a file";
			}
		else if($file=="subject.csv")
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
							{ if($fileop[0]=='Subject_name'&&$fileop[1]=='Year'&&$fileop[2]=='Semester'&&$fileop[3]=='Credit_theory'&& $fileop[4]=='Credit_practical'&&$fileop[5]=='Course_No'&&$fileop[6]=='Max_marks')
								{$count=1;
								$ct++;
								continue;}
								else
								{
								echo "<br/>please enter valid data in file ";
								break;
								}
								}
					$sql=mysqli_query($conn,"INSERT INTO subject(Subject_Name,year,semester,Credit_theory,Credit_practical,Course_No,max_marks)values('$fileop[0]','$fileop[1]','$fileop[2]',$fileop[3],$fileop[4],'$fileop[5]',$fileop[6])");

					$ct++;
				 if($sql)
						{
						if($err==0)
						{echo 'data uplaoded successfully';
						 header('Location:subjectCal.php');
						//header("location:insertStudent.php");
						}
						else
						{
						echo "data entered from ".$ct ." no row of your csv file<br/>";
						}
						}
				else
				{		$err++;
						echo "data duplicasy occur at ".$ct ." no row of your csv file<br/>";
					}
			 }
		 }
		 else
		 {
		 echo "please enter valid file it should be named as subject.csv";
		 }
	}
else if(isset($_POST['cancel']))
	{
			header("location:upload_data.php");
	}

else if(isset($_POST['skip']))
	{
			header("location:insertStudent.php");
	}

echo "</div></body>";
?>





<br><br><br>
<br><br>

</div>

<br>
<footer style="background-color:black">
  <br>
    <!-- ################################################################################################ -->
    <p style="text-align:center;color:white">Copyright &copy; 2020 - All Rights Reserved - <a href="#" style="color:#FFFFFF;">www.mpuat.ac.in</a></p>

    <!-- ################################################################################################ -->
<
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
