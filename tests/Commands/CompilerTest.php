<?php

namespace Okh\CombinationLock\Tests\Commands;

use Okh\CombinationLock\Commands\Compiler;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CompilerTest extends TestCase
{
	public function testItDisplaysTheRightOutput()
	{
		$command = new Compiler();

		$tester = new CommandTester($command);
		$tester->setInputs(['i', 'yes', '0', 'no']);
		$tester->execute([]);

		$tester->assertCommandIsSuccessful();
	}
}
