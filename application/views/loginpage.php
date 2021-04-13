<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Login Page</title>
<link rel="stylesheet" href="<?php echo base_url('assets/css/stylelogin.css'); ?>">
</head>
<body>
<div class="container">
  <section id="content">
  <form action="<?php echo base_url('index.php/system/loginUser'); ?>" method="post">
      <h1>Login Form</h1>
      <div>
        <input name="username" type="text" placeholder="Username" required="" id="username" />
      </div>
      <div>
        <input name="password" type="password" placeholder="Password" required="" id="password" />
      </div>
      <div>
        <input type="submit" value="Log in" />
        <a href="register">Lost your password?</a>
        <a href="register">Register</a>
      </div>
    </form><!-- form -->
    
  </section><!-- content -->
</div><!-- container -->
</body>
</html>