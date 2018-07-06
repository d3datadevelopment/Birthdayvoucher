[{ assign var="shop"      value=$oEmailView->getShop() }]
[{ assign var="oViewConf" value=$oEmailView->getViewConfig() }]
[{ assign var="currency"  value=$oEmailView->getCurrency() }]
[{ assign var="user"      value=$oEmailView->getUser() }]

[{ oxcontent ident="d3bvreminderexpirationmailplain" }]

[{ oxcontent ident="oxemailfooterplain" }]
