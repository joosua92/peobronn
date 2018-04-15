<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Profile
$lang['info_picture_upload_successful'] = 'Pilt edukalt üles laetud';
$lang['info_picture_upload_login_required'] = 'Faili üleslaadimiseks peate olema sisse logitud.';
$lang['info_picture_remove_login_required'] = 'Faili eemaldamiseks peate olema sisse logitud.';
$lang['info_no_picture_to_remove'] = 'Teil pole ühtegi pilti mida eemaldada.';
$lang['info_picture_remove_success'] = 'Pilt edukalt eemaldatud.';
$lang['info_picture_remove_fail'] = 'Faili kustutamine ebaõnnestus.';

// Register
$lang['info_register_empty_first_name'] = 'Eesnime väli peab olema täidetud.';
$lang['info_register_invalid_first_name'] = 'Ebasobiv eesnimi.';
$lang['info_register_empty_last_name'] = 'Perenime väli peab olema täidetud.';
$lang['info_register_invalid_last_name'] = 'Ebasobiv perenimi.';
$lang['info_register_empty_email'] = 'E-maili väli peab olema täidetud.';
$lang['info_register_invalid_email'] = 'Ebasobiv e-mail.';
$lang['info_register_email_not_unique'] = 'Sisestatud e-mail on juba kasutusel.';
$lang['info_register_password_empty'] = 'Salasõna peab olema täidetud.';
$lang['info_register_invalid_password'] = 'Salasõna pikkus peab olema vähemalt 8.';
$lang['info_register_password_repeat_empty'] = 'Korda oma salasõna uuesti.';
$lang['info_register_password_repeat_not_match'] = 'Salasõnad ei kattu.';
$lang['info_register_success'] = 'Registreerumine õnnestus.';
$lang['info_register_login_reference'] = 'Sisene';

// Login
$lang['info_login_email_empty'] = 'Palun sisesta e-mail.';
$lang['info_login_password_empty'] = 'Salasõna väli peab olema täidetud.';
$lang['info_login_email_not_exist'] = 'Sellise e-mailiga kasutajat ei ole.';
$lang['info_login_email_type_google'] = 'Selle e-mailiga kasutajaga peab sisse logima läbi Google.';
$lang['info_login_email_type_smart_id'] = 'Selle e-mailiga kasutajaga peab sisse logima Smart-ID-ga.';
$lang['info_login_incorrect_password'] = 'Vale salasõna';

// Google
$lang['info_google_email_already_exist'] = 'Selle e-mailiga kasutaja juba eksisteerib'.
$lang['info_google_invalid_token'] = 'Kehtetud token';

// Reserv
$lang['info_reserv_login_required'] = 'Broneerimiseks logige sisse.';
$lang['info_reserv_invalid_date'] = 'Ebasobiv kuupäeva formaat';
$lang['info_reserv_time_empty'] = 'Valige sobiv kellaaeg';
$lang['info_reserv_invalid_time'] = 'Ebasobiv kellaaja formaat';
$lang['info_reserv_empty_package'] = 'Valige sobiv pakett';
$lang['info_reserv_invalid_package'] = 'Ebasobiv paketi formaat';
$lang['info_reserv_already_reserved'] = 'See aeg on juba broneeritud.';
$lang['info_reserv_success'] = 'Broneering kinnitatud. Broneeringuid saate näha profiililehelt.';

// Cancel reservation
$lang['info_cancel_reservation_success'] = 'Broneering tühistatud.';

// Email
$lang['email_register_subject'] = 'Olete edukalt registreeritud - Mängumaailm';
$lang['email_register_body'] = 'Olete edukalt endale Mängumaailm kasutaja teinud. ' . "\r\n" .
	'Sisenemiseks vajutage kodulehel sisene lingile.' . "\r\n\r\n" . 'Mängumaailm';
	
// Pages
$lang['info_login_to_reserv'] = 'Broneerimiseks on vaja sisse logida.';
$lang['info_login_to_see_profile'] = 'Profiili nägemiseks on vaja sisse logida.';
