<?php

/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 * http://www.shopmodule.com
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author        D3 Data Development - <support@shopmodule.com>
 * @link          http://www.oxidmodule.com
 */

date_default_timezone_set('Europe/Berlin');

/**
 * Class d3PreCheckInFolder
 */
class d3PreCheckInFolder
{
    public $sVersion = '3.0';

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->sVersion;
    }

    /**
     * @return bool
     */
    public function hasMinPhpVersion()
    {
        $aArgs = func_get_args();

        if (version_compare(phpversion(), $aArgs[0]['version'], '>=')) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function hasMaxPhpVersion()
    {
        $aArgs = func_get_args();

        if (version_compare(phpversion(), $aArgs[0]['version'], '<=')) {
            return true;
        }

        return false;
    }

    /**
     * @return array
     */
    public function hasFromToPhpVersion()
    {
        $aArgs = func_get_args();

        if ((version_compare(phpversion(), $aArgs[0]['from'], '>=')) && (version_compare(
                phpversion(),
                $aArgs[0]['to'],
                '<'
            ))
        ) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function hasZendLoaderOptimizer()
    {
        if ((version_compare(phpversion(), '5.2.0', '>=') && version_compare(
                    phpversion(),
                    '5.2.900',
                    '<'
                ) && function_exists('zend_optimizer_version')) || (version_compare(
                    phpversion(),
                    '5.3.0',
                    '>='
                ) && version_compare(phpversion(), '5.4.900', '<') && function_exists('zend_loader_version'))
        ) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function hasIonCubeLoader()
    {
        if (function_exists('ioncube_loader_version')) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function hasExtension()
    {
        $aArgs = func_get_args();

        if (extension_loaded($aArgs[0]['type'])) {
            return true;
        }

        return false;
    }
}

/**
 * @param $mVar
 */
function dumpvar($mVar)
{
    echo "<pre>";
    print_r($mVar);
    echo "</pre>";
}

if (!isset($_SERVER['REMOTE_ADDR']) || !isset($_SERVER['HTTP_USER_AGENT'])) {
    $oPreCheck = new d3precheckinfolder;
    if (isset($_GET['fnc']) && $_GET['fnc']) {
        $aParams = isset($_GET['params']) ? unserialize(stripslashes(urldecode($_GET['params']))) : array();
        echo serialize(call_user_func(array($oPreCheck, $_GET['fnc']), $aParams));
    }
}