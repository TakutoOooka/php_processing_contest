<?php
class Request {
  function __construct() {
  }

	function get_http_params()
	{
	    $parameter = array();
	    switch ($_SERVER['REQUEST_METHOD']) {
	    case 'GET':
	        $parameter = $_GET;
	        break;
	    case 'POST':
	        $parameter = $_POST;
	        break;
	    case 'PUT':
	    case 'DELETE':
	    default:
	        parse_str(file_get_contents('php://input'), $parameter);
	        break;
	    }
	    return $parameter;
	} 
}
?>
