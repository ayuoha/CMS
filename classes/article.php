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
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['publicationDate'] ) ) $this->publicationDate = $data['publicationDate'];
    if ( isset( $data['title'] ) ) $this->title = $data['title'];
    if ( isset( $data['summary'] ) ) $this->summary = $data['summary'];
    if ( isset( $data['content'] ) ) $this->content = $data['content'];
    if ( isset( $data['author'] ) ) $this->author = $data['author'];
  }

  /**
  * Sets the object's properties using the edit form post values in the supplied array
  *
  * @param assoc The form post values
  */
 
  public function storeFormValues ( $params ) {
      $this->__construct( $params );
      $publicationDate = date("Y-m-d H:i:s");  // Current time 
      $this->publicationDate = $publicationDate;
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
    $query = 'SELECT id, title, content, publicationDate, author FROM articles ORDER BY ' . $order;
    $results = array();
    foreach($currentConnection->query($query) as $row) {
       $article = new Article( $row );
       array_push($results, $article);
    }
    $currentConnection = null;
    return $results;
  }
 

  /**
  * Inserts the current Article object into the database, and sets its ID property.
  */
 
  public function insert() {
      $currentConnection = $this->getConnection();

      $sql = $currentConnection->prepare("INSERT INTO articles(title,summary,content,author,publicationDate) VALUES(:title,:summary,:content,:author,:publicationDate)");
      $sql->bindParam(':title',$this->title,PDO::PARAM_STR);
      $sql->bindParam(':summary',$this->summary,PDO::PARAM_STR);
      $sql->bindParam(':content',$this->content,PDO::PARAM_STR);
      $sql->bindParam(':author',$this->author,PDO::PARAM_STR);
      $sql->bindParam(':publicationDate',$this->publicationDate,PDO::PARAM_STR);

      $result = array();
      if ($sql->execute()) {
          $result['result'] = true;
      } else {
          $result['result'] = false;
          $result['error'] = $sql->errorInfo();
      }
      $currentConnection = null;
      return $result;
  }

  public function getConnection(){
     $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
     return $conn;
  }
 
}
 
?>