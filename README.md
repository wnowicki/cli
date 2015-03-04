# PHP CLI Library
by WNowicki

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/wnowicki/cli/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/wnowicki/cli/?branch=master) [![Build Status](https://scrutinizer-ci.com/g/wnowicki/cli/badges/build.png?b=master)](https://scrutinizer-ci.com/g/wnowicki/cli/build-status/master)

## Install
### Composer Installation
To install *cli* library you will need to use [Composer](http://getcomposer.org/) in your project. If you aren't using Composer yet, it's really simple!
```bash
curl -sS https://getcomposer.org/installer | php
```

### Cli Installation
```bash
php composer.phar require wnowicki/cli:~1.0
```

## Example

```PHP
$box = \WNowicki\Cli\Box::makeFromString("Lorem ipsum dolor sit amet,\nconsectetur adipiscing elit.", null, null, \WNowicki\Cli\Color::BG_RED);

$box2 = \WNowicki\Cli\Box::make(20, 7, \WNowicki\Cli\Color::COLOR_YELLOW, null, \WNowicki\Cli\Color::BG_WHITE)
    ->addBorder('*', null, \WNowicki\Cli\Color::BG_RED)
    ->addTitle('Box', \WNowicki\Cli\Color::COLOR_BLACK);

\WNowicki\Cli\Screen::make()
    ->putInCenter($box, 6)
    ->putInColumn($box2, 2, 1, 10)
    ->putInColumn($box2, 2, 2, 10)
    ->addTitle('Title', \WNowicki\Cli\Color::COLOR_GREEN, null, \WNowicki\Cli\Color::BG_BLACK)
    ->render();
```

## Demo
Run:
```
cd demo
php snake.php
```
