<?php
declare(strict_types = 1);

/**
 * Process the puzzle for AOC Day 2A
 * @copyright (c) eDifference 2023
 */
(new class {
    private const COLOR_MAX = [
        'red' => 12,
        'green' => 13,
        'blue' => 14,
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
            if (!$this->isValidGame($line)) {
                echo "is not valid\n";
                continue;
            }
            echo "is valid\n";
            $counter += ($id+1);
        }
        echo sprintf("\nAnswer is: %d \n", $counter);
    }

    /**
     * Is this a valid game?
     * @param string $line
     * @return bool
     */
    private function isValidGame(string $line): bool
    {
        $reveals = $this->getReveals($line);
        foreach($reveals as $reveal) {
            if (!$this->isValidReveal($reveal)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Get the separate reveals from the line
     * @param string $line
     * @return array
     */
    private function getReveals(string $line): array
    {
        preg_match('/.*: (.*)/', $line, $reveals);
        return explode('; ', $reveals[1]);
    }

    /**
     * Determine if a reveal does not contain to many cubes
     * @param string $reveal
     * @return bool
     */
    private function isValidReveal(string $reveal): bool
    {
        foreach(explode(', ', $reveal) as $cube) {
            preg_match('/(\d*) (.*)/', $cube, $cube);
            if ($cube[1] <= self::COLOR_MAX[$cube[2]]) {
                continue;
            }
            return false;
        }
        return true;
    }
})->run();