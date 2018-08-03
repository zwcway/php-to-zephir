Php to Zephir
=============

> Convert PHP to Zephir.

This project is builded on top of nikic/PHP-Parser


Install
=======

```bash
composer require zwcway/php-to-zephir
```


How to use
====

```bash
vendor/bin/php-to-zephir phpToZephir:convert myDirToConvert 
```
    
It converts all files recursivly to [Zephir](https://github.com/phalcon/zephir) language.

Issue
=====

If you find a bug, please report it by new issue (with tested php code to see error).

Fatal error :'(
====

If you find a fatal error during converting, add --debug and identify where the fatal error happen. 
Then open issue !
