<?php if (!defined('BASEPATH'))
    exit('No direct script access
allowed');
$route['default_controller'] = "home";
$route['login'] = 'home/login';
$route['login_failure'] = 'home/login';
$route['dashboard'] = 'home';
$route['item'] = 'newitem';
$route['model'] = 'stock';
$route['proses'] = 'mesin';
$route['monitoring'] = 'monitoring';
$route['report'] = 'report';
$route['404_override'] = 'MY_Exceptions/show_404';/* End of file
routes.php */
/* Location: ./application/config/routes.php */