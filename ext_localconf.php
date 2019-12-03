<?php
defined('TYPO3_MODE') || die('Access denied.');

define('IMPORT_TT_ADDRESS_NICOSDIR_EXT', 'import_tt_address_nicosdir');

if (TYPO3_MODE == 'BE') {
    call_user_func(function () {

        /** @var \TYPO3\CMS\Extbase\SignalSlot\Dispatcher $signalSlotDispatcher */
        $signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class);
        $signalSlotDispatcher->connect(
            \JambageCom\Import\Controller\ImportTablesWizardModuleFunctionController::class,
                                                    // Signal class name
            'menu',                                 // Signal name
            \JambageCom\ImportTtAddressNicosdir\Slots\FunctionSlots::class,   // Slot class name
            'getMenu'                               // Slot name
        );


        $signalSlotDispatcher->connect(
            \JambageCom\Import\Controller\ImportTablesWizardModuleFunctionController::class,
                                                            // Signal class name
            'import',                                       // Signal name
            \JambageCom\ImportTtAddressNicosdir\Slots\FunctionSlots::class,   // Slot class name
            'importTables'                               // Slot name
        );
    });
}


