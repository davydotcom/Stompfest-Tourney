<?php
// src: http://codeigniter.com/wiki/Use_URL_helper_from_Smarty/
/* In your template file use {base_url} to output the root url of your site (e.g. http://fest.servehttp.com/)
{site_url url="controller/function"} produces something like this http://fest.servehttp.com/index.php/controller/function
*/
function smarty_function_base_url($params,&$smarty) {
	if (!function_exists('base_url')) {
		//return error message in case we can't get CI instance
		if (!function_exists('get_instance')) return "Can't get CI instance";
		$CI= &get_instance();
		$CI->load->helper('url');
	}
	
	return base_url();	
}
?>