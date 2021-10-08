<?php
/**
 * @package  CT4GGPlugin
 * @Version 1.1.0
 * 
 * Desciption: htaccess
 */
use CT4GG\Api\FileHTAcccess;

$htaccess_file = new FileHTAcccess();


if (isset($_POST[CT4GG_NAME.'-verif']) && wp_verify_nonce($_POST[CT4GG_NAME.'-verif'], CT4GG_NAME.'-opt')) {
    if (isset($_POST['submit-htaccess-restore'])) {
        if ($htaccess_file->backup()) {
            if (isset($_POST['ct4gg-htaccess'])) {
                if (copy(ABSPATH.$_POST['ct4gg-htaccess'], ABSPATH.'.htaccess')) {
                    self::view('htaccess',array('type' => 'copy-ok'));
                } else {
                    self::view('htaccess',array('type' => 'copy-ko'));
                }
            } else {
                self::view('htaccess',array('type' => 'ct4gg-htaccess-ko'));
            }
        } else {
            self::view('htaccess',array('type' => 'backup-ko'));
        }
    } elseif (isset($_POST['submit-htaccess-delete'])) {
        if (isset($_POST['ct4gg-htaccess'])) {
            if(unlink(ABSPATH.$_POST['ct4gg-htaccess'])) {
                self::view('htaccess',array('type' => 'delete-ok'));
            } else {
                self::view('htaccess',array('type' => 'delete-ko'));
            }
        } else {
            self::view('htaccess',array('type' => 'ct4gg-htaccess-ko'));
        }
        
    } else {
        $htaccess_params = array('htaccess_disable_show_directory',
            'htaccess_hide_server_information',
            'htaccess_protect_files_ht',
            'htaccess_force_download_enable',
            'htaccess_enable_cache',
            'htaccess_enable_compress_statics_files');
        foreach($htaccess_params as $htaccess_param) {
            if ($this->activated( $htaccess_param)) {
                $htaccess_file->add( $htaccess_param );
            }
        }
        if (file_exists(ABSPATH.'.htaccess')) {
            if ($htaccess_file->backup())  {
                if (!$htaccess_file->save()) {
                    self::view('htaccess',array('type' => 'update-ko'));
                } else {
                    self::view('htaccess',array('type' => 'update-ok'));
                }
            } else {
                self::view('htaccess',array('type' => 'backup-ko'));
            }
        } else {
            if (!$htaccess_file->save()) {
                self::view('htaccess',array('type' => 'update-ko'));
            } else {
                self::view('htaccess',array('type' => 'update-ok'));
            }
        }
    }
    
}



 self::get_template(array('header', 'htaccess/nav-tabs', 'htaccess/tab-content', 'footer'));
