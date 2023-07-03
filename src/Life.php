<?php

class Life
{
    private array $boundary = [];

    public function __construct(protected int $gridY, protected int $gridX)
    {
    }

    public function createBoundary(): void
    {
        for ($i = 1; $i <= $this->gridX; ++$i) {
            $height = [];
            for ($j = 1; $j <= $this->gridY; ++$j) {
                $height[$j] = round(rand(0,1));
            }
            $this->boundary[$i] = $height;
        }
    }

    public function processGeneration(): void
    {
        $nextGenerationBoundary = [];

        foreach ($this->boundary as $gridXIndex => $gridX) {
            $nextGenerationBoundary[$gridXIndex] = [];
            foreach ($gridX as $gridYIndex => $gridY) {
                $neighbor = $this->countNeighbors($gridXIndex, $gridYIndex);

                $gridY = match (true) {
                    $gridY == 1 => $neighbor < 2 || $neighbor > 3 ? 0 : 1,
                    $gridY == 0 => $neighbor == 3 ? 1 : 0,
                    default => 0,
                };

                $nextGenerationBoundary[$gridXIndex][$gridYIndex] = $gridY;
            }
        }
        $this->boundary = $nextGenerationBoundary;
        unset($nextGenerationBoundary);
    }

    public function countNeighbors($x, $y): int
    {
        $coordinatesArray = [
            [-1, -1],[-1, 0],[-1, 1],
            [0, -1],[0, 1],
            [1, -1],[1, 0],[1, 1]
        ];

        $count = 0;

        foreach ($coordinatesArray as $coordinate) {
            if (isset($this->boundary[$x + $coordinate[0]][$y + $coordinate[1]])
                && $this->boundary[$x + $coordinate[0]][$y + $coordinate[1]] == 1) {
                $count++;
            }
        }
        return $count;
    }

    function render(): string
    {
        $output = '';
        foreach ($this->boundary as $width) {
            foreach ($width as $height) {
                $output .= $height == 1 ? 'X' : '-';
            }
            $output .= PHP_EOL;
        }

        return $output;
    }
}

