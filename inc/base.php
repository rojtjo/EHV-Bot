<?php
/**
 * Base
 *
 * @package default
 * @author Roj Vroemen <rojtjo@gmail.com>
 **/
class Base {
  /**
   * @var
   */
  private $db;

  /**
   * @var
   */
  protected $mysql_link;

  /**
   * Construct
   */
  public function __construct() {
    $this->connect();
  }

  /**
   * Connect to MySQL
   */
  private function connect() {
    require(CONFIG_PATH . 'database.php');
    $this->db = $db;
    $this->mysql_link = mysql_connect($this->db['host'], $this->db['username'], $this->db['password']);
    mysql_select_db($this->db['database'], $this->mysql_link);
  }

  /**
   * Load in requested view files
   * 
   * @param array $view_files
   * @param array $data
   */
  public function show_view($view_files, $data = NULL) {
    /* Array keys to vars */
    if(is_array($data)) foreach($data as $key => $value) ${$key} = $value;

    /* Require all requested view files if found */
    foreach($view_files as $file) {
      if(file_exists(VIEW_PATH . $file . '.php')) require_once(VIEW_PATH . $file . '.php');
      else require_once(VIEW_PATH . 'errors/404.php');
    }
  }


  /**
   * Redirect to the requested page
   * 
   * @param string $location
   */
  public function redirect($location = '') {
    header('Location: ' . BASE_URL . $location);
  }
}