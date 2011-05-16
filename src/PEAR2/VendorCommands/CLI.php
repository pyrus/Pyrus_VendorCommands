<?php
/**
 * PEAR2\VendorCommands\Main
 *
 * PHP version 5
 *
 * @category  PEAR2
 * @package   PEAR2_VendorCommands
 * @author    Brett Bieber <brett.bieber@gmail.com>
 * @copyright 2011 Brett Bieber
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   SVN: $Id$
 * @link      https://github.com/pear2/PEAR2_VendorCommands
 */

/**
 * Main class for PEAR2_VendorCommands
 *
 * @category  PEAR2
 * @package   PEAR2_VendorCommands
 * @author    Brett Bieber <brett.bieber@gmail.com>
 * @copyright 2011 Brett Bieber
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @link      https://github.com/pear2/PEAR2_VendorCommands
 */
namespace PEAR2\VendorCommands;
class CLI
{
    /**
     * Command to update dependencies found
     *
     * @param PEAR2\Pyrus\ScriptFrontend\Commands $frontend
     * @param array $args
     * @param array $options
     */
    function updateDependencies($frontend, $args, $options)
    {
        $main = new Main();

        if ($args['vendor_dir']) {
            $main->setPath($args['vendor_dir']);
        }

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