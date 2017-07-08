<?php
//dpdp art 7.2.1 get charging Url request
$data = array (
			  'accesInfo' => array (
					'servicekey' => 'String',
					'accesschannel' => 'String',
				),
			  'charge' => array (
					'code' => 'String',
					'amount' => 'BigDecimal',
					'taxAmount' => 'BigDecimal',
					'description' => 'String',
					'currency' => 'String',
					'referenceCode' => 'String',
				),
			  'productInfo' => array (
					'id' => 'String',
					'type' => 'String',
					'title' => 'String',
					'thumbnailUrl' => 'String',
					'successUrl' => 'String',
					'failureUrl' => 'String',
					'cancelUrl' => 'String',
					'notifyUrl' => 'String',
					'downloadUrl' => 'String',
					'validity' => 'String',
				)
		); 

$servicekey=$data['accesInfo']['servicekey'];
$accesschannel=$data['accesInfo']['accesschannel'];
$code=$data['charge']['code'];
$amount=$data['charge']['amount'];
$taxAmount=$data['charge']['taxAmount'];
$description=$data['charge']['description'];
$currency=$data['charge']['currency'];
$referenceCode=$data['charge']['referenceCode'];
$contentid=$data['productInfo']['id'];
$type=$data['productInfo']['type'];
$title=$data['productInfo']['title'];
$thumbnailUrl=$data['productInfo']['thumbnailUrl'];
$successUrl=$data['productInfo']['successUrl'];
$failureUrl=$data['productInfo']['failureUrl'];
$cancelUrl=$data['productInfo']['cancelUrl'];
$notifyUrl=$data['productInfo']['notifyUrl'];
$downloadUrl=$data['productInfo']['downloadUrl'];
$validity=$data['productInfo']['validity'];

                                                          
$data_string = json_encode($data);   
$ch = curl_init();
$url="http://localhost/DPDP/GETchargingUrl/recv_data.php";

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_string)));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response  = curl_exec($ch);
curl_close($ch);
$data_array = json_decode($response,true);
// print_r($data_array);
// die();
if($data_array['statusInfo']['statusCode']==200){
	$statusCode=$data_array['statusInfo']['statusCode'];
	$referenceCode=$data_array['statusInfo']['referenceCode'];
	$serverReferenceCode=$data_array['statusInfo']['serverReferenceCode'];
	$chargeRedirectUrl=$data_array['statusInfo']['chargeRedirectUrl'];
	$errorCode="NULL";
	$errorDescription="NULL";
}

if($data_array['statusInfo']['statusCode']==500){
	$statusCode=$data_array['statusInfo']['statusCode'];
	$referenceCode=$data_array['statusInfo']['referenceCode'];
	$serverReferenceCode=$data_array['statusInfo']['serverReferenceCode'];
	$chargeRedirectUrl="NULL";
	$errorCode=$data_array['statusInfo']['errorInfo']['errorCode'];
	$errorDescription=$data_array['statusInfo']['errorInfo']['errorDescription'];
}

$connection=mysqli_connect("localhost","root","","hvas");
$sql="Insert into gp_chargingurl (servicekey,channel,code,amount,tax,description,currency,referenceCode,contentid, type,tittle,
      thumbnailUrl,successUrl,failureUrl,cancelUrl,notifyUrl,downloadUrl,validity,statuscode,serverReferenceCode,
	  chargeRedirectUrl,errorcode,errordescription)  values('$servicekey','$accesschannel','$code','$amount','$taxAmount',
	  '$description','$currency','$referenceCode','$contentid','$type','$title','$thumbnailUrl','$successUrl','$failureUrl',
	  '$cancelUrl','$notifyUrl','$downloadUrl','$validity','$statusCode','$serverReferenceCode',
	  '$chargeRedirectUrl','$errorCode','$errorDescription')";
$connection->query($sql);
echo $sql;









