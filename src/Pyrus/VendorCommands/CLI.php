<?php
/**
 * Pyrus\VendorCommands\Main
 *
 * PHP version 5
 *
 * @category  Pyrus
 * @package   Pyrus_VendorCommands
 * @author    Brett Bieber <brett.bieber@gmail.com>
 * @copyright 2011 Brett Bieber
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   SVN: $Id$
 * @link      https://github.com/pyrus/Pyrus_VendorCommands
 */

/**
 * Main class for Pyrus_VendorCommands
 *
 * @category  Pyrus
 * @package   Pyrus_VendorCommands
 * @author    Brett Bieber <brett.bieber@gmail.com>
 * @copyright 2011 Brett Bieber
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @link      https://github.com/pyrus/Pyrus_VendorCommands
 */
namespace Pyrus\VendorCommands;
class CLI
{
    /**
     * Command to update dependencies found
     *
     * @param Pyrus\ScriptFrontend\Commands $frontend
     * @param array $args
     * @param array $options
     */
    function updateDependencies($frontend, $args, $options)
    {
        $main = new Main($args['vendor_dir']);

        echo 'Scanning '.$main->getPath().' for dependencies...'.PHP_EOL;
        $deps = $main->scanPackageXMLDependencies();

        echo count($deps) . ' found in the package.xml file'.PHP_EOL;

        // Now run the pyrus frontend with the commands we need
        $py_args = array('package' => $deps);
        $py_opts = array(
                     'force'        => $options['force'],
                     'optionaldeps' => $options['optionaldeps'],
                     'plugin'       => false,
                     'upgrade'      => true,
        );

        // Now execute the install command for pyrus
        $frontend->install($py_args, $py_opts);

        echo 'Done'.PHP_EOL;
    }
}