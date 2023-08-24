<?php

/*
 * This file is part of the package ucph_content_sys_status.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

defined('TYPO3') or die('Access denied.');

use TYPO3\CMS\Core\Information\Typo3Version;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

$versionInformation = GeneralUtility::makeInstance(Typo3Version::class);
// Only include page.tsconfig if TYPO3 version is below 12 so that it is not imported twice.
if ($versionInformation->getMajorVersion() < 12) {
  ExtensionManagementUtility::addPageTSConfig('
      @import "EXT:ucph_content_sys_status/Configuration/page.tsconfig"
   ');
}

// Register plugin
ExtensionUtility::configurePlugin(
  'ucph_content_sys_status',
  'Pi1',
  [\UniversityOfCopenhagen\UcphContentSysStatus\Controller\DriftinfoController::class => 'list'],
  [\UniversityOfCopenhagen\UcphContentSysStatus\Controller\DriftinfoController::class => 'list']
);

// KU driftinformation Viewhelper namespace
$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['kuDriftinfo'] = ['UniversityOfCopenhagen\UcphContentSysStatus\ViewHelpers'];