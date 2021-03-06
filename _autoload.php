<?php
// set error reporting high
error_reporting(E_ALL | E_STRICT);

// make sure we see them
ini_set('display_errors', 'On');

// make sure current directory and class directories are on include path
// this is necessary for auto load to work
set_include_path(join(PATH_SEPARATOR, array(
    dirname(__FILE__) . DIRECTORY_SEPARATOR . '/src',
    dirname(__FILE__) . DIRECTORY_SEPARATOR . '/tests',
    get_include_path()
)));

// set up an autoload for Zend / Pear style class loading
spl_autoload_register(function ($class) {
    if (0 === strpos($class, 'Image')) {
        require_once str_replace('\\', '/', $class) . '.php';
    }
}, true, true);
