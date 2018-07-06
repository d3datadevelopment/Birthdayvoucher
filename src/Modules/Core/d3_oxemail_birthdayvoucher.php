<?php

/**
 * This Software is the property of D³ Data Development
 * and is protected by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license
 * key is a violation of the license agreement and will be
 * prosecuted by civil and criminal law.
 *
 * D3 Data Development
 * Inhaber: Thomas Dartsch
 * Alle Rechte vorbehalten
 *
 * @package "Geburstagsgutscheine"
 * @author Thomas Dartsch <thomas.dartsch@shopmodule.com> / Markus Gärtner <markus.gaertner@shopmodule.com>
 * @copyright (C) 2014, D3 Data Development
 * @see http://www.shopmodule.com
 */

#ini_set('display_errors', 1);
#ini_set('error_reporting', 1);

namespace D3\Birthdayvoucher\Modules\Core;

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Log\d3log;

use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Application\Model\Voucher;
use D3\Birthdayvoucher\Application\Model\d3voucher;


class d3_oxemail_birthdayvoucher extends d3_oxemail_birthdayvoucher_parent
{
    private $_sModId = 'd3birthdayvoucher';
    protected $_d3_email_birthdayvoucher_html = "d3_email_birthdayvoucher_html.tpl";
    protected $_d3_email_birthdayvoucher_plain = "d3_email_birthdayvoucher_plain.tpl";
    protected $_d3_email_birthdayvoucher_subj = "d3_email_birthdayvoucher_subj.tpl";

    protected $_d3_email_birthdayvoucher_reminder_html = "d3_email_birthdayvoucher_reminder_html.tpl";
    protected $_d3_email_birthdayvoucher_reminder_plain = "d3_email_birthdayvoucher_reminder_plain.tpl";
    protected $_d3_email_birthdayvoucher_reminder_subj = "d3_email_birthdayvoucher_reminder_subj.tpl";

    protected $_d3_email_birthdayvoucher_reminder_expiration_html = "d3_email_birthdayvoucher_reminder_expiration_html.tpl";
    protected $_d3_email_birthdayvoucher_reminder_expiration_plain = "d3_email_birthdayvoucher_reminder_expiration_plain.tpl";
    protected $_d3_email_birthdayvoucher_reminder_expiration_subj = "d3_email_birthdayvoucher_reminder_expiration_subj.tpl";

