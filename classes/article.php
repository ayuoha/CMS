<?php
 
/**
 * Class to handle articles
 */
 
class Article
{
 
  // Properties
 
  /**
  * @var int The article ID from the database
  */
  public $id = null;
 
  /**
  * @var int When the article was published
  */
  public $publicationDate = null;
 
  /**
  * @var string Full title of the article
  */
  public $title = null;
 
  /**
  * @var string A short summary of the article
  */
  public $summary = null;
  
 
  /**
  * @var string The HTML content of the article
  */
  public $content = null;
 
   /**
  * @var string An author of the article
  */
  public $author = null;
 
  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */
 
  public function __construct( $data=array() ) {
  }
 

  /**
  * Sets the object's properties using the edit form post values in the supplied array
  *
  * @param assoc The form post values
  */
 
  public function storeFormValues ( $params ) {
      $publicationDate = date("Y-m-d");// Today's date 
      $params['publicationDate'] = $publicationDate;
      return $params;
  }
 
 
  /**
  * Returns an Article object matching the given article ID
  *
  * @param int The article ID
  * @return Article|false The article object, or false if the record was not found or there was a problem
  */
 
  public static function getById( $id ) {
  }
 
 
  /**
  * Returns all (or a range of) Article objects in the DB
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the articles (default="publicationDate DESC")
  * @return Array|false A two-element array : results => array, a list of Article objects; totalRows => Total number of articles
  */
 
  public static function getList( $numRows=1000000, $order="publicationDate DESC" ) {
    // $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $currentConnection = Article::getConnection();

    // http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers
    // -----------------------------------------
    // foreach($db->query('SELECT * FROM table') as $row) {
    // echo $row['field1'].' '.$row['field2']; //etc...
    // ---------------------------------------
    // $stmt = $db->query('SELECT * FROM table');
 
    // while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // echo $row['field1'].' '.$row['field2']; //etc...
    // }
    // ------------------------------------------
    // $stmt = $db->query('SELECT * FROM table');
    // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // -------------------------------------------
    $query = 'SELECT title, content, publicationDate, author FROM articles ORDER BY ' . $order;
    $results = array();
    foreach($currentConnection->query($query) as $row) {
       $article = array();
       $article['title'] = $row['title'];
       $article['content'] = $row['content'];
       $article['publicationDate'] = $row['publicationDate'];
       $article['author'] = $row['author'];
       array_push($results, $article);
    }

    // $stmt = $currentConnection->prepare('SELECT title, content, publicationDate FROM articles');
    // $stmt->execute();
    // $qryResults = $stmt->fetch();
    //var_dump($results);
    return $results;
    // var_dump($currentConnection);
  }
 

  /**
  * Adds new entry to DB
  * @param Array Input values sent from add new entry form
  * @return Array|true two element array : true, id => Id of the entry in DB
  *               false  two-element array : result => false, error => error from SQLServer
  */
  public static function addEntry( $params ) {
      $params = Article::storeFormValues( $params );
      return Article::insert($params);
  }

  /**
  * Inserts the current Article object into the database, and sets its ID property.
  */
 
  public function insert($params) {
      $currentConnection = Article::getConnection();

      $sql=$currentConnection->prepare("INSERT INTO articles(title,summary,content,author,publicationDate) VALUES(:title,:summary,:content,:author,:publicationDate)");
      $sql->bindParam(':title',$params['title'],PDO::PARAM_STR);
      $sql->bindParam(':summary',$params['summary'],PDO::PARAM_STR);
      $sql->bindParam(':content',$params['content'],PDO::PARAM_STR);
      $sql->bindParam(':author',$params['author'],PDO::PARAM_STR);
      $sql->bindParam(':publicationDate',$params['publicationDate'],PDO::PARAM_STR,10);

      if ($sql->execute()) {
          $result = array();
          $result['result'] = true;
          //$result['id'] = $sql->lastInsertId(); 
          return $result;
      } else {
          $result = array();
          $result['result'] = false;
          $result['error'] = $sql->errorInfo();
          return $result;
      }
  }
 
 
  /**
  * Updates the current Article object in the database.
  */
 
  public function update() {
 
  }
 
 
  /**
  * Deletes the current Article object from the database.
  */
 
  public function delete() {
 
  }

  static function getConnection(){
     $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
     return $conn;
  }
 
}
 
?>