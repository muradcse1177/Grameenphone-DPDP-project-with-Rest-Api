<?php

    $files = glob("E:/xampp/htdocs/video/DPDP/smlog/*.txt");
    $output = "result.txt";

    foreach($files as $file) {
		$fil= date("Y-m-d H:i:s.",filemtime($file));
        $content = file_get_contents($file);
		$result=json_decode($content,true);
		$MSISDN=  $result["subscriptionInfoList"][0]["subscriptionInfo"][0]["msisdn"];
		$status=  $result["subscriptionInfoList"][0]["subscriptionInfo"][0]["status"];
		$con=mysqli_connect("localhost","root","","hvas");
		$sql="Insert into gp_sub (msisdn,status,time) values('$MSISDN','$status','$fil')";
		$con->query($sql);
        file_put_contents($output, $content, FILE_APPEND);
    }

?>