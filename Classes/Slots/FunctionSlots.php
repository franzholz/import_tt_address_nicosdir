<?php
namespace JambageCom\ImportTtAddressNicosdir\Slots;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;

use JambageCom\Import\Api\Api;


/**
 * Class for example slots to import files into TYPO3 tables
 */
class FunctionSlots implements \TYPO3\CMS\Core\SingletonInterface
{
    protected $tables = array('tt_address');

    /**
     * Constructor
     */
    public function __construct ()
    {
        $languageFile = 'EXT:' . IMPORT_TT_ADDRESS_NICOSDIR_EXT . '/Resources/Private/Language/locallang.xlf';
        $this->getLanguageService()->includeLLFile($languageFile);
    }

    public function getTables ()
    {
        return $this->tables;
    }

    /**
     * Adds entries to the menu selector of the import extension
     *
     * @return mixed[] Array with entries for the import menu
     */
    public function getMenu (
        $pObj,
        array $menu
    )
    {
        $tables = $this->getTables();
        foreach ($tables as $table) {
            $menuItem = $this->getLanguageService()->getLL('menu.' . $table);
            $menu[$table] = $menuItem;
        }
        $result = array($pObj, $menu);
        return $result;
    }

    /**
     * imports into the tables tt_address and sys_category if tt_address is part of the given tables
     *
     * @return mixed[] Array with entries for the import menu
     */
    public function importTables (
        $pObj,
        $pid,
        array $paramTables
    )
    {
            // Rendering of the output via fluid
        $api = GeneralUtility::makeInstance(Api::class);

        $tables = $this->getTables();
        foreach ($tables as $table) {
            if (in_array($table, $paramTables)) {
                switch ($table) {
                case 'tt_address' :
                        // import the addresses
                    $addressRelationFile =
                        GeneralUtility::getFileAbsFileName(
                            'EXT:' . IMPORT_TT_ADDRESS_NICOSDIR_EXT . '/Resources/Public/Relations/NicosdirectoryTtAdress.xml'
                        );

                    $categoryRelationFile =
                        GeneralUtility::getFileAbsFileName(
                            'EXT:' . IMPORT_TT_ADDRESS_NICOSDIR_EXT . '/Resources/Public/Relations/NicosdirectorySysCategory.xml'
                        );

                    $mode = 0;
                    $api->importTableFromTable($addressRelationFile, $categoryRelationFile, $mode);
                    break;
                }
            }
        }
    }

    /**
     * Returns LanguageService
     *
     * @return \TYPO3\CMS\Lang\LanguageService
     */
    protected function getLanguageService()
    {
        return $GLOBALS['LANG'];
    }
}

