<?php
/**
 * Created by PhpStorm.
 * User: apokorski
 * Date: 26/07/2018
 * Time: 11:27
 */

class DescriptionFieldPlugin extends MantisPlugin {

    function register() {
        $this->name = lang_get( 'plugin_description_title' );
        $this->description = lang_get( 'plugin_description_description' );
        $this->page = 'config';

        $this->version     = '1.0';
        $this->requires    = array(
            'MantisCore'       => '2.0.0',
        );

        $this->author      = 'Alexis POKORSKI';
        $this->contact     = '';
        $this->url         = '';
    }

    function hooks(){
        return array(
            "EVENT_CORE_HEADERS" => 'csp_headers',
            "EVENT_LAYOUT_RESOURCES" => 'ressources',
            "EVENT_LAYOUT_PAGE_FOOTER" => 'update_description'
        );
    }

    function ressources(){
        if(basename($_SERVER['PHP_SELF']) === 'bug_report_page.php') {
            echo '<script type="text/javascript" src="' . plugin_file('UpdateDescriptionTextArea.js') . '" ></script>';
        }
    }

    function update_description(){
        if(basename($_SERVER['PHP_SELF']) === 'bug_report_page.php') {
            $f_master_bug_id = gpc_get_int( 'm_id', 0 );
            if($f_master_bug_id == 0){
                $description = json_encode(plugin_config_get('description_text'));
                echo '<script type="text/javascript"> setDescription('.  $description . '); </script>';
            }
        }
    }

    function csp_headers(){
        http_csp_add( 'script-src', "'unsafe-inline'" );
    }

    /**
     * Default plugin configuration.
     * @return array
     */
    function config() {
        return array(
            'description_text'		=> '[u]Profil (Navigateur, utilisateur, poste de travail)[/u]:
                                        
[u]Description[/u] :
                                        
[u]Étapes pour reproduire[/u] :
                                        
[u]Résultat attendu[/u] :
                                        
      '
        );
    }




}