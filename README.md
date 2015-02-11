# PHP CLI Library
by WNowicki
## Examples

```PHP
$screen = \WNowicki\Cli\Screen::make()->addBorder('*')->addTitle('Example CLI Screen');

$screen->putIn(\WNowicki\Cli\Box::make(20,10)->addBorder('+')->addTitle('Example Box'), 10, 10);

$screen->putIn('Updated: ' . date('H:i:s d/m/Y'), -2, -30);

$screen->render();
```

## Demo
Run:
```
cd demo
php snake.php
```
