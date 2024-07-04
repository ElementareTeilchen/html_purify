<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'HTML pruify',
    'description' => 'Adds HTML purify functionality as viewhelper and service class to purify HTML code from unwanted HTML tags or HTML code containing XSS content.',
    'category' => 'fe',
    'author' => 'Sebastian Müller',
    'author_email' => 'sebastian.mueller@elementare-teilchen.de',
    'state' => 'stable',
    'version' => '2.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-12.4.99'
        ],
        'conflicts' => [],
        'suggests' => []
    ],
];
