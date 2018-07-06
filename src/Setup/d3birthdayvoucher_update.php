<?php

namespace D3\Birthdayvoucher\Setup;

use D3\ModCfg\Application\Model\Install\d3install_updatebase;
use D3\ModCfg\Application\Model\Installwizzard\d3installdbrecord;
use d3\modcfg\Application\Model\d3database;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Facts\Facts;

/**
 * Class d3birthdayvoucher_update
 */
class d3birthdayvoucher_update extends d3install_updatebase
{

    protected $_aRefreshMetaModuleIds = array();
    public $aMultiLangTables = array();

    public $aRenameTables = array();

    public $sModRevision = '260';
    public $sModKey = 'd3birthdayvoucher';
    public $sModName = 'Geburtstagsgutscheine';
    public $sModVersion = '4.0.0.0';
    public $sModBaseConfKey = '9arv2==YzNXSDI1Zm9OY0dVaHc5RE9hcktJWHJnVzF4UUVmcFVDQ2F3YVd3OFMyUE5VRkNQRkNiQzY2M
1hnL3NkbnJ6YUVtb0lkY0JRazJ3eG9SaFZoYTVMTTVxWEdOK1NIbDRmWmJOaDNtSllORElCYWtGV05ma
kxFUklBWExVeFZCOCtCWlN1SktzcDhIcmJDaktTd3dXLzhkbHRIZlQ5TnZQdkxZcldSV2NtRVYyNVJ3M
GFVUTgwcXJYNFJwMDJPQzZWYjNJdmdSa2Q3eFlteUVlYWVhUkZjOW5mS2x6TU5meDlENjU5K2lVZFJtY
3lucDNFTW5yVjhqbFBWQmZBbmRraXFmWk9HUW9Gd0tQK3QvVHJ1QzEvdi9sY2RWSUExYzUwOFQ0S0ZRd
0pXb3cwUVdVUFozTk1XbUg1TGNvR05VeVNpVUM3WVQ5WmVoSUNqUUxuSzh3UElnPT0=';

    public $sRequirements ='';


    // auszuf�hrende Check- und Updateanweisungen in auszuf�hrender Reihenfolge
    protected $_aUpdateMethods = array(
        array('check' => 'checkMultiLangTables',
            'do' => 'fixRegisterMultiLangTables'),
        #array('check' => 'checkRenameTables', // pr�ft auf umzubenennende Tabellen und f�hrt dies ggf. aus
        #    'do' => 'fixRenameTables'),
        #array('check' => 'checkTestTableExist', // pr�ft Tabelle und legt sie ggf. an
        #    'do' => 'updateTestTableExist'),
        array('check' => 'checkRenameFields', // pr�ft auf umzubenennende Felder und f�hrt dies ggf. aus
            'do' => 'fixRenameFields'),
        array('check' => 'checkFields', // pr�ft Felder in Tabelle und legt sie ggf. an bzw. modifiziert diese
            'do' => 'fixFields'),
        array('check' => 'checkIndizes', // pr�ft Indizes in Tabelle und legt sie ggf. an
            'do' => 'fixIndizes'),
        array('check' => 'checkModCfgItemExist', // pr�ft auf DB-Eintrag (hier ModCfg) und f�gt diese ggf. ein bzw. f�hrt Update aus
            'do' => 'updateModCfgItemExist'),
        array('check' => 'checkVoucherSeriesItemExist', // pr�ft auf DB-Eintrag (hier ModCfg) und f�gt diese ggf. ein bzw. f�hrt Update aus
            'do' => 'updateVoucherSeriesItemExist'),

        /*
        array('check' => 'checkCmsItems',
            'do' => 'updateCmsItems'),
        */
/*
        array('check' => 'checkCmsItems_01',
            'do' => 'executeCmsTypesItemsList_01'),
        array('check' => 'checkCmsItems_02',
            'do' => 'executeCmsTypesItemsList_02'),
        array('check' => 'checkCmsItems_03',
            'do' => 'executeCmsTypesItemsList_03'),
*/
        array('check' => 'checkModCfgSameRevision', // pr�ft auf nachgezogene Revisionsnummer und �bertr�gt diese ggf.
            'do' => 'updateModCfgSameRevision'),
    );


