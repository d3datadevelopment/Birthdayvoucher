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

    .ext_edittext {
        padding: 2px;
    }

    td.edittext {
        white-space: normal;
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
    <div id="liste">
    <table border="0" width="98%">
        <tr>
            <td valign="top" class="edittext">
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

                    <table width="100%">
                        <tr>
                            <td class="edittext ext_edittext" align="left">
                                <div class="d3modcfg_btn">
                                    <input type="submit" class="edittext ext_edittext" name="save"
                                           value="[{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_MAIN_SAVE"}]">
                                </div>
                            </td>
                        </tr>
                    </table>
                    [{*
                    <hr>
                    <table width="100%">
                        <tr>
                            <td class="edittext ">[{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_AGE_GENERAL"}]</td>
                            <td class="edittext " >
                                <input type="text" class="editinput" size="10" maxlength="100"
                                       name="value[d3_cfg_mod__d3birthdayvoucher_AGE_GENERAL]"
                                       value="[{$value->d3_cfg_mod__d3birthdayvoucher_AGE_GENERAL}]">
                                [{oxinputhelp ident="D3_CFG_MOD_d3birthdayvoucher_AGE_GENERAL_HELP"}]
                            </td>
                            <td class="">&nbsp;</td>
                        </tr>
                    </table>
                    *}]

                    [{*oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_COUNTRIES"*}]
                    [{assign var='oCountries' value=$oView->getCountries()}]
                    <table>
                        <tr>
                            <td width="10%">
                                [{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_COUNTRIES_ACTIVE"}]
                            </td>
                            <td width="15%">
                                [{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_COUNTRIES_AGE"}]
                                [{oxinputhelp ident="D3_CFG_MOD_d3birthdayvoucher_COUNTRIES_AGE_HELP"}]
                            </td>
                            <td width="75%">
                                [{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_COUNTRIES_COUNTRY"}]
                            </td>
                        </tr>

                        <tr>
                            <td style="background:lightgray;">&nbsp;</td>
                            <td style="background:lightgray;">
                                <input type="text" class="editinput" size="2" maxlength="5"
                                       name="value[d3_cfg_mod__d3birthdayvoucher_AGE_GENERAL]"
                                       id="value[d3_cfg_mod__d3birthdayvoucher_AGE_GENERAL]"
                                       value="[{$value->d3_cfg_mod__d3birthdayvoucher_AGE_GENERAL}]">
                            </td>
                            <td style="background:lightgray;"><span style="font-weight:bold;">
                                    <label for="value[d3_cfg_mod__d3birthdayvoucher_AGE_GENERAL]">
                                    [{oxmultilang ident="D3_CFG_MOD_d3birthdayvoucher_AGE_GENERAL"}]</label>
                                </span>
                                [{oxinputhelp ident="D3_CFG_MOD_d3birthdayvoucher_AGE_GENERAL_HELP"}]
                            </td>
                        </tr>

                        [{foreach from=$oCountries item='Country' name='country'}]
                        [{*$Country|debug_print_var*}]

                        [{if $smarty.foreach.country.iteration % 2 != 0}]
                            [{assign var='tdBackGround' value=''}]
                        [{else}]
                            [{assign var='tdBackGround' value='listitem'}]
                        [{/if}]

                        <tr>
                            <td class=" [{$tdBackGround}] [{if $Country->oxcountry__oxactive->value == 1 }]active[{/if}]">
                                <div class="listitemfloating"> </div>
                            </td>

                            <td class=" [{$tdBackGround}]">
                                <input type="text" name="SELECTIONGROUPS[SELECTION_COUNTRIES_FOR_AGE_LIMIT][[{$Country->oxcountry__oxid->value}]]"
                                       id="SELECTIONGROUPS[SELECTION_COUNTRIES_FOR_AGE_LIMIT][[{$Country->oxcountry__oxid->value}]]"
                                    value="[{$Country->AgeLimit}]"
                                    size="2">
                            </td>

                            <td class=" [{$tdBackGround}]">
                                <label for="SELECTIONGROUPS[SELECTION_COUNTRIES_FOR_AGE_LIMIT][[{$Country->oxcountry__oxid->value}]">
                                [{$Country->oxcountry__oxtitle->rawValue}]
                                </label>
                            </td>
                        </tr>
                        [{/foreach}]
                    </table>

                    <hr>
                    <table width="100%">
                        <tr>
                            <td class="edittext ext_edittext" align="left">
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
    </div>
</form>
[{include file="d3_cfg_mod_inc.tpl"}]
