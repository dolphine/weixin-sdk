<?php

define('API_NAME', '');
define('API_TOKEN', '');


include_once ('./class.unifi.php');

$from_user_name = '';
print_r(Unifi::get_url($from_user_name));
print_r(Unifi::unsubscribe($from_user_name));