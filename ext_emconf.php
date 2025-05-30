<?php

$EM_CONF[$_EXTKEY] =  [
    'title' => 'Reports',
    'description' => 'Reporting Extension',
    'category' => 'plugin',
    'version' => '1.0.0',
    'state' => 'beta',
    'clearcacheonload' => 1,
    'author' => 'Dirk Wenzel',
    'author_email' => 't3events@gmx.de',
    'constraints' =>
     [
         'depends' =>
          [
              'typo3' => '12.4.0-13.4.99',
          ],
         'conflicts' =>
          [
          ],
         'suggests' =>
          [
          ],
     ],
];
