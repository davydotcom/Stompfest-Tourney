<?php
// src: http://codeigniter.com/wiki/Use_URL_helper_from_Smarty/
/* In your template file use {base_url} to output the root url of your site (e.g. http://fest.servehttp.com/)
{site_url url="controller/function"} produces something like this http://fest.servehttp.com/index.php/controller/function
*/

function smarty_function_form($params, &$smarty)
{
	//check if the needed function exists
	//otherwise try to load it
	if (!function_exists('form_open')) {
		//return error message in case we can't get CI instance
		if (!function_exists('get_instance')) return "Can't get CI instance";
		$CI= &get_instance();
		$CI->load->helper('form');
	}
	
	if (isset($params['url']) && $params['type'] == 'upload') {
		return form_open_multipart($params['url']);
	} elseif (isset($params['url'])) {
		return form_open($params['url']);
	} else {
		return form_close();
	}
}

?>