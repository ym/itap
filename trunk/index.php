<?php
	/*
	 * This work is licensed under the Creative Commons Attribution-Share Alike 2.5 China Mainland License.
	 * To view a copy of this license, visit http://creativecommons.org/licenses/by-sa/2.5/cn/ or
	 * send a letter to Creative Commons, 171 Second Street, Suite 300, San Francisco, California, 94105, USA.
	 *
	 * @name: iTAP
	 * @author: Kristy Swan (@LonelySwan) (MxSiyuan@Gmail.com)
	 * @website: http://blog.vii.im
	 * @version: r7 2010-06-25 12:02
	 * 
	 * The login page is modified from NetPutter
	 */
	 
	error_reporting(E_ALL);
	
	define('OAUTH_URL','https://twitter.com/oauth/');
	define('BASE_URL','/');
	define('BASE_URL_LENGTH',strlen(BASE_URL));
	
	define('ITAP_VERSION','r7 - 20100625');
	
	$allowed_method = array(
		'authenticate_post','authenticate','authorize','authorize_post'
	);
	
	$method = $_SERVER['REQUEST_URI'];
	if(strpos($method,'?')) {
		$method = substr($method,0,strpos($method,'?'));
	}
	if(substr($method,0,BASE_URL_LENGTH)==BASE_URL) {
		$method = substr($method,BASE_URL_LENGTH);
	} else {
		exit("Please check your config file.\n<br />We've found that BASE_URL is wrong.");
	}
	$query = '?'.(isset($_SERVER['REDIRECT_QUERY_STRING']) ? $_SERVER['REDIRECT_QUERY_STRING'] : $_SERVER['QUERY_STRING']);
	

	require_once 'handler.php';
	
	$a = new OAPHandle;
		//$a->keepCookie();
		if($method=='authorize') {
			$a->auth_show();
		} elseif($method=='authorize_post') {
			$a->auth_post();
		} elseif($method=='authenticate_post') {
			$a->auth_post_l();
		} elseif($method=='authenticate') {
			$a->auth_show_l();
		} else {
			exit('Invalid Method.');
		}
?>
