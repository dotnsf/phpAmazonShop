<?php
require( 'common.php' );

$nodes = array(
    //. https://affiliate.amazon.co.jp/gp/associates/help/t100
	"52391051", //. ビューティー(all)
	"171288011" //. ドラッグストア/アダルトグッズ(all)
);

foreach( $nodes as $node ){
	getCodesFromAmazonAPI( $node );
}
exit;


?>

