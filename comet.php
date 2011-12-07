<?php
// Set time limit to indefinite execution
//@set_time_limit (10);
require("include/connect_db.php");
// Set the ip and port we will listen on
$address = '127.0.0.1';
$port = 9000;

// Create a TCP Stream socket
$sock = socket_create(AF_INET, SOCK_STREAM, 0);

socket_set_nonblock ( $sock );
$timeout = array('sec'=>5,'usec'=>0);
socket_set_option($sock,SOL_SOCKET,SO_RCVTIMEO,$timeout);

// Bind the socket to an address/port 
while($port < 9100 && !@socket_bind($sock, $address, $port)) $port++;
if($port == 9100) {
	echo "over 9000";
	return;
};

$q = mysql_real_escape_string($_REQUEST['q']);
mysql_query("update qrlogin_sessions set session_port = $port where session_qrlink = '$q'") or die(mysql_error());

/*$linger = array('l_linger' => 0, 'l_onoff' => 1);
socket_set_option($sock, SOL_SOCKET, SO_LINGER, $linger);*/
//echo "derpson";
// Start listening for connections
socket_listen($sock);
$tc = 0;
while(true) 
{
	if(!($client = @socket_accept($sock))) {
		sleep(1);
		if($tc++ > 100) {
			@socket_close($client);
			@socket_close($sock);
			return;
		}
		
	} else break;
}

//echo "herpson";

/* Accept incoming requests and handle them as child processes */


// Read the input from the client &#8211; 1024 bytes
$input = socket_read($client, 1024);
$input = explode(' ',$input);
if($input[0] == $_REQUEST['q']) echo $input[1];

// Close the client (child) socket
socket_close($client);

// Close the master sockets
socket_close($sock);
?> 