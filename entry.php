<?php require( "config.php" ); ?>

<html>
<head>
	<title>World of Cats - Add Entry</title>
        <link href="css/entry.css" rel="stylesheet" type="text/css">
</head>
<body>
  <div class="blog">
    <div class="entry">
    <div class="page-title"><h1>Add New Entry</h1></div>
      <div class="add-link">
        Back to <a href="index.php">home</a>.
      </div>
    <form id="new-entry" method="post" action="">
      <div class="einput">
        <div class="ilabel"><label for="author" id="author-label">Author:</label></div>
        <div class="ifield"><input type="text" name="author" id="author" value=""/></div>
        <div class="ierror" id="author-error"></div>
      </div>
      <div class="einput">
        <div class="ilabel"><label for="title" id="title-label">Title:</label></div>
        <div class="ifield"><input type="text" name="title" id="title" value=""/></div>
        <div class="ierror" id="title-error"></div>
      </div>
      <div class="einput">
        <div class="ilabel"><label for="content" id="content-label">Content:</label></div>
        <div class="ifield"><textarea name="content" id="content"></textarea></div>
        <div class="ierror" id="content-error"></div>
      </div>
      <div class="einput">
        <div class="ilabel"><label for="summary" id="summary-label">Summary:</label></div>
        <div class="ifield"><textarea name="summary" id="summary"></textarea></div>
        <div class="ierror" id="summary-error"></div>
      </div>
      <div class="einput">
        <div class="ilabel">&nbsp;</div>
        <div class="ifield"><input type="submit" value="Submit" id="submit-btn" class="submit"/></textarea></div>
      </div>
    </form>
    </div>
  </div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="js/add-entry.js"></script>
<!--[if lt IE 9]>
  <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
</body>
</html>