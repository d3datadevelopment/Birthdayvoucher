[{include file="headitem.tpl" title="D3_CFG_MOD"|oxmultilangassign}]


<script type="text/javascript">
    <!--
    [{block name="D3_BIRTDAYVOUCHER_OVERVIEW_JS"}]
        [{if $updatelist == 1}]
            UpdateList('[{$oxid}]');
        [{/if}]
        function _groupExp(el) {
            var _cur = el.parentNode;

            if (_cur.className == "exp") _cur.className = "";
            else _cur.className = "exp";
        }
    [{/block}]
    -->
</script>

<style type="text/css">
    <!--
    [{block name="D3_BIRTDAYVOUCHER_OVERVIEW_CSS"}]

    fieldset {
        border: 1px inset black;
    }

    legend {
        font-weight: bold;
    }

    .groupExp dl {
        border-top: 1px solid #bbbbbb;
    }

    .groupExp dl dt {
        font-weight: normal;
        width: 35%;
        padding-left: 10px;
    }

    .groupExp.highlighted a.rc b {
        color: white;
    }

    .groupExp.highlighted .exp a.rc b {
        color: black;
    }

    /*
    .groupExp {
        border: 1px solid lightgray;
    }
    */

    .ext_edittext {
        padding: 2px;
    }

    td.edittext {
        white-space: normal;
    }

    .confinput {
        width: 300px;
        height: 60px;
    }

    span.field {
        border: 1px inset black;
        padding: 1px 6px;
        width: 138px;
        display: block;
    }

    a.d3cronjoblink:hover {
        text-decoration: none;
    }
    [{/block}]
    -->
</style>

<form name="transfer" id="transfer" action="[{$oViewConf->getSelfLink()}]" method="post">
    <div>
        [{$oViewConf->getHiddenSid()}]
        <input type="hidden" name="oxid" value="[{$oxid}]">
        <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
        <input type="hidden" name="editlanguage" value="[{$editlanguage}]">
    </div>
</form>