    // Standardwerte f�r checkFields(), _addTable() und fixFields()
    public $aFields = array(
        array(
            'sTableName' => 'oxuser',
            'sFieldName' => 'D3BIRTHDAYVOUCHER_LASTDATE',
            'sType' => 'date',
            'blNull' => FALSE,
            'sDefault' => '0000-00-00',
            'sComment' => 'send last BirthdayVoucher on',
            'sExtra' => '',
            'blMultilang' => FALSE,
        ),
        array(
            'sTableName' => 'oxvouchers',
            'sFieldName' => 'D3VOUCHEREXPIRATIONDATE',
            'sType' => 'date',
            'blNull' => FALSE,
            'sDefault' => '0000-00-00',
            'sComment' => 'D3 Birthdayvoucher,last Day of validity',
            'sExtra' => '',
            'blMultilang' => FALSE,
        ),
        array(
            'sTableName' => 'oxvouchers',
            'sFieldName' => 'D3VOUCHERLASTACTION',
            'sType' => 'date',
            'blNull' => FALSE,
            'sDefault' => '0000-00-00',
            'sComment' => 'D3 Birthdayvoucher,last Day of an action',
            'sExtra' => '',
            'blMultilang' => FALSE,
        ),
        array(
            'sTableName' => 'oxvouchers',
            'sFieldName' => 'D3USERID',
            'sType' => 'varchar(32)',
            'blNull' => TRUE,
            'sDefault' => '',
            'sComment' => 'D3 Birthdayvoucher, User Oxid, used to send reminder',
            'sExtra' => '',
            'blMultilang' => FALSE,
        ),
    );

    // Standardwerte f�r checkIndizes() und fixIndizes()
    public $aIndizes = array();

    // Standardwerte f�r checkRenameFields() und fixRenameFields()
    public $aRenameFields = array(
        array(
            'sTableName' => 'oxuser',
            'mOldFieldNames' => array('d3lastbdvoucherdate','D3LASTBDVOUCHERDATE'), // is case sensitive
            'sFieldName' => 'D3BIRTHDAYVOUCHER_LASTDATE',
            'sComment' => 'send last BirthdayVoucher on',
            'blMultilang' => FALSE,
            'blNull' => TRUE,
            'sDefault' => '0000-00-00',
            'use_quote' => false,
        ),
    );

