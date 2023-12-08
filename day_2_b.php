<?php
declare(strict_types = 1);

/**
 * Process the puzzle for AOC Day 2B
 * @copyright (c) eDifference 2023
 */
(new class {
    private const COLORS = [
        'red',
        'green',
        'blue',
    ];

    /**
     * Run the puzzle
     * @return void
     */
    public function run(): void
    {
        $data = file('data/day_2.txt');
        $counter = 0;
        foreach ($data as $id => $line) {
            echo sprintf("Game %d: ", $id+1);
            $maxes = [];
            foreach(self::COLORS as $color) {
                preg_match_all("/(\d*) {$color}/", $line, $amounts);
                $maxes[] = (int)max($amounts[1]);
            }
            $product = array_product($maxes);
            echo sprintf("Product: %d \n", $product);
            $counter += $product;
        }
        echo sprintf("\nAnswer is: %d \n", $counter);
    }
})->run();
