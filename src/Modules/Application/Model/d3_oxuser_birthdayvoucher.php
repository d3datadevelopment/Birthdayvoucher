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

namespace D3\Birthdayvoucher\Modules\Application\Model;

class d3_oxuser_birthdayvoucher extends d3_oxuser_birthdayvoucher_parent
{
    /**
     * @return bool
     */
    public function save()
    {
        if ( is_array( $this->oxuser__d3birthdayvoucher_lastdate->value ) ) {
            $this->oxuser__d3birthdayvoucher_lastdate = new \OxidEsales\Eshop\Core\Field(
            $this->convertBirthday( $this->oxuser__d3birthdayvoucher_lastdate->value ), \OxidEsales\Eshop\Core\Field::T_RAW
            );
        }
        return parent::save();
    }
}