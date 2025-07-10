<?php

require_once 'classes/LDAP.class.php';

$ldap = new LDAP();

$usuario = $ldap->logar('williamferreira', '175415@Bc');

echo "<pre>";
print_r($usuario);

?>

