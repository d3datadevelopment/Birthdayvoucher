<?php

use D3\Birthdayvoucher\Setup as ModuleSetup;
use OxidEsales\Eshop\Application\Controller as OxidController;
use OxidEsales\Eshop\Application\Model as OxidModel;
use OxidEsales\Eshop\Core as OxidCore;

/**
 * Metadata version
 */
$sMetadataVersion = '2.0';

$sD3Logo = (class_exists(d3\modcfg\Application\Model\d3utils::class) ? d3\modcfg\Application\Model\d3utils::getInstance()->getD3Logo() : 'D&sup3;');

/**
 * Module information
 */
$aModule = array(
    'id'           => 'd3birthdayvoucher',
    'title'        => $sD3Logo . ' Geburtstagsgutscheine',
    'description'   => array(
        'de' => 'Bereiten Sie Ihrem Kunden mit einem automatisch generierten Geburtstagsgutschein eine Freude.<br><br>
 Dieses Modul schaut jeden Tag, ob einer Ihrer Kunden Geburtstag hat und schickt diesem zusammen mit einer Gl&uuml;ckwunsch-E-mail eine automatisch generierte Gutschein-Nummer.',
        'en' => '')
    ,

    'thumbnail'    => 'picture.png',
    'version'      => '4.0.0.1',
    'author' => 'D&sup3; Data Development',
    'url' => 'http://www.shopmodule.com',
    'email' => 'support@shopmodule.com',
    'extend'       => array(
        OxidCore\Email::class        => \D3\Birthdayvoucher\Modules\Core\d3_oxemail_birthdayvoucher::class,
        OxidModel\User::class        => \D3\Birthdayvoucher\Modules\Application\Model\d3_oxuser_birthdayvoucher::class,
        OxidModel\Voucher::class     => \D3\Birthdayvoucher\Modules\Application\Model\d3_oxvoucher_birtdayvoucherdate::class,

    ),
    'controllers' => array(
        'd3_d3birthdayvoucher_licence'       => \D3\Birthdayvoucher\Application\Controller\Admin\licence::class,
        'd3_d3birthdayvoucher_main'         => \D3\Birthdayvoucher\Application\Controller\Admin\main::class,
        'd3_d3birthdayvoucher_settings'         => \D3\Birthdayvoucher\Application\Controller\Admin\settings::class,
        'd3_d3birthdayvoucher_list'         => \D3\Birthdayvoucher\Application\Controller\Admin\birthdayvoucherlist::class,
        'd3_d3birthdayvoucher_loglist'         => \D3\Birthdayvoucher\Application\Controller\Admin\birthdayvoucherloglist::class,
        'd3_d3birthdayvoucher_log'         => \D3\Birthdayvoucher\Application\Controller\Admin\birthdayvoucherlog::class,
        'd3_d3birthdayvoucher_agelimit'         => \D3\Birthdayvoucher\Application\Controller\Admin\agelimit::class,
    ),

    'templates' => array(
        'd3birthdayvoucher_settings.tpl'         => 'd3/birthdayvoucher/Application/views/admin/tpl/d3birthdayvoucher_settings.tpl',
        'd3birthdayvoucher_settings_agelimit.tpl'         => 'd3/birthdayvoucher/Application/views/admin/tpl/d3birthdayvoucher_settings_agelimit.tpl',

        'd3_email_birthdayvoucher_html.tpl'         => 'd3/birthdayvoucher/Application/views/tpl/email/d3_email_birthdayvoucher_html.tpl',
        'd3_email_birthdayvoucher_plain.tpl'         => 'd3/birthdayvoucher/Application/views/tpl/email/d3_email_birthdayvoucher_plain.tpl',
        'd3_email_birthdayvoucher_subj.tpl'         => 'd3/birthdayvoucher/Application/views/tpl/email/d3_email_birthdayvoucher_subj.tpl',

        'd3_email_birthdayvoucher_reminder_html.tpl'         => 'd3/birthdayvoucher/Application/views/tpl/email/d3_email_birthdayvoucher_reminder_html.tpl',
        'd3_email_birthdayvoucher_reminder_plain.tpl'         => 'd3/birthdayvoucher/Application/views/tpl/email/d3_email_birthdayvoucher_reminder_plain.tpl',
        'd3_email_birthdayvoucher_reminder_subj.tpl'         => 'd3/birthdayvoucher/Application/views/tpl/email/d3_email_birthdayvoucher_reminder_subj.tpl',

        'd3_email_birthdayvoucher_reminder_expiration_html.tpl'         => 'd3/birthdayvoucher/Application/views/tpl/email/d3_email_birthdayvoucher_reminder_expiration_html.tpl',
        'd3_email_birthdayvoucher_reminder_expiration_plain.tpl'         => 'd3/birthdayvoucher/Application/views/tpl/email/d3_email_birthdayvoucher_reminder_expiration_plain.tpl',
        'd3_email_birthdayvoucher_reminder_expiration_subj.tpl'         => 'd3/birthdayvoucher/Application/views/tpl/email/d3_email_birthdayvoucher_reminder_expiration_subj.tpl',
    ),
    'blocks' => array(
        array(
            'template' => 'user_main.tpl',
            'block'    => 'admin_user_main_form',
            'file'     => 'Application/views/admin/blocks/user_main_form.tpl'
        ),
    ),
    'events' => array(
        'onActivate' => '\D3\Birthdayvoucher\Setup\Events::onActivate',
    ),

    'd3FileRegister'    => array(
        'd3/birthdayvoucher/IntelliSenseHelper.php',
        'd3/birthdayvoucher/metadata.php',

        'd3/birthdayvoucher/Application/Controller/Admin/agelimit.php',
        'd3/birthdayvoucher/Application/Controller/Admin/birthdayvoucherlist.php',
        'd3/birthdayvoucher/Application/Controller/Admin/birthdayvoucherlog.php',
        'd3/birthdayvoucher/Application/Controller/Admin/birthdayvoucherloglist.php',
        'd3/birthdayvoucher/Application/Controller/Admin/licence.php',
        'd3/birthdayvoucher/Application/Controller/Admin/main.php',
        'd3/birthdayvoucher/Application/Controller/Admin/settings.php',

        'd3/birthdayvoucher/Application/Model/reminder.php',
        'd3/birthdayvoucher/Application/Model/utils_birthdayvoucher.php',
        'd3/birthdayvoucher/Application/Model/voucher.php',

        'd3/birthdayvoucher/Application/translations/de/d3_d3birtdayvoucherdate_lang.php',

        'd3/birthdayvoucher/Application/public/d3_birthday_voucher.php',
        'd3/birthdayvoucher/Application/public/d3_birthday_voucher.sh',

        'd3/birthdayvoucher/Application/Modules/Core/d3_oxemail_birthdayvoucher.php',
        'd3/birthdayvoucher/Application/Modules/Application/Models/d3_oxuser_birthdayvoucher.php',
        'd3/birthdayvoucher/Application/Modules/Application/Models/d3_oxvoucher_birthdayvoucher.php',

        'd3/birthdayvoucher/Setup/d3birthdayvoucher_update.php',
    ),

     'd3SetupClasses' => array(
        ModuleSetup\d3birthdayvoucher_update::class,
    ),
);