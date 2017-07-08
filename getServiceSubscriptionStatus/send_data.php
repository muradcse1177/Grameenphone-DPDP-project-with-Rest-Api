<?php
//dpdp art 7.2.1 get charging Url request
$data = array (
			  'accesInfo' => array (
					'servicekey' => 'String',
					'endUserId' => 'String',
					'accesschannel' => 'String',
					'referenceCode' => 'String',
				)
		); 

$servicekey=$data['accesInfo']['servicekey'];
$endUserId=$data['accesInfo']['endUserId'];
$accesschannel=$data['accesInfo']['accesschannel'];
$referenceCode=$data['accesInfo']['referenceCode'];
                                                         
$data_string = json_encode($data);   
$ch = curl_init();
$url="http://localhost/DPDP/getServiceSubscriptionStatus/recv_data.php";

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
	$serviceIdentifier=$data_array['subscriptionInfo']['serviceIdentifier'];
	$productIdentifier=$data_array['subscriptionInfo']['productIdentifier'];
	$subscriptionId=$data_array['subscriptionInfo']['subscriptionId'];
	$subscriptionStatus=$data_array['subscriptionInfo']['subscriptionStatus'];
	$registrationDate=$data_array['subscriptionInfo']['registrationDate'];
	$activationDate=$data_array['subscriptionInfo']['activationDate'];
	$lastRenewalDate=$data_array['subscriptionInfo']['lastRenewalDate'];
	$nextRenewalDate=$data_array['subscriptionInfo']['nextRenewalDate'];
	$statusChargedDate=$data_array['subscriptionInfo']['statusChargedDate'];
	$lastChargedAmount=$data_array['subscriptionInfo']['lastChargedAmount'];
	$errorCode="NULL";
	$errorDescription="NULL";
}
 
if($data_array['statusInfo']['statusCode']==500){
	$statusCode=$data_array['statusInfo']['statusCode'];
	$referenceCode=$data_array['statusInfo']['referenceCode'];
	$serverReferenceCode=$data_array['statusInfo']['serverReferenceCode'];
	$serviceIdentifier="NULL";
	$productIdentifier="NULL";
	$subscriptionId="NULL";
	$subscriptionStatus="NULL";
	$registrationDate="NULL";
	$activationDate="NULL";
	$lastRenewalDate="NULL";
	$nextRenewalDate="NULL";
	$statusChargedDate="NULL";
	$lastChargedAmount="NULL";
	$errorCode=$data_array['statusInfo']['errorInfo']['errorCode'];
	$errorDescription=$data_array['statusInfo']['errorInfo']['errorDescription'];
}

$connection=mysqli_connect("localhost","root","","hvas");
//base table update korte hobe v_msisdn er sapakkhe
$sql="Insert into gp_subscriptionstatus (servicekey,msisdn,accesschannel,referenceCode,statuscode,serverReferenceCode,
	  svcidentifier,productidentifier,subscriptionid,substatus,registrationDate,activationDate,
	  lastrenewalDate,nextrenewalDate,statuschargedDate,lastchargedAmount,errorcode,errordescription) 
	  values('$servicekey','$endUserId','$accesschannel','$referenceCode','$statusCode','$serverReferenceCode',
	  '$serviceIdentifier','$productIdentifier','$subscriptionId','$subscriptionStatus','$registrationDate'
	  ,'$activationDate','$lastRenewalDate','$nextRenewalDate','$statusChargedDate','$lastChargedAmount',
	  '$errorCode','$errorDescription')";
$connection->query($sql);
echo $sql;






