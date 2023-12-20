<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CI4Backend</title>
    <meta name="description" content="<?php if (isset($description))
        echo $description; ?>">
    <meta name="keywords" content="<?php if (isset($keywords))
        echo $keywords ?>">
        <meta name="author" content="ORA Finance">
        <meta name="facebook-domain-verification" content="vy3iouk1ldqhoba95j3lyc84j8p73q" />
        <meta property="og:type" content="website">
        <meta property="og:url" content="<?php echo base_url() ?>">
    <meta property="og:title" content="CI4Backend">
    <meta property="og:description" content="<?php if (isset($description))
        echo $description; ?>">
    <meta property="og:image" content="<?php echo base_url() ?>assets/images/web_preview.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?php echo base_url() ?>">
    <meta property="twitter:title" content="CI4Backend">
    <meta property="twitter:description" content="<?php if (isset($description))
        echo $description; ?>">
    <meta property="twitter:image" content="<?php echo base_url() ?>assets/images/web_preview.png">

    <link rel="icon" type="image/png" href="<?php echo base_url() ?>assets/images/favicon.png">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/orafinance-icon.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/icofont.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/settings.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/slick.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/owl.theme.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/preset.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/theme.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/custom.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/sweetalert2.min.css" />
    <?= $this->renderSection('style') ?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/custom/main.css" />
</head>
<style>
    .active_a{
        color: #e86c02 !important ;
    }
</style>

<body>
    <!-- Preloading -->
    <div class="preloader text-center">
        <div class="la-ball-circus la-2x">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- Preloading -->
    <!-- Header section -->
    <header class="header_1" id="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3">
                    <div class="logo">
                        <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url() ?>assets/images/logo.png"
                                alt=""></a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <nav class="mainmenu MenuInRight text-right">
                        <a href="javascript:void(0);" class="mobilemenu d-md-none d-lg-none d-xl-none">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                        <?php $menusObj =  new \App\Services\MenusService(); $menus = $menusObj->getMenus(); if($menus) {  ?>
                            <ul>
                                <?php foreach($menus as $lev1) { ?>
                                    <?php if(empty($lev1['child'])) { ?>
                                        <li><a href="<?= $lev1['name'] != "Login" ? base_url().$lev1['url'] : $lev1['url'] ; ?>"><?= $lev1['name'] ?></a></li>
                                    <?php } else { ?>
                                        <li class="menu-item-has-children">
                                            <a href="#"><?= $lev1['name'] ?></a>
                                            <ul class="sub-menu">
                                                <?php foreach($lev1['child'] as $lev2) { ?>
                                                    <?php if(empty($lev2['child'])) { ?>
                                                        <li><a href="<?php echo base_url().$lev2['url']; ?>"><?= $lev2['name'] ?></a></li>
                                                    <?php } else { ?>
                                                        <li class="menu-item-has-children">
                                                            <a href="#"><?= $lev2['name'] ?></a>
                                                            <ul class="sub-menu">
                                                                <?php foreach($lev2['child'] as $lev3) { ?>
                                                                    <?php if(empty($lev3['child'])) { ?>
                                                                        <li><a href="<?php echo base_url().$lev3['url']; ?>"><?= $lev3['name'] ?></a></li>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </ul>
                                                        </li>
                                                    <?php } ?>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                        <!-- <ul>
                            <li><a href="<?php echo base_url(); ?>#products">Products</a></li>
                            <li><a href="<?php echo base_url('about'); ?>">About Us</a></li>
                            <li class="menu-item-has-children">
                                <a href="#">Others</a>
                                <ul class="sub-menu">
                                    <li><a href="<?php echo base_url('policies'); ?>">Policies</a></li>
                                    <li class="menu-item-has-children">
                                        <a href="#">Impact</a>
                                        <ul class="sub-menu">
                                            <li><a href="portfolio.html">Portfolio</a></li>
                                            <li><a href="portfolio_detail.html">Portfolio Details</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url('investor_relation'); ?>">Investor Relation</a></li>
                            <li><a href="https://los.orafinance.in/admin" target="_blank"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
                        </ul> -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header section -->

    <?= $this->renderSection('content') ?>

    <!-- footer section -->
    <footer class="text-lg-start footer footer_2 py-5">
        <div class="container text-md-start">
            <!-- Grid row -->
            <div class="row">
                <!-- Grid column -->
                <div class="col-md-5 col-lg-5 col-xl-5 mx-auto mb-2">
                    <!-- Content -->
                    <aside class="widget about_widgets">
                        <img class="mb-3" src="<?php echo base_url() ?>assets/images/logo.png" alt="" />
                        <p>+91-9838122252</p>
                        <p>care@ci4backend.in</p>
                    </aside>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-2 footer_ps">
                    <!-- Links -->
                    <p>
                        <a href="<?php echo base_url(); ?>#products" class="">Products</a>
                    </p>
                    <p>
                        <a href="<?php echo base_url('about') ?>" class="">About Us</a>
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-2">
                    <aside class="widget subscribe_widgets">
                        <h4>Subscribe our newsletter.</h4>
                        <form id="subscrbe_form" action="<?php echo base_url('subscribe'); ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="email" placeholder="Email address" class="required_field form_field"
                                name="subscriber_email" id="subscriber_email" />
                            <input type="text" placeholder="Phone no." class="required_field form_field"
                                name="subscriber_mobile" id="subscriber_mobile" maxlength="10" />
                            <button type="submit" class="common_btn" id="subscribe_btn">Subscribe now</button>
                        </form>
                    </aside>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </footer>
    <!-- footer section -->

    <!-- Copyright section -->
    <section class="copyright copyright_2">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <p>Copyright &copy; CI4Backend. All rights reserved</p>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="#" id="backTo"><i class="flaticon-chevron"></i></a>
                </div>
            </div>
        </div>
    </section>
    <!-- Copyright section -->

    <!-- Include All JS -->
    <script src="<?php echo base_url() ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/sweetalert2.all.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/custom/main.js "></script>
    <script src="<?php echo base_url() ?>assets/js/modernizr.custom.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.themepunch.revolution.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.themepunch.tools.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>
    <script src="<?php echo base_url() ?>assets/js/shuffle.js"></script>
    <script src="<?php echo base_url() ?>assets/js/slick.js"></script>
    <script src="<?php echo base_url() ?>assets/js/gmaps.js"></script>
    <script src="<?php echo base_url() ?>assets/js/owl.carousel.js"></script>
    <script src="<?php echo base_url() ?>assets/js/theme.js"></script>
    <script src="<?php echo base_url() ?>assets/js/chart.js"></script>
    <script>

        var currentURL = window.location.href;
        var menuItems = document.querySelectorAll(".mainmenu ul li a");

        menuItems.forEach(function(item) {
            if (item.href === currentURL) {
                item.classList.add("active_a");
            }
        });
        // console.log("Current URL:", currentURL);

    </script>

    <?= $this->renderSection('script') ?>
</body>

</html>