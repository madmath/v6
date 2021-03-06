<?php
/**
 * CubeCart v6
 * ========================================
 * CubeCart is a registered trade mark of CubeCart Limited
 * Copyright CubeCart Limited 2015. All rights reserved.
 * UK Private Limited Company No. 5323904
 * ========================================
 * Web:   http://www.cubecart.com
 * Email:  sales@cubecart.com
 * License:  GPL-3.0 https://www.gnu.org/licenses/quick-guide-gplv3.html
 */
if (!defined('CC_INI_SET')) die('Access Denied');
if (version_compare(PHP_VERSION, '5.2.3', '<')) {
	die('<strong>ERROR!</strong><br />CubeCart requires <a href="http://www.php.net">PHP</a> Version 5.2.3 or better. Your server is currently running PHP Version '.PHP_VERSION);
}
global $glob;
define('ADMIN_CP', true);
// Initialize Cache
$GLOBALS['cache'] = Cache::getInstance();
// Initialize Database class, and fetch default configuration
$GLOBALS['db'] = Database::getInstance($glob);
// Initialize Config class
$GLOBALS['config'] = Config::getInstance($glob);
// Initialize debug
$GLOBALS['debug'] = Debug::getInstance();
// Initialize sessions
$GLOBALS['session'] = Session::getInstance();
//Check security token
Sanitize::checkToken();
// Initialize Smarty
$GLOBALS['smarty'] = new Smarty();
$GLOBALS['smarty']->muteExpectedErrors();
$GLOBALS['smarty']->error_reporting = E_ALL & ~E_NOTICE & ~E_WARNING;
$GLOBALS['smarty']->compile_dir  = CC_SKIN_CACHE_DIR;
$GLOBALS['smarty']->config_dir  = CC_SKIN_CACHE_DIR;
$GLOBALS['smarty']->cache_dir  = CC_SKIN_CACHE_DIR;
//Initialize language
$GLOBALS['language'] = Language::getInstance();
//Initialize hooks
$GLOBALS['hooks'] = HookLoader::getInstance();
//Initialize GUI
$GLOBALS['gui'] = GUI::getInstance(true);
//Initialize SEO
$GLOBALS['seo'] = SEO::getInstance();
//Initialize SSL
$GLOBALS['ssl'] = SSL::getInstance();
//Setup language template
$GLOBALS['language']->setTemplate();
//Initialize Catalogue
$GLOBALS['catalogue'] = Catalogue::getInstance();

// Define the default timezone
$tz = $GLOBALS['config']->get('config', 'time_zone');
date_default_timezone_set((!empty($tz)) ? $tz : 'UTC');

$GLOBALS['main'] = ACP::getInstance();
$lang = $GLOBALS['language']->getLanguageStrings();

$global_template_file['session_true']  = 'main.php';
$global_template_file['session_false']  = 'login.php';

// hook_tab_content is a place where hooks can specify template includes that
// define their admin tab content.
$GLOBALS['hook_tab_content'] = array();

foreach ($GLOBALS['hooks']->load('controller.admin') as $hook) include $hook;