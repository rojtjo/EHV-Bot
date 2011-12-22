<?php
/**
 * Arduino
 *
 * @package default
 * @author Roj Vroemen <rojtjo@gmail.com>
 **/

require_once(INC_PATH . 'base.php');

/**
 * Class arduino
 */
class Arduino extends Base {
  /**
   *
   */
  public function __construct() {
    parent::__construct();
  } // END __construct
  
  /**
   * Control the camera
   * 
   * @param string $side
   * @param array $args
   */
  public function camera($action, $args) {
    
  } // END control_camera
  
}