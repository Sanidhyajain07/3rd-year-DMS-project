<?php
session_start();
$uname=$_POST['uname'];
$pass=$_POST['pass'];
print $uname."<br/>";
print $pass."<br/>";
$db="result";
$tb="login";
//connection 
		$a=mysqli_connect('localhost','root','','result');
		if($a)
		{
		print "connected"."<br/>";
		}
		else
		{print "not connected "."<br/>";
		mysqli_error();
		}
//using db
		$c="USE $db";
		$udb=mysqli_query($a,$c);
		if($udb)
		{print "database used"."<br/>"; 
		}
		else
		{print "not used "."<br/>";
		mysql_error();
		}
//searching cum printing
//print "1st step executed";

		$d="SELECT * FROM $tb WHERE UserName='$uname' AND password='$pass';";
		print "1st step executed";

		$sr=mysqli_query($a,$d);
		print "2nd step executed";
		
		if($r=mysqli_fetch_array($sr))
			{ print "printing<br/>";
			
			$_SESSION['y']=$uname;
			setcookie("x" , "mydata" , time()+60);
			setcookie("name" , "$uname" );
			setcookie("name1" , "$pass" );
			 header('location:adminoptions.php');
			//setcookie("x" , "mydata" , time()+15);
			
			}
		else 
			{
			print " syntex problem";
			header('location:adminloginf.php');
			mysql_error();
			}

//closing db
mysql_close($a);
?>
