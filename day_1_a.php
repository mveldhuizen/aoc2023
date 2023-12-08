<?php
declare(strict_types = 1);

/**
 * Process the puzzle for AOC Day 1A
 * @copyright (c) eDifference 2023
 */
class Processor
{
    /**
     * Run the puzzle
     * @return void
     */
    public function run(): void
    {
        $data = file('data/day_1.txt');
        $counter = 0;
        foreach ($data as $line) {
            $counter += $this->getLineValue($line);
        }
        echo sprintf("Answer is: %d \n", $counter);
    }

    /**
     * Get the first and last digit of a line to get the correct value
     * @param string $line
     * @return int
     */
    private function getLineValue(string $line): int
    {
        preg_match_all("/\d/", $line, $digits);
        return intval(reset($digits[0]).end($digits[0]));
    }
}

(new Processor())->run();