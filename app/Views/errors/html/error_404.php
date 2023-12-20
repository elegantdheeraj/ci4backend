<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ora Finance - Agri Banking & Agri Business Loan</title>
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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/responsive.css" />
    <!-- Favicon Icon -->

</head>

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
                        <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url() ?>assets/images/logo.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header section -->

    <!-- Common Section -->
    <section class="commonSection page_4040">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="content_404 text-center">
                        <h1>404</h1>
                        <?php if (ENVIRONMENT !== 'production') : ?>
                            <p><?= nl2br(esc($message)) ?></p>
                        <?php else : ?>
                            <h4>Opps! This page is not found.</h4>
                            <p><?= lang('Errors.sorryCannotFind') ?></p>
                        <?php endif ?>
                        <a class="common_btn" href="<?php echo base_url(); ?>">Back to home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Common Section -->
    <!-- Copyright section -->
    <section class="copyright copyright_2">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <p>Copyright &copy; ORA Financ Pvt Ltd. All rights reserved</p>
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
    <script src="<?php echo base_url() ?>assets/js/modernizr.custom.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.themepunch.revolution.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.themepunch.tools.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>
    <script src="<?php echo base_url() ?>assets/js/shuffle.js"></script>
    <script src="<?php echo base_url() ?>assets/js/slick.js"></script>
    <script src="<?php echo base_url() ?>assets/js/gmaps.js"></script>
    <!--<script src="https://maps.google.com/maps/api/js?key=AIzaSyCysDHE3s4Qw3nTh9o58-2mJcqvR6HV8Kk"></script>-->
    <script src="<?php echo base_url() ?>assets/js/owl.carousel.js"></script>
    <script src="<?php echo base_url() ?>assets/js/theme.js"></script>
</body>

</html>