<form name="myedit" id="myedit" action="[{$oViewConf->getSelfLink()}]" method="post">
    <div>
        [{$oViewConf->getHiddenSid()}]
        <input type="hidden" name="cl" value="[{$oViewConf->getActiveClassName()}]">
        <input type="hidden" name="fnc" value="save">
        <input type="hidden" name="oxid" value="[{$oxid}]">
        <input type="hidden" name="editval[d3_cfg_mod__oxid]" value="[{$oxid}]">
    </div>
    <table border="0" width="98%">
        <tr>
            <td valign="top" class="edittext">
                [{include file="d3_cfg_mod_active.tpl"}]
                <hr>
                [{if $oView->getValueStatus() == 'error'}]
                <table>
                    <tr>
                        <td>
                            <b>[{oxmultilang ident="D3_CFG_MOD_GENERAL_NOCONFIG_DESC"}]</b><br>

                            <div class="d3modcfg_btn fixed icon status_danger">
                                <input type="submit" value="[{oxmultilang ident="D3_CFG_MOD_GENERAL_NOCONFIG_BTN"}]">

                                <div></div>
                            </div>
                        </td>
                    </tr>
                </table>
                [{else}]
                <fieldset>
                    <legend>[{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_CRONJOBS_OWERVIEW"}]</legend>
                    [{block name="D3_BIRTDAYVOUCHER_OVERVIEW_CONFIG_TABLE"}]
                    <table cellspacing="0" cellpadding="0" border="0" width="100%">
                        <tr>
                            <td class="edittext listitem">[{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_CRONJOBS_ACTIVE"}]</td>
                            <td class="edittext listitem">
                                <input type="hidden" name="value[d3_cfg_mod__bld3birthdayvoucher_CRONJOB_ACTIVE]"
                                       value="0">
                                <input class="edittext ext_edittext" type="checkbox"
                                       name="value[d3_cfg_mod__bld3birthdayvoucher_CRONJOB_ACTIVE]" value='1'
                                [{if $value->d3_cfg_mod__bld3birthdayvoucher_CRONJOB_ACTIVE == 1}]checked[{/if}]>
                                [{oxinputhelp ident="D3_CFG_MOD_d3birthdayvoucher_CRONJOBS_ACTIVE_HELP"}]
                            </td>
                        </tr>
                        <tr>
                            <td class="edittext ">[{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_LAST_STARTS_CRONJOBS"}]</td>
                            <td class="edittext "><span class="field">[{$value->d3_cfg_mod__d3birthdayvoucher_CronJob_LastStart}]&nbsp;</span></td>
                        </tr>
                        <tr>
                            <td class="edittext listitem">[{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_CRONJOBS_LINK"}]</td>
                            <td class="edittext listitem" style="white-space: nowrap;">
                                <a href="[{$oViewConf->getModuleUrl('d3birthdayvoucher', 'public/d3_birthday_voucher.php')}]?key=[{$value->d3_cfg_mod__d3birthdayvoucher_ACCESSKEY}][{$oView->d3GetShopId()}]"
                                   target="_new" class="d3modcfg_btn icon d3color-blue" style="margin-right: 3px; padding-right: 0; background-image: none; width: 25px;"
                                   title="[{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_CRONJOBS_LINK"}]">&nbsp;
                                    <i class="fa fa-mouse-pointer fa-inverse" style="padding: 5px 3px;"></i>
                                </a>
                                [{$oViewConf->getModuleUrl('d3birthdayvoucher', 'public/d3_birthday_voucher.php')}]?key=[{$value->d3_cfg_mod__d3birthdayvoucher_ACCESSKEY}][{$oView->d3GetShopId()}]

                                &nbsp;[{oxinputhelp ident="D3_CFG_MOD_d3birthdayvoucher_CRONJOBS_LINK_HELP"}]
                            </td>
                        </tr>
                        <tr>
                            <td class="edittext">[{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_ACCESSKEY"}]</td>
                            <td class="edittext">
                                <input type="text" class="editinput" size="10" maxlength="100"
                                       name="value[d3_cfg_mod__d3birthdayvoucher_ACCESSKEY]"
                                       value="[{$value->d3_cfg_mod__d3birthdayvoucher_ACCESSKEY|default:$oView->d3GetRandomCode()}]">
                                [{oxinputhelp ident="D3_CFG_MOD_d3birthdayvoucher_ACCESSKEY_HELP"}]
                            </td>
                            <td class="">&nbsp;</td>
                        </tr>
                        <tr>
                            <td class="edittext listitem">[{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_MAIL4BCC"}]
                            </td>
                            <td class="edittext listitem"><input type="text"
                                                                 name="value[d3_cfg_mod__d3birthdayvoucher_MAIL4BCC]"
                                                                 value="[{$value->d3_cfg_mod__d3birthdayvoucher_MAIL4BCC}]"
                                                                 size="35" maxlength="70">
                                [{oxinputhelp ident="D3_CFG_MOD_d3birthdayvoucher_MAIL4BCC_HELP"}]
                            </td>
                        </tr>

                        <tr>
                            <td class="edittext listitem">[{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_TEST_MODUS_ADDRESS"}]
                            </td>
                            <td class="edittext listitem"><input type="text"
                                                                 name="value[d3_cfg_mod__d3birthdayvoucher_TEST_MODUS_ADDRESS]"
                                                                 value="[{$value->d3_cfg_mod__d3birthdayvoucher_TEST_MODUS_ADDRESS}]"
                                                                 size="35" maxlength="70">
                                [{oxinputhelp ident="D3_CFG_MOD_d3birthdayvoucher_TEST_MODUS_ADDRESS_HELP"}]
                            </td>
                        </tr>

                        <tr>
                            <td class="edittext ">
                                [{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_VOUCHER_NUMBER_OF_CHARAKTER"}]
                            </td>
                            <td class="edittext "><input type="text"
                                                                 name="value[d3_cfg_mod__d3birthdayvoucher_VOUCHER_NUMBER_OF_CHARAKTER]"
                                                                 value="[{$value->d3_cfg_mod__d3birthdayvoucher_VOUCHER_NUMBER_OF_CHARAKTER}]"
                                                                 size="3" maxlength="10">
                                [{oxinputhelp ident="D3_CFG_MOD_d3birthdayvoucher_VOUCHER_NUMBER_OF_CHARAKTER_HELP"}]
                            </td>
                        </tr

                        <tr>
                            <td class="edittext listitem">
                                [{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_blOnly_Registered_User"}]
                            </td>
                            <td class="edittext listitem">
                                <input type="hidden" name="value[d3_cfg_mod__d3birthdayvoucher_blOnly_Registered_User]"
                                       value="0">
                                <input class="edittext ext_edittext" type="checkbox"
                                       name="value[d3_cfg_mod__d3birthdayvoucher_blOnly_Registered_User]" value='1'
                                [{if $value->d3_cfg_mod__d3birthdayvoucher_blOnly_Registered_User == 1}]checked[{/if}]>
                                [{oxinputhelp ident="D3_CFG_MOD_d3birthdayvoucher_blOnly_Registered_User_HELP"}]
                            </td>
                        </tr>
                        [{/block}]
                    </table>
                </fieldset>
                <br>
                [{block name="D3_BIRTDAYVOUCHER_CONFIG_RESTRICTIONS"}]
                    <div class="groupExp">
                        <div class="">
                            <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                <b>
                                    [{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_SELECT_ORDERS"}]
                                </b>
                            </a>
                            [{block name="D3_BIRTDAYVOUCHER_CONFIG_USER"}]
                            [{* Kundengruppen freigeben *}]
                            <dl>
                                <dt>
                                    [{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_GROUPS_FOR_VOUCHER"}]
                                    [{oxinputhelp ident="D3_CFG_MOD_d3birthdayvoucher_GROUPS_FOR_VOUCHER_HELP"}]
                                </dt>
                                <dd>
                                    <div style="width:64%;float:right;">
                                        <input class="edittext ext_edittext" type="hidden" name="SELECTIONGROUPS[SELECTION_GROUPS_FOR_VOUCHER]" value='0' >
                                        [{strip}]
                                        <table>
                                            <tr>
                                                [{assign var=oGroups4Points value=$oView->d3_PrepareGroups4Points()}]
                                                [{foreach from=$oGroups4Points item=Groups name="group4points"}]
                                                <td>
                                                    [{*<input class="edittext ext_edittext" type="hidden" name="SELECTIONGROUPS[SELECTION_SELECTION_GROUPS_FOR_VOUCHER][]" value='0' >*}]
                                                    <input class="edittext ext_edittext" type="checkbox" name="SELECTIONGROUPS[SELECTION_GROUPS_FOR_VOUCHER][]"
                                                           value='[{$Groups->oxgroups__oxid->value}]' [{if $Groups->select == 1}]checked[{/if}]>
                                                    &nbsp;[{$Groups->oxgroups__oxtitle->value}] [{if !$Groups->oxgroups__oxactive->value}]<span class="filename_filepath_or_italic">([{oxmultilang ident="D3_CFG_MOD_d3points_INACTIVE"}])</span>[{/if}]
                                                    (<span style="font-style: italic">
                                                        Oxid: [{$Groups->oxgroups__oxid->value}]</span>)
                                                </td>
                                                [{if $smarty.foreach.group4points.last && $smarty.foreach.group4points.iteration % 2 != 0}]
                                                <td></td>
                                                [{/if}]
                                                [{if $smarty.foreach.group4points.iteration % 2 == 0}]
                                            </tr>
                                            [{if !$smarty.foreach.group4points.last}]
                                            <tr>
                                                [{/if}]
                                                [{/if}]
                                                [{/foreach}]
                                        </table>
                                        [{/strip}]
                                    </div>
                                    <div class="spacer"></div>
                                </dd>
                            </dl>
                            [{*Kundengruppen ausschliessen*}]
                            <dl>
                                <dt>
                                    [{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_GROUPS_FOR_NO_VOUCHER"}]
                                    [{oxinputhelp ident="D3_CFG_MOD_d3birthdayvoucher_GROUPS_FOR_NO_VOUCHER_HELP"}]
                                </dt>
                                <dd>
                                    <div style="width:64%;float:right;">
                                        <input class="edittext ext_edittext" type="hidden" name="SELECTIONGROUPS[SELECTION_GROUPS_FOR_NO_VOUCHER]" value='0'>
                                        [{strip}]
                                        <table>
                                            <tr>
                                                [{assign var=oGroups4NoPoints value=$oView->d3_PrepareGroups4NoPoints()}]
                                                [{foreach from=$oGroups4NoPoints item=Groups name="groupnopoints"}]
                                                <td>

                                                    <input class="edittext ext_edittext" type="checkbox" name="SELECTIONGROUPS[SELECTION_GROUPS_FOR_NO_VOUCHER][]"
                                                           value='[{$Groups->oxgroups__oxid->value}]' [{if $Groups->select == 1}]checked[{/if}]>
                                                      &nbsp;[{$Groups->oxgroups__oxtitle->value}] [{if !$Groups->oxgroups__oxactive->value}]<span class="filename_filepath_or_italic">([{oxmultilang ident="D3_CFG_MOD_d3points_INACTIVE"}])</span>[{/if}]
                                                      (<span style="font-style: italic">Oxid: [{$Groups->oxgroups__oxid->value}]</span>)
                                                </td>
                                                [{if $smarty.foreach.groupnopoints.last && $smarty.foreach.groupnopoints.iteration % 2 != 0}]
                                                <td></td>
                                                [{/if}]
                                                [{if $smarty.foreach.groupnopoints.iteration % 2 == 0}]
                                            </tr>
                                            [{if !$smarty.foreach.groupnopoints.last}]
                                            <tr>
                                                [{/if}]
                                                [{/if}]
                                                [{/foreach}]
                                        </table>
                                        [{/strip}]
                                    </div>
                                    <div class="spacer"></div>
                                </dd>
                            </dl>
                            [{* E-Mailadresse fuer Blacklist *}]
                            <dl>
                                <dt>
                                    [{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_ADRESSES_FOR_BLACKLIST"}]
                                </dt>
                                <dd>
                                    <textarea cols="50" rows="3" class="confinput" name="valuearr[d3_cfg_mod__d3birthdayvoucher_sBLACKLISTADDRESSES]">[{$edit->getEditValue('d3_cfg_mod__d3birthdayvoucher_sBLACKLISTADDRESSES')}]</textarea>
                                    [{oxinputhelp ident="D3_CFG_MOD_d3birthdayvoucher_ADRESSES_FOR_BLACKLIST_HELP"}]
                                    <div class="spacer"></div>
                                </dd>
                            </dl>
                            [{/block}]
                        </div>
                    </div>

                    <div class="groupExp">
                        <div class="">
                            <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                <b>
                                    [{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_LIMIT_FOR_VALIDITY"}]
                                </b>
                            </a>
                            [{* Zeit fuer Laufzeitlimit der Gutscheine *}]
                            <dl>
                                <dt>
                                    [{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_LIMIT_FOR_VALIDITY_IN_DAYS"}]
                                </dt>
                                <dd>
                                    <div style="width:64%;float:right;">
                                        <input type="text"
                                               name="value[d3_cfg_mod__d3birthdayvoucher_VALIDITY_DATE_LIMIT_RANGE]"
                                               value="[{$value->d3_cfg_mod__d3birthdayvoucher_VALIDITY_DATE_LIMIT_RANGE}]"
                                               size="3" maxlength="10">
                                        [{oxinputhelp ident="D3_CFG_MOD_d3birthdayvoucher_LIMIT_FOR_VALIDITY_IN_DAYS_HELP"}]

                                    </div>
                                    <div class="spacer"></div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="groupExp">
                        <div class="">
                            <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                <b>
                                    [{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_REMIDNER_FOR_EXPIRATION"}]
                                </b>
                            </a>
                            <dl>
                                <dt>
                                    [{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_iDaysForReminderRangeExpiration"}]
                                </dt>
                                <dd>
                                    <div style="width:64%;float:right;">
                                        <input type="text"
                                               name="value[d3_cfg_mod__d3birthdayvoucher_iDaysForReminderRangeExpiration]"
                                               value="[{$value->d3_cfg_mod__d3birthdayvoucher_iDaysForReminderRangeExpiration}]"
                                               size="3" maxlength="10">
                                        [{oxinputhelp ident="D3_CFG_MOD_d3birthdayvoucher_iDaysForReminderRangeExpiration_HELP"}]
                                    </div>
                                    <div class="spacer"></div>
                                </dd>
                            </dl>
                            <dl>
                                <dt>
                                    [{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_iLoopForReminderRangeExpiration"}]
                                </dt>
                                <dd>
                                    <div style="width:64%;float:right;">
                                        <input type="text"
                                               name="value[d3_cfg_mod__d3birthdayvoucher_iLoopForReminderRangeExpiration]"
                                               value="[{$value->d3_cfg_mod__d3birthdayvoucher_iLoopForReminderRangeExpiration}]"
                                               size="3" maxlength="10">
                                        [{oxinputhelp ident="D3_CFG_MOD_d3birthdayvoucher_iLoopForReminderRangeExpiration_HELP"}]
                                    </div>
                                    <div class="spacer"></div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="groupExp">
                        <div class="">
                            <a class="rc" onclick="_groupExp(this); return false;" href="#">
                                <b>
                                    [{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_REMIDNER_FOR_VOUCHERS_WITHTOU_EXPIRATION"}]
                                </b>
                            </a>
                            <dl>
                                <dt>
                                    [{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_iDaysForReminderRange"}]
                                </dt>
                                <dd>
                                    <div style="width:64%;float:right;">
                                        <input type="text"
                                               name="value[d3_cfg_mod__d3birthdayvoucher_iDaysForReminderRange]"
                                               value="[{$value->d3_cfg_mod__d3birthdayvoucher_iDaysForReminderRange}]"
                                               size="3" maxlength="10">
                                        [{oxinputhelp ident="D3_CFG_MOD_d3birthdayvoucher_iDaysForReminderRange_HELP"}]
                                    </div>
                                    <div class="spacer"></div>
                                </dd>
                            </dl>
                            <dl>
                                <dt>
                                    [{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_iLoopForReminderRange"}]
                                </dt>
                                <dd>
                                    <div style="width:64%;float:right;">
                                        <input type="text"
                                               name="value[d3_cfg_mod__d3birthdayvoucher_iLoopForReminderRange]"
                                               value="[{$value->d3_cfg_mod__d3birthdayvoucher_iLoopForReminderRange}]"
                                               size="3" maxlength="10">
                                        [{oxinputhelp ident="D3_CFG_MOD_d3birthdayvoucher_iLoopForReminderRange_HELP"}]
                                    </div>
                                    <div class="spacer"></div>
                                </dd>
                            </dl>
                        </div>
                    </div>

                [{/block}]
                <hr>
                <table width="100%">
                    <tr>
                        <td class="edittext ext_edittext" align="left">
                            <br>

                            <div class="d3modcfg_btn">
                                <input type="submit" class="edittext ext_edittext" name="save"
                                       value="[{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_MAIN_SAVE"}]">
                            </div>
                            <br><br>
                        </td>
                    </tr>
                </table>
                [{/if}]
            </td>
        </tr>
    </table>
</form>

[{include file="d3_cfg_mod_inc.tpl"}]
