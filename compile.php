<?php

try
{
	$pharFile = 'combinationlock.phar';

	if (file_exists($pharFile)) {
		unlink($pharFile);
	}

	if (file_exists($pharFile . '.gz')) {
		unlink($pharFile . '.gz');
	}

	$phar = new Phar($pharFile);

	$phar->startBuffering();

	$defaultStub = $phar->createDefaultStub('index.php');

	$phar->buildFromDirectory(__DIR__ . '/combinationlock');

	$stub = "#!/usr/bin/env php \n" . $defaultStub;

	$phar->setStub($stub);

	$phar->stopBuffering();

	$phar->compressFiles(Phar::GZ);

	chmod(__DIR__ . '/combinationlock.phar', 0770);

	echo "$pharFile successfully created" . PHP_EOL;
}
catch (Exception $e)
{
	echo $e->getMessage();
}
