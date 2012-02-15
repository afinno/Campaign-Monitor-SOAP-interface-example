<?php
/*
*
*  AJAX Functions
*
*/

if (function_exists($_POST['func'])) {
	die($_POST['func']($_POST));
} else {
	die("FUNCTION NOT FOUND");
}

function doSubscribe($post) {

	$name = $post['full_name']; if ($post['full_name'] == '') $response['errors']['full_name'] = 'Name is required';
	$email = $post['email']; if (!preg_match('/^[^@]+@[a-zA-Z0-9._-]+\.[a-zA-Z]+$/', $email)) $response['errors']['email'] = "This field must contain a valid email address";
	$subscribe = $post['subscribe']; if ($post['subscribe'] == '') $response['errors']['subscribe'] = 'Subscription status is required';
	
	if (empty($response['errors'])) {
		
		try {
			$client = new SoapClient("http://app.campaignmonitor.com/api/api.asmx?wsdl", array('trace' => 1));
			$params->ApiKey = "INSERT-API-KEY";
			$params->ListID = "INSERT-LIST-ID";
			
			$params->Email = $email;
			$params->Name = $name;

			if ($subscribed == 'Y') {
				$result = get_object_vars($client->AddAndResubscribe($params));	
			} else {
				$result = get_object_vars($client->AddSubscriber($params));
				$result = get_object_vars($client->Unsubscribe($params));
			}
		    
			// Get results
			$resultCode = current($result)->Code;
			$resultMessage = current($result)->Message;
			
			// Not successful
			if (in_array($resultCode, array(0, 100, 202) ) ) {
				$response['message'] = 'The following error was returned';
				$response['errors']['exception'] = $resultMessage.' ['.$resultCode.']';
			} else {
				$response['message'] = 'Success';
				$response['errors']['exception'] = $resultMessage.' ['.$resultCode.']';
			}
				
		} catch (SoapFault $exception) {
			
			$response['errors']['exception'] = $exception;
			
		}
		
	} else {
		
		$response['message'] = 'Please check your form';
		
	}
	
	return json_encode($response);
}

?>