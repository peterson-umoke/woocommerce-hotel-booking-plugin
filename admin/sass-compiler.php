<?php

/**
 * 
 * This SASS Compiler compiles scss to css with the right sourcemaps
 * 
 * @todo convert the sass compiler to a oop object
 * @author Peterson Nwachukwu Umoke <umoke10@hotmail.com>
 * @version 1.0.0
 */

if(!defined("WPK_SCSS")) define("WPK_SCSS", dirname( dirname( __FILE__ ) ) );

$compile_path = WPK_SCSS . DIRECTORY_SEPARATOR . "admin" . DIRECTORY_SEPARATOR . "scss/";
$includes_path = WPK_SCSS . DIRECTORY_SEPARATOR . "admin" . DIRECTORY_SEPARATOR . "scss/";

/**
 * Require the main file
 */
require_once WPK_SCSS . DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "scssphp"  . DIRECTORY_SEPARATOR ."scss.inc.php";

use Leafo\ScssPhp\Compiler;
use Leafo\ScssPhp\Server;

$scss_engine = new Compiler();
$scss_engine->setImportPaths($includes_path);
$scss_engine->setFormatter('Leafo\ScssPhp\Formatter\Compressed');

$scss_engine_server = new Server($compile_path, null, $scss_engine);
$scss_engine_server->serve();
?>