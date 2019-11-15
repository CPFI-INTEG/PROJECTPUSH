<HTML>
<head>
<TITLE>
Delete Product
</TITLE>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<?PHP 
require_once("../../../DB/dbcon.php");

if(isset($_GET['id'])){
	$id = $_GET['id'];
}
	
$q = "PRODUCTS_MOD~DELETEITEM~Inactive~".$_GET['id'];
header("Location: ../PROCEDURE/?msg=".base64_url_encode($q));

//encode
function base64_url_encode($q){
	return strtr(base64_encode($q), '+/=', '-_,');
}
	
//decode
function base64_url_decode($input){
	return base64_decode(strtr($input, '-_,', '+/='));		
}
?>

</HTML>