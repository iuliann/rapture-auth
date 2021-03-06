<?php
// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
// this is an autogenerated file - do not edit
spl_autoload_register(
    function($class) {
        static $classes = null;
        if ($classes === null) {
            $classes = array(
                'rapture\\auth\\authentication' => '/../src/Authentication.php',
                'rapture\\auth\\definition\\sourceinterface' => '/../src/Definition/SourceInterface.php',
                'rapture\\auth\\definition\\storageinterface' => '/../src/Definition/StorageInterface.php',
                'rapture\\auth\\definition\\userinterface' => '/../src/Definition/UserInterface.php',
                'rapture\\auth\\user' => '/../src/User.php'
            );
        }
        $cn = strtolower($class);
        if (isset($classes[$cn])) {
            require __DIR__ . $classes[$cn];
        }
    }
);
// @codeCoverageIgnoreEnd
