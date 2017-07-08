<?php
//dpdp art 13.1.2 notify charging status
$data = array (
				'accesInfo' => array (
										'servciekey' => 'String',
										'endUserId' => '8801729658389',
										'language' => 'String',
										'accesschannel' => 'String',
										'referenceCode' => 'String',
							    ),
				'subscriptionInfo' => array (
												'serviceIdentifier' => 'String',
												'productIdentifier' => 'String',
												'subscriptionId' => 'String',
												'subscriptionStatus' => 'alamin',
												'registrationDate' => 'String',
												'activationDate' => 'String',
												'lastRenewalDate' => 'String',
												'validity' => '1.0',
												'nextRenewalDate' => 'String',
												'statusChangedDate' => 'String',
												'lastChangedAmount' => '1.0',
									),
		);
                                                 
$data_string = json_encode($data);   
$ch = curl_init();
$url="http://localhost/DPDP/NotifyServiceSubscription/recv_data.php";
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_string)));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response  = curl_exec($ch);
echo $response;
curl_close($ch);