    /*******************************************************************************************/
    /***** eigene Test- und Updatemethoden (ggf. �berladung vorhandener Methoden) **************/
    /*******************************************************************************************/

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     */
    public function checkModCfgItemExist()
    {
        $blRet = false;
        foreach (Registry::getConfig()->getShopIds() as $sShopId) {
            $aWhere = array(
                'oxmodid'       => $this->sModKey,
                'oxnewrevision' => $this->sModRevision,
                'oxshopid'      => $sShopId,
            );

            $blRet = $this->_checkTableItemNotExist('d3_cfg_mod', $aWhere);

            if ($blRet) {
                return $blRet;
            }
        }

        return $blRet;
    }

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function updateModCfgItemExist()
    {
        $blRet = FALSE;

        if ($this->checkModCfgItemExist()) {
            foreach (Registry::getConfig()->getShopIds() as $sShopId) {
                $aWhere = array(
                    'oxmodid' => $this->sModKey,
                    'oxshopid' => $sShopId,
                    'oxnewrevision' => $this->sModRevision,
                );
                if($this->_checkTableItemNotExist('d3_cfg_mod',$aWhere))
                {
                    // update don't use this property
                    unset($aWhere['oxnewrevision']);
                    $aInsertFields = array(
                        array(
                            'fieldname' => 'OXID',
                            'content' => "md5('" . $this->sModKey . " " . $sShopId . " de')",
                            'force_update' => FALSE,
                            'use_quote' => FALSE,
                            'use_multilang' => FALSE,
                        ),
                        array(
                            'fieldname' => 'OXSHOPID',
                            'content' => $sShopId,
                            'force_update' => FALSE,
                            'use_quote' => TRUE,
                        ),
                        array(
                            'fieldname' => 'OXMODID',
                            'content' => $this->sModKey,
                            'force_update' => FALSE,
                            'use_quote' => TRUE,
                        ),
                        array(
                            'fieldname' => 'OXNAME',
                            'content' => $this->sModName,
                            'force_update' => FALSE,
                            'use_quote' => TRUE,
                        ),
                        array(
                            'fieldname' => 'OXACTIVE',
                            'content' => '0',
                            'force_update' => FALSE,
                            'use_quote' => FALSE,
                        ),
                        array(
                            'fieldname' => 'OXBASECONFIG',
                            'content' => $this->sModBaseConfKey,
                            'force_update' => TRUE,
                            'use_quote' => TRUE,
                        ),
                        array(
                            'fieldname' => 'OXSERIAL',
                            'content' => "",
                            'force_update' => FALSE,
                            'use_quote' => TRUE,
                        ),
                        array(
                            'fieldname' => 'OXINSTALLDATE',
                            'content' => "NOW()",
                            'force_update' => TRUE,
                            'use_quote' => FALSE,
                        ),
                        array(
                            'fieldname' => 'OXVERSION',
                            'content' => $this->sModVersion,
                            'force_update' => TRUE,
                            'use_quote' => TRUE,
                        ),
                        array(
                            'fieldname' => 'OXSHOPVERSION',
                            'content' => oxNew(Facts::class)->getEdition(),
                            'force_update' => TRUE,
                            'use_quote' => TRUE,
                        ),
                        array(
                            'fieldname' => 'OXREQUIREMENTS',
                            'content' => $this->sRequirements,
                            'force_update' => TRUE,
                            'use_quote' => TRUE,
                        ),
                        array(
                            'fieldname' => $this->_getLangAbbrFieldName('d3_cfg_mod', 'OXVALUE', 'de'),
                            'content' => '',
                            'force_update' => FALSE,
                            'use_quote' => TRUE,
                        ),
                        array(
                            'fieldname' => 'OXNEWREVISION',
                            'content' => $this->sModRevision,
                            'force_update' => TRUE,
                            'use_quote' => TRUE,
                        )
                    );
                    $aRet = $this->_updateTableItem2('d3_cfg_mod', $aInsertFields, $aWhere);
                    $blRet = $aRet['blRet'];
                    $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                    $this->setUpdateBreak(true);
                }
            }
        }
        return $blRet;
    }

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     */
    public function checkVoucherSeriesItemExist()
    {
        /*
        $sShopEdition = Registry::getConfig()->getActiveShop()->oxshops__oxedition->value;
        if ($sShopEdition == 'EE') {
            $sShopId = '1';
        } else {
            $sShopId = '1';
        }
*/
        $sShopId = '1';

        $aWhere = array(
            'oxid'     => 'oxidbirthdayvouchers',
            'oxshopid' => $sShopId,
        );

        $blRet = $this->_checkTableItemNotExist('oxvoucherseries', $aWhere);

        if ($blRet) {
            return $blRet;
        }

        return $blRet;
    }

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function updateVoucherSeriesItemExist()
    {
        /*
        $sShopEdition = Registry::getConfig()->getActiveShop()->oxshops__oxedition->value;
        if ($sShopEdition == 'EE') {
            $sShopId = '1';
        } else {
            $sShopId = '1';
        }
*/
        $sShopId = '1';

        $blRet = FALSE;
        if ($this->checkVoucherSeriesItemExist()) {
                $aWhere = array(
                    'oxid' => 'oxidbirthdayvouchers',
                    'oxshopid' => $sShopId,
                );
                $aInsertFields = array(
                    array(
                        'fieldname' => 'OXID',
                        'content' => 'oxidbirthdayvouchers',
                        'force_update' => FALSE,
                        'use_quote' => true,
                        'use_multilang' => FALSE,
                    ),
                    array(
                        'fieldname' => 'OXSHOPID',
                        'content' => $sShopId,
                        'force_update' => FALSE,
                        'use_quote' => TRUE,
                    ),
                    array(
                        'fieldname' => 'OXSERIENR',
                        'content' => 'Geburtstagsgutscheine (D3)',
                        'force_update' => FALSE,
                        'use_quote' => TRUE,
                    ),
                    array(
                        'fieldname' => 'OXSERIEDESCRIPTION',
                        'content' => 'Geburtstagsgutscheine',
                        'force_update' => FALSE,
                        'use_quote' => TRUE,
                    ),
                    array(
                        'fieldname' => 'OXDISCOUNT',
                        'content' => '5.00',
                        'force_update' => false,
                        'use_quote' => true,
                    ),
                    array(
                        'fieldname' => 'OXDISCOUNTTYPE',
                        'content' => 'absolute',
                        'force_update' => false,
                        'use_quote' => TRUE,
                    ),
                    array(
                        'fieldname' => 'OXBEGINDATE',
                        'content' => '2009-01-01 00:00:00',
                        'force_update' => true,
                        'use_quote' => TRUE,
                    ),
                    array(
                        'fieldname' => 'OXENDDATE',
                        'content' => '2100-12-31 00:00:00',
                        'force_update' => false,
                        'use_quote' => true,
                    ),

                    array(
                        'fieldname' => 'OXMINIMUMVALUE',
                        'content' => '20.00',
                        'force_update' => false,
                        'use_quote' => TRUE,
                    )
                );
/*
                $sShopEdition = Registry::getConfig()->getActiveShop()->oxshops__oxedition->value;
                if($sShopEdition == 'EE')
                {
                }
*/

                $aRet = $this->_updateTableItem2('oxvoucherseries', $aInsertFields, $aWhere);
                $blRet = $aRet['blRet'];
                $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
                $this->setUpdateBreak(FALSE);
            }
        return $blRet;
    }

