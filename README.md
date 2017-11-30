The Knight’s Travails 
=================================================

What is it?
--------------

This is a potential solution for the Knight’s Travails problem.
It finds the shortest sequence of valid moves to take a chess knight piece from a given position on the board
to another.

How to install it?
--------------

First make sure to have the correct php version (>7.0.0) on your OS. Check [**https://php-osx.liip.ch/**][0].
Here are some instructions for the installation on macOS, run the following commands:

`curl -s https://php-osx.liip.ch/install.sh | bash -s 7.1`

`export PATH=/usr/local/php5/bin:$PATH`

You can recheck the php version with:

`php -v`

We'll use [**composer**][1] for installing the required packages. 
Run the following command on the console from the root path of the project:

`composer install`  
 
How to run it with custom inputs?
--------------
 
Just type "php run" followed by the letter of the starting column and the number of starting row; and finally followed by
the letter of the end column and the number of the end row. 
The command letters are **case-insensitive**. Example:
 
`php run e8 c1`<br />` php run B2 C3` 

Example of output for `php run A8 B7`:

*Found a 4 step(s) sequence for moving the knight from A8 to B7:<br /> C7, B5, D6, B7*

How to run the tests?
--------------
We'll use only [**PHPUnit**][2] for testing. You can find the classes under ./tests.
 
In order to try them just run the following command:
 
`make test-all`
 
There command above will run all the existing tests at once as it's specified on the Makefile. You can run
one by one by typing "vendor/bin/phpunit" followed by the path of the test. Example:

`vendor/bin/phpunit tests/KnightSequenceTest.php`

[0]: https://php-osx.liip.ch/
[1]: https://getcomposer.org/doc/00-intro.md
[2]: hhttps://phpunit.de/getting-started.html