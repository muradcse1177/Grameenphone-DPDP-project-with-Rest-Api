<?php
//echo(microtime());
//echo $a= microtime_float();
function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

$time_start = microtime();

// //usleep(100);
microtime_float();
 $time_end = microtime();
 //$time = $time_end - $time_start;
echo $time_start.'<br>';
echo $time_end.'<br>'.'<br>'.'<br>';
//echo $time;

$time_start = microtime();
echo $a= md5( rand(100000000, 999999999)).'<br>';
echo substr($a,0,20).'<br>';
$time_end = microtime();
echo $time_start.'<br>';
echo $time_end.'<br>';

// $conn=mysqli_connect("localhost","root","","asad");

// for($i=0;$i<=600000;$i++){
	// $rand=rand(100000000, 999999999);
	// $sql = "INSERT INTO random (rand)VALUES('$rand')";
	// $conn->query($sql);
// }