    /**
     * @return bool
     * @throws \oxSystemComponentException
     */
    public function addCmsItems()
    {
        $blRet = TRUE;

        $aExampleJobMethods = array('executeCmsTypesItemsList_01','executeCmsTypesItemsList_02','executeCmsTypesItemsList_03');
        foreach ($aExampleJobMethods as $sJobMethod)
        {
            $blRet = $this->{$sJobMethod}();
            if (!$blRet)
            {
                break;
            }
        }
        return $blRet;
    }

    /**
     * @return bool TRUE, if update is required
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     */
    public function checkCmsItems()
    {
        $blRet = FALSE;
        foreach (Registry::getConfig()->getShopIds() as $sShopId)
        {
            // change this to your inividual check criterias
            /*
            $sSql = "SELECT count(`oxid`) FROM `oxcontents`
            WHERE (
                OXLOADID = 'd3birthdayvouchersubjectmail'
                OR OXLOADID = 'd3birthdayvouchermail'
                OR OXLOADID = 'd3birthdayvoucherplainmail'
            )
            AND OXSHOPID = '".$oShop->getId()."'";
*/
            $sSql = <<<MYSQL
SELECT count(oxid) FROM oxcontents
            WHERE (
                OXLOADID = 'd3birthdayvouchersubjectmail'
                OR OXLOADID = 'd3birthdayvouchermail'
                OR OXLOADID = 'd3birthdayvoucherplainmail'
            )
            AND OXSHOPID = '{$sShopId}'
MYSQL;

            #echo "<hr>".$sSql;
            if ($this->getDb()->getOne($sSql) != 3)
            {
                $blRet = TRUE;
            }
        }
        return $blRet;
    }

    /**
     * @return bool
     */
    public function updateCmsItems()
    {
        return $this->_confirmMessage('D3_BIRTHDAY_UPDATE_ITEMINSTALL');
    }

