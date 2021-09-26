<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['pre_controller']=function()
{
	//  using this to check if the request is from vue client
	if(strpos(@$_SERVER['PATH_INFO'], 'api') !== FALSE || strpos(@$_SERVER['ORIG_PATH_INFO'], 'api') !== FALSE){
		//  this is use to always get php input as an array since the incoming data is in json
		$fileData = file_get_contents('php://input');
		if (!$fileData) {
			return;
		}
		$data = json_decode($fileData, true);
		$_POST = $data;
	}
	return;
};
