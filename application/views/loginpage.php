<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Login Page</title>
<link rel="stylesheet" href="<?php echo base_url('assets/css/stylelogin.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/worldwide.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/index.css'); ?>">
</head>
<body>
<div id="wb_header">
        <div id="header">
            <div class="row">
                <div class="col-1">
                    <div id="wb_headerMenu" style="display:inline-block;width:100%;z-index:3;vertical-align:top;">
                        <ul id="headerMenu">
                            <li><a href="./index">Home</a></li>
                            <li class="active" aria-current="page">Login</li>
                            <li><a href="./services.html">Services</a></li>
                            <li><a href="./team.html">Team</a></li>
                            <li><a href="./contact.html">Contact</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="container">
  <section id="content">
   <form action="<?= $action ?>" method="post">
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