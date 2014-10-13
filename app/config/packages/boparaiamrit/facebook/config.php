<?php 

return array(
	'secret' => array(
		//put your app id and secret
							'appId'  => '329145523803567',
						  	'secret' => '0bafd00320742fc22c8e0a67158fb249'
							),
	//Redirect after successfull login
	'redirect' => 'YourSiteURL',
	//When Someone Logout from your Site
	'logout' => 'LogoutPageUrl',
	//you can add scope according to your requirement
	'scope' => 'user_birthday,email,user_hometown,user_location,user_status,user_photos,user_likes,user_education_history'
	);
