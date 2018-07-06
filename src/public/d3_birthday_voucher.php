<?php

/**
 * This Software is the property of D³ Data Development
 * and is protected by copyright law - it is NOT Freeware.
 * Any unauthorized use of this software without a valid license
 * key is a violation of the license agreement and will be
 * prosecuted by civil and criminal law.
 * D3 Data Development
 * Inhaber: Thomas Dartsch
 * Alle Rechte vorbehalten
 *
 * @package       "Geburstagsgutscheine"
 * @author        Thomas Dartsch <thomas.dartsch@shopmodule.com> / Markus Gärtner <markus.gaertner@shopmodule.com>
 * @copyright (C) 2014, D3 Data Development
 * @see           http://www.shopmodule.com
 */

#ini_set('display_errors', 1);
#ini_set('error_reporting', 1);

namespace D3\Birthdayvoucher\publica;

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Log\d3log;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use D3\Birthdayvoucher\Application\Model\utils_birthdayvoucher;
use D3\Birthdayvoucher\Application\Model\d3voucher;
use D3\Birthdayvoucher\Application\Model\reminder;
use OxidEsales\Eshop\Core\Controller\BaseController;

require_once dirname(__FILE__) . "/../../../../bootstrap.php";

/**
 * Class D3_Birthday_Voucher
 */
class D3_Birthday_Voucher extends BaseController
{
    protected $_sDefaultAccessKey = "H78hbk32Jofjeo";

    /**
     * sModId
     *
     * @var string
     */
    private $_sModId = 'd3birthdayvoucher';

    /**
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     */
    public function generateVoucher()
    {
        //Shopid setzten
        $sShopId = utils_birthdayvoucher::checkShopId();
        Registry::getConfig()->setShopId($sShopId);

        $this->getModCfg()->d3getLog()->Log(
            d3log::INFO,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            "Starting CronJob-Geburtstagsgutscheine",
            ""
        );

        //Modul aktiv
        if (!$this->getModCfg()->isActive()) {
            $this->getModCfg()->d3getLog()->Log(
                d3log::INFO,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                "Modul Geburtstagsgutscheine nicht aktiv",
                "nicht aktiv"
            );
            echo "Modul Geburtstagsgutscheine nicht aktiv";
            Registry::getSession()->freeze();
            exit();
        }

        //Info letzter Aufruf des CronJobs fuer Ansicht im Admin speichern
        $this->getModCfg()->setValue('d3birthdayvoucher_CronJob_LastStart', date('Y-m-d H:i:s'));
        $this->getModCfg()->saveNoLicenseRefresh();

        $sModus = 'Live';
        if ($this->getModCfg()->hasTestMode()) {
            $sModus = 'Test';
        }

        $this->getModCfg()->d3getLog()->Log(
            d3log::INFO,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            "Geburtstagsgutscheine-Modus: " . $sModus,
            "Modus: " . $sModus
        );

        $this->getModCfg()->d3getLog()->Log(
            d3log::DEBUG,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            "starting debug",
            " %_SERVER is '" . print_r($_SERVER, true) . "'"
        );

        $sGetAccessKey = Registry::get(Request::class)->getRequestEscapedParameter("key");
        $sValidAccessKey = $this->getModCfg()->getValue('d3birthdayvoucher_ACCESSKEY');

        if (!$sValidAccessKey) {
            $sValidAccessKey = $this->_sDefaultAccessKey;
        }
        if (($_SERVER['REMOTE_ADDR'] || $_SERVER['HTTP_USER_AGENT']) && $sValidAccessKey != $sGetAccessKey) {
            $this->getModCfg()->d3getLog()->Log(
                d3log::ALERT,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                "shutdown",
                " access with browser!. "
            );
            die("security shutdown");
        }

        //CronJob aktiv
        if (!$this->getModCfg()->getValue('bld3birthdayvoucher_CRONJOB_ACTIVE')) {
            $this->getModCfg()->d3getLog()->Log(
                d3log::INFO,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                "CronJob nicht aktiv",
                "nicht aktiv"
            );
            //todo Uebesetzung
            echo "CronJob Geburtstagsgutscheine nicht aktiv";
            Registry::getSession()->freeze();
            exit();
        }

        /* @var $oD3BirthdayVoucher d3voucher */
        $oD3BirthdayVoucher = oxnew(d3voucher::class);
        $ret                = $oD3BirthdayVoucher->d3StartCronJobActions();

        $this->getModCfg()->d3getLog()->log(
            d3log::INFO,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            "End CronJob-Geburtstagsgutscheine",
            $ret
        );

    }

