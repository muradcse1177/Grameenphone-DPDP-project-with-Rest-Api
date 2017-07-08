<?php
//dpdp art 14.2.1 get charging Url request
$data = array (
			  'accesInfo' => array (
					'servciekey' => 'String',
					'endUserId' => 'String',
					'accesschannel' => 'String',
					'referenceCode' => 'String',
				),
		); 
		
$servciekey=$data['accesInfo']['servciekey'];
$endUserId=$data['accesInfo']['endUserId'];
$accesschannel=$data['accesInfo']['accesschannel'];
$referenceCode=$data['accesInfo']['referenceCode'];
                                                          
$data_string = json_encode($data);   
$ch = curl_init();
$url="http://localhost/video/DPDP/GetTransactionStatus/recv_data.php";

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_string)));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response  = curl_exec($ch);
curl_close($ch);
$data_array = json_decode($response,true);
if($data_array['statusInfo']['statusCode']==200){
	$statusCode=$data_array['statusInfo']['statusCode'];
	$referenceCode=$data_array['statusInfo']['referenceCode'];
	$serverReferenceCode=$data_array['statusInfo']['serverReferenceCode'];
	$totalAmountCharged=$data_array['statusInfo']['totalAmountCharged'];
	$errorCode="NULL";
	$errorDescription="NULL";
}

if($data_array['statusInfo']['statusCode']==500){
	$statusCode=$data_array['statusInfo']['statusCode'];
	$referenceCode=$data_array['statusInfo']['referenceCode'];
	$serverReferenceCode=$data_array['statusInfo']['serverReferenceCode'];
	$totalAmountCharged="NULL";
	$errorCode=$data_array['statusInfo']['errorInfo']['errorCode'];
	$errorDescription=$data_array['statusInfo']['errorInfo']['errorDescription'];
}


$connection=mysqli_connect("localhost","root","","hvas");
$sql="Insert into gp_gettransactionstatus (servicekey,msisdn,accesschannel,referenceCode,statuscode,
	  serverReferenceCode,totalAmountCharged,errorcode,errordescription) 
	  values('$servciekey','$endUserId','$accesschannel','$referenceCode','$statusCode','$serverReferenceCode',
	  '$totalAmountCharged','$errorCode','$errorDescription')";
$connection->query($sql);
echo $sql;







