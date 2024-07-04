<?php

defined('TYPO3') || die('Access denied.');

if (!\TYPO3\CMS\Core\Core\Environment::isComposerMode()) {
    require \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('html_purify') . '/Resources/Private/Php/Libraries/vendor/autoload.php';
}