<?php

$sLangName  = "Deutsch";
$aLang = array(

//Navigation
'charset'                                   => 'UTF-8',

'd3birthdayvoucher_TRANSL'                            => 'Geburtstagsgutscheine',
'd3birthdayvoucher_HELPLINK'                          => 'Geburtstagsgutscheine/',

//ModCfg
'd3mxd3birthdayvoucher'                             => 'Geburtstagsgutscheine',
'd3cfgd3birthdayvoucher'                            => 'Konfiguration',
'd3tbcld3birthdayvoucher_settings_main'             => 'Konfiguration',
'd3mxd3birthdayvoucher_SETTINGS'             	   => 'Konfiguration',
'd3mxd3birthdayvoucher_SUPPORT'             	   	   => 'Support',

'D3_CFG_MOD_GENERAL_MODULELOGGING'             	   	   => 'Logging',
'D3_CFG_d3birthdayvoucher_LOGGING_HELP'             	   	   => '<b>Logging:</b><br>Mit dieser Auswahl k&ouml;nnen Sie die Priorit&auml;t des Logging einstellen. Meldungen oder Fehler haben eine vordefinierte Priorit&auml;t. Anhand der Priorit&auml;t wird entschieden, welche Eintr&auml;ge in die Datenbank geschrieben werden.<br>
                            <ul>
                                <li><b>kein Protokoll</b>: in der Datenbank wird kein Logeintrag geschrieben. Ist diese Einstellung gesetzt wird das Modul weder eine normale Meldung schreiben noch eine schwere Fehlermeldung.</li>
                                <li><b>Alles protokollieren</b>: s&auml;mtliche Meldungen egal ob schwerer Fehler oder nur Statusmeldungen werden in der Datenbank abgespeichert. Diese Option sollte zur Fehleranalyse bzw. eine kurze Zeit nach Installation des Moduls aktiviert werden.<br><b>Achtung: es werden sehr viele Daten in der Datenbank gespeichert!</b></li>
                                <li><b>Fehler mitschreiben</b>: nur Meldungen mit dem Status eines Fehlers werden gespeichert.</li>
                            </ul>',

'D3_CFG_MOD_d3birthdayvoucher_MODULEACTIVE'         => 'Modul aktiv',

'D3_CFG_d3birthdayvoucher_DEBUG_MODUS'      => 'Debug-Modus',
'D3_CFG_d3birthdayvoucher_DEBUG_MODUS_HELP'      => '<b>Debug-Modus:</b><br>Ist diese Checkbox aktiviert, werden weitere zus&auml;tzliche Informationen ausgegeben bzw. in der Log-Tabelle gespeichert.<br>
                                        <br>Dieser Modus dient zur Untersuchung von eventuell auftretenden Fehlern und sollte nur kurzzeitig aktiviert sein.<br>',

'D3_CFG_d3birthdayvoucher_TEST_MODUS'               => 'Test-Modus',
'D3_CFG_d3birthdayvoucher_TEST_MODUS_HELP'          => '<b>Test-Modus</b><br>Ist dieser Modus aktiviert werden die E-Mails an die Info-E-Mailadresse des Shops gesendet.',

'D3_CFG_MOD_d3birthdayvoucher_CRONJOBS_OWERVIEW'    => 'Übersicht CronJob',
'D3_CFG_MOD_d3birthdayvoucher_CRONJOBS_ACTIVE'     => 'CronJob:',
'D3_CFG_MOD_d3birthdayvoucher_CRONJOBS_ACTIVE_HELP'     => '<b>Cronjob:</b><br>De/Aktiviert den Cronjob.<br>Eine separate &Auml;nderung in den Cronjob-Einstellung bei Ihrem Provider ist nicht n&ouml;tig.<br>Diese Option ist Vorraussetzung f&uuml;r die enthaltenen Funktionen.',
'D3_CFG_MOD_d3birthdayvoucher_LAST_STARTS_CRONJOBS' => 'letzte Ausführung:',
'D3_CFG_MOD_d3birthdayvoucher_CRONJOBS_LINK'        => 'Link:',

'D3_CFG_MOD_d3birthdayvoucher_ACCESSKEY'            => 'Zugriffsschutz für den CronJob:',
'D3_CFG_MOD_d3birthdayvoucher_ACCESSKEY_HELP'       => '<b>Zugriffsschutz f&uuml;r den CronJob:</b><br>Vergeben Sie hier ein mehrstelliges Passwort (ca. 6-8 Zeichen), um unberechtigte Aufrufe des CronJobs zu unterbinden.',

'D3_CFG_MOD_d3birthdayvoucher_MAIN_SAVE'              => 'Einstellung speichern',
'D3_CFG_MOD_d3birthdayvoucher_SETTINGS'               => 'Test-Modus',

'D3_CFG_MOD_d3birthdayvoucher_MAIL4BCC'               => 'Blindkopie-E-Mailadresse angeben',
'D3_CFG_MOD_d3birthdayvoucher_MAIL4BCC_HELP'          => '<b>Blindkopie-E-Mailadresse angeben:</b><br>Alle ausgehenden E-Mails werden zus&auml;tzlich als BCC (Blindkopie) an die eingetragene E-Mailadresse versendet.',

'D3_CFG_MOD_d3birthdayvoucher_TEST_MODUS_ADDRESS'               => 'Test-E-Mailadresse angeben',
'D3_CFG_MOD_d3birthdayvoucher_TEST_MODUS_ADDRESS_HELP'          => '<b>Test-E-Mailadresse angeben:</b><br>Im Testmodus werden alle ausgehenden E-Mails an die eingetragene E-Mailadresse versendet.',

'D3_CFG_MOD_d3birthdayvoucher_VOUCHER_NUMBER_OF_CHARAKTER'     => 'Anzahl der Zeichen des Gutscheincodes',
'D3_CFG_MOD_d3birthdayvoucher_VOUCHER_NUMBER_OF_CHARAKTER_HELP'     => '<b>Anzahl der Stellen des Gutscheincodes:</b><br>
                            Anzahl der Stellen, die ein Gutscheincode bei der Erstellung bekommen soll. Die Generierung erfolgt per Zufall mit n Stellen.',

'D3_CFG_MOD_d3birthdayvoucher_blOnly_Registered_User'         => 'Nur Kunden mit Passwort',
'D3_CFG_MOD_d3birthdayvoucher_blOnly_Registered_User_HELP'    => 'Ist diese Option nicht gesetzt, erhalten alle Kunden mit dem richtigen Geburtsdatum einen Gutschein.<br>Soll die Vergabe von Gutscheinen jedoch nur auf registrierte Kunden mit Passwort eingeschränkt werden aktivieren Sie diese Option. Damit erhalten nur Kunden mit einem Kundenkonto Gutscheine.',

'D3_BIRTHDAY_UPDATE_ITEMINSTALL'         => 'Das Modul beinhaltet 3 CMS-Texte.'.PHP_EOL.'Diese können leider nicht automatisch installiert oder aktualisiert werden. Bitte installieren Sie diese manuell.'.PHP_EOL.PHP_EOL.
    'Diese CMS-Texte liegen als txt-Dateien im Order "changed_full/CMS" des Installationsverzeichnis.',

'D3_CFG_MOD_d3birthdayvoucher_SELECT_ORDERS'    =>    'Benutzer einschränken',

'D3_CFG_MOD_d3birthdayvoucher_GROUPS_FOR_VOUCHER'     =>   'Benutzergruppen erlauben',
'D3_CFG_MOD_d3birthdayvoucher_GROUPS_FOR_VOUCHER_HELP'    =>    '',
'D3_CFG_MOD_d3birthdayvoucher_GROUPS_FOR_NO_VOUCHER'    =>    'Benutzergruppen ausschließen',
'D3_CFG_MOD_d3birthdayvoucher_GROUPS_FOR_NO_VOUCHER_HELP'    =>    '',

'D3_CFG_MOD_d3birthdayvoucher_ADRESSES_FOR_BLACKLIST'                  => 'E-Mailadressen ausschließen',
'D3_CFG_MOD_d3birthdayvoucher_ADRESSES_FOR_BLACKLIST_HELP'                  => '<ul>
            <li>pro Zeile eine Adresse</li>
            <li>vollständige Adressen und Adressen mit Platzhalter können gemischt werden</li>
            <li>Beispiel vollständige Adresse: test@test.de</li>
            <li>Beispiel vollständige Adresse mit Platzhalter: *@test.de</li>
            <li>Platzhalter: *<li>
            ',

'd3tbcld3birthdayvoucher_settings_agelimit'     =>  'Altersbegrenzung',
'D3_CFG_MOD_d3birthdayvoucher_AGE_GENERAL'     =>  'globale Altersbegrenzung',
'D3_CFG_MOD_d3birthdayvoucher_AGE_GENERAL_HELP'     =>  'Diese Angabe dient als Standartvorgabe für Altersangaben.
<br>Ist an einem Land keine Altersgrenze hinterlegt wird dieser Wert als Vorgabe verwendet.<br>
Wenn an einem Land ein Alter hinterlegt ist, hat die Angabe am Land Prioriät.
',
'D3_CFG_MOD_d3birthdayvoucher_COUNTRIES'     =>  'Länder',
'D3_CFG_MOD_d3birthdayvoucher_COUNTRIES_ACTIVE'     =>  'Aktiv',
'D3_CFG_MOD_d3birthdayvoucher_COUNTRIES_ACTIVE_HELP'     =>  '',
'D3_CFG_MOD_d3birthdayvoucher_COUNTRIES_AGE'     =>  'Alter',
'D3_CFG_MOD_d3birthdayvoucher_COUNTRIES_AGE_HELP'     =>  'Angabe in Jahren',
'D3_CFG_MOD_d3birthdayvoucher_COUNTRIES_COUNTRY'     =>  'Länder',


//order_main
'ORDER_MAIN_D3BIRTHDAYVOUCHER_LASTDATA'         => 'Erstellung letzter Geburtstagsgutschein:',
'ORDER_MAIN_D3BIRTHDAYVOUCHER_LASTDATA_HELP'    => 'Zur Kontrolle der letzten Vergabe eines Geburtstagsgutscheins.<br>
    Der Kunde erhält nur einen Gutschein pro Kalenderjahr.',

/*Gutscheine mit Ablaufdatum*/
'D3_CFG_MOD_d3birthdayvoucher_LIMIT_FOR_VALIDITY'      => 'Gültig-Bis',
'D3_CFG_MOD_d3birthdayvoucher_LIMIT_FOR_VALIDITY_IN_DAYS'      => 'Gültigkeit der Gutscheine in Tagen',
'D3_CFG_MOD_d3birthdayvoucher_LIMIT_FOR_VALIDITY_IN_DAYS_HELP'      => 'Nach Ablauf dieser Tage wird der Gutschein vom Modul entwertet.<br>
Die Angabe erfolgt in Tagen. Bei 0 wird am Gutschein kein Datum hinterlegt.
<br><br>
Das Modul kann periodisch E-Mails versenden. Ist ein Ablaufdatum gegeben dann werden die Mails vor Ablauf gesendet,
ist kein Ablaufdatum hinterlegt dann erhält der Kunde nach der Erstellung die Mails.',



'D3_CFG_MOD_d3birthdayvoucher_REMIDNER_FOR_EXPIRATION'      => 'Erinnerungsmail für Gutscheine mit Ablaufdatum',
'D3_CFG_MOD_d3birthdayvoucher_iDaysForReminderRangeExpiration'      => 'Interval in Tagen',
'D3_CFG_MOD_d3birthdayvoucher_iDaysForReminderRangeExpiration_HELP'      => 'Diese Anzahl an Tagen vor Ablauf der Gültigkeit des Gutscheines<br>
<ul>
    <li>Die Angabe erfolgt in Tagen.</li>
    <li>Bei 0 wird keine Prüfung der Gutschein vorgenommen, und damit keine E-Mail versendet.</li>
</ul>',
'D3_CFG_MOD_d3birthdayvoucher_iLoopForReminderRangeExpiration'      => 'Wie oft wird soll der Kunde eine E-Mail erhalten',
'D3_CFG_MOD_d3birthdayvoucher_iLoopForReminderRangeExpiration_HELP'      => 'Anzahl der Wiederholungen<br>
Diese Angabe vervielfacht die Angabe zum Interval.<br>
Beispiel:<br>
-Interval: 15 Tage<br> 
-Anzahl der Wiederholungen: 3<br>
An folgenden Tage vor dem Ablaufdatum des Gutscheines erhält der Kunden eine E-Mail: 45, 30 und 15 Tage.<br>',



'D3_CFG_MOD_d3birthdayvoucher_REMIDNER_FOR_VOUCHERS_WITHTOU_EXPIRATION'                   => 'Erinnerungsmail für Gutscheine ohne Ablaufdatum',
'D3_CFG_MOD_d3birthdayvoucher_iDaysForReminderRange'                   => 'Interval in Tagen',
'D3_CFG_MOD_d3birthdayvoucher_iDaysForReminderRange_HELP'                   => 'Die Anzahl an Tagen nach der Vergabe des Gutscheines<br>
<ul>
    <li>Die Angabe erfolgt in Tagen.</li>
    <li>Bei 0 wird keine Prüfung der Gutschein vorgenommen, und damit keine E-Mail versendet.</li>
</ul>
',
'D3_CFG_MOD_d3birthdayvoucher_iLoopForReminderRange'                   => 'Wie oft soll der Kunde eine E-Mail erhalten',
'D3_CFG_MOD_d3birthdayvoucher_iLoopForReminderRange_HELP'                   => 'Anzahl der Wiederholungen<br>
Diese Angabe vervielfacht die Angabe zum Interval.<br>
Beispiel:<br>
-Interval: 15 Tage<br> 
-Anzahl der Wiederholungen: 3<br>
An folgenden Tage nach der Erstelung des Gutscheines erhält der Kunden eine E-Mail: 15, 30 und 45 Tage.<br>',

);