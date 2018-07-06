<?PHP

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

use D3\ModCfg\Application\Controller\Admin\d3_cfg_mod_licence;

class licence extends d3_cfg_mod_licence
{

    protected $_sModId = 'd3birthdayvoucher';
    protected $_hasLicence = false;
    protected $_hasNewsletterForm = false;
    protected $_hasUpdate = true;
    protected $_modUseCurl = false;
    protected $_sMenuItemTitle = 'd3mxd3birthdayvoucher';
    protected $_sMenuSubItemTitle = 'd3mxd3birthdayvoucher_SUPPORT';
    protected $_sHelpLinkMLAdd = 'Fragen-zu-speziellen-Modulen/Geburtstagsgutscheine/';

    //protected $_sBlogFeed = "http://blog.oxidmodule.com/feeds/categories/9-erweiterte-Suche.rss";
}