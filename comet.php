<?php
// Set time limit to indefinite execution
@set_time_limit (120);
require("include/connect_db.php");
// Set the ip and port we will listen on
$address = '127.0.0.1';
$port = 9002;

// Create a TCP Stream socket
$sock = socket_create(AF_INET, SOCK_STREAM, 0);
// Bind the socket to an address/port
while($port < 9100 && !@socket_bind($sock, $address, $port)) $port++;
if($port == 9100) {
	echo "over 9000";
	return;
};

$q = mysql_real_escape_string($_REQUEST['q']);
mysql_query("update qrlogin_sessions set session_port = $port where session_qrlink = '$q'") or die(mysql_error());

// Start listening for connections
socket_listen($sock);

/* Accept incoming requests and handle them as child processes */
$client = socket_accept($sock);

// Read the input from the client &#8211; 1024 bytes
$input = socket_read($client, 1024);
$input = explode(' ',$input);
if($input[0] == $_REQUEST['q']) echo $input[1];

// Close the client (child) socket
socket_close($client);

// Close the master sockets
socket_close($sock);
?> 