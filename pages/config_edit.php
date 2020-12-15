<?php
form_security_validate( 'plugin_format_config_edit' );

auth_reauthenticate( );
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );

$f_description_text = gpc_get_string( 'description');

if( plugin_config_get( 'description_text' ) != $f_description_text ) {
	plugin_config_set( 'description_text', $f_description_text );
}

form_security_purge( 'plugin_format_config_edit' );

print_successful_redirect( plugin_page( 'config', true ) );