    /**
     * @return bool
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     */
    public function checkCmsItems_01()
    {
        $blRet = FALSE;
        foreach (Registry::getConfig()->getShopIds() as $sShopId)
        {
            // change this to your inividual check criterias
            /*
            $sSql = "SELECT count(`oxid`) FROM `oxcontents`
            WHERE
            OXLOADID = 'd3birthdayvouchersubjectmail'
            AND OXSHOPID = '".$oShop->getId()."'";
*/
            $sSql = <<<MYSQL
SELECT count(oxid) FROM oxcontents
            WHERE
            OXLOADID = 'd3birthdayvouchersubjectmail'
            AND OXSHOPID = '{$sShopId}'
MYSQL;

            #echo "<hr>".$sSql;
            if ($this->getDb()->getOne($sSql) != 1)
            {
                $blRet = TRUE;
            }
        }
        return $blRet;
    }

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function executeCmsTypesItemsList_01()
    {
        $blRet = FALSE;

        foreach (Registry::getConfig()->getShopIds() as $sShopId)
        {
            $aWhere = array(
                #'oxid' => "md5('d3birthdayvouchersubjectmail " . $oShop->getId() . " de')",
                'oxshopid' => $sShopId,
                'OXLOADID' => 'd3birthdayvouchersubjectmail',
            );
            $aInsertFields = array(
                array(
                    'fieldname' => 'OXID',
                    'content' => "md5('d3birthdayvouchersubjectmail " . $sShopId . "')",
                    'force_update' => FALSE,
                    'use_quote' => FALSE,
                    'use_multilang' => FALSE,
                ),
                array(
                    'fieldname' => 'OXLOADID',
                    'content' => 'd3birthdayvouchersubjectmail',
                    'force_update' => FALSE,
                    'use_quote' => TRUE,
                ),
                array(
                    'fieldname' => 'OXSHOPID',
                    'content' => $sShopId,
                    'force_update' => FALSE,
                    'use_quote' => TRUE,
                ),
                array (
                    'fieldname'     => 'OXSNIPPET',
                    'content'       => "1",
                    'force_update'  => TRUE,
                    'use_quote'     => TRUE,
                    'use_multilang' => FALSE,
                ),
                array (
                    'fieldname'     => 'OXTYPE',
                    'content'       => "0",
                    'force_update'  => TRUE,
                    'use_quote'     => TRUE,
                    'use_multilang' => FALSE,
                ),
                array(
                    'fieldname' => 'OXACTIVE',
                    'content' => '1',
                    'force_update' => FALSE,
                    'use_quote' => FALSE,
                ),
                array (
                    'fieldname'     => 'OXPOSITION',
                    'content'       => "",
                    'force_update'  => FALSE,
                    'use_quote'     => TRUE,
                    'use_multilang' => FALSE,
                ),
                array(
                    'fieldname'     => $this->_getLangAbbrFieldName('oxcontents', 'OXTITLE', 'de'),
                    'content'       => 'Geburtstags-EMail Betreff-Text',
                    'force_update'  => TRUE,
                    'use_quote'     => TRUE,
                    'use_multilang' => FALSE,
                ),
                array (
                    'fieldname'     => $this->_getLangAbbrFieldName('oxcontents', 'OXCONTENT', 'de'),
                    'content'       => "Ihr Gutschein zum Geburtstag!",
                    'force_update'  => FALSE,
                    'use_quote'     => TRUE,
                    'use_multilang' => FALSE,
                ),

                array(
                    'fieldname'     => 'OXCATID',
                    'content'       => '8a142c3e4143562a5.46426637',
                    'force_update'  => TRUE,
                    'use_quote'     => TRUE,
                ),
                array(
                    'fieldname'     => 'OXFOLDER',
                    'content'       => 'CMSFOLDER_EMAILS',
                    'force_update'  => TRUE,
                    'use_quote'     => TRUE,
                ),
            );
            $aRet = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
            #dumpvar($aRet);
            $blRet = $aRet['blRet'];
            $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
            $this->setUpdateBreak(FALSE);
        }
        return $blRet;
    }

