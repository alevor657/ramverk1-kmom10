Anax comment
==================================

[![Latest Stable Version](https://poser.pugx.org/anax/comment/v/stable)](https://packagist.org/packages/anax/comment)
[![Join the chat at https://gitter.im/mosbth/anax](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/canax?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![Build Status](https://travis-ci.org/canax/comment.svg?branch=master)](https://travis-ci.org/canax/comment)
[![CircleCI](https://circleci.com/gh/canax/comment.svg?style=svg)](https://circleci.com/gh/canax/comment)
[![Build Status](https://scrutinizer-ci.com/g/canax/comment/badges/build.png?b=master)](https://scrutinizer-ci.com/g/canax/comment/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/canax/comment/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/canax/comment/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/canax/comment/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/canax/comment/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/d831fd4c-b7c6-4ff0-9a83-102440af8929/mini.png)](https://insight.sensiolabs.com/projects/d831fd4c-b7c6-4ff0-9a83-102440af8929)

Alvo comment module.



About
------------------

This package includes all needed parts to build a comment system using Anax.

Observe that there is no style included for exception of bootstrap 4 beta.



Setup
------------------

1. add route.php file from vendor directory to your config directory
2. copy route2 folder from vendor to your config directory
3. add services from vendor/alvo/comment/config/di.php to your config/di.php file
4. add templates from view folder in vendor catalog to your view folder
5. add src/functions.php to your src folder
6. add following to the autoloader

    "autoload": {
        "files": [
            "src/functions.php"
        ]
    }



Database
-------------------

In order to get things working you need to set up a mysql database. To do that, simply run sql/sqtup.sql file.
You also have to copy over config/database.php to your own config folder.



Tests
-------------------

I have my mock database on rpi up and running. So you can just user make test.



License
------------------

This software carries a MIT license.



```
 .  
..:  Copyright (c) 2017 Alexey V (alevor657@gmail.com)
```
