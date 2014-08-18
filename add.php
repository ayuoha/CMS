<?php require( "config.php" ); 

function sanitizeString($var)
{
	$var = stripslashes($var);
	$var = htmlentities($var);
	$var = strip_tags($var);
	return $var;
}

$params = array();
if (isset($_POST['author'])) $params['author'] = sanitizeString($_POST['author']);
if (isset($_POST['summary'])) $params['summary'] = sanitizeString($_POST['summary']);
if (isset($_POST['content'])) $params['content'] = sanitizeString($_POST['content']);
if (isset($_POST['title'])) $params['title'] = sanitizeString($_POST['title']);

//var_dump($params);

$result = Article::addEntry($params);

echo json_encode($result);

?>
