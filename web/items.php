<html>
<head>
<meta charset="utf8"/>
<title>items</title>
<script type="text/javascript" src="//code.jquery.com/jquery-2.0.3.min.js"></script>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"/>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.3.5/cerulean/bootstrap.min.css"/>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
<link href="./colorbox.css" rel="stylesheet"/> 
<script type="text/javascript" src="./jquery.colorbox-min.js"></script>
<script type="text/javascript">
$(function(){
  $('.iframe').colorbox({
    iframe: true,
    width: "90%",
    height: "90%"
  });
});
</script>
<style>
html, body, {
  background-color: #ddddff;
  height: 100%;
  margin: 0px;
  padding: 0px
}

#cboxOverlay {
    background: #000;
}
#cboxLoadedContent {
    background: #fff;
}
#cboxLoadedContent {
  padding: 0;
  overflow: auto;
    -moz-box-shadow: 0px 1px 10px #000000;
    -webkit-box-shadow: 0px 1px 10px #000000;
    box-shadow: 0px 1px 10px #000000;
}
#cboxPrevious, #cboxNext, #cboxSlideshow, #cboxClose , #cboxTitle {
  top: -30px;
}
#colorbox, #cboxOverlay, #cboxWrapper {
  overflow: visible ;
}
#cboxTitle {
  color: #fff;
}
#inline-content {/* インラインを使用する時のみ */
    margin: 20px;
}
#ajax-wrap {/* ajaxを使用する時のみ */
  margin: 20px;
}
</style>
</head>
<body>
<?php

require( '../credentials.php' );


$q = "";
$limit = 100;
$offset = 0;
if( $_GET['q'] ){
  $q = $_GET['q'];
}
if( $_GET['limit'] ){
  $limit = $_GET['limit'];
}
if( $_GET['offset'] ){
  $offset = $_GET['offset'];
}
?>

<form name="frm" method="GET" action="items.php">
<input type="hidden" name="offset" value="0"/>
<input type="hidden" name="limit" value="<?php echo $limit; ?>"/>
<input type="text" name="q" value="<?php echo $q; ?>"/>
<input class="btn btn-info btn-sm" type="submit" value="Query"/>
</form>
<hr/>

<?php
$cnt = 0;
$pdo = new PDO( 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8', DB_USER, DB_PASSWORD );
if( $pdo ){
  $pdo->query( 'SET NAMES utf8' );

  $sql0 = "select count(*) as cnt from items";
  if( $q ){
    $sql0 .= " where name like '%" . $q . "%' or brand like '%" . $q . "%' or maker like '%" . $q . "%'";
  }
  $stmt0 = $pdo->query( $sql0 );
  if( $row = $stmt0->fetch(PDO::FETCH_ASSOC) ){
    $cnt = ( int )$row['cnt'];
  }
}
?>

<table class="table table-bordered table-hobor table-condensed">
<tr><th>#</th><th>NAME</th><th>BRAND</th><th>MAKER</th></tr>
<?php
if( $pdo ){
  $pdo->query( 'SET NAMES utf8' );

  $sql = "select * from items";
  if( $q ){
    $sql .= " where name like '%" . $q . "%' or brand like '%" . $q . "%' or maker like '%" . $q . "%'";
  }

  $sql .= " order by code limit " . $offset . "," . $limit;
  $stmt = $pdo->query( $sql );
  $num = 0;
  while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
    $id = ( int )$row['id'];
    $code = $row['code'];
    $name = $row['name'];
    $price = ( int )$row['price'];
    $brand = $row['brand'];
    $maker = $row['maker'];
    $image_url = $row['image_url'];
    $asin = $row['asin'];

    $image_url2 = str_replace( "SL160", "SL400", $image_url );
    $link = AWS_ASSOC_TAG  ? "http://www.amazon.co.jp/dp/" . $asin . "?tag=" . AWS_ASSOC_TAG . "&linkCode=as1&creative=6339" : "";

    $tr = "<tr><td>" . $code . "<br/><a class=\"single iframe\" rel=\"external\" href=\"" . $image_url2 . "\" title=\"" . $name . "\"><img src=\"" . $image_url . "\" width=\"30\" height=\"30\"/></a></td><td>" . ( $link ? "<a target=\"_blank\" href=\"" . $link . "\">" . $name . "</a>" : $name ) . "</td><td>" . $brand . "</td><td>" . $maker . "</td></tr>\n";
    echo $tr;
    $num ++;
  }

  $tr = "<tr><td align=\"left\">";
  if( $offset > 0 ){
    $newoffset = $offset - $limit;
    if( $newoffset < 0 ){
      $newoffset = 0;
    }
    $query = "offset=" . $newoffset;
    if( $q ){
      $query .= ( "&q=" . $q );
    }
    $tr .= "<a href=\"./items.php?" . $query . "\">&lt;&lt;</a>";
  }else{
    $tr .= "&nbsp;";
  }

  $tr .= "<td colspan=\"2\" align=\"middle\">" . ( $offset + 1 ) . " - " . ($offset + $num) . " / " . $cnt . "</td>";

  $tr .= "</td><td align=\"right\">";
  if( $offset + $limit < $cnt ){
    $query = "offset=" . ( $offset + $limit );
    if( $q ){
      $query .= ( "&q=" . $q );
    }
    $tr .= "<a href=\"./items.php?" . $query . "\">&gt;&gt;</a>";
  }else{
    $tr .= "&nbsp;";
  }
  $tr .= "</td></tr>\n";
  echo $tr;
}
?>
</table>
</body>
</html>

