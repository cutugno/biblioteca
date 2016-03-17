<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.tlctel.com';
$config['smtp_user'] = 'admin@tlctel.com';
$config['smtp_pass'] = 'Aleare26';
$config['mailtype'] = 'html'; 

$config['sender_confirm_address'] = 'info@biblioteca.it';
$config['sender_confirm_name'] = 'Biblioteca Ramadu';

$config["multipart"]="related"; 

$config['email_templates_folder']="templates/email/";
?>
