<?php
define('ROOT', __DIR__ . DIRECTORY_SEPARATOR);
define('BASE', basename(ROOT));
define('CORE', ROOT . 'core' . DIRECTORY_SEPARATOR);
define('MODULE', ROOT . 'module' . DIRECTORY_SEPARATOR);
define('VENDOR', ROOT . 'vendor' . DIRECTORY_SEPARATOR);

function autoload($className) {
	global $config;

    $classPath = str_replace('\\', '/', $className) . '.php';

	if (is_readable(CORE . $classPath))
        include_once CORE . $classPath;
    else if (is_readable(MODULE . $classPath))
        include_once MODULE . $classPath;
    else if (is_readable(VENDOR . $classPath))
        include_once VENDOR . $classPath;
	else
		foreach (System::getConfig('autoloadDirectories') as $dir)
			if (is_readable($dir . $classPath))
				include_once $dir . $classPath;

    return true;
}
spl_autoload_register('autoload', true, true);

System::init();