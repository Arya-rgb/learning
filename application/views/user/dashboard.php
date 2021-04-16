<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Digital Learning System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo base_url('assets/user/css/font-awesome.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/user/css/worldwide.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/user/css/index.css'); ?>">
<script src="<?php echo base_url('assets/user/js/jquery-1.12.4.min.js'); ?>"> </script>
<script src="<?php echo base_url('assets/user/js/jquery-ui.min.js'); ?>"> </script> 
<script src="<?php echo base_url('assets/user/js/skrollr.min.js'); ?>"> </script>
<script src="<?php echo base_url('assets/user/js/wwb15.min.js'); ?>"> </script>

<script>
$(document).ready(function()
{
   $('#reviewsImage1').addClass('visibility-hidden');
   $('#portfolio-image2').addClass('visibility-hidden');
   $('#reviewsImage1').addClass('visibility-hidden');
   $('#portfolio-image2').addClass('visibility-hidden');
   $('#reviewsImage1').addClass('visibility-hidden');
   $('#portfolio-image2').addClass('visibility-hidden');
   $("a[href*='#logo']").click(function(event)
   {
      event.preventDefault();
      $('html, body').stop().animate({ scrollTop: $('#wb_logo').offset().top }, 600, 'easeOutCirc');
   });
   $("a[href*='#header']").click(function(event)
   {
      event.preventDefault();
      $('html, body').stop().animate({ scrollTop: $('#wb_header').offset().top }, 600, 'easeOutCirc');
   });
   $("a[href*='#welcome']").click(function(event)
   {
      event.preventDefault();
      $('html, body').stop().animate({ scrollTop: $('#wb_welcome').offset().top-88 }, 600, 'easeOutCirc');
   });
   $("a[href*='#intro']").click(function(event)
   {
      event.preventDefault();
      $('html, body').stop().animate({ scrollTop: $('#wb_intro').offset().top-88 }, 600, 'easeOutCirc');
   });
   function onScrollintro()
   {
      var $obj = $("#wb_intro");
      if (!$obj.hasClass("in-viewport") && $obj.inViewPort(false))
      {
         $obj.addClass("in-viewport");
         AnimateCss('reviewsImage1', 'animate-fade-in-up', 0, 1000);
         AnimateCss('portfolio-image2', 'animate-fade-in-up', 500, 1000);
      }
   }
   onScrollintro();
   $(window).scroll(function(event)
   {
      onScrollintro();
   });
   $("a[href*='#services']").click(function(event)
   {
      event.preventDefault();
      $('html, body').stop().animate({ scrollTop: $('#wb_services').offset().top-88 }, 600, 'easeOutCirc');
   });
   function skrollrInit()
   {
      skrollr.init({forceHeight: false, mobileCheck: function() { return false; }, smoothScrolling: false});
   }
   skrollrInit();
   $("a[href*='#getstarted']").click(function(event)
   {
      event.preventDefault();
      $('html, body').stop().animate({ scrollTop: $('#wb_getstarted').offset().top-88 }, 600, 'easeOutCirc');
   });
   function onScrollgetstarted()
   {
      var $obj = $("#wb_getstarted");
      if (!$obj.hasClass("in-viewport") && $obj.inViewPort(false))
      {
         $obj.addClass("in-viewport");
         AnimateCss('reviewsImage1', 'animate-fade-in-up', 0, 1000);
         AnimateCss('portfolio-image2', 'animate-fade-in-up', 500, 1000);
      }
   }
   onScrollgetstarted();
   $(window).scroll(function(event)
   {
      onScrollgetstarted();
   });
   $("a[href*='#infoBlock1']").click(function(event)
   {
      event.preventDefault();
      $('html, body').stop().animate({ scrollTop: $('#wb_infoBlock1').offset().top }, 600, 'easeInCubic');
   });
   $("a[href*='#moreServices']").click(function(event)
   {
      event.preventDefault();
      $('html, body').stop().animate({ scrollTop: $('#wb_moreServices').offset().top-88 }, 600, 'easeOutCirc');
   });
   $("a[href*='#info']").click(function(event)
   {
      event.preventDefault();
      $('html, body').stop().animate({ scrollTop: $('#wb_info').offset().top-88 }, 600, 'easeOutCirc');
   });
   function onScrollinfo()
   {
      var $obj = $("#wb_info");
      if (!$obj.hasClass("in-viewport") && $obj.inViewPort(false))
      {
         $obj.addClass("in-viewport");
         AnimateCss('reviewsImage1', 'animate-fade-in-up', 0, 1000);
         AnimateCss('portfolio-image2', 'animate-fade-in-up', 500, 1000);
      }
   }
   onScrollinfo();
   $(window).scroll(function(event)
   {
      onScrollinfo();
   });
   $("a[href*='#LayoutGrid4']").click(function(event)
   {
      event.preventDefault();
      $('html, body').stop().animate({ scrollTop: $('#wb_LayoutGrid4').offset().top-88 }, 600, 'easeOutCirc');
   });
   $("a[href*='#facts']").click(function(event)
   {
      event.preventDefault();
      $('html, body').stop().animate({ scrollTop: $('#wb_facts').offset().top-88 }, 600, 'easeOutCirc');
   });
function countUpfactsJavaScript1()
{
   var $obj = $('#factsJavaScript1');
   var count = $obj.attr('data-count');
   var bottomObj = $obj.offset().top + $obj.outerHeight();
   var bottomWnd = $(window).scrollTop() + $(window).height();
   if (bottomWnd > bottomObj && count != 0)
   {
      $({countUp: $obj.text()}).animate({countUp: count},
      {
         duration: 4000,
         step: function() { $obj.text(Math.floor(this.countUp)); },
         complete: function() { $obj.text(this.countUp); $obj.attr('data-count', 0); }
      });  
   }
}
$(window).scroll( function()
{
   countUpfactsJavaScript1();
});
countUpfactsJavaScript1();
function countUpfactsJavaScript2()
{
   var $obj = $('#factsJavaScript2');
   var count = $obj.attr('data-count');
   var bottomObj = $obj.offset().top + $obj.outerHeight();
   var bottomWnd = $(window).scrollTop() + $(window).height();
   if (bottomWnd > bottomObj && count != 0)
   {
      $({countUp: $obj.text()}).animate({countUp: count},
      {
         duration: 4000,
         step: function() { $obj.text(Math.floor(this.countUp)); },
         complete: function() { $obj.text(this.countUp); $obj.attr('data-count', 0); }
      });  
   }
}
$(window).scroll( function()
{
   countUpfactsJavaScript2();
});
countUpfactsJavaScript2();
function countUpfactsJavaScript3()
{
   var $obj = $('#factsJavaScript3');
   var count = $obj.attr('data-count');
   var bottomObj = $obj.offset().top + $obj.outerHeight();
   var bottomWnd = $(window).scrollTop() + $(window).height();
   if (bottomWnd > bottomObj && count != 0)
   {
      $({countUp: $obj.text()}).animate({countUp: count},
      {
         duration: 4000,
         step: function() { $obj.text(Math.floor(this.countUp)); },
         complete: function() { $obj.text(this.countUp); $obj.attr('data-count', 0); }
      });  
   }
}
$(window).scroll( function()
{
   countUpfactsJavaScript3();
});
countUpfactsJavaScript3();
function countUpfactsJavaScript4()
{
   var $obj = $('#factsJavaScript4');
   var count = $obj.attr('data-count');
   var bottomObj = $obj.offset().top + $obj.outerHeight();
   var bottomWnd = $(window).scrollTop() + $(window).height();
   if (bottomWnd > bottomObj && count != 0)
   {
      $({countUp: $obj.text()}).animate({countUp: count},
      {
         duration: 20000,
         step: function() { $obj.text(Math.floor(this.countUp)); },
         complete: function() { $obj.text(this.countUp); $obj.attr('data-count', 0); }
      });  
   }
}
$(window).scroll( function()
{
   countUpfactsJavaScript4();
});
countUpfactsJavaScript4();
   var iOS = !!navigator.platform && /iPad|iPhone|iPod/.test(navigator.platform);
   if (iOS)
   {
      $('#wb_welcome').css('background-attachment', 'scroll');
   }
});
</script>
<script src="<?php echo base_url('assets/js/particles.min.js'); ?>"> </script>
<script>
$(document).ready(function()
{
   $('#welcome').prepend('<div id="particles1"></div>');
   particlesJS('particles1', {
     "particles": {
       "number": {
         "value": 100,
         "density": {
           "enable": true,
           "value_area": 800
         }
       },
       "color": {
         "value": "FFFFFF"
       },
       "shape": {
         "type": "circle",
         "stroke": {
           "width": 0,
           "color": "#000000"
         },
         "polygon": {
           "nb_sides": 3
         },
         "image": {
           "src": "img/github.svg",
           "width": 100,
           "height": 100
         }
       }, 
       "opacity": {
         "value": 0.5,
         "random": false,
         "anim": {
           "enable": false,
           "speed": 1,
           "opacity_min": 0.1,
           "sync": false
         }
       },
       "size": {
         "value": 3,
         "random": true,
         "anim": {
           "enable": false,
           "speed": 90,
           "size_min": 0.1,
           "sync": false
         }
       },
       "line_linked": {
         "enable": true,
         "distance": 150,
         "color": "FFFFFF",
         "opacity": 0.4,
         "width": 1
       },
       "move": {
         "enable": true,
         "speed": 6,
         "direction": "none",
         "random": false,
         "straight": false,
         "out_mode": "out",
         "bounce": false,
         "attract": {
           "enable": false,
           "rotateX": 600,
           "rotateY": 1200
         }
       }
     },
     "interactivity": {
       "detect_on": "canvas",
       "events": {
         "onhover": {
           "enable": true,
           "mode": "grab"
         },
         "onclick": {
           "enable": true,
           "mode": "push"
         },
         "resize": true
       },
       "modes": {
         "grab": {
           "distance": 140,
           "line_linked": {
             "opacity": 1
           }
         },
         "bubble": {
           "distance": 400,
           "size": 40,
           "duration": 2,
           "opacity": 0.8,
           "speed": 3
         },
         "repulse": {
           "distance": 200,
           "duration": 0.4
         },
         "push": {
           "particles_nb": 4
         },
         "remove": {
           "particles_nb": 2
         }
       }
     },
     "retina_detect": true
   });
});
</script>
</head>
<body>
 
    <div id="wb_header">
        <div id="header">
            <div class="row">
                <div class="col-1">
                    <div id="wb_headerMenu" style="display:inline-block;width:100%;z-index:3;vertical-align:top;">
                        <ul id="headerMenu">
                            <li class="active" aria-current="page">Home</li>
                            <li><a href="<?= base_url('index.php/slearn/login');?>">Login</a></li>
                            <li><a href="./services.html">Services</a></li>
                            <li><a href="./team.html">Team</a></li>
                            <li><a href="./contact.html">Contact</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="wb_welcome">
        <div id="welcome-divider-bottom">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 355" preserveAspectRatio="none">
                <path fill="none" d="M999.45 0H0v165.72l379.95 132.46L999.45 0z" />
                <path class="divider-fill" style="opacity:0.5" d="M379.95 298.18l28.47 9.92L1000 118.75V0h-.55l-619.5 298.18zM492.04 337.25L1000 252.63V118.75L408.42 308.1l83.62 29.15z" />
                <path class="divider-fill" style="opacity:0.5" d="M492.04 337.25L1000 252.63V118.75L408.42 308.1l83.62 29.15z" />
                <path class="divider-fill" d="M530.01 350.49l20.22 4.51H1000V252.63l-507.96 84.62 37.97 13.24z" />
                <path class="divider-fill" style="opacity:0.5" d="M530.01 350.49l20.22 4.51H1000V252.63l-507.96 84.62 37.97 13.24z" />
                <path class="divider-fill" style="opacity:0.5" d="M530.01 350.49l20.22 4.51H1000V252.63l-507.96 84.62 37.97 13.24z" />
                <path class="divider-fill" d="M542.94 355h7.29l-20.22-4.51 12.93 4.51z" />
                <path class="divider-fill" style="opacity:0.5" d="M542.94 355h7.29l-20.22-4.51 12.93 4.51z" />
                <path class="divider-fill" style="opacity:0.3" d="M542.94 355h7.29l-20.22-4.51 12.93 4.51z" />
                <path class="divider-fill" style="opacity:0.5" d="M542.94 355h7.29l-20.22-4.51 12.93 4.51z" />
                <path class="divider-fill" style="opacity:0.3" d="M379.95 298.18L0 165.72v66.59l353.18 78.75 26.77-12.88z" />
                <path class="divider-fill" style="opacity:0.3" d="M353.18 311.06L0 232.31v71.86l288.42 38.06 64.76-31.17z" />
                <path class="divider-fill" style="opacity:0.3" d="M353.18 311.06L0 232.31v71.86l288.42 38.06 64.76-31.17z" />
                <path class="divider-fill" style="opacity:0.5" d="M380.28 317.11l28.14-9.01-28.47-9.92-26.77 12.88 27.1 6.05z" />
                <path class="divider-fill" style="opacity:0.3" d="M380.28 317.11l28.14-9.01-28.47-9.92-26.77 12.88 27.1 6.05z" />
                <path class="divider-fill" style="opacity:0.5" d="M479.79 339.29l12.25-2.04-83.62-29.15-28.14 9.01 99.51 22.18z" />
                <path class="divider-fill" style="opacity:0.5" d="M479.79 339.29l12.25-2.04-83.62-29.15-28.14 9.01 99.51 22.18z" />
                <path class="divider-fill" style="opacity:0.3" d="M479.79 339.29l12.25-2.04-83.62-29.15-28.14 9.01 99.51 22.18z" />
                <path class="divider-fill" d="M530.01 350.49l-37.97-13.24-12.25 2.04 50.22 11.2z" />
                <path class="divider-fill" style="opacity:0.5" d="M530.01 350.49l-37.97-13.24-12.25 2.04 50.22 11.2z" />
                <path class="divider-fill" style="opacity:0.5" d="M530.01 350.49l-37.97-13.24-12.25 2.04 50.22 11.2z" />
                <path class="divider-fill" style="opacity:0.3" d="M530.01 350.49l-37.97-13.24-12.25 2.04 50.22 11.2zM288.42 342.23l9.46 1.25 82.4-26.37-27.1-6.05-64.76 31.17z" />
                <path class="divider-fill" style="opacity:0.5" d="M288.42 342.23l9.46 1.25 82.4-26.37-27.1-6.05-64.76 31.17z" />
                <path class="divider-fill" style="opacity:0.3" d="M288.42 342.23l9.46 1.25 82.4-26.37-27.1-6.05-64.76 31.17z" />
                <path class="divider-fill" style="opacity:0.5" d="M380.28 317.11l-82.4 26.37 87.3 11.52h.34l94.27-15.71-99.51-22.18z" />
                <path class="divider-fill" style="opacity:0.3" d="M380.28 317.11l-82.4 26.37 87.3 11.52h.34l94.27-15.71-99.51-22.18z" />
                <path class="divider-fill" style="opacity:0.5" d="M380.28 317.11l-82.4 26.37 87.3 11.52h.34l94.27-15.71-99.51-22.18z" />
                <path class="divider-fill" style="opacity:0.3" d="M380.28 317.11l-82.4 26.37 87.3 11.52h.34l94.27-15.71-99.51-22.18z" />
                <path class="divider-fill" d="M479.79 339.29L385.52 355h157.42l-12.93-4.51-50.22-11.2z" />
                <path class="divider-fill" style="opacity:0.5" d="M479.79 339.29L385.52 355h157.42l-12.93-4.51-50.22-11.2z" />
                <path class="divider-fill" style="opacity:0.3" d="M479.79 339.29L385.52 355h157.42l-12.93-4.51-50.22-11.2z" />
                <path class="divider-fill" style="opacity:0.5" d="M479.79 339.29L385.52 355h157.42l-12.93-4.51-50.22-11.2z" />
                <path class="divider-fill" style="opacity:0.3" d="M479.79 339.29L385.52 355h157.42l-12.93-4.51-50.22-11.2z" />
                <path class="divider-fill" d="M288.42 342.23L0 304.17V355h385.18l-87.3-11.52-9.46-1.25z" />
            </svg>
        </div>
        <div id="welcome">
            <div class="col-1">
                <div id="wb_welcomeText">
                    <p style="font-size:15px;line-height:16.5px;color:#FFFFFF;"><span style="font-size:32px;line-height:36px;font-weight:bold;">Belajar Coding Online</span></p>
                    <p style="font-size:16px;line-height:18px;color:#FFFFFF;">Nikmati pembelajaran coding online yang berkualitas dan bersetandar internasional gratis.</p>
                </div>
            </div>
        </div>
    </div>
    <div id="wb_intro">
        <div id="intro">
            <div class="row">
                <div class="col-1">
                    <div class="col-1-padding">
                        <div id="wb_introHeading" style="display:inline-block;width:100%;z-index:6;">
                            <h1 id="introHeading">Dapatkan Karir Impian Dengan Belajar Pemrograman</h1>
                        </div>
                        <div id="wb_introText">
                            <p style="color:#969696;">Materi di susun dengan teratur dan mudah di fahami, mulai lah belajar sekarang juga dan menjadi developer handal.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="wb_services">
        <div id="services">
            <div class="row">
                <div class="col-1">
                    <div class="col-1-padding">
                        <div id="wb_servicesCard1" style="display:flex;width:100%;text-align:center;z-index:8;" data--250-bottom="transform: scale(1.0,1.0);" data-333-bottom="transform: scale(0.5,0.5);">
                            <div id="servicesCard1-card-body">
                                <div id="servicesCard1-card-item0"><img src="<?php echo base_url('assets/user/images/logo_android.png'); ?>" id="Image1"  alt="Android Development" style="width:60px;height:50px;"></div>
                                <div id="servicesCard1-card-item1">Android Development</div>
                                <div id="servicesCard1-card-item2">Do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                <div id="servicesCard1-card-item3" ><a href="index.php/slearn/login">Login Untuk Mulai Belajar ></a></div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="col-2-padding">
                        <div id="wb_servicesCard2" style="display:flex;width:100%;text-align:center;z-index:9;" data--250-bottom="transform: scale(1.0,1.0);" data-333-bottom="transform: scale(0.5,0.5);">
                            <div id="servicesCard2-card-body">
                                <div id="servicesCard2-card-item0"><img src="<?php echo base_url('assets/user/images/logo_html.png'); ?>" id="Image1"  alt="Web Development" style="width:60px;height:50px;"></div>
                                <div id="servicesCard2-card-item1">Front-End Web Developer</div>
                                <div id="servicesCard2-card-item2">Do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                <div id="servicesCard2-card-item3">Login Untuk Mulai Belajar ></div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="col-3-padding">
                        <div id="wb_servicesCard3" style="display:flex;width:100%;text-align:center;z-index:10;" data--250-bottom="transform: scale(1.0,1.0);" data-333-bottom="transform: scale(0.5,0.5);">
                            <div id="servicesCard3-card-body">
                                <div id="servicesCard3-card-item0"><img src="<?php echo base_url('assets/user/images/machine_learning.png'); ?>" id="Image1"  alt="Machine Learning" style="width:60px;height:50px;"></div>
                                <div id="servicesCard3-card-item1">Machine Learning</div>
                                <div id="servicesCard3-card-item2">Do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                <div id="servicesCard3-card-item3">Login Untuk Mulai Belajar ></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>