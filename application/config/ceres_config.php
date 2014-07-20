<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['app_root'] = '/ceres';

$config['app_name'] = 'Collective Electronic Registry of Elective Surgeries';

$config['jquery'] = $config['app_root'].'/js/jquery-1.11.1.min.js';

$config['bootstrap_css'] = $config['app_root'].'/bootstrap/css/bootstrap.min.css';

$config['bootstrap_js'] = $config['app_root'].'/bootstrap/js/bootstrap.min.js';

$config['datatables_css'] = $config['app_root'].'/datatables/jquery.dataTables.min.css';

$config['datatables_js'] = $config['app_root'].'/datatables/jquery.dataTables.min.js';

$config['datepicker_css'] = $config['app_root'].'/datepicker/datepicker.css';

$config['datepicker_js'] = $config['app_root'].'/datepicker/bootstrap-datepicker.js';

$config['logged_startpage'] = $config['app_root'].'/index.php/welcome';

$config['access_type']['0'] = "Administrator";
$config['access_type']['1'] = "Manager";
$config['access_type']['2'] = "Viewer";

$config['pw_changed']['0'] = "No";
$config['pw_changed']['1'] = "Yes";
