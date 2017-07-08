<?php
header("Content-Type:application/json");
$rawinput=file_get_contents('php://input');
//file_put_contents('dpdp/'.date('Y-m-d-H-i-s').'.'.rand(100000,999999).'.txt', $rawinput);

$data_array = json_decode($rawinput,true);
$statusCode=$data_array['statusInfo']['statusCode'];
$referenceCode=$data_array['statusInfo']['referenceCode'];
$serverReferenceCode=$data_array['statusInfo']['serverReferenceCode'];
$serverBatchReferenceCode=$data_array['statusInfo']['serverBatchReferenceCode'];
$totalAmountCharged=$data_array['statusInfo']['totalAmountCharged'];

$connection=mysqli_connect("localhost","root","","hvas");
$sql="Update gp_chargingurl set poststatuscode='$statusCode',postserverReferenceCode='$serverReferenceCode',
	  serverBatchReferenceCode='$serverBatchReferenceCode',totalAmountCharged='$totalAmountCharged' where
	  referenceCode='$referenceCode'";
	  echo $sql;
$connection->query($sql);

$success_data = array (
						'statusInfo' => array (
												'statusCode' => "$statusCode",
												'referenceCode' => "$statusCode",
												'serverReferenceCode' => "$referenceCode",
								    ),
				);
$data_string = json_encode($success_data);	
echo $data_string;				