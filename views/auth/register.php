<div id="wrapper">
  <div id="login">
    <h1>You want to join, matey?</h1>
    <p>That is too kind! Give us your credit card details and we will set you up with an account. We will not scam!</p>
    <form action="<?=BASE_URL?>auth/register" method="post">
      <input type="text" name="email" placeholder="email">
      <br>
      <input type="text" name="username" placeholder="username">
      <br>
      <input type="password" name="password" placeholder="password">
      <br>
      <input type="password" name="password_again" placeholder="password again">
      <br>
      <input type="submit" name="submit_register" value="count me in &hearts;">
      <p class="register"><a href="<?=BASE_URL?>auth/login">.. or return to the login page here</a></p>
    </form>
  </div>
</div>
<?php if(isset($notifications)) print_r($notifications)?>