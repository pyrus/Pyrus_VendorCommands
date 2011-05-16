<?php
/**
 * PEAR2\VendorCommands\Main
 *
 * PHP version 5
 *
 * @category  Yourcategory
 * @package   PEAR2_VendorCommands
 * @author    Your Name <handle@php.net>
 * @copyright 2011 Your Name
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @version   SVN: $Id$
 * @link      http://svn.php.net/repository/pear2/PEAR2_VendorCommands
 */

/**
 * Main class for PEAR2_VendorCommands
 *
 * @category  Yourcategory
 * @package   PEAR2_VendorCommands
 * @author    Your Name <handle@php.net>
 * @copyright 2011 Your Name
 * @license   http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @link      http://svn.php.net/repository/pear2/PEAR2_VendorCommands
 */
namespace PEAR2\VendorCommands;
class Main
{

    /**
     * Path to the vendor directory which contains the libs
     *
     * @var string
     */
    protected $vendor_path;

    /**
     * The Pyrus config for the vendor registry
     *
     * @var PEAR2\Pyrus\Config
     */
    protected $config;

    function __construct($path = null)
    {
        if (null === $path) {
            $path = getcwd() . DIRECTORY_SEPARATOR . 'vendor';
        }

        $this->setPath($path);
    }

    /**
     * Scan for declared dependencies
     *
     * @return array
     */
    function scanDependencies()
    {
        return $this->scanPackageXMLDependencies();
    }

    /**
     * Scan for dependencies declared in a package.xml file
     *
     * @return array
     */
    function scanPackageXMLDependencies()
    {
        $deps = array();

        $xml_file = dirname($this->path) . DIRECTORY_SEPARATOR . 'package.xml';
        if (file_exists($xml_file)) {
            $xml = new \PEAR2\Pyrus\PackageFile($xml_file);
            foreach ($xml->dependencies['required']->package as $dep) {
                $dep_description = $dep->channel . '/' . $dep->name;
                $deps[] = $dep_description;
            }
        }
        return $deps;
    }

    function scanVendorRegistry()
    {
        
    }

    function installDependencies($deps)
    {
        // @TODO
    }

    function updateDependencies()
    {
        // @TODO
    }

    function setPath($path)
    {
        $this->path = $path;
        $this->config = \PEAR2\Pyrus\Config::singleton($path);
    }

    function getPath()
    {
        return $this->config->path;
    }
}
