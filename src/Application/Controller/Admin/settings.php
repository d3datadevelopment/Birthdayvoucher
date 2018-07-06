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
 * @version 2.2.1_PE4
 * @author Thomas Dartsch <thomas.dartsch@shopmodule.com> / Markus Gärtner <markus.gaertner@shopmodule.com>
 * @copyright (C) 2011, D3 Data Development
 * @see http://www.shopmodule.com
 *
 * $Rev::                                               $:
 * $Author::                                            $:
 * $Date::                                              $:
 */

namespace D3\Birthdayvoucher\Application\Controller\Admin;

use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_main;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;

use OxidEsales\Eshop\Core\Request;
use D3\Birthdayvoucher\Application\Model\utils_birthdayvoucher;
use OxidEsales\Eshop\Core\Registry;

/**
 * Class d3_d3birthdayvoucher_settings
 */
class settings extends d3_cfg_mod_main
{

    protected $_sThisTemplate = 'd3birthdayvoucher_settings.tpl';
    protected $_sModId = 'd3birthdayvoucher';

    protected $_blHasDebugSwitch = true;
    protected $_blHasTestModeSwitch = true;

    protected $_sMenuItemTitle = 'd3mxd3birthdayvoucher';
    protected $_sMenuSubItemTitle = 'd3mxd3birthdayvoucher_SETTINGS';
    protected $_sHelpLinkMLAdd = 'Fragen-zu-speziellen-Modulen/Geburtstagsgutscheine/';

    protected $_sDebugHelpTextIdent = 'D3_CFG_d3birthdayvoucher_DEBUG_MODUS_HELP';
    protected $_sTestModeHelpTextIdent = 'D3_CFG_d3birthdayvoucher_TEST_MODUS_HELP';

    /**
     *
     */
    public function __construct_()
    {
        return parent::__construct();
    }

    /**
     * @return string
     * @throws DatabaseConnectionException
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     * @throws d3_cfg_mod_exception
     */
    public function render()
    {
        $ret = parent::render();

        #echo __LINE__;
        #dumpvar($this->d3GetSet()->oValue);

        return $ret;
    }

    /**
     * Return URL-Paramete with String
     * only if is in subshop
     *
     * @return string
     */
    public function d3GetShopId()
    {
        $sShopId = Registry::getConfig()->getShopId();
        if ($sShopId != '1')
        {
            return "&shp=" . $sShopId;
        }

        return '';

    }

    /**
     * Get Randomcode for cronjob
     *
     * @return string
     * @throws DatabaseConnectionException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function d3GetRandomCode()
    {
        /** @var utils_birthdayvoucher $oUtils */
        $oUtils = oxNew(utils_birthdayvoucher::class);
        return $oUtils->GetRandomVoucherCode();
    }

    /**
     * Add some arrays to config
     * transform SELECTIONGROUPS[SELECTION_GROUPS_4_POINTS][] to "d3points_SELECTION_GROUPS_4_POINTS" and save it under "d3_cfg_mod__d3points_SELECTION_GROUPS_4_POINTS"
     *
     * @return void
     * @throws DatabaseConnectionException
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     * @throws d3_cfg_mod_exception
     */
    public function save()
    {
        parent::save();
        $ad3Points = Registry::get(Request::class)->getRequestEscapedParameter('SELECTIONGROUPS');
        #dumpvar($ad3Points);
        if ($ad3Points != 0 && count($ad3Points) > 0)
        {
            foreach (Registry::get(Request::class)->getRequestEscapedParameter('SELECTIONGROUPS') AS $key => $aGroup)
            {
                #echo $key;
                #dumpvar($aGroup);
                $this->d3GetSet()->setValue('d3birthdayvoucher_' . $key, array());
                $this->d3GetSet()->setValue('d3birthdayvoucher_' . $key, serialize($aGroup));
            }
        }
        #parent::save();

        $this->d3GetSet()->prepareSaveData();
        $this->d3GetSet()->save();
    }

    /**
     * Kundengruppen freigeben
     *
     * @return array alist
     * @throws DatabaseConnectionException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function d3_PrepareGroups4Points()
    {
        $oGroups = array();
        $aGroups = unserialize($this->d3GetSet()->getValue('d3birthdayvoucher_SELECTION_GROUPS_FOR_VOUCHER'));
        foreach ($this->d3_GetGroups() as $oGroup)
        {
            if (is_array($aGroups))
            {
                if (in_array($oGroup->oxgroups__oxid->getRawValue(), $aGroups))
                {
                    $oGroup->select = 1;
                    #$oGroup->save();
                }
            }
            $oGroups[] = $oGroup;
        }
        return $oGroups;
    }

    /**
     * Kundengruppen ausschließen
     *
     * @return array alist
     * @throws DatabaseConnectionException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function d3_PrepareGroups4NoPoints()
    {
        $oGroups = array();
        $aGroups = unserialize($this->d3GetSet()->getValue('d3birthdayvoucher_SELECTION_GROUPS_FOR_NO_VOUCHER'));
        foreach ($this->d3_GetGroups() as $oGroup)
        {
            if (is_array($aGroups))
            {
                if (in_array($oGroup->oxgroups__oxid->getRawValue(), $aGroups))
                {
                    $oGroup->select = 1;
                    #$oGroup->save();
                }
            }
            $oGroups[] = $oGroup;
        }
        return $oGroups;
    }

    /**
     * Load Groups
     *
     * @return object alist
     */
    protected function d3_GetGroups()
    {
        /** @var utils_birthdayvoucher $od3_d3birthdayvoucher_utils */
        $od3_d3birthdayvoucher_utils = oxnew(utils_birthdayvoucher::class);
        return $od3_d3birthdayvoucher_utils->LoadGroups();

    }
}