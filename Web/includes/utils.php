<?php

	/**
	 * Wrappers, functions and code for database needs
	 */

	/**
	 * Wrapper to run a query, process any errors
	 * @param  string 	$query 	Query
	 * @return object 		query resource or boolean
	 */
	function resourceForQuery($query) {
		$result = mysql_query($query) or trigger_error(mysql_error() . " " . $query);

		return $result;
	}

    function getAttribute($attr) {

    	if (isset($attr)) {

    		// If it is an array, we can parse all its elements
    		if (is_array($attr)) {
    			$attribute = array_map("getAttribute", $attr);
    		// Else, we can parse the string
    		} elseif(is_string($attr)) {
    			$attribute = trim(htmlentities(utf8_decode($attr)));
    		}

	    	if (function_exists("http_response_code") && is_null($attribute)) {
	    		http_response_code(409);
	    	} else {
	    		return $attribute;
	    	}

		} else {
			die(FALSE);
		}
    }

?>