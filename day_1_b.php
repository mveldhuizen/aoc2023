<?php
declare(strict_types = 1);

/**
 * Process the puzzle for AOC Day 1B
 * @copyright (c) eDifference 2023
 */
(new class {
    /**
     * Run the puzzle
     * @return void
     */
    public function run(): void
    {
        $data = file('data/day_1.txt');
        $counter = 0;
        foreach ($data as $line) {
            $lineValue = $this->getLineValue($line);
            echo sprintf("Found line value: %d \n", $lineValue);
            $counter += $lineValue;
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
        preg_match(
            "/\d|one|two|three|four|five|six|seven|eight|nine/",
            $line,
            $firstDigit
        );
        preg_match(
            "/.*(\d|one|two|three|four|five|six|seven|eight|nine)/",
            $line,
            $lastDigit
        );
        return intval(
            $this->replaceWordsToDigits($firstDigit[0]) .
            $this->replaceWordsToDigits($lastDigit[1])
        );
    }

    /**
     * Replaces the number words to digits
     * @param string $line
     * @return string
     */
    private function replaceWordsToDigits(string $line): string
    {
        return str_replace(
            ['one','two','three','four','five','six','seven','eight','nine'],
            ['1','2','3','4','5','6','7','8','9'],
            $line
        );
    }
})->run();