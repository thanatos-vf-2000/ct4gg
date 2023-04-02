<?php
/**
 * @package CT4GGPlugin
 * @version 1.4.8
 *
 * Desciption: humans
 */

use CT4GG\Api\FileHumans;

$humans_file = new FileHumans();


if (isset($_POST[CT4GG_NAME.'-verif']) && wp_verify_nonce(sanitize_text_field($_POST[CT4GG_NAME.'-verif']), CT4GG_NAME.'-opt')) {
    if (isset($_POST['submit-humans-restore'])) {
        if ($humans_file->backup()) {
            if (isset($_POST['ct4gg-humans'])) {
                if (copy(ABSPATH.sanitize_text_field($_POST['ct4gg-humans']), ABSPATH.'humans.txt')) {
                    self::view('humans', array('type' => 'copy-ok'));
                } else {
                    self::view('humans', array('type' => 'copy-ko'));
                }
            } else {
                self::view('humans', array('type' => 'ct4gg-humans-ko'));
            }
        } else {
            self::view('humans', array('type' => 'backup-ko'));
        }
    } elseif (isset($_POST['submit-humans-delete'])) {
        if (isset($_POST['ct4gg-humans'])) {
            if (unlink(ABSPATH.sanitize_text_field($_POST['ct4gg-humans']))) {
                self::view('humans', array('type' => 'delete-ok'));
            } else {
                self::view('humans', array('type' => 'delete-ko'));
            }
        } else {
            self::view('humans', array('type' => 'ct4gg-humans-ko'));
        }
    } elseif (isset($_POST['submit-build-humans'])) {
        if (file_exists(ABSPATH.'.htaccess')) {
            $humans_file->backup();
            $humans_file->save_mod($_POST['humans-content']);
        }
    } else {
        $humans_params = array('humans_team',
            'humans_thanks',
            'humans_site');
        foreach ($humans_params as $humans_param) {
            if ($this->activated($humans_param)) {
                $humans_file->add($humans_param);
            }
        }
        if (file_exists(ABSPATH.'humans.txt')) {
            if ($humans_file->backup()) {
                if (!$humans_file->save()) {
                    self::view('humans', array('type' => 'update-ko'));
                } else {
                    self::view('humans', array('type' => 'update-ok'));
                }
            } else {
                self::view('humans', array('type' => 'backup-ko'));
            }
        } else {
            if (!$humans_file->save()) {
                self::view('humans', array('type' => 'update-ko'));
            } else {
                self::view('humans', array('type' => 'update-ok'));
            }
        }
    }
}



 self::get_template(array('header', 'humans/nav-tabs', 'humans/tab-content', 'footer'));
