<?php

$ringAmount = $argv[1];
settype($ringAmount, "integer");

$firstRingValues = array(1, 3, 5, 7, 9);
$values = array(0, 1, 2, 3, 5, 6, 7, 8, 9);

$optionsAmount = count($firstRingValues);

for ($i = 0; $i < $ringAmount; $i++) {
	$optionsAmount *= count($values);
}
echo $optionsAmount . "\n";
$counter = 1;
$lockOptions = [];
while ($counter <= $optionsAmount) {

	if ($ringAmount >= 4) {
		$firstPart = [];
		$firstRingKey = rand(0, 4);
		$firstPart[] = $firstRingValues[$firstRingKey];

		$secondPart = [];
		$key = rand(0, 8);
		$size = $ringAmount - 3;

		for ($i = 0; $i < $size; $i++) {
			array_push($secondPart, $values[$key]);
		}

		$secondPart[] = 5;
		$secondPart[] = 6;
		sort($secondPart);

		$merged = array_merge($firstPart, $secondPart);

		$lock = null;
		foreach ($merged as $number) {
			$lock .= $number;
		}
		echo "Option #$counter: $lock\n";
		$lockOptions[] = $lock;

		$counter++;

	} else {
		echo "An amount of rings in the lock can not be less than 4.\n";
	}
}