    /**
     * @return bool TRUE, if update is required
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     */
    public function checkCmsItems_02()
    {
        $blRet = FALSE;
        foreach (Registry::getConfig()->getShopIds() as $sShopId)
        {
            // change this to your inividual check criterias
/*
            $sSql = "SELECT count(`oxid`) FROM `oxcontents`
            WHERE
            OXLOADID = 'd3birthdayvoucherplainmail'
            AND OXSHOPID = '".$oShop->getId()."'";
*/

            $sSql = <<<MYSQL
SELECT count(oxid) FROM oxcontents
            WHERE
            OXLOADID = 'd3birthdayvoucherplainmail'
            AND OXSHOPID = '{$sShopId}'
MYSQL;

            #echo "<hr>".$sSql;
            if ($this->getDb()->getOne($sSql) != 1)
            {
                $blRet = TRUE;
            }
        }
        return $blRet;
    }

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     * @throws \oxSystemComponentException
     */
    public function executeCmsTypesItemsList_02()
    {
        $blRet = FALSE;

        foreach (Registry::getConfig()->getShopIds() as $sShopId)
        {
            $aWhere = array(
                #'oxid' => "md5('d3birthdayvouchersubjectmail " . $oShop->getId() . " de')",
                'oxshopid' => $sShopId,
                'OXLOADID' => 'd3birthdayvoucherplainmail',
            );
            $aInsertFields = array(
                array(
                    'fieldname' => 'OXID',
                    'content' => "md5('d3birthdayvoucherplainmail " . $sShopId . "')",
                    'force_update' => FALSE,
                    'use_quote' => FALSE,
                    'use_multilang' => FALSE,
                ),
                array(
                    'fieldname' => 'OXLOADID',
                    'content' => 'd3birthdayvoucherplainmail',
                    'force_update' => FALSE,
                    'use_quote' => TRUE,
                ),
                array(
                    'fieldname' => 'OXSHOPID',
                    'content' => $sShopId,
                    'force_update' => FALSE,
                    'use_quote' => TRUE,
                ),
                array (
                    'fieldname'     => 'OXSNIPPET',
                    'content'       => "1",
                    'force_update'  => TRUE,
                    'use_quote'     => TRUE,
                    'use_multilang' => FALSE,
                ),
                array (
                    'fieldname'     => 'OXTYPE',
                    'content'       => "0",
                    'force_update'  => TRUE,
                    'use_quote'     => TRUE,
                    'use_multilang' => FALSE,
                ),
                array(
                    'fieldname' => 'OXACTIVE',
                    'content' => '1',
                    'force_update' => FALSE,
                    'use_quote' => FALSE,
                ),
                array (
                    'fieldname'     => 'OXPOSITION',
                    'content'       => "",
                    'force_update'  => FALSE,
                    'use_quote'     => TRUE,
                    'use_multilang' => FALSE,
                ),
                array(
                    'fieldname'     => $this->_getLangAbbrFieldName('oxcontents', 'OXTITLE', 'de'),
                    'content' => 'Geburtstags-EMail Plain-Text',
                    'force_update' => TRUE,
                    'use_quote' => TRUE,
                    'use_multilang' => FALSE,
                ),
                array (
                    'fieldname'     => $this->_getLangAbbrFieldName('oxcontents', 'OXCONTENT', 'de'),
                    'content'       => 'Guten Tag [{ $user->oxuser__oxsal->value|oxmultilangsal }] [{ $user->oxuser__oxfname->value }] [{ $user->oxuser__oxlname->value }],\r\n\r\nIhr [{ $shop->oxshops__oxname->value }] m�chte Ihnen ganz herzlich zum Geburtstag gratulieren.\r\n\r\nAls kleines Pr�sent senden wir Ihnen im Folgenden einen Gutschein im Wert von [{$voucherserie->oxvoucherseries__oxdiscount->value|string_format:"%.2f"|replace:".":","}] [{if $voucherserie->oxvoucherseries__oxdiscounttype->value == "absolute"}]EUR[{else}]%[{/if}] zu.\r\n\r\n\r\nIhre pers�nlicher Geburtstagsgutschein-Nr. lautet: [{$voucher->oxvouchers__oxvouchernr->value}]\r\n\r\nUnd so einfach gehts:\r\nGehen Sie in unseren Onlineshop unter [{ $shop->oxshops__oxurl->value }].\r\nSt�bern Sie in Ruhe unter der Vielzahl an Aritkeln und legen Sie die gew�nschten Produkte in den Warenkorb.\r\nKlicken Sie nun auf den Warenkorb um eine �bersicht Ihrer gew�hlten Artikel zu sehen.\r\nUnter der Artikelliste finden Sie das Eingabefeld f�r den Gutscheincode.\r\nGeben Sie diesen dort ein, best�tigen Sie die Eingabe und f�hren Sie den Bestellvorgang ganz normal durch.\r\n\r\nIn Schritt 4 des Bestellvorgangs sehen Sie nun in der Zusammenfassung den abgezogenen Gutscheinwert.\r\n\r\nNoch einen sch�nen Tag w�nscht\r\n\r\nIhr  [{ $shop->oxshops__oxname->value }] Team',
                    'force_update'  => FALSE,
                    'use_quote'     => TRUE,
                    'use_multilang' => FALSE,
                ),
                array(
                    'fieldname' => 'OXCATID',
                    'content' => '8a142c3e4143562a5.46426637',
                    'force_update' => TRUE,
                    'use_quote' => TRUE,
                ),
                array(
                    'fieldname' => 'OXFOLDER',
                    'content' => 'CMSFOLDER_EMAILS',
                    'force_update' => TRUE,
                    'use_quote' => TRUE,
                ),
            );
            #$aRet = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
            $aRet = $this->_updateTableItem22('oxcontents', $aInsertFields, $aWhere);
            #dumpvar($aRet);
            $blRet = $aRet['blRet'];
            $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
            $this->setUpdateBreak(FALSE);
        }
        return $blRet;
    }

