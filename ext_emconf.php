<?php
$EM_CONF[$_EXTKEY] = array(
    'title' => 'HTML pruify',
    'description' => 'Adds HTML purify functionality as viewhelper and service class to purify HTML code from unwanted HTML tags or HTML code containing XSS content.',
    'category' => 'fe',
    'author' => 'Sebastian Müller',
    'author_email' => 'sebastian.mueller@elementare-teilchen.de',
    'state' => 'stable',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '1.1.1',
    'constraints' => array(
        'depends' => array(
            'typo3' => '10.4.0-11.5.99',
        ),
        'conflicts' => array(
        ),
        'suggests' => array(
        ),
    ),
);
