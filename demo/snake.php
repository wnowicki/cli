<?php

require_once('../vendor/autoload.php');

$screen = \WNowicki\Cli\Screen::make();

$x = rand(0, $screen->getWidth()-1);
$y = rand(0, $screen->getHeight()-1);

$moves = [-1,1];

$snake = [
    [$y, $x],
    [$y, $x],
    [$y, $x],
    [$y, $x],
    [$y, $x],
    [$y, $x],
    [$y, $x],
    [$y, $x],
    [$y, $x],
    [$y, $x],
];

$a = false;
$dx = 1;
$dy = 0;


while (1) {

    $screen->reset();

    $screen->put('*', $snake[0][1], $snake[0][0]);
    $screen->put('*', $snake[1][1], $snake[1][0]);
    $screen->put('*', $snake[2][1], $snake[2][0]);
    $screen->put('*', $snake[3][1], $snake[3][0]);
    $screen->put('*', $snake[4][1], $snake[4][0]);
    $screen->put('*', $snake[5][1], $snake[5][0]);
    $screen->put('*', $snake[6][1], $snake[6][0]);
    $screen->put('*', $snake[7][1], $snake[7][0]);
    $screen->put('*', $snake[8][1], $snake[8][0]);
    $screen->put('#', $snake[9][1], $snake[9][0]);

    if (rand(0,10) > 7) {
        if ($a) {
            $dx = $moves[array_rand($moves)];
            $dy = 0;
            $a = false;
        } else {
            $dy = $moves[array_rand($moves)];
            $dx = 0;
            $a = true;
        }
    }

    $x = min($x + $dx, $screen->getWidth()-1);
    $y = min($y + $dy, $screen->getHeight()-1);

    array_shift($snake);
    $snake[9] = [$y, $x];

    $screen->put('Updated: ' . date('H:i:s d/m/Y'), -28, -2);

    $screen->render();

    sleep(1);
}
