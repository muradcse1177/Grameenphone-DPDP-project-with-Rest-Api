<?php
header("Content-Type:application/json");
$rawinput=file_get_contents('php://input');
//file_put_contents('dpdp/'.date('Y-m-d-H-i-s').'.'.rand(100000,999999).'.txt', $rawinput);

$data_array = json_decode($rawinput,true);

$servciekey=$data_array['accesInfo']['servciekey'];
$endUserId=$data_array['accesInfo']['endUserId'];
$language=$data_array['accesInfo']['language'];
$accesschannel=$data_array['accesInfo']['accesschannel'];
$referenceCode=$data_array['accesInfo']['referenceCode'];
$serviceIdentifier=$data_array['subscriptionInfo']['serviceIdentifier'];
$productIdentifier=$data_array['subscriptionInfo']['productIdentifier'];
$subscriptionId=$data_array['subscriptionInfo']['subscriptionId'];
$subscriptionStatus=$data_array['subscriptionInfo']['subscriptionStatus'];
$registrationDate=$data_array['subscriptionInfo']['registrationDate'];
$activationDate=$data_array['subscriptionInfo']['activationDate'];
$lastRenewalDate=$data_array['subscriptionInfo']['lastRenewalDate'];
$validity=$data_array['subscriptionInfo']['validity'];
$nextRenewalDate=$data_array['subscriptionInfo']['nextRenewalDate'];
$statusChangedDate=$data_array['subscriptionInfo']['statusChangedDate'];
$lastChangedAmount=$data_array['subscriptionInfo']['lastChangedAmount'];

$connection=new mysqli("localhost","root","","hvas");
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
$sql="Select MSISDN from subscription where MSISDN = '$endUserId'";
$result = $connection->query($sql);
if ($result->num_rows > 0){
	$row = $result->fetch_assoc();
	$vmsisdn=$row['MSISDN'];	
	if ($subscriptionStatus == "subscribed" || $subscriptionStatus == "active"){
		$up_sql = "Update gp_subscription set productidentifier='$productIdentifier',
		subscriptionid='$subscriptionId',subscriptionstatus='$subscriptionStatus',registrationdate='$registrationDate', 
		activationdate='$activationDate',lastrenewdate='$lastRenewalDate',validity='$validity',
		nextrenewdate='$nextRenewalDate',statuschangeddate='$statusChangedDate', flag=2 where enduserid='$vmsisdn'";
		$connection->query($up_sql);
		echo $up_sql;
	}
	else{
		$up_sql = "Update gp_subscription set productidentifier='$productIdentifier',
		subscriptionid='$subscriptionId',subscriptionstatus='$subscriptionStatus',registrationdate='$registrationDate', 
		activationdate='$activationDate',lastrenewdate='$lastRenewalDate',validity='$validity',
		nextrenewdate='$nextRenewalDate',statuschangeddate='$statusChangedDate', flag=0 where enduserid='$vmsisdn'";
		$connection->query($up_sql);
		echo $up_sql;		
	}
}
else{
	$insert_sql = "Insert into gp_subscription (enduserid,productidentifier,subscriptionid,subscriptionstatus,
	registrationdate,activationdate,lastrenewdate,validity,nextrenewdate,statuschangeddate,flag) 
	values('$endUserId','$productIdentifier','$subscriptionId','$subscriptionStatus','$registrationDate',
	'$activationDate','$lastRenewalDate','$validity','$nextRenewalDate','$statusChangedDate','0')";
	$connection->query($insert_sql);
	echo $insert_sql;
}
$sql="Insert into gp_notification (servciekey,msisdn,language,accesschannel,servrefcode,serviceidentifier,
	  productidentifier,subscriptionid,substatus,registrationDate,activationDate,lastrenewalDate,validity,
	  nextrenewalDate,statuschangedDate,lastchangedAmount) 
	  values('$servciekey','$endUserId','$language','$accesschannel','$referenceCode','$serviceIdentifier',
	  '$productIdentifier','$subscriptionId','$subscriptionStatus','$registrationDate','$activationDate',
	  '$lastRenewalDate','$validity','$nextRenewalDate','$statusChangedDate','$lastChangedAmount')";
$connection->query($sql);


$success_data = array (
						'statusInfo' => array (
												'statusCode' => "String",
												'referenceCode' => "String",
												'serverReferenceCode' => "String",
								    ),
				);
$data_string = json_encode($success_data);	
echo $data_string;				