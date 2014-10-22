<?php

function sslInstagramProfilePic($url) {

	if( preg_match("/http:\/\/images.ak.instagram.com/", $url) ) {
		$result = preg_replace("/http:\/\/images.ak.instagram.com/", "//distillery.s3.amazonaws.com", $url);
	}
	else if( preg_match("/http:\/\/photos-[a-z].ak.instagram.com\/hphotos-ak-[0-9a-z]/", $url) ) {
		$result = preg_replace("/http:\/\/photos-[a-z].ak.instagram.com/", "//origincache-frc.fbcdn.net", $url);
	}
	else {
		$result = str_replace( 'http://', '//', $url );
	}

	return $result;
}