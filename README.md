# TYPO3 Extension html_purify

Purify HTML to prevent XSS attacks or unwanted HTML.

## Features

This extension provides you with opportunities to purify specific HTML
which may is not fully under your control in order to
remove possible Cross-Site-Scripting (XSS) attacks.

## Installation

Simply install the extension with Composer.

`composer require elementareteilchen/html-purify`

This extension uses [ezyang/htmlpurifier](https://github.com/ezyang/htmlpurifier),
which is set as composer requirement to be loaded automatically.

## Usage

### Viewhelper

```
<hp:purify allowedHtmlTags="strong,em">{someVariableWithPotentialXSS -> f:format.raw()}</hp:purify>
```
```
{someVariableWithPotentialXSS -> f:format.raw() -> hp:purify()}
```
```
{hp:purify(allowedHtmlTags: 'p,strong', htmlContent: '<p>Text with <strong>HTML</strong> but <em>EM will be removed</em></p>')}
```

### Service in PHP code
```
$purifiedHtml = \ElementareTeilchen\HtmlPurify\Service\PurifyService::purify($htmlContent, $allowedHtmlTags);
```
