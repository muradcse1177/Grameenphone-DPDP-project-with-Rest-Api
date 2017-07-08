<?php
date_default_timezone_set('Asia/Dhaka');
$time=date("Y-m-d");
$time .= "%20".date("H:i:s");
$date=date("YmdHis");
$randNumber=md5( rand(10000000,999999999));
$referenceCode=$date.substr($randNumber,-18);
//dpdp art 10.2.2 Format
$data = array (
			  'accesInfo' => array (
					'servicekey' => 'String',
					'endUserId' => 'String',
					'accesschannel' => 'String',
					'OTPTransactionId' => 'String',
					'transactionPIN' => 'String',
					'referenceCode' => $referenceCode,
				),			  
			  'productInfo' => array (
					'id' => 'String',
					'type' => 'String',
					'title' => 'String',
					'thumbnailUrl' => 'String',					
					'downloadUrl' => 'String',
					'validity' => 'String',
				)
		); 

$servicekey=$data['accesInfo']['servicekey'];
$endUserId=$data['accesInfo']['endUserId'];
$accesschannel=$data['accesInfo']['accesschannel'];
$OTPTransactionId=$data['accesInfo']['OTPTransactionId'];
$transactionPIN=$data['accesInfo']['transactionPIN'];
$referenceCode=$data['accesInfo']['referenceCode'];
$contentid=$data['productInfo']['id'];
$type=$data['productInfo']['type'];
$title=$data['productInfo']['title'];
$thumbnailUrl=$data['productInfo']['thumbnailUrl'];
$downloadUrl=$data['productInfo']['downloadUrl'];
$validity=$data['productInfo']['validity'];
                                                          
$data_string = json_encode($data);   
$ch = curl_init();
$url="http://localhost/video/DPDP/chargeOTPTransaction/recv_data.php";

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

$sql="Insert into gp_chargetransaction (servicekey,msisdn,accesschannel,otptransactionid,transactionpin,
	  referenceCode,contentid,type,tittle,thumbnailUrl,downloadUrl,validity,statuscode,serverReferenceCode,
	  totalAmountCharged,errorcode,errordescription)
	  values('$servicekey','$endUserId','$accesschannel','$OTPTransactionId','$transactionPIN','$referenceCode',
	  '$contentid','$type','$title','$thumbnailUrl','$downloadUrl','$validity','$statusCode','$serverReferenceCode',
	  '$totalAmountCharged','$errorCode','$errorDescription')";
 $connection->query($sql);
 echo $sql;






