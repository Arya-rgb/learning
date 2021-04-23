<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Digital Learning System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel='stylesheet' id='ecademy-fonts-css' href='//fonts.googleapis.com/css2?family=Nunito%3Aital%2Cwght%400%2C300%3B0%2C400%3B0%2C600%3B0%2C700%3B0%2C800%3B0%2C900%3B1%2C600%3B1%2C700%3B1%2C800%3B1%2C900&#038;display=swap&#038;ver=1.0.0' type='text/css' media='screen' />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo base_url('assets/user/css/font-awesome.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/user/css/worldwide.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/user/css/index.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/user/css/custom.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/user/css/bootstrap.css'); ?>">

<script src="<?php echo base_url('assets/user/js/jquery-1.12.4.min.js'); ?>"> </script>
<script src="<?php echo base_url('assets/user/js/jquery-ui.min.js'); ?>"> </script> 
<script src="<?php echo base_url('assets/user/js/skrollr.min.js'); ?>"> </script>
<script src="<?php echo base_url('assets/user/js/wwb15.min.js'); ?>"> </script>
</head>
<body>
 
    <div id="wb_header">
        <div id="header">
            <div class="row">
                <div class="col-md-12">
                    <div id="wb_headerMenu" style="display:inline-block;width:100%;z-index:3;vertical-align:top;">
                        <ul id="headerMenu">
                            <li class="" aria-current="page">Home</li>
                            <?php if (!empty($this->session->userdata('token'))): ?>
                               <li>Welcome <?php echo $this->session->userdata("username"); ?> <a href="<?= base_url('slearn/logout');  ?>">Logout</a> </li>
                             <?php else: ?>
                              <li><a href="<?= base_url('slearn/login');?>">Login</a></li>
                            <?php endif ?>
                            <li><a href="./services.html">Services</a></li>
                            <li><a href="./team.html">Team</a></li>
                            <li><a href="./contact.html">Contact</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $content ?>
    <div id="copyright">
      <div class="row">
        <div class="col-md-12 text-center">
          <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="http://solmit.com">Solmit</a>.</strong> All rights
      reserved.
        </div>
      </div>
    </div>
</body>
</html>