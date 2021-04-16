<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Login Page</title>
<link rel="stylesheet" href="<?php echo base_url('assets/user/css/stylelogin.css'); ?>">
</head>
<body>
<div class="container">
  <section id="content">
  <form action="<?= $action ?>" method="post">
      <h1>Register Form</h1>
      <div>
        <input name="nama_lengkap" type="text" placeholder="Nama Lengkap" required="" id="nama_lengkap" />
      </div>
      <div>
        <input name="username" type="text" placeholder="Username" required="" id="username" />
      </div>
      <div>
        <input name="password" type="password" placeholder="Password" required="" id="password" />
      </div>
      <div>
        <input name="email" type="text" placeholder="Email" required="" id="email" />
      </div>
      <div>
        <input name="headline" type="text" placeholder="Headline" required="" id="headline" />
      </div>
      <div>
        <input name="tentang_saya" type="text" placeholder="Tentang Saya" required="" id="tentang_saya" />
      </div>
      <div>
        <input type="submit" value="Sign Up" />
        <a href="index">Login</a>
      </div>
    </form><!-- form -->
    
  </section><!-- content -->
</div><!-- container -->
</body>
</html>