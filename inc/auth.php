<?php
/**
 * Auth
 *
 * @package default
 * @author Roj Vroemen <rojtjo@gmail.com>
 **/
require_once(INC_PATH . 'base.php');
class Auth extends Base {
  /**
   * Construct
   */
  public function __construct() {
    parent::__construct();
  }

  /**
   * Login
   * 
   * @param string $username
   * @param string $password
   * @return array
   */
  public function login($username, $password) {
    $username = mysql_real_escape_string($username);
    $password = sha1($password);
    $query    = mysql_query("SELECT user_id,username FROM `users` WHERE `username` = '$username' AND `password` = SHA1(concat((SELECT salt FROM `users` WHERE `username` = '$username'), '$password'))");

    if(mysql_num_rows($query) > 0) {
      $_SESSION['auth']['user_id']  = mysql_result($query, 0, 'user_id');
      $_SESSION['auth']['username'] = mysql_result($query, 0, 'username');
    
      $return = true;
    } else $return = false;

    return $return;
  }

  /**
   * Logout
   */
  public function logout() {
    session_unset();
    session_destroy();
  }

  /**
   * Register an account
   * 
   * @param string $email
   * @param string $username
   * @param string $password
   * @param string $password_again
   * @return mixed 
   */
  public function register($email, $username, $password, $password_again) {
    $check = $this->check_data($email, $username, $password, $password_again);
    if(empty($check['error'])) {
      $email    = mysql_real_escape_string($email);
      $username = mysql_real_escape_string($username);
      $salt     = sha1(time() . $email . $username . $password);
      $password = sha1($salt . sha1($password));
      $query    = mysql_query("INSERT INTO `users` (email, username, password, salt) VALUES('$email', '$username', '$password', '$salt')");
      if(mysql_affected_rows() > 0) $output = true;
      else $output = false;
    } else $output =  $check;
    
    return $output;
  }

    /**
     * Check register data
     * 
     * @param string $email
     * @param string $username
     * @param string $password
     * @param string $password_again
     * @return mixed 
     */
  private function check_data($email, $username, $password, $password_again) {
    /* Base check */
    $check['base']['email']    = preg_match("^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$^", $email);
    $check['base']['username'] = (preg_match("^[A-Za-z0-9]$^", $username) == false ? false : (strlen($username) > 40 ? false : (strlen($username) < 4 ? false : true)));
    $check['base']['password'] = ($password === $password_again ? true : false);

    /* Add errors to $error array */
    foreach($check['base'] as $part => $data) if($data == false) $error['base'] = $part;

    /* If no errors */
    if(!isset($error)) {
      /* Database check */
      $username = mysql_real_escape_string($username);
      $email    = mysql_real_escape_string($email);
      $query    = mysql_query("SELECT username,email FROM `users` WHERE `username` = '$username' OR `email` = '$email'");

      /* If we get query result */
      if(mysql_num_rows($query) > 0) {
        $check['db']['username'] = (mysql_result($query, 0, 'username') != $username ? true : false);
        $check['db']['email']    = (mysql_result($query, 0, 'email') != $email ? true : false);
      } else {
        $check['db']['username'] = true;
        $check['db']['email']    = true;
      }

      /* Add errors to $error array */
      foreach($check['db'] as $part => $data) if($data == false) $error['db'] = $part;
    }

    /* Set $return array */
    if(isset($error)) foreach($error as $part) $return['error'][] = $part;
    else $return = true;

    return $return;
  }
}