<?php
declare(strict_types=1);

namespace ElementareTeilchen\HtmlPurify\ViewHelpers;

/**
 * This file is part of the "html_purify" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use ElementareTeilchen\HtmlPurify\Service\PurifyService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithContentArgumentAndRenderStatic;

/**
 * Purifies HTML content by keeping only allowed HTML tags.
 *
 * Examples
 * ========
 *
 * Default
 * -------
 *
 * ::
 *
 *    <hp:purify allowedHtmlTags="strong,em">{someVariableWithUnwantedHTMLTagsOrPotentialXSS -> f:format.raw()}</hp:purify>
 *
 * Output in frontend::
 *
 *    String without html tags beside strong or em
 *
 *
 * Inline notation
 * ---------------
 *
 * ::
 *
 *    {someVariableWithUnwantedHTMLTagsOrPotentialXSS -> f:format.raw() -> hp:purify(allowedHtmlTags: 'strong,em')}
 *
 * Output::
 *
 *    String without html tags beside strong or em
 *
 *
 * Inline notation without variable
 * ------------------
 *
 * ::
 *
 *    {hp:purify(allowedHtmlTags: 'p,strong', htmlContent: '<p>Text with <strong>HTML</strong> but <em>EM tag will be removed</em></p>')}
 *
 * Output::
 *
 *    String without html tags beside p and strong
 *    <p>Text with <strong>HTML</strong> but EM tag will be removed</p>
 */
class PurifyViewHelper extends AbstractViewHelper
{
    use CompileWithContentArgumentAndRenderStatic;

    protected $escapeOutput = false;

    public function initializeArguments()
    {
        $this->registerArgument('htmlContent', 'string', 'The html content to purify');
        $this->registerArgument('allowedHtmlTags', 'string', 'The allowed HTML tags');
    }

    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $htmlContent = $renderChildrenClosure();

        // if there is no string content, we do not proceed
        if (!is_string($htmlContent) || \trim($htmlContent) === '') {
            return '';
        }

        // allowed HTML tags
        $allowedHtmlTags = null;
        // use viewhelper argument if set
        if ($arguments['allowedHtmlTags']) {
            $allowedHtmlTags = $arguments['allowedHtmlTags'];

        // use typoscript default values if configured
        } else {
            $configurationManager = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');
            $typoScript = $configurationManager->getConfiguration(
                ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,
                'html_purify'
            );
            if (isset($typoScript['allowedHtmlTags'])) {
                $allowedHtmlTags = $typoScript['allowedHtmlTags'];
            }
        }

        // purify and return HTML content
        return PurifyService::purify($htmlContent, $allowedHtmlTags);
    }
}
