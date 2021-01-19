<?php
declare(strict_types=1);

namespace ElementareTeilchen\HtmlPurify\Service;

/**
 * This file is part of the "html_purify" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

/**
 * Service for purifying HTML content
 */
class PurifyService
{
    /**
     * @param string $htmlContent HTML content which should be purified by only keeping allowed HTML tags
     * @param string|null $allowedHtmlTags Comma separated list of allowed HTML tags
     *
     * @return string
     */
    public static function purify(string $htmlContent, ?string $allowedHtmlTags = null) : string
    {
        // if there is no content, we do not proceed
        if (\trim($htmlContent) === '') {
            return $htmlContent;
        }

        // if there are no allowed HTML tags provided, use default
        if (\is_null($allowedHtmlTags) || $allowedHtmlTags === '') {
            $allowedHtmlTags = 'h1,h2,h3,p,strong,br,i,a[href],ol,ul,li';
        }

        // create Purifier config
        $config = \HTMLPurifier_Config::createDefault();
        $config->loadArray(
            [
                'HTML' => [
                    'Allowed' => $allowedHtmlTags,
                    // we set targets to blank
                    'TargetBlank' => true,
                ],
            ]
        );

        // create Purifier and assign config to it
        $purifier = new \HTMLPurifier($config);

        // purify html content and return it
        return $purifier->purify($htmlContent);
    }
}
