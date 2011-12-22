<?php

error_reporting(E_ALL);
session_start();

/* Require constants */
require_once('constants.php');

if( ! empty($_GET)) $url_segment = explode('/', $_GET['url']);
else $url_segment[0] = 'home';

switch ($url_segment[0]) {
  case 'home':
    require_once(INC_PATH . 'base.php');
    $base = new Base();
    if( ! empty($_SESSION['auth'])) {
      $views = array('parts/header', 'home', 'parts/footer');
      $base->show_view($views);
    } else {
      $base->redirect('auth/login');
    }
    break;
  
  case 'auth':
    require_once(INC_PATH . 'auth.php');
    $auth = new Auth();
    if( ! isset($url_segment[1])) {
      $auth->redirect('auth/login');
    } else {
      switch ($url_segment[1]) {
        case 'login':
          if(empty($_SESSION['auth'])) {
            if(isset($_POST['submit_login'])) {
              $login = $auth->login($_POST['username'], $_POST['password']);
              if($login === true) {
                $auth->redirect();
              } else {
                $views = array('parts/header', 'auth/login', 'parts/footer');
                $auth->show_view($views);
              }
            } else {
              $views = array('parts/header', 'auth/login', 'parts/footer');
              $auth->show_view($views);
            }
          } else {
            $auth->redirect();
          }
          break;
      
        case 'logout':
          $auth->logout();
          $auth->redirect('auth/login');
          break;
      
        case 'register':
          if(empty($_SESSION['auth'])) {
            if(isset($_POST['submit_register'])) {
              $register = $auth->register($_POST['email'], $_POST['username'], $_POST['password'], $_POST['password_again']);
              if($register === true) {
                $data['meta_redirect'] = '<meta http-equiv="refresh" content="5; URL=' . BASE_URL . 'auth/login" />';
                $views = array('parts/header', 'auth/register_success', 'parts/footer');
                $auth->show_view($views, $data);
                //$auth->redirect('auth/login');
              } else {
                $data['errors'] = $register;
                $views = array('parts/header', 'auth/register', 'parts/footer');
                $auth->show_view($views, $data);
              }
            } else {
              $views = array('parts/header', 'auth/register', 'parts/footer');
              $auth->show_view($views);
            }
          } else {
            $auth->redirect();
          }
          break;
      
        default:
        
          break;
      }
    }
    break;
  
  default:
    require_once(INC_PATH . 'base.php');
    $base = new Base();
    $views = array('parts/header', 'errors/404', 'parts/footer');
    $base->show_view($views);
    break;
}
