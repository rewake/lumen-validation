<?php

namespace Rewake\Lumen\ComposerScripts;

use Composer\Installer\PackageEvent;

class CreateDefaultValidationLangFile
{
    public static function postPackageInstall(PackageEvent $event)
    {
        // Determine src dir
        $srcDir = dirname((dirname(dirname(__FILE__))));

        // Copy default validation file to resources folder
        copy($srcDir.'/resources/lang/en/validation.php', 'resources/lang/en/validation.php');
    }
}