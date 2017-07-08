<?php
date_default_timezone_set("Asia/Dhaka");
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
for($i=0;$i<=600000;$i++){
	$date=date("YmdHis");
	$a=md5( rand(100000000, 999999999));
	$rand=$date.substr($a,-25).",\n";
	// echo $rand;
	// die();
	fwrite($myfile, $rand);
	usleep(5);
}