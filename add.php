<?php require( "config.php" ); 

$params = array();

if (isset($_POST['author'])) $_POST['author'] = sanitizeString($_POST['author']);
if (isset($_POST['summary'])) $_POST['summary'] = sanitizeString($_POST['summary']);
if (isset($_POST['content'])) $_POST['content'] = sanitizeString($_POST['content']);
if (isset($_POST['title'])) $_POST['title'] = sanitizeString($_POST['title']);

function sanitizeString($var)
{
  $var = stripslashes($var);
  $var = htmlentities($var);
  $var = strip_tags($var);
  return $var;
}

$article = new Article();
$article->storeFormValues($_POST);
$result = $article->insert();
echo json_encode($result);
?>
