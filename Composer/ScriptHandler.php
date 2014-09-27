<?php
/**
 * This file is part of the Bootstrap Select Bundle for Symfony.
 *
 * @copyright   Copyright (C) 2014 Hassan Amouhzi. All rights reserved.
 * @license     The MIT License (MIT), see LICENSE.md
 */
 
namespace Anezi\Bundle\BootstrapSelectBundle\Composer;

use Composer\Script\Event;

class ScriptHandler
{
    public static function copyFilesToBundle(Event $event)
    {
        $IO = $event->getIO();

        $IO->write("Copying bootstrap-select files ... ", FALSE);

        $vendor = 'vendor';
        $bundle = $vendor . '/symfony-bundle/bootstrap-select-bundle';
        
        if(!file_exists($bundle . '/Anezi/Bundle/BootstrapSelectBundle/Resources')) {
            mkdir($bundle . '/Anezi/Bundle/BootstrapSelectBundle/Resources');
        }
        
        if(!file_exists($bundle . '/Anezi/Bundle/BootstrapSelectBundle/Resources/public')) {
            mkdir($bundle . '/Anezi/Bundle/BootstrapSelectBundle/Resources/public');
        }

        if(file_exists($bundle . '/Anezi/Bundle/BootstrapSelectBundle/Resources/public')) {
            self::delTree($bundle . '/Anezi/Bundle/BootstrapSelectBundle/Resources/public');
        }

        self::recurse_copy(
            $vendor . '/bootstrap-select/bootstrap-select/dist',
            $bundle . '/Anezi/Bundle/BootstrapSelectBundle/Resources/public'
        );

        $IO->write(" <info>OK</info>");
    }

    /**
     * @param $dir
     * @return bool
     * @see http://php.net/manual/fr/function.rmdir.php#110489
     */
    public static function delTree($dir) {
        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? self::delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    /**
     * @param $src
     * @param $dst
     * @see http://php.net/manual/fr/function.copy.php#91010
     */
    public static function recurse_copy($src,$dst) {
        $dir = opendir($src);
        mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    self::recurse_copy($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }
}
