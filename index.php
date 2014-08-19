<?php require( "config.php" ); ?>
<html>
<head>
	<title>World of Cats - Home</title>
        <link href="css/entry.css" rel="stylesheet" type="text/css">

</head>

<body>
<div id="blog" class="blog">
  <div id="entry" class="entry">
    <div class="page-title"><h1>World of Cats</h1></div>
    <div class="add-link">
      Add <a href="entry.php">new entry</a>.
    </div>
  </div>
<?php 
  $data = Article::getList();
  //print_r($data);
  $numEntries = count($data);

  foreach ( $data as $article ) { 
?>
    <div id="entry-id-<?php echo $article->id ?>" class="entry">
      <div class="title"><h1><?php echo $article->title ?></h1></div>
      <div class="content">
        <div class="left">
          <div class="date"><?php echo $article->publicationDate ?></div>
          <div class="author">Written by <?php echo $article->author ?></div>
        </div>
        <div class="right"><?php echo $article->content ?></div>
      </div>
    </div>
<?php 
  }
?>
</div>
<!--[if lt IE 9]>
  <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
</body>
</html>