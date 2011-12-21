<div id="wrapper">
  <div id="login">
    <h1>Oi, sparky!</h1>
    <p>Use this form to log in and use our awesome Arduino webcam! Free webcam show + <img src="<?=BASE_URL?>assets/images/popcorn.png"> inside!</p>
    <form action="<?=BASE_URL?>auth/login" method="post">
      <input type="text" name="username" id="" placeholder="username">
      <br>
      <input type="password" name="password" id="" placeholder="password">
      <br>
      <input type="submit" name="submit_login" id="" value="get me in">
      <p class="register"><a href="<?=BASE_URL?>auth/register">.. or register here</a></p>
    </form>
  </div>
</div>
<?php if(isset($notifications)) print_r($notifications)?>