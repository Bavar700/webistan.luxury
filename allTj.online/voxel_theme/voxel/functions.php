<?php

namespace Voxel;

if (!defined('ABSPATH')) {
	exit;
}

function is_debug_mode()
{
	return defined('WP_DEBUG') && WP_DEBUG;
}

function is_dev_mode()
{
	return defined('VOXEL_DEV_MODE') && VOXEL_DEV_MODE;
}

function is_running_tests()
{
	return defined('VOXEL_RUNNING_TESTS') && VOXEL_RUNNING_TESTS;
}

require_once locate_template('app/utils/utils.php');
if (file_exists(__DIR__ . '/app/import-categories.php')) {
	require_once __DIR__ . '/app/import-categories.php';
}

foreach (\Voxel\config('controllers') as $controller) {
	new $controller;
}
