<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {display_message} function plugin
 *
 * Type:     function<br>
 * Name:     math<br>
 * Purpose:  handle math computations in template<br>
 * @link 		 http://seofilter.com
 * @author   Svetoslav Marinov <svetosavm at gmail dot com>
 * @param array
 * @param Smarty
 * @return string
 */
function smarty_function_display_message($params, &$smarty)
{    	
		$out = "";
		
		if (!empty($params['error'])) {		
			//$params['error']
			$params['error'] = (array) $params['error'];
		
		foreach ($params['error'] as $value) {
	    	$out .= "\t\t".'<li class="error_msg">'.$value.'</li>' . "\n";
	    }
/*	    There is a problem with payment form! Please revise error messages.

 If you are unable to complete this form or if you get unexpected error please email us at <B>support@seofilter.com.</b>
*/
		$out = "<!-- Errors -->\n\t<font class='error_msg error'><strong>Errors: </strong></font><br />\n<ul>\n$out\n\t</ul>\n<!-- /Errors -->";
  	}
  	
  	// todo: success message 
		if (!empty($params['success'])) {		
			$params['success'] = (array) $params['success'];
		
	    foreach ($params['success'] as $value) {
	    	$out .= "\t\t".'<li class="note_msg success success_msg">'.$value.'</li>' . "\n";
	    }
	    
	    $out = "<!-- Success -->\n\t<font class='note_msg success success_msg'><strong>Success: </strong></font><br />\n<ul>\n$out\n\t</ul>\n<!-- /Success -->";
  	}
  
    return $out;
}

/* vim: set expandtab: */

?>