    /**
     * @param User    $oUser
     * @param Voucher $oVoucher
     * @param int     $iLang
     *
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function D3SendBirthdayVoucher(User $oUser, Voucher $oVoucher, $iLang = 0)
    {
        //sets language of shop
        $iCurrLang = $iLang;
        $iActShopLang = Registry::getConfig()->getActiveShop()->getLanguage();
        if (isset($iActShopLang) && $iActShopLang != $iCurrLang) {
            $iCurrLang = $iActShopLang;
        }

        // shop info
        $oShop = $this->_getShop($iCurrLang);

        $this->_setMailParams($oShop);

        $this->setUser($oUser);
        // create messages
        $oSmarty = $this->_getSmarty();
        $this->setViewData("user", $oUser);
        $this->setViewData("voucher", $oVoucher);
        $this->setViewData("voucherserie", $oVoucher->getSerie());

        // Process view data array through oxoutput processor
        $this->_processViewArray();

        $this->setBody($oSmarty->fetch($this->_d3_email_birthdayvoucher_html));
        $this->setAltBody($oSmarty->fetch($this->_d3_email_birthdayvoucher_plain));
        $this->setSubject($oSmarty->fetch($this->_d3_email_birthdayvoucher_subj));


        if($this->_getD3CfgMod()->hasTestMode())
        {
            if($this->_getD3CfgMod()->getValue('d3birthdayvoucher_TEST_MODUS_ADDRESS') != '')
                $sEMailAddress = $this->_getD3CfgMod()->getValue('d3birthdayvoucher_TEST_MODUS_ADDRESS');
            else{
                $sEMailAddress = $oShop->getFieldData('oxinfoemail');
            }
        }
        else
        {
            $sEMailAddress = $oUser->oxuser__oxusername->value;
        }

        $sFullName = $oUser->oxuser__oxfname->value . " " . $oUser->oxuser__oxlname->value;

        $this->setRecipient($sEMailAddress, $sFullName);
        $this->setReplyTo($oShop->oxshops__oxinfoemail->value, $oShop->oxshops__oxname->value);
        $this->setFrom($oShop->oxshops__oxinfoemail->value, $oShop->oxshops__oxname->getRawValue());

        $sBccEmail = $this->_getD3CfgMod()->getValue('d3birthdayvoucher_MAIL4BCC');
        if ($sBccEmail != '')
        {
            $this->addBCC($sBccEmail, $oShop->oxshops__oxname->value);
        }

        $this->d3WriteRemark($this->getAltBody(), $oUser->getId(), "r");

        return $this->send();
    }

    /**
     * @param User    $oUser
     * @param Voucher $oVoucher
     * @param int       $iLang
     * @param bool      $blExpirtation
     * @param           $iDays
     *
     * @return
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function d3SendReminderMail(User $oUser, Voucher $oVoucher, $iLang = 0, $blExpirtation = false, $iDays)
    {
        // shop info
        $oShop = $this->_getShop($iLang);

        $this->_setMailParams($oShop);
        $this->setUser($oUser);
        // create messages
        $oSmarty = $this->_getSmarty();
        $this->setViewData("user", $oUser);
        $this->setViewData("voucher", $oVoucher);
        $this->setViewData("voucherserie", $oVoucher->getSerie());
        $this->setViewData("date_diff", $iDays);
        // Process view data array through oxoutput processor
        $this->_processViewArray();
        if($blExpirtation == false) {
            $this->setBody($oSmarty->fetch($this->_d3_email_birthdayvoucher_reminder_html));
            $this->setAltBody($oSmarty->fetch($this->_d3_email_birthdayvoucher_reminder_plain));
            $this->setSubject($oSmarty->fetch($this->_d3_email_birthdayvoucher_reminder_subj));
        }
        else{
            $this->setBody($oSmarty->fetch($this->_d3_email_birthdayvoucher_reminder_expiration_html));
            $this->setAltBody($oSmarty->fetch($this->_d3_email_birthdayvoucher_reminder_expiration_plain));
            $this->setSubject($oSmarty->fetch($this->_d3_email_birthdayvoucher_reminder_expiration_subj));
        }
        if($this->_getD3CfgMod()->hasTestMode())
        {
            if($this->_getD3CfgMod()->getValue('d3birthdayvoucher_TEST_MODUS_ADDRESS') != '')
                $sEMailAddress = $this->_getD3CfgMod()->getValue('d3birthdayvoucher_TEST_MODUS_ADDRESS');
            else{
                $sEMailAddress = $oShop->getFieldData('oxinfoemail');
            }
        }
        else
        {
            $sEMailAddress = $oUser->oxuser__oxusername->value;
        }

        $sFullName = $oUser->oxuser__oxfname->value . " " . $oUser->oxuser__oxlname->value;

        $this->setRecipient($sEMailAddress, $sFullName);
        $this->setReplyTo($oShop->oxshops__oxinfoemail->value, $oShop->oxshops__oxname->value);
        $this->setFrom($oShop->oxshops__oxinfoemail->value, $oShop->oxshops__oxname->getRawValue());
        $sBccEmail = $this->_getD3CfgMod()->getValue('d3birthdayvoucher_MAIL4BCC');
        if ($sBccEmail != '')
        {
            $this->addBCC($sBccEmail, $oShop->oxshops__oxname->value);
        }
        $this->d3WriteRemark($this->getAltBody(), $oUser->getId(), "r");

        return $this->send();
    }

    /**
     * Create Remark
     *
     * @param String $sMessage
     * @param String $sUserId
     * @param String $sType
     *
     * @return bool
     * @throws \Exception
     */
    public function d3WriteRemark($sMessage, $sUserId, $sType = 'r')
    {
        /** @var d3voucher $od3points  */
        $od3points = oxnew(d3voucher::class);
        return $od3points->d3WriteRemark($sMessage, $sUserId, $sType);
    }

    /**
     * @return d3_cfg_mod
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    protected function _getD3CfgMod()
    {
        return d3_cfg_mod::get($this->_sModId);
    }

    /**
     * @return d3log
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    protected function _getLog()
    {
        return $this->_getD3CfgMod()->d3getLog();
    }
}
