Clim Demo With Symfony 2 
=====================

Welcome to the Clip Demo Project - a fully-functional Symfony2
application that you can use as test.

This document contains information on how to download, install, and start
using it. 

1) Installing
------------

First Symfony 

As Symfony uses [Composer][1] to manage its dependencies, the recommended way
to create a new project is to use it.

If you don't have Composer yet, download it following the instructions on
http://getcomposer.org/ or just run the following command:

    curl -s http://getcomposer.org/installer | php

Then, use the `create-project` command to generate a new Symfony application:

    php composer.phar create-project symfony/framework-standard-edition path/to/install

Composer will install Symfony and all its dependencies under the
`path/to/install` directory.


2) Checking your System Configuration
-----------------------------------

Before starting coding, make sure that your local system is properly
configured for Symfony.

Execute the `check.php` script from the command line:

    php app/check.php

The script returns a status code of `0` if all mandatory requirements are met,
`1` otherwise.

Access the `config.php` script from a browser:

    http://localhost/path/to/symfony/app/web/config.php

If you get any warnings or recommendations, fix them before moving on.

3) Browsing the Demo Application
--------------------------------

Congratulations! You're now ready to use Symfony.

From the `config.php` page, click the "Bypass configuration and go to the
Welcome page" link to load up your first Symfony page.

You can also use a web-based configurator by clicking on the "Configure your
Symfony Application online" link of the `config.php` page.

To see a real-live Symfony page in action, access the following page:

    web/app_dev.php/

4) Getting started with Symfony


It comes pre-configured with the following bundles:

  * **FrameworkBundle** - The core Symfony framework bundle

  * [**SensioFrameworkExtraBundle**][2] - Adds several enhancements, including
    template and routing annotation capability

  * [**DoctrineBundle**][3] - Adds support for the Doctrine ORM

  * [**TwigBundle**][4] - Adds support for the Twig templating engine

  * [**SecurityBundle**][5] - Adds security by integrating Symfony's security
    component

  * [**SwiftmailerBundle**][6] - Adds support for Swiftmailer, a library for
    sending emails

  * [**MonologBundle**][7] - Adds support for Monolog, a logging library

  * [**AsseticBundle**][8] - Adds support for Assetic, an asset processing
    library

  * **WebProfilerBundle** (in dev/test env) - Adds profiling functionality and
    the web debug toolbar

  * **SensioDistributionBundle** (in dev/test env) - Adds functionality for
    configuring and working with Symfony distributions

  * [**SensioGeneratorBundle**][9] (in dev/test env) - Adds code generation
    capabilities

  * **AcmeDemoBundle** (in dev/test env) - A demo bundle with some example
    code


Enjoy!

[1]:  http://getcomposer.org/
[2]:  http://symfony.com/doc/2.3/bundles/SensioFrameworkExtraBundle/index.html
[3]:  http://symfony.com/doc/2.3/book/doctrine.html
[4]:  http://symfony.com/doc/2.3/book/templating.html
[5]:  http://symfony.com/doc/2.3/book/security.html
[6]: http://symfony.com/doc/2.3/cookbook/email.html
[7]: http://symfony.com/doc/2.3/cookbook/logging/monolog.html
[8]: http://symfony.com/doc/2.3/cookbook/assetic/asset_management.html
[9]: http://symfony.com/doc/2.3/bundles/SensioGeneratorBundle/index.html
