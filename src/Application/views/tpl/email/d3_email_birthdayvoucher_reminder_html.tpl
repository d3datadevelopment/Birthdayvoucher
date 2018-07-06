[{ assign var="shop"      value=$oEmailView->getShop() }]
[{ assign var="oViewConf" value=$oEmailView->getViewConfig() }]
[{ assign var="currency"  value=$oEmailView->getCurrency() }]
[{ assign var="user"      value=$oEmailView->getUser() }]

[{oxcontent ident="d3bvreminderexpirationsubject" assign="title"}]

[{include file="email/html/header.tpl" title=$shop->oxshops__oxordersubject->value|cat:" | "|cat:$title }]

    [{ oxcontent ident="d3bvremindermailhtml" }]
    <br><br>
    [{ oxcontent ident="oxemailfooter" }]


[{include file="email/html/footer.tpl"}]