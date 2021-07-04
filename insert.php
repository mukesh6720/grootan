<?php
$con=mysqli_connect("localhost","root","","mukesh");
if($con)
{
	$file=$_FILES['csvfile']['tmp_name'];
	$handle=fopen($file,"r");
	$i=0;
	while(($cont=fgetcsv($handle,100000,","))!==false)
	{
		$table=rtrim($_FILES['csvfile']['name'],".csv");
		if($i==0)
		{
			$name=$cont[0];
			$dept=$cont[1];
			$rollno=$cont[2];
			$query="CREATE TABLE $table ($name VARCHAR(50),$dept VARCHAR(10),$rollno INT(5));";
			echo $query,"<br>";
			mysqli_query($con,$query);
		}
		else
		{
			$query="INSERT INTO $table ($name,$dept,$rollno) VALUES ('$cont[0]','$cont[1]','$cont[2]');";
			echo $query,"<br>";
			mysqli_query($con,$query);
		}
		$i++;
	}
}
else
{
	echo"connection failed";
}
?>