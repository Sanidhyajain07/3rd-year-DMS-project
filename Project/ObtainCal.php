<?php
//error_reporting( 0 );
$conn=mysqli_connect("Localhost","root","","result") or die(mysql_error());

mysqli_query($conn,'update obtained_marks set Total_Obtained_theory=Obtained_sem+Obtained_mid ');
mysqli_query($conn,'update obtained_marks set Subject_total=Obtained_practical+Total_Obtained_theory ');
mysqli_query($conn,'update obtained_marks set Subject_Name=(select Subject_Name from subject where subject.Course_No=obtained_marks.Course_No) ');
mysqli_query($conn,'update obtained_marks set Subject_grade_points=0.1*Subject_total');
mysqli_query($conn,'update obtained_marks set Subject_credit_points=Subject_grade_points*(select Total_cr from subject where subject.Course_No=obtained_marks.Course_No )');
mysqli_query($conn,"update obtained_marks set Subject_status='pass' where Total_Obtained_theory>=(select Passing_th from subject where subject.Course_No=obtained_marks.Course_No)and Obtained_practical>=(select Passing_pr from subject where subject.Course_No=obtained_marks.Course_No)");
mysqli_query($conn,"update obtained_marks set Subject_status='fth' where Total_Obtained_theory<(select Passing_th from subject where subject.Course_No=obtained_marks.Course_No) ");
mysqli_query($conn,"update obtained_marks set Subject_status='fpr' where Obtained_practical<(select Passing_pr from subject where subject.Course_No=obtained_marks.Course_No) ");
mysqli_query($conn,"update obtained_marks set Subject_status='fail' where Total_Obtained_theory<(select Passing_th from subject where subject.Course_No=obtained_marks.Course_No)and Obtained_practical<(select Passing_pr from subject where subject.Course_No=obtained_marks.Course_No)");
$r=mysqli_query($conn,"select distinct E_no from obtained_marks ");
while($enr=mysqli_fetch_array($r))
{/*echo "<br/>";
	echo "<br/>";
	print_r($enr);
    echo "<br/>";
	*/
	$p=mysqli_query($conn,"select Course_No from obtained_marks where E_no='$enr[0]'");
	while($csr=mysqli_fetch_array($p))
	{
	/*echo "<br/>";
		print_r($csr);
    echo "<br/>";
		*/	
		$a=mysqli_query($conn,"select Year,Semester from subject where Course_No='$csr[0]' ");
			while($yr=mysqli_fetch_array($a))
			{ 
			/*print_r($yr);
			echo "<br/>";
			echo $csr[0]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			echo $enr[0]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			echo $yr[0]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			echo $yr[1]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			*/
			mysqli_query($conn,"update obtained_marks set Year='$yr[0]',Semester='$yr[1]' where E_no='$enr[0]' and Course_no='$csr[0]'");


			}
			
	}
}
/*mysql_query('update obtained_marks set Passing_th=0.40*max_th');
mysql_query('update obtained_marks set Passing_th=0.40*(max_th+max_mid)');
mysql_query('update obtained_marks set Passing_pr=0.40*max_pr');
mysql_query('update obtained_marks set Total_cr=Credit_theory+Credit_practical');
mysql_query('update obtained_marks set Passing_pr=0.40*max_pr');
*/
header('Location:result.php');
?>

