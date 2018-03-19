<?php

namespace Rewake\Lumen\ComposerScripts;

use Composer\Installer\PackageEvent;

class CreateDefaultValidationLangFile
{
    public static function postPackageInstall(PackageEvent $event)
    {
        // Determine src dir
        $srcDir = dirname((dirname(dirname(__FILE__))));

        // Set validation file paths
        $source = $srcDir.'/resources/lang/en/validation.php';
        $destination = 'resources/lang/en/validation.php';

        // See if file already exists
        if (!file_exists($destination)) {

            // Create directory
            mkdir('resources/lang/en/', 777, true);

            // Copy default validation file to resources folder
            copy($source, $destination);
        }
    }
}