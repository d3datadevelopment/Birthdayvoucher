<?php

namespace D3\Birthdayvoucher\Application\Controller\Admin;

use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_main;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;
use D3\Birthdayvoucher\Application\Model\utils_birthdayvoucher;


/**
 * Class d3_d3birthdayvoucher_agelimit
 */
class agelimit extends d3_cfg_mod_main
{

    protected $_sThisTemplate = 'd3birthdayvoucher_settings_agelimit.tpl';
    protected $_sModId = 'd3birthdayvoucher';

    /**
     *
     */
    public function __construct()
    {

        //$this->oSet = d3_cfg_mod::get($this->_sModId);
        return parent::__construct();
    }

    /**
     * @return string
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \OxidEsales\Eshop\Core\Exception\StandardException
     * @throws d3_cfg_mod_exception
     */
    public function render()
    {
        $ret = parent::render();

        #echo __LINE__;
        #dumpvar($this->oSet->oValue);

        return $ret;
    }

    /**
     * Add some arrays to config
     * transform SELECTIONGROUPS[SELECTION_GROUPS_4_POINTS][] to "d3points_SELECTION_GROUPS_4_POINTS" and save it under "d3_cfg_mod__d3points_SELECTION_GROUPS_4_POINTS"
     *
     * @return void
     * @throws \D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
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
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function getCountries()
    {
        return $this->getMergedCountriesWithConfig();
    }

    /**
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function getMergedCountriesWithConfig()
    {
        $aCountries = array();
        $oCountries = $this->getCountriesFromShop();
        $aCountriesFromD3Cfg = $this->getCountriesFromD3CfgMod();

        foreach($oCountries as $oCountry)
        {
            if(array_key_exists($oCountry->oxcountry__oxid->value, $aCountriesFromD3Cfg))
            {
                if($aCountriesFromD3Cfg[$oCountry->oxcountry__oxid->value] != 0)
                {
                    $oCountry->AgeLimit = $aCountriesFromD3Cfg[$oCountry->oxcountry__oxid->value];
                }
            }
            $aCountries[] = $oCountry;
        }
        #dumpvar($aCountries);
        return $aCountries;
    }


    public function getCountriesFromShop(){

        /* @var $d3Utils utils_birthdayvoucher */
        $od3_d3birthdayvoucher_utils = oxnew(utils_birthdayvoucher::class);
        return $od3_d3birthdayvoucher_utils->getCountries();
    }

    /**
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function getCountriesFromD3CfgMod()
    {
        return (array) unserialize($this->d3GetSet()->getValue('d3birthdayvoucher_SELECTION_COUNTRIES_FOR_AGE_LIMIT'));

    }
}