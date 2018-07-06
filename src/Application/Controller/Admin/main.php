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

use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_;

class main extends d3_cfg_mod_
{
    protected $_hasListItems = false;
    public function render()
    {
        $this->addTplParam('sListClass', 'birthdayvoucherlist');
        $this->addTplParam('sMainClass', 'birthdayvouchersettings');
        return parent::render();
    }
}