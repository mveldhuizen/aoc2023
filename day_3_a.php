<?php
declare(strict_types = 1);

/**
 * Process the puzzle for AOC Day 3A
 * @copyright (c) eDifference 2023
 */
(new class {
    /**
     * Run the puzzle
     * @return void
     */
    public function run(): void
    {
        $dataMap = array_map(fn($v): array => str_split($v), file('data/day_3.txt'));

        $counter = 0;
        foreach ($dataMap as $lineId => $line) {
            echo sprintf("Line %d: ", $lineId+1);

            $number = '';
            $positionsToCheck = [];
            foreach($line as $charId => $character) {
                if (preg_match('/\d/', $character)) {
                    $number .= $character;
                    $positionsToCheck[] = [$lineId, $charId];
                    continue;
                }
                if (empty($number)) {
                    continue;
                }
                if ($this->isValidNumber($dataMap, $positionsToCheck)) {
                    echo sprintf("%d, ", (int)$number);
                    $counter += (int)$number;
                }
                $number = '';
                $positionsToCheck = [];
            }
            echo "\n";
        }
        echo sprintf("\nAnswer is: %d \n", $counter);
    }

    /**
     * @param array $dataMap
     * @param array $positionsToCheck
     * @return bool
     */
    private function isValidNumber(
        array $dataMap,
        array $positionsToCheck
    ): bool {
        foreach($positionsToCheck as $coordinates) {
            $x = $coordinates[0];
            $y = $coordinates[1];
            foreach([-1, 0, +1] as $xModifier) {
                foreach([-1, 0, +1] as $yModifier) {
                    $position = $dataMap[$x + $xModifier][$y + $yModifier] ?? '.';
                    if (preg_match('/[^\d.\n]/', $position)) { // is symbol?
                        return true;
                    }
                }
            }
        }
        return false;
    }
})->run();
