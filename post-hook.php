<?php
###################################################
################# CONFIGURATION START ###############
/*
|--------------------------------------------------------------------------
| Your beanstalk url. You must also add the url for this PHP file to the Post-deployment URL section in Beanstalk - http://support.beanstalkapp.com/customer/portal/articles/75806-how-do-i-trigger-hooks-before-and-after-a-deployment-
| eg; https://example.beanstalkapp.com
|--------------------------------------------------------------------------
 */
$beanstalk_url = 'https://example.beanstalkapp.com' ;
/*
|--------------------------------------------------------------------------
| Your Slack incoming webhook URL. Genrate this in your Slack dashboard https://slack.com/services/new/incoming-webhook
| eg; https://company.slack.com/services/hooks/incoming-webhook?token=XxXxXxX
|--------------------------------------------------------------------------
 */
$slack_webhook = 'https://example.slack.com/services/hooks/incoming-webhook?token=XxXxXxX';
/*
|--------------------------------------------------------------------------
| The channel where the message will be posted. Or, leave this blank and your repo name will be used as the Slack #channel
| eg; deployments
|--------------------------------------------------------------------------
*/
$channel = 'deployments' ;

############### CONFIGURATION  END ##################
###################################################

// Check the URL
if( ! $slack_webhook )
{
	die('Webhook URL is required');
}

// Get data from Beanstalk
$beanstalk_info = json_decode(@file_get_contents('php://input'));

// and translate into params for Slack
$channel = $channel ? $channel : strtolower($beanstalk_info->repository);
$author = $beanstalk_info->author;
$author_email = $beanstalk_info->author_email;
$repository = $beanstalk_info->repository;
$environment = $beanstalk_info->environment;
$deployed_at = $beanstalk_info->deployed_at;
$comment = $beanstalk_info->comment;

// Make the request and generate JSON encoded message to post to Slack
$payload = array(
	'payload' => '{
		"channel": "#'.$channel.'",
		"username": "'.$author_email.'",
		"icon_emoji": ":punch:",
		"attachments":[{
			"fallback":"['.$environment.'] branch deployed to <'.$beanstalk_url.'/'.$repository.'|'.$repository.'>",
			"pretext":"['.$environment.'] branch deployed to <'.$beanstalk_url.'/'.$repository.'|'.$repository.'>",
			"color":"good",
			"fields":[{
				"title":"Commit",
				"value":"'.$comment.'",
				"short":false
			}]
		}]
	}'
	);
// Start the CURL connection
$process = curl_init($slack_webhook);
curl_setopt($process, CURLOPT_POST, true);
curl_setopt($process, CURLOPT_POSTFIELDS, $payload);

// grab webhook and execute
curl_exec($process);

// close cURL resource, and free up system resources
curl_close($process);
?>
