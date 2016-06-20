<?php

require_once( 'common.php' );

$s_time = microtime(true);

if( $argc == 1 ){
	echo "Usage: php db_updatemaster.php filename\n";
	exit;
}
$filename = $argv[1];
if( $filename != '' ){
	echo "Processing # $filename ..";
	$cnt = update_master_tsv( $filename );
	echo " -> $cnt \n";
}

$e_time = microtime(true);
$t = $e_time - $s_time;

echo "Processing time: $t [s]\n";


?>

