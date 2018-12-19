<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['place/([0-9]*)'] = '/place/index/$1';
$route['converter/([0-9]*)'] = '/converter/id/$1';
