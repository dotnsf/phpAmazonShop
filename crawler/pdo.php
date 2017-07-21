<?php

require( 'credentials.php' );


function insert_items( $pdo, $code, $name, $price, $brand, $maker, $image_url, $asin ){
	$r = 0;

	//. Insert
	try{
		$sql = "insert into items(code, name, price, brand, maker, image_url, asin ) values(:code, :name, :price, :brand, :maker, :image_url, :asin )";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':code', $code, PDO::PARAM_STR);
		$stmt->bindParam(':name', $name, PDO::PARAM_STR);
		$stmt->bindValue(':price', $price, PDO::PARAM_INT);
		$stmt->bindValue(':brand', $brand, PDO::PARAM_STR);
		$stmt->bindValue(':maker', $maker, PDO::PARAM_STR);
		$stmt->bindParam(':image_url', $image_url, PDO::PARAM_STR);
		$stmt->bindValue(':asin', $asin, PDO::PARAM_STR);
		$r = $stmt->execute();

		echo( "[$code] : insert -> '$r' \n" );
	}catch( Exception $e ){
		echo( "($code) : exception -> " . $e->getMessage() . "\n" );
	}catch( PDOException $e ){
		echo( "($code) : pdoexception -> " . $e->getMessage() . "\n" );
	}catch( SQLException $e ){
		echo( "($code) : sqlexception -> " . $e->getMessage() . "\n" );
	}

	return $r;
}

?>

