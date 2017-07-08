<?php
//dpdp art 12.2.1 get charging Url request
$data = array (
			  'accesInfo' => array (
					'servicekey' => 'String',
					'endUserId' => 'String',
					'accesschannel' => 'String',
					'referenceCode' => 'String',
				),
			  'subscriptionInfo' => array (
					'subscriptionId' => 'String',
				),
		); 
$servicekey=$data['accesInfo']['servicekey'];
$endUserId=$data['accesInfo']['endUserId'];
$accesschannel=$data['accesInfo']['accesschannel'];
$referenceCode=$data['accesInfo']['referenceCode'];
$subscriptionId=$data['subscriptionInfo']['subscriptionId'];

$data_string = json_encode($data);   
$ch = curl_init();
$url="http://localhost/DPDP/UnsubscribeSubscriber/recv_data.php";

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
	$subscriptionId=$data_array['subscriptionInfo']['subscriptionId'];
	$subscriptionStatus=$data_array['subscriptionInfo']['subscriptionStatus'];
	$validity=$data_array['subscriptionInfo']['validity'];
	$errorCode="NULL";
	$errorDescription="NULL";
}
                                                       

if($data_array['statusInfo']['statusCode']==500){
	$statusCode=$data_array['statusInfo']['statusCode'];
	$referenceCode=$data_array['statusInfo']['referenceCode'];
	$serverReferenceCode=$data_array['statusInfo']['serverReferenceCode'];
	$subscriptionId="NULL";
	$subscriptionStatus="NULL";
	$validity="NULL";
	$errorCode=$data_array['statusInfo']['errorInfo']['errorCode'];
	$errorDescription=$data_array['statusInfo']['errorInfo']['errorDescription'];
}
$connection=mysqli_connect("localhost","root","","hvas");
$sql="Insert into gp_unsubscribe_subscriber (servicekey,msisdn,accesschannel,referenceCode,subscriptionid,
	 statuscode,serverReferenceCode,subscriptionstatus,validity,errorcode,errordescription)
	 values('$servicekey','$endUserId','$accesschannel','$referenceCode','$subscriptionId','$statusCode',
	 '$serverReferenceCode','$subscriptionStatus','$validity','$errorCode','$errorDescription')";   
$connection->query($sql);
echo $sql;







