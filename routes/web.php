<?php 

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', function(){
    return view('default');
});


/*
 * --------------------------------------------------------------------
 * admin Routing
 * --------------------------------------------------------------------
 *
 * 
 */
$routes->match(['get', 'post'], 'user/login', 'Admin\Auth::login');
$routes->get('user/logout', 'Admin\Auth::logout');

$routes->group('backend', static function ($routes) {

    //dashboard
    $routes->get('/', 'Admin\Dashboard::index');
    //images
    $routes->get('images', 'Admin\Images::index/$1');
    $routes->match(['get', 'post'], 'image/add', 'Admin\Images::add');
    $routes->match(['get', 'post'], 'image/edit/(:any)', 'Admin\Images::edit/$1');
    $routes->get('image/delete/(:any)', 'Admin\Images::delete/$1');
    //users
    $routes->get('users', 'Admin\UsersController::index');
    $routes->match(['get', 'post'], 'user/add', 'Admin\UsersController::add');
    $routes->match(['get', 'post'], 'user/edit/(:any)', 'Admin\UsersController::edit/$1');
    $routes->get('user/delete/(:any)', 'Admin\UsersController::delete/$1');
    //role
    $routes->get('roles', 'Admin\UsersController::roles');
    $routes->match(['get', 'post'], 'role/add', 'Admin\UsersController::roleAdd');
    $routes->match(['get', 'post'], 'role/edit/(:any)', 'Admin\UsersController::roleEdit/$1');
    $routes->get('role/delete/(:any)', 'Admin\UsersController::roleDelete/$1');
    //setting
    //admin menu items
    $routes->get('admin_menus', 'Admin\MenusController::index');
    $routes->match(['get', 'post'], 'admin_menu/add', 'Admin\MenusController::add');
    $routes->match(['get', 'post'], 'admin_menu/edit/(:any)', 'Admin\MenusController::edit/$1');
    $routes->get('admin_menu/delete/(:any)', 'Admin\MenusController::delete/$1');
    //admin menu items
    $routes->get('menus', 'Admin\MenusController::menus');
    $routes->match(['get', 'post'], 'menu/add', 'Admin\MenusController::menuAdd');
    $routes->match(['get', 'post'], 'menu/edit/(:any)', 'Admin\MenusController::menuEdit/$1');
    $routes->get('menu/delete/(:any)', 'Admin\MenusController::menuDelete/$1');
});