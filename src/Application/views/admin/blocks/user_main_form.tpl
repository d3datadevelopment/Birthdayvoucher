[{$smarty.block.parent}]

[{d3modcfgcheck modid="d3birthdayvoucher"}]
[{/d3modcfgcheck}]

[{*** D3 Geburtstagsgutscheine ADD START   **}]
[{if $mod_d3birthdayvoucher}]
    <tr>
        <td class="edittext">
            <img src="[{$oViewConf->getModuleUrl('d3modcfg_lib', 'public/d3logo.php')}]">
            <br>
            [{oxmultilang ident="ORDER_MAIN_D3BIRTHDAYVOUCHER_LASTDATA"}]
        </td>
        <td class="edittext"><br>
            [{*
            <span class="field" style="border:1px solid; background:#F0F0F0;">
                [{$edit->oxuser__d3birthdayvoucher_lastdate->value}]
            </span>
            *}]
            <input type="text" class="editinput" size="3" maxlength="2" name="editval[oxuser__d3birthdayvoucher_lastdate][day]" value="[{$edit->oxuser__d3birthdayvoucher_lastdate->value|regex_replace:"/^([0-9]{4})[-]([0-9]{1,2})[-]/":"" }]" [{ $readonly }] disable>
            <input type="text" class="editinput" size="3" maxlength="2" name="editval[oxuser__d3birthdayvoucher_lastdate][month]" value="[{$edit->oxuser__d3birthdayvoucher_lastdate->value|regex_replace:"/^([0-9]{4})[-]/":""|regex_replace:"/[-]([0-9]{1,2})$/":"" }]" [{ $readonly }] disable>
            <input type="text" class="editinput" size="8" maxlength="4" name="editval[oxuser__d3birthdayvoucher_lastdate][year]" value="[{$edit->oxuser__d3birthdayvoucher_lastdate->value|regex_replace:"/[-]([0-9]{1,2})[-]([0-9]{1,2})$/":"" }]" [{ $readonly }] disable>

            [{oxinputhelp ident="ORDER_MAIN_D3BIRTHDAYVOUCHER_LASTDATA_HELP"}]
        </td>
    </tr>
[{/if}]
[{*** D3 Geburtstagsgutscheine ADD END ***}]