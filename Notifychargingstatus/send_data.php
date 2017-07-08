<?php
//dpdp art 8.1.2 notify charging status
$data = array (
				'statusInfo' => array (
								'statusCode' => 'Stril',
								'referenceCode' => 'String1400',
								'serverReferenceCode' => 'Stri',
								'serverBatchReferenceCode' => 'Strfgghghjing',
								'totalAmountCharged' => '50.0'
						    )
		);                                                   
$data_string = json_encode($data);   
$ch = curl_init();
$url="http://localhost/DPDP/Notifychargingstatus/recv_data.php";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_string)));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response  = curl_exec($ch);
echo $response;
curl_close($ch);









