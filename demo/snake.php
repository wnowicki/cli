<?php

require_once('../vendor/autoload.php');

$screen = \WNowicki\Cli\Screen::make();

$x = rand(0, $screen->cols());
$y = rand(0, $screen->rows());

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

    $screen->putIn('*', $snake[0][0], $snake[0][1]);
    $screen->putIn('*', $snake[1][0], $snake[1][1]);
    $screen->putIn('*', $snake[2][0], $snake[2][1]);
    $screen->putIn('*', $snake[3][0], $snake[3][1]);
    $screen->putIn('*', $snake[4][0], $snake[4][1]);
    $screen->putIn('*', $snake[5][0], $snake[5][1]);
    $screen->putIn('*', $snake[6][0], $snake[6][1]);
    $screen->putIn('*', $snake[7][0], $snake[7][1]);
    $screen->putIn('*', $snake[8][0], $snake[8][1]);
    $screen->putIn('#', $snake[9][0], $snake[9][1]);

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

    $x = min($x + $dx, $screen->cols()-1);
    $y = min($y + $dy, $screen->rows()-1);

    array_shift($snake);
    $snake[9] = [$y, $x];

    $screen->putIn('Updated: ' . date('H:i:s d/m/Y'), -2, -28);

    $screen->render();

    sleep(1);
}
