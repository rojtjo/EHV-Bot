<?php
/**
 * @author Kevin Newesil <newesil.kevin@gmail.com>
 * @package default
 * @version 0.1
 * 
 */

 error_reporting(E_ALL || E_STRICT);
 
 require_once ('../constants.php');
 require ('base.php');
 /**
  * Class open
  */
 class open extends Base{
  /**
   * function __construct
   */
  public function __construct() {
    parent::__construct();
  }
  /**
   * Get data from database
   */
  public function from_db(){
  	
	
	$rand = rand(0, 5);
  	$query = "SELECT `id`,`tweets` FROM `tweets` ORDER BY `id` DESC LIMIT 0,5";
	
	$sql = mysql_query($query);
	
	/**
	 * The mysql array
	 */
	$result_array = array();
	while($value = mysql_fetch_array($sql)){
		$result_array[] = $value['tweets'];
	}
	return $result_array[$rand];
  } 
 }
 
 $obj = new open();
 $do = $obj->from_db();
 /**
  * @param do 
  * $do represents de text that is going to be displayed on the screen.
  */
 echo $do;
 require('Refresh.html');
?>