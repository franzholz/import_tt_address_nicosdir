<?php

$EM_CONF[$_EXTKEY] = [
	'title' => 'nicosdirectory into tt_address and sys_category',
	'description' => 'This extends the import extension for the conversion from nicosdirectory to tt_address',
	'category' => 'backend',
	'author' => 'Franz Holzinger',
	'author_email' => 'franz@ttproducts.de',
	'state' => 'beta',
	'uploadfolder' => 0,
	'createDirs' => '',
	'clearCacheOnLoad' => 0,
	'author_company' => '',
	'version' => '0.1.2',
	'constraints' => [
		'depends' => [
			'php' => '5.5.0-7.99.99',
			'typo3' => '7.6.0-9.99.99',
			'import' => '0.4.0-0.0.0',
		],
		'conflicts' => [
		],
		'suggests' => [
		],
	],
];