    /**
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     */
    public function reminder()
    {
        //Shopid setzten
        $sShopId = utils_birthdayvoucher::checkShopId();
        Registry::getConfig()->setShopId($sShopId);

        $this->getModCfg()->d3getLog()->Log(
            d3log::INFO,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            "Starting CronJob-Geburtstagsgutscheine Reminder",
            ""
        );
        echo "Starting CronJob-Geburtstagsgutscheine Reminder";

        //Modul aktiv
        if (!$this->getModCfg()->isActive()) {
            $this->getModCfg()->d3getLog()->Log(
                d3log::INFO,
                __CLASS__,
                __FUNCTION__,
                __LINE__,
                "Modul Geburtstagsgutscheine nicht aktiv",
                "nicht aktiv"
            );
            echo "Modul Geburtstagsgutscheine nicht aktiv";
            Registry::getSession()->freeze();
            exit();
        }

        //Info letzter Aufruf des CronJobs fuer Ansicht im Admin speichern
        $this->getModCfg()->setValue('d3birthdayvoucher_CronJob_LastStart', date('Y-m-d H:i:s'));
        $this->getModCfg()->saveNoLicenseRefresh();

        $sModus = 'Live';
        if ($this->getModCfg()->hasTestMode()) {
            $sModus = 'Test';
        }

        $this->getModCfg()->d3getLog()->Log(
            d3log::INFO,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            "Geburtstagsgutscheine-Modus: " . $sModus,
            "Modus: " . $sModus
        );

        $this->getModCfg()->d3getLog()->Log(
            d3log::DEBUG,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            "starting debug",
            " %_SERVER is '" . print_r($_SERVER, true) . "'"
        );

        $sGetAccessKey = Registry::get(Request::class)->getRequestEscapedParameter("key");
        $sValidAccessKey = $this->getModCfg()->getValue('d3birthdayvoucher_ACCESSKEY');

        if (!$sValidAccessKey) {
            $sValidAccessKey = $this->_sDefaultAccessKey;
        }
        if (($_SERVER['REMOTE_ADDR'] || $_SERVER['HTTP_USER_AGENT']) && $sValidAccessKey != $sGetAccessKey) {
            $this->getModCfg()->d3getLog()->Log(
            d3log::ALERT,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            "shutdown",
            " access with browser!. "
            );
            die("security shutdown");
        }

        //CronJob aktiv
        /*
        if (!$this->getModCfg()->getValue('bld3birthdayvoucherreminder_CRONJOB_ACTIVE')) {
            $this->getModCfg()->d3getLog()->Log(
            d3log::INFO,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            "CronJob nicht aktiv",
            "nicht aktiv"
            );
            echo "CronJob Geburtstagsgutscheine nicht aktiv";
            oxRegistry::getSession()->freeze();
            exit();
        }
        */

        /* @var $oD3BirthdayVoucher reminder */
        $oD3BirthdayVoucher = oxNew(reminder::class);
        $ret                = $oD3BirthdayVoucher->d3StartCronJobActions();

        $this->getD3Log()->log(
            d3log::INFO,
            __CLASS__,
            __FUNCTION__,
            __LINE__,
            "End CronJob-Geburtstagsgutscheine Reminder",
            $ret
        );

        echo PHP_EOL."<br>End CronJob-Geburtstagsgutscheine Reminder";

        Registry::getSession()->freeze();
        exit(nl2br($ret));
    }

    /**
     * @return object
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function getModCfg()
    {
        return d3_cfg_mod::get($this->_sModId);
    }

    /**
     * @return d3log
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function getD3Log()
    {
        return $this->getModCfg()->d3getLog();
    }

}

$oBV = new D3_Birthday_Voucher;
$oBV->generateVoucher();
$oBV->reminder();