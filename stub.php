#!/usr/bin/env php
<?php
/**
 * If your package does special stuff in phar format, use this file.  Remove if
 * no phar format is ever generated
 * More information: http://pear.php.net/manual/en/pyrus.commands.package.php#pyrus.commands.package.stub
 */
if (version_compare(phpversion(), '5.3.1', '<')) {
    if (substr(phpversion(), 0, 5) != '5.3.1') {
        // this small hack is because of running RCs of 5.3.1
        echo "Pyrus_VendorCommands requires PHP 5.3.1 or newer.
";
        exit -1;
    }
}
foreach (array('phar', 'spl', 'pcre', 'simplexml') as $ext) {
    if (!extension_loaded($ext)) {
        echo 'Extension ', $ext, " is required
";
        exit -1;
    }
}
try {
    Phar::mapPhar();
} catch (Exception $e) {
    echo "Cannot process Pyrus_VendorCommands phar:
";
    echo $e->getMessage(), "
";
    exit -1;
}
function Pyrus_VendorCommands_autoload($class)
{
    $class = str_replace(array('_', '\\'), '/', $class);
    if (file_exists('phar://' . __FILE__ . '/Pyrus_VendorCommands-@PACKAGE_VERSION@/php/' . $class . '.php')) {
        include 'phar://' . __FILE__ . '/Pyrus_VendorCommands-@PACKAGE_VERSION@/php/' . $class . '.php';
    }
}
spl_autoload_register("Pyrus_VendorCommands_autoload");
$phar = new Phar(__FILE__);
$sig = $phar->getSignature();
define('Pyrus_VendorCommands_SIG', $sig['hash']);
define('Pyrus_VendorCommands_SIGTYPE', $sig['hash_type']);

// your package-specific stuff here, for instance, here is what Pyrus does:

/**
 * $frontend = new \Pyrus\ScriptFrontend\Commands;
 * @array_shift($_SERVER['argv']);
 * $frontend->run($_SERVER['argv']);
 */
__HALT_COMPILER();
