<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CI4Backend</title>
    <meta name="author" content="CI4Backend">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url() ?>assets/images/favicon.png">
    <link href="<?php echo base_url() ?>assets/plugin/izitoast/css/iziToast.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url() ?>assets/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/admin/css/app.css" rel="stylesheet">
    <?= $this->renderSection('style') ?>
    <style>
        /* .navbar {
            --bs-navbar-padding-x: 1.375rem;
            --bs-navbar-padding-y: 0.875rem;
        } */

        /* .c-height {
            height: 48px;
        } */
    </style>
</head>

<body data-theme="light">
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand text-decoration-none" href="<?php echo base_url('backend') ?>">
                    <img class="c-height object-fit-scale"
                        src="<?php echo base_url('assets/admin/img/icons/oralogo.png') ?>" />
                </a>

                <ul class="sidebar-nav">
                    <?php 
                        $user_menus_access = session()->has('USER_MENUS_ACCESS') ? session()->get('USER_MENUS_ACCESS') : [] ; 
                        $loggedInUser = session()->get('LOGGEDIN_USER');
                    ?>
                    <?php $backendMenus =  new \App\Services\MenusService();  ?>
                    <?php foreach($backendMenus->getBackendMenus() as $menu1) : ?>  
                        <?php if(in_array($menu1['url'], $user_menus_access) || $loggedInUser->role == 101) : ?>
                            <?php if(empty($menu1['child'])) : ?>
                                <li class="sidebar-item active">
                                    <a class="sidebar-link" href="<?= base_url($menu1['url']) ?>">
                                        <i class="align-middle" data-feather="<?= $menu1['f_icon'] ?>"></i> <span class="align-middle"><?= $menu1['name'] ?></span>
                                    </a>
                                </li>
                            <?php else : ?>  
                                <li class="sidebar-item">
                                    <a href="#<?= $menu1['id'] ?>" data-bs-toggle="collapse" class="sidebar-link collapsed">
                                        <span class="align-middle"><i class="align-middle" data-feather="<?= $menu1['f_icon'] ?>"></i> <?= $menu1['name'] ?></span>
                                    </a>
                                    <ul id="<?= $menu1['id'] ?>" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                                        <?php foreach($menu1['child'] as $menu2) : ?>  
                                            <?php if(in_array($menu2['url'], $user_menus_access) || $loggedInUser->role == 101) : ?>
                                                <?php if(empty($menu2['child'])) : ?>
                                                    <li class="sidebar-item"><a class="sidebar-link" href="<?= base_url($menu2['url']) ?>"><?= $menu2['name'] ?></a></li>
                                                <?php endif; ?>
                                            <?php endif; ?> 
                                        <?php endforeach; ?>  
                                    </ul>
                                </li>
                            <?php endif; ?>  
                        <?php endif; ?>  
                    <?php endforeach; ?> 
                    <!-- <li class="sidebar-item active">
                        <a class="sidebar-link" href="<?= base_url('backend') ?>">
                            <i class="align-middle" data-feather="home"></i> <span class="align-middle">Dashboard</span>
                        </a>
                    </li> -->
                    <!-- <li class="sidebar-item">
                        <a href="#extra" data-bs-toggle="collapse" class="sidebar-link collapsed">
                            <span class="align-middle"><i class="align-middle" data-feather="zap"></i> Extra</span>
                        </a>
                        <ul id="extra" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url('backend/impact') ?>">Impacts List</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="<?php echo base_url('backend/images') ?>">Images</a></li>
                            <li class="sidebar-item">
                                <a href="#auth2" data-bs-toggle="collapse" class="sidebar-link collapsed">
                                    <span class="align-middle">Impacts</span>
                                </a>
                                <ul id="auth2" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#extra">
                                    <li class="sidebar-item"><a class="sidebar-link" href="#sign">Sign
                                            In</a></li>
                                    <li class="sidebar-item"><a class="sidebar-link" href="pages-sign-up.html">Sign
                                            Up</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->
                    <!-- <li class="sidebar-item">
                        <a href="#users" data-bs-toggle="collapse" class="sidebar-link collapsed">
                            <span class="align-middle"><i class="align-middle" data-feather="user"></i> Users</span>
                        </a>
                        <ul id="users" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="<?= base_url('backend/users') ?>">Users</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="<?= base_url('backend/roles') ?>">User Role</a></li>
                        </ul>
                    </li> -->
                    <!-- <li class="sidebar-item">
                        <a href="#setting" data-bs-toggle="collapse" class="sidebar-link collapsed">
                            <span class="align-middle"><i class="align-middle" data-feather="settings"></i> Setting</span>
                        </a>
                        <ul id="setting" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item"><a class="sidebar-link" href="<?= base_url('backend/admin_menus') ?>">Admin Menus</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="<?= base_url('backend/menus') ?>">Menus</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="<?= base_url('backend/documents') ?>">Documents</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="<?= base_url('backend/business_type') ?>">Business Type</a></li>
                        </ul>
                    </li> -->

                    <!-- <li class="sidebar-item">
                        <a data-bs-target="#multi" data-bs-toggle="collapse" class="sidebar-link collapsed"
                            aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-corner-right-down align-middle">
                                <polyline points="10 15 15 20 20 15"></polyline>
                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                            </svg> <span class="align-middle">Multi Level</span>
                        </a>
                        <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"
                            style="">
                            <li class="sidebar-item">
                                <a data-bs-target="#multi-2" data-bs-toggle="collapse" class="sidebar-link collapsed"
                                    aria-expanded="false">Two Levels</a>
                                <ul id="multi-2" class="sidebar-dropdown list-unstyled collapse">
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="#">Item 1</a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="#">Item 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item">
                                <a data-bs-target="#multi-3" data-bs-toggle="collapse" class="sidebar-link collapsed"
                                    aria-expanded="false">Three Levels</a>
                                <ul id="multi-3" class="sidebar-dropdown list-unstyled collapse" style="">
                                    <li class="sidebar-item">
                                        <a data-bs-target="#multi-3-1" data-bs-toggle="collapse"
                                            class="sidebar-link">Item 1</a>
                                        <ul id="multi-3-1" class="sidebar-dropdown list-unstyled collapse" style="">
                                            <li class="sidebar-item">
                                                <a class="sidebar-link" href="#">Item 1</a>
                                            </li>
                                            <li class="sidebar-item">
                                                <a class="sidebar-link" href="#">Item 2</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="sidebar-item">
                                        <a class="sidebar-link" href="#">Item 2</a>
                                    </li>
                                </ul>
                            </li>
                        </ul> -->
                    </li>
                </ul>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>
                <span class="h6 m-0"><strong>
                        <?= isset($title) ? $title : "" ?>
                    </strong></span>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item">
                            <a class="nav-icon js-fullscreen d-none d-lg-block" href="#">
                                <div class="position-relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-maximize align-middle">
                                        <path
                                            d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3">
                                        </path>
                                    </svg>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="bell"></i>
                                    <span class="indicator">4</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                                aria-labelledby="alertsDropdown">
                                <div class="dropdown-menu-header">
                                    4 New Notifications
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-danger" data-feather="alert-circle"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Update completed</div>
                                                <div class="text-muted small mt-1">Restart server 12 to complete the
                                                    update.</div>
                                                <div class="text-muted small mt-1">30m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-warning" data-feather="bell"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Lorem ipsum</div>
                                                <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate
                                                    hendrerit et.</div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-primary" data-feather="home"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Login from 192.186.1.8</div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-success" data-feather="user-plus"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">New connection</div>
                                                <div class="text-muted small mt-1">Christina accepted your request.
                                                </div>
                                                <div class="text-muted small mt-1">14h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all notifications</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown"
                                data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="message-square"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0"
                                aria-labelledby="messagesDropdown">
                                <div class="dropdown-menu-header">
                                    <div class="position-relative">
                                        4 New Messages
                                    </div>
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="<?php echo base_url() ?>/assets/admin/img/avatars/avatar-5.jpg"
                                                    class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Vanessa Tucker</div>
                                                <div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu
                                                    tortor.</div>
                                                <div class="text-muted small mt-1">15m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="<?php echo base_url() ?>/assets/admin/img/avatars/avatar-2.jpg"
                                                    class="avatar img-fluid rounded-circle" alt="William Harris">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">William Harris</div>
                                                <div class="text-muted small mt-1">Curabitur ligula sapien euismod
                                                    vitae.</div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="<?php echo base_url() ?>/assets/admin/img/avatars/avatar-4.jpg"
                                                    class="avatar img-fluid rounded-circle" alt="Christina Mason">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Christina Mason</div>
                                                <div class="text-muted small mt-1">Pellentesque auctor neque nec urna.
                                                </div>
                                                <div class="text-muted small mt-1">4h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="<?php echo base_url() ?>/assets/admin/img/avatars/avatar-3.jpg"
                                                    class="avatar img-fluid rounded-circle" alt="Sharon Lessman">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Sharon Lessman</div>
                                                <div class="text-muted small mt-1">Aenean tellus metus, bibendum sed,
                                                    posuere ac, mattis non.</div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all messages</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-icon" href="<?= base_url('user/logout'); ?>" data-bs-toggle="tooltip"
                                data-bs-title="Logout">
                                <i class="align-middle" data-feather="power"></i>
                                <!-- <div class="position-relative">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize align-middle"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg>
                                </div> -->
                            </a>

                        </li>
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-bs-toggle="dropdown">
                                <img src="assets/admin/img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1"
                                    alt="Charles Hall" /> <span class="text-dark">Charles Hall</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1"
                                        data-feather="user"></i> Profile</a>
                                <a class="dropdown-item" href="#">Log out</a>
                            </div>
                        </li> -->
                    </ul>
                </div>
            </nav>

            <main class="content">
                <?= $this->renderSection('content') ?>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-12 text-end">
                            <a class="text-muted" href="<?php echo base_url(); ?>" target="_blank"><strong>CI4Backend</strong></a> - 2023 &copy;
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="<?php echo base_url() ?>assets/admin/js/app.js"></script>
    <script src="<?php echo base_url() ?>assets/plugin/izitoast/js/iziToast.min.js"></script>
    <?= $this->renderSection('script') ?>
    <script>
        iziToast.settings({
            'position': 'topRight',
            'transitionIn': 'flipInX',
            'transitionOut': 'flipOutX',
        });
        $(document).ready(function () {
            let error = `<?= session()->has('error'); ?>`;
            let warning = `<?= session()->has('warning'); ?>`;
            let success = `<?= session()->has('success'); ?>`;
            if (error) {
                iziToast.error({ message: `<?= session()->getFlashdata('error'); ?>` });
            }
            if (warning) {
                iziToast.warning({ message: `<?= session()->getFlashdata('warning'); ?>` });
            }
            if (success) {
                iziToast.success({ message: `<?= session()->getFlashdata('success'); ?>` });
            }
        });
    </script>
    <script>
        // Function to set a cookie
        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (1 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + value + expires + "; path=/";
        }

        // Function to get a cookie value
        function getCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) === ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        $(document).ready(function () {
            // Check if a cookie for the active item exists
            var activeItem = getCookie('activeItem');

            // If a cookie exists, set the active class
            if (activeItem) {
                $('.sidebar-item').removeClass('active');
        
                $('.sidebar-link[href="' + activeItem + '"]').parents('.sidebar-item').addClass('active');

                // If it's a dropdown, also open the dropdown
                $('.sidebar-dropdown.show').removeClass('show');
                $('.sidebar-link[href="' + activeItem + '"]').parents('.sidebar-dropdown').addClass('show');
            }

            // Handle click events on sidebar items
            $('.sidebar-link').on('click', function () {
                if($(this).attr('data-bs-toggle')) {
                    return true;
                }
                var clickedLink = $(this).attr('href');
                // Set the active item cookie
                setCookie('activeItem', clickedLink, 7);
                // Remove active class from all items
                $('.sidebar-item').removeClass('active');
                // Add active class to the clicked item
                $(this).closest('.sidebar-item').addClass('active');
                // If it's a dropdown, also open the dropdown
                $('.sidebar-dropdown.show').removeClass('show');
                $(this).closest('.sidebar-item').find('.sidebar-dropdown').addClass('show');
            });
        });
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                        form.classList.add('was-validated')
                    } else {
                        $(form).find(":submit").html('<div class="spinner-border spinner-border-sm" role="status"></div> Saving...');
                    }
                }, false)
            })
        })();
    </script>
</body>

</html>