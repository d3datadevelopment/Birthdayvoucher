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

namespace D3\Birthdayvoucher\Modules\Core
{

    use OxidEsales\Eshop\Core\Email;

    class d3_oxemail_birthdayvoucher_parent extends Email{}
}


namespace D3\Birthdayvoucher\Modules\Application\Model
{

    use OxidEsales\Eshop\Application\Model\User;
    use OxidEsales\Eshop\Application\Model\Voucher;

    class d3_oxuser_birthdayvoucher_parent extends User{}
    class d3_oxvoucher_birtdayvoucherdate_parent extends Voucher{}
}

