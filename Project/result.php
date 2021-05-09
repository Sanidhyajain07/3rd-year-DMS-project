<?php
//error_reporting( 0 );
$conn=mysqli_connect("Localhost","root","","result") or die(mysql_error());


//enrolment no and RollNo entry 

$f=mysqli_query($conn,"select distinct E_no,RollNo,Year,Semester  from obtained_marks");
while($r=mysqli_fetch_array($f))
{
			print $r[0]  ."&nbsp;&nbsp;". $r[1] ."&nbsp;&nbsp;". $r[2] ."&nbsp;&nbsp;".$r[3]. "<br /><br/>";
		mysqli_query($conn,"insert into result (E_no,RollNo,Year,Semester)values('$r[0]',$r[1],'$r[2]','$r[3]') ");
		$no=0;
		$p=mysqli_query($conn,"select Subject_credit_points from obtained_marks where E_no='$r[0]' and RollNo=$r[1] and Year='$r[2]' and Semester='$r[3]' ");
		
		while($d=mysqli_fetch_array($p))
			{
			$no=$no+$d[0];
			}
/*
//Year and semester updation
		$y=mysql_query("select distinct Year,Semester from obtained_marks where E_no='$r[0]' and RollNo=$r[1] " );
		while($sem=mysql_fetch_array($y))
		{
			mysql_query("update result set Year='$sem[0]',Semester='$sem[1]' where E_no='$r[0]' and RollNo=$r[1]");
		}
*/
//Total_credit_obtained updation

		mysqli_query($conn,"update result set Total_credit_obtained=$no where E_no='$r[0]' and RollNo=$r[1] and Year='$r[2]' and Semester='$r[3]'  ");
			$no=0;
		$a=mysqli_query($conn,"select Subject_Name from obtained_marks where  E_no='$r[0]' and RollNo=$r[1] and Year='$r[2]' and Semester='$r[3]' ");
			while($d=mysqli_fetch_array($a))
			{
					$m=mysqli_query($conn,"select Total_cr from subject where Subject_Name='$d[0]'");
					$n=mysqli_fetch_array($m);
					$no=$no+$n[0];
			}

//Total_credit updation 
		
			mysqli_query($conn,"update result set Total_credit=$no where E_no='$r[0]' and RollNo=$r[1] and Year='$r[2]' and Semester='$r[3]' ");
			

// SGPA updation		

			mysqli_query($conn,"update result set SGPA=Total_credit_obtained/Total_credit where E_no='$r[0]' and RollNo='$r[1]'and Year='$r[2]' and Semester='$r[3]' ");
	
//Current Backlog_details updation	

			$backcr=" ";
			$pass=mysqli_query($conn,"select Course_No from obtained_marks where Subject_status!='pass' and E_no='$r[0]' and RollNo=$r[1] and Year='$r[2]' and Semester='$r[3]' ");
			$count1=0;
			while($a=mysqli_fetch_array($pass))
			{ //print $a[0]."<br/>";
				$backcr=$backcr.$a[0];
				$backcr=$backcr.",";
				$count1++;
			}
			
			mysqli_query($conn,"update result set Current_backlog='$backcr' where E_no='$r[0]' and RollNo=$r[1] and Year='$r[2]' and Semester='$r[3]' ");
		
//Backlog_details updation	

			$back=" ";
			$cr=0;
			//$pass=mysql_query("select Course_No from obtained_marks where Subject_status!='pass' and E_no='$r[0]' and RollNo>=$r[1]  ");
			
			if($r[3]=='2')
			{
			$pass=mysqli_query($conn,"select Course_No from obtained_marks where Subject_status!='pass' and E_no='$r[0]' and RollNo<=$r[1]  ");
			}
			else 
			{
			$pass=mysqli_query($conn,"select Course_No from obtained_marks where Subject_status!='pass' and E_no='$r[0]' and RollNo<$r[1]  ");
			$cr=1;
			}
			$count=0;
			
			while($a=mysqli_fetch_array($pass))
			{ //print $a[0]."<br/>";
				$back=$back.$a[0];
				$back=$back.",";
				$count++;
			//	echo $back;
			}
			
			if($cr==1)
			{
			$back=$back.$backcr;
			$count=$count+$count1;
			}
			mysqli_query($conn,"update result set Backlog_details='$back' where E_no='$r[0]' and RollNo=$r[1] and Year='$r[2]' and Semester='$r[3]' ");
			

	
//OGPA Updation		

			$no=0;
			$freq=0;
			
			if($r[3]=='2')
			{
						$OGPA=mysqli_query($conn,"select SGPA from result where E_no='$r[0]' and RollNo<=$r[1]");

			}
			else 
			{
						$OGPA=mysqli_query($conn,"select SGPA from result where E_no='$r[0]' and RollNo<$r[1]");

				$cr=1;
			}
			
			while($a=mysqli_fetch_array($OGPA))
			{
				$no=$no+$a[0];
				$freq++;
			//	echo "freq:=".$freq."<br/>";
			}
			//print $no;
			
			if($cr==1)
			{	
				$SGPA=mysqli_query($conn,"select SGPA from result where E_no='$r[0]' and RollNo=$r[1] and Semester='$r[3]'");
				//print $cr;
				$sgpa=mysqli_fetch_array($SGPA);
				$no=$no+$sgpa[0];
				$freq++;
			}
			
		/*	echo "total: = ".$no."<br/>";
			echo "freq: = ".$freq."<br/>";
		*/
			// average finding
			$no=$no/$freq;
		
		//	echo "average=".$no."<br/>";
			
			mysqli_query($conn,"update result set OGPA='$no' where E_no='$r[0]' and RollNo=$r[1] and Year='$r[2]' and Semester='$r[3]'");

			
//Final_STATUSofSEM updation	

			$pass=mysqli_query($conn,"select Course_No from obtained_marks where Subject_status!='pass' and E_no='$r[0]' and RollNo=$r[1] and Year='$r[2]' and Semester='$r[3]'");
			if($a=mysqli_fetch_array($pass))
			{
			mysqli_query($conn,"update result set Final_STATUSofSEM='fail' where E_no='$r[0]' and RollNo=$r[1] and Year='$r[2]' and Semester='$r[3]' ");
			
			}
			else 
			mysqli_query($conn,"update result set Final_STATUSofSEM='pass' where E_no='$r[0]' and RollNo=$r[1] and Year='$r[2]' and Semester='$r[3]' ");


//year_back_status updation	

			$back=" ";
			$temp=0;
			if($r[3]=='2')
				{
				$pass=mysqli_query($conn,"select Course_No from obtained_marks where Subject_status!='pass' and E_no='$r[0]' and RollNo<=$r[1] ");
				}
			else 
				{
				$pass=mysqli_query($conn,"select Course_No from obtained_marks where Subject_status!='pass' and E_no='$r[0]' and RollNo<$r[1] ");
				$temp=1;
				}
			$count=0;
			
			while($a=mysqli_fetch_array($pass))
			{ 
				$count++;
			}
			
			if($temp==1)
			{	
				$pass1=mysqli_query($conn,"select Course_No from obtained_marks where Subject_status!='pass' and E_no='$r[0]' and RollNo=$r[1] and Semester='$r[3]'");
				$a1=mysqli_fetch_array($pass1);
				if($a1[0])
				{	
			
					$pass1=mysqli_query($conn,"select Course_No from obtained_marks where Subject_status!='pass' and E_no='$r[0]' and RollNo=$r[1] and Semester='$r[3]'");
					
					while($a1=mysqli_fetch_array($pass1))
							{ 
								$count++;
							}
				 
				}
				
			}
			mysqli_query($conn,"update result set No_ofBack='$count' where E_no='$r[0]' and RollNo=$r[1] and Year='$r[2]' and Semester='$r[3]'");
			mysqli_query($conn,"update result set year_back_status='yes' where E_no='$r[0]' and RollNo=$r[1] and Year='$r[2]' and Semester='$r[3]' and $count>=9 ");
			mysqli_query($conn,"update result set year_back_status='no' where E_no='$r[0]' and RollNo=$r[1] and Year='$r[2]' and Semester='$r[3]' and $count<9");

			
	

}


//mysql_query('update result set ');

header('Location:adminOptions.php');
?>