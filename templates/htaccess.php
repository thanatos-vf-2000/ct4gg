<?php
/**
 * @package  CT4GGPlugin
 * @Version 1.4.3
 * 
 * Desciption: htaccess
 */
use CT4GG\Api\FileHTAccess;

$htaccess_file = new FileHTAccess();


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
        
    } elseif (isset($_POST['submit-build-htaccess'])) {
        if (file_exists(ABSPATH.'.htaccess')) {
            $htaccess_file->backup();
            $htaccess_file->save_mod($_POST['htaccess-content']);
        }
    } else {
        $htaccess_params = array('login_screen_v2',
            'htaccess_disable_show_directory',
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
