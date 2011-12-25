<?php
/**
 * Tweets
 *
 * @package default
 * @author Kevin Newesil <newesil.kevin@gmail.com>
 **/

require_once(INC_PATH . 'base.php');

/**
 * Class tweets
 */
class tweets extends Base {
  
  /**
   * function __construct
   */
  public function __construct() {
    parent::__construct();
  } 
  
  /**
   * get mentions from twitter
   * 
   */
  public function tweet_fetcher() {
    require('./twitter/tweets.php');
	$tweets = get_mentions();
	return $tweets;
  }
  /**
   * Save tweets into Database.
   */
  public function tweet_saver($tweets){
  	/**
	 * Check if tweets allready exsist in Database
	 */
  	$query1 = "SELECT `tweets` FROM `tweets` WHERE `tweets` = '" . $tweets . "'";
	$sql1 = mysql_query($query1) or die (mysql_error());
	$row = mysql_num_rows($sql1);
	/**
	 * if tweets don't exsist in database yet:
	 * insert into database
	 */
	if($row === 0){
	  	$query2 = "INSERT INTO `tweets`(`id`,`tweets`)VALUES('','" . $tweets . "')";
		$sql2 = mysql_query($query2)or die(mysql_error());
	}
  }
}
?>