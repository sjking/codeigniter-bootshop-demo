<?php
/* Set of functions for sending json responses to ajax requests
 * @author Steve King
 */
function ajax_failure($msg = null)
{
	header('Content-Type: application/json');
	return json_encode(
        array('success' => false, 'msg' => $msg, 'level' => 'danger')
    );	
}

function ajax_success($msg = null)
{
	header('Content-Type: application/json');
	return json_encode(
        array('success' => true, 'msg' => $msg, 'level' => 'success')
    );
}

function ajax_warning($msg = null)
{
    header('Content-Type: application/json');
    return json_encode(
        array('success' => true, 'msg' => $msg, 'level' => 'warning')
    );
}

/* send an array of html data 
 * @data
 */
function ajax_html(array $data)
{
	header('Content-Type: application/json');
	return json_encode($data);
}

/* send a json object to browser
 * @data
 */
function ajax_json(array $data)
{
    header('Content-Type: application/json');
    return json_encode($data);
}


?>