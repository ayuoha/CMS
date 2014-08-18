<?php require( "config.php" ); ?>
<html>
<head>
	<title>World of Cats - Home</title>
        <link href="css/entry.css" rel="stylesheet" type="text/css">

</head>

<body>
<div class="blog">
  <div class="entry">
    <div class="page-title"><h1>World of Cats</h1></div>
    <div class="add-link">
      Add <a href="entry.php">new entry</a>.
    </div>
  </div>
<?php 
  $data = Article::getList();
  //print_r($data);
  $numEntries = count($data);
  for ($i = 0; $i < $numEntries; $i++) {
      echo '<div id="entry-' . $i . '" class="entry">';
      echo '  <div class="title"><h1>' . $data[$i]['title'] . '</h1></div>';
      echo '  <div class="content">';
      echo '    <div class="left">';
      echo '      <div class="date">' . $data[$i]['publicationDate'] . '</div>';
      echo '      <div class="author">Written by ' . $data[$i]['author'] . '</div>';
      echo '    </div>';
      echo '    <div class="right">' . $data[$i]['content'] . '</div>';
      echo '  </div>';
      echo '</div>';
  }
?>
</div>
<!--[if lt IE 9]>
  <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
</body>
</html>