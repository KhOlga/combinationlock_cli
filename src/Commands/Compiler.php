<?php

namespace Okh\CombinationLock\Commands;

use Phar;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class Compiler extends Command
{
	protected function configure(): void
	{
		$this
			->setName('compile:phar')
			->setDescription('Compiles a PHP archive.')
			->setHelp("
			This command allows you to compile a PHP archive. Creating archive '*.phar' can be disabled
			by the php.ini setting 'phar.readonly'. You’ll need to allow write-access which is done through
			the php.ini file. Open php.ini, find the phar.readonly directive, and modify it accordingly:\n
			\t\t\t\tphar.readonly = 0\n	
			Otherwise, a PharException will be thrown.
			");
	}

	protected function execute(InputInterface $input, OutputInterface $output): int
	{
		$io = new SymfonyStyle($input, $output);
		$answer = (int) $io->confirm(sprintf("Should I compile .phar for you?", true));

		if ($answer == true) {
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
			$phar->buildFromDirectory('combinationlock');
			$stub = "#!/usr/bin/env php \n" . $defaultStub;
			$phar->setStub($stub);
			$phar->stopBuffering();
			$phar->compressFiles(Phar::GZ);
			chmod('combinationlock.phar', 0770);
			$io->success("'$pharFile' successfully created!");

		} else {
			$io->note('You always could create it next time, if you would like.');
		}

		return Command::SUCCESS;
	}
}
