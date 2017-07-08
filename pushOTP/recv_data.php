<?php
header("Content-Type:application/json");
$rawinput=file_get_contents('php://input');
//echo $rawinput;
//file_put_contents('dpdp/'.date('Y-m-d-H-i-s').'.'.rand(100000,999999).'.txt', $rawinput);


$success_data = array (
						'statusInfo' => array (
												'statusCode' => '200',
												'referenceCode' => 'String',
												'serverReferenceCode' => 'String',
												'OTPTransactionId' => 'String ',
									    ),
				);
// $data_string = json_encode($success_data);	
// echo $data_string;	
$error_data = array (
					'statusInfo' => array (
						'statusCode' => '500',
						'referenceCode' => 'String',
						'serverReferenceCode' => 'String',
						'errorInfo' => 
							array (
							  'errorCode' => 'String',
							  'errorDescription' => 'String',
							),
					),
			);  				
$data_string = json_encode($error_data);	
echo $data_string;