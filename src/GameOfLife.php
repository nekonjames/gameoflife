<?php
include 'Life.php';

$life = new Life(25, 10);
$life->createBoundary();

for($i = 0; $i < 10; $i++) {
    echo "\n Generation: " . $i+1 . "\n";
    echo $life->render();
    $life->processGeneration();
    usleep(1000);
}