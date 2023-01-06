<?php
/* Keep it as clean as possible in here, try to include classes instead of plain functions */
require_once get_template_directory() . '/classes/class-uptop-setup.php';

$settings = [
    'woocommerce' => false,
	'dev' => true,
	'acf_option_page' => true,
	'acf_google_api' => 'AIzaSyCtuG5fXssq6mf8QoW1hqyIGp1fxGrT_0M',
];

new UptopSetup($settings);