    /**
     * @return bool TRUE, if update is required
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     */
    public function checkCmsItems_03()
    {
        $blRet = FALSE;
        foreach (Registry::getConfig()->getShopIds() as $sShopId)
        {
            // change this to your inividual check criterias
            /*
            $sSql = "SELECT count(`oxid`) FROM `oxcontents`
            WHERE
            OXLOADID = 'd3birthdayvouchermail'
            AND OXSHOPID = '".$oShop->getId()."'";
            */

            $sSql = <<<MYSQL
SELECT count(oxid) FROM oxcontents
            WHERE
            OXLOADID = 'd3birthdayvouchermail'
            AND OXSHOPID = '{$sShopId}'
MYSQL;

            #echo "<hr>".$sSql;
            if ($this->getDb()->getOne($sSql) != 1)
            {
                $blRet = TRUE;
            }
        }
        return $blRet;
    }

    /**
     * @return bool
     * @throws \Doctrine\DBAL\DBALException
     * @throws \OxidEsales\Eshop\Core\Exception\ConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    public function executeCmsTypesItemsList_03()
    {
        $blRet = FALSE;

        foreach (Registry::getConfig()->getShopIds() as $sShopId)
        {
            $aWhere = array(
                #'oxid' => "md5('d3birthdayvouchersubjectmail " . $oShop->getId() . " de')",
                'oxshopid' => $sShopId,
                'OXLOADID' => 'd3birthdayvouchermail',
            );
            $aInsertFields = array(
                array(
                    'fieldname' => 'OXID',
                    'content' => "md5('d3birthdayvouchermail " . $sShopId . "')",
                    'force_update' => FALSE,
                    'use_quote' => FALSE,
                    'use_multilang' => FALSE,
                ),
                array(
                    'fieldname' => 'OXLOADID',
                    'content' => 'd3birthdayvouchermail',
                    'force_update' => FALSE,
                    'use_quote' => TRUE,
                ),
                array(
                    'fieldname' => 'OXSHOPID',
                    'content' => $sShopId,
                    'force_update' => FALSE,
                    'use_quote' => TRUE,
                ),
                array (
                    'fieldname'     => 'OXSNIPPET',
                    'content'       => "1",
                    'force_update'  => TRUE,
                    'use_quote'     => TRUE,
                    'use_multilang' => FALSE,
                ),
                array (
                    'fieldname'     => 'OXTYPE',
                    'content'       => "0",
                    'force_update'  => TRUE,
                    'use_quote'     => TRUE,
                    'use_multilang' => FALSE,
                ),
                array(
                    'fieldname' => 'OXACTIVE',
                    'content' => '1',
                    'force_update' => FALSE,
                    'use_quote' => FALSE,
                ),
                array (
                    'fieldname'     => 'OXPOSITION',
                    'content'       => "",
                    'force_update'  => FALSE,
                    'use_quote'     => TRUE,
                    'use_multilang' => FALSE,
                ),
                array(
                    'fieldname' => $this->_getLangAbbrFieldName('oxcontents', 'OXTITLE', 'de'),
                    'content' => 'Geburtstags-EMail Text',
                    'force_update' => TRUE,
                    'use_quote' => TRUE,
                    'use_multilang' => FALSE,
                ),
                array (
                    'fieldname'     => $this->_getLangAbbrFieldName('oxcontents', 'OXCONTENT', 'de'),
                    'content'       => 'Guten Tag [{$user->oxuser__oxsal->value|oxmultilangsal}] [{$user->oxuser__oxfname->value}] [{$user->oxuser__oxlname->value}],
<p>Ihr [{ $shop->oxshops__oxname->value }] m�chte Ihnen ganz herzlich zum Geburtstag gratulieren.<br>
<br>
Als kleines Pr�sent senden wir Ihnen im Folgenden einen Gutschein im Wert von
[{$voucherserie->oxvoucherseries__oxdiscount->value|string_format:"%.2f"|replace:".":","}] [{if $voucherserie->oxvoucherseries__oxdiscounttype->value == "absolute"}]EUR[{else}]%[{/if}] zu.<br>
</p>
<p>Ihre pers�nlicher Geburtstagsgutschein-Nr. lautet: <strong>[{$voucher->oxvouchers__oxvouchernr->value}]</strong></p>
<p><br>
Und so einfach gehts:<br />
Gehen Sie in unseren Onlineshop unter [{ $shop->oxshops__oxurl->value }].<br>
St�bern Sie in Ruhe unter der Vielzahl an Aritkeln und legen Sie die gew�nschten Produkte in den Warenkorb.<br />
Klicken Sie nun auf den Warenkorb um eine �bersicht Ihrer gew�hlten Artikel zu sehen.<br>
Unter der Artikelliste finden Sie das Eingabefeld f�r den Gutscheincode.<br />
Geben Sie diesen dort ein, best�tigen Sie die Eingabe und f�hren Sie den Bestellvorgang ganz normal durch.<br />
In Schritt 4 des Bestellvorgangs sehen Sie nun in der Zusammenfassung den abgezogenen Gutscheinwert.<br />
<br />
Noch einen sch�nen Tag w�nscht</p>
<p>Ihr  [{ $shop->oxshops__oxname->value }] Team </p>',
                    'force_update'  => FALSE,
                    'use_quote'     => TRUE,
                    'use_multilang' => FALSE,
                ),
                array(
                    'fieldname' => 'OXCATID',
                    'content' => '8a142c3e4143562a5.46426637',
                    'force_update' => TRUE,
                    'use_quote' => TRUE,
                ),
                array(
                    'fieldname' => 'OXFOLDER',
                    'content' => 'CMSFOLDER_EMAILS',
                    'force_update' => TRUE,
                    'use_quote' => TRUE,
                ),
            );
            $aRet = $this->_updateTableItem2('oxcontents', $aInsertFields, $aWhere);
            #dumpvar($aRet);
            $blRet = $aRet['blRet'];
            $this->setActionLog('SQL', $aRet['sql'], __METHOD__);
            $this->setUpdateBreak(FALSE);
        }
        return $blRet;
    }
}