# Slim Skeleton - CodelineRed

This git is for [slim3.codelinered.net](https://slim3.codelinered.net). Take a look at [screenshots](https://github.com/CodelineRed/slim-skeleton/tree/master/screenshots).

## Table of contents
- [Included Third Party Code](#included)
- Install Guides
    - [Install Skeleton](#install-skeleton)
    - [Install PHP, MySQL, Composer and Adminer (optional)](#install-php-mysql-composer-and-adminer-optional)
- [Path generation with Locale code and Generic locale code](#path-generation-with-locale-code-and-generic-locale-code)
- [How to create further localisations](#how-to-create-further-localisations)
- [How to switch between different url modes](#how-to-switch-between-different-url-modes)
    - [Mode 1](#mode-1)
    - [Mode 2](#mode-2)
    - [Mode 3](#mode-3-default)
- [ACL settings](#acl-settings)
- [Troubleshooting](#troubleshooting)
- [Links](#links)

## Included
- [Slim 3](https://www.slimframework.com)
- [Slim Twig View 2](https://github.com/slimphp/Twig-View)
- [Slim CSRF 0.8](https://github.com/slimphp/Slim-Csrf)
- [Slim Flash 0.4](https://github.com/slimphp/Slim-Flash)
- [Monolog 1](https://seldaek.github.io/monolog/)
- [Doctrine ORM 2](https://packagist.org/packages/doctrine/orm)
- [Geggleto ACL 1](https://github.com/geggleto/geggleto-acl)
- [Google Authenticator](https://github.com/PHPGangsta/GoogleAuthenticator)
- [Google reCAPTCHA 1](https://github.com/google/recaptcha)
- [HTML Compress Twig Extension](https://github.com/nochso/html-compress-twig)


## Install Skeleton
### Required
- PHP 8.0
- MySQL 5.7 (pdo_mysql)

Open console on your OS and navigate to your project folder.
[Download zip](https://github.com/CodelineRed/slim-skeleton/archive/production.zip) if you don't have git or composer on your OS.
```bash
+++++ ZIP VERSION +++++
$ (unix) wget -O slim-prod.zip https://github.com/CodelineRed/slim-skeleton/archive/production.zip
$ (unix) unzip slim-prod.zip
$ (win10) curl -L -o slim-prod.zip https://github.com/CodelineRed/slim-skeleton/archive/production.zip
$ (win10) tar -xf slim-prod.zip
$ cd slim-skeleton-production
$ (optional) cp config\additional-settings.dist.php config\additional-settings.php
$ ---- Open "config\additional-settings.php" and change everything you have to change ----
$ php composer insall --no-dev
$ php doctrine dbal:run-sql "CREATE DATABASE slim_skeleton"
$ php doctrine orm:schema-tool:update --force
$ php doctrine dbal:import sql/all-records.sql
```

```bash
+++++ GIT VERSION +++++
$ git clone https://github.com/CodelineRed/slim-skeleton.git
$ cd slim-skeleton
$ git checkout production
$ (optional on unix)  rm -rf .git
$ (optional on win10) rmdir .git /s
$ (optional) cp config\additional-settings.dist.php config\additional-settings.php
$ ---- Open "config\additional-settings.php" and change everything you have to change ----
$ php composer insall --no-dev
$ php doctrine dbal:run-sql "CREATE DATABASE slim_skeleton"
$ php doctrine orm:schema-tool:update --force
$ php doctrine dbal:import sql/all-records.sql
```

```bash
+++++ COMPOSER VERSION +++++
$ php composer create-project codelinered/slim-skeleton slim-skeleton "dev-production" --no-dev
$ cd slim-skeleton
$ php doctrine dbal:run-sql "CREATE DATABASE slim_skeleton"
$ php doctrine orm:schema-tool:update --force
$ php doctrine dbal:import sql/all-records.sql
```

Default Website login: user = user, pass = password
If you need PHP, MySQL, Composer and Adminer, see below ⇓.

## Install PHP, MySQL, Composer and Adminer (optional)
### Required
- [Docker](https://www.docker.com/)

Open console on your OS and navigate to the unziped/ cloned app folder.
```bash
$ (unix)    systemctl docker start
$ (windows) "c:\path\to\Docker Desktop.exe"
$ docker-compose build
$ docker-compose up -d
$ docker-compose run composer install --no-dev
$ (unix)    docker inspect slim-db | grep "IPAddress"
$ (windows) docker inspect slim-db | findstr "IPAddress"
$ ---- Add IPAddress as Doctrine "host" in "config\additional-settings.php" ----
```
Open [localhost:7705](http://localhost:7705) for Website or [localhost:7707](http://localhost:7707) for Adminer.

| DB Login | [Adminer](http://localhost:7707) |
|----------|----------------------------------|
| Server   | IP from `IPAddress`              |
| Username | root                             |
| Password | rootdockerpw                     |
| Database |                                  |

## Path generation with Locale code and Generic locale code
- Mode 1 - example.com/de/ = `'process' => \App\Utility\LanguageUtility::LOCALE_URL | \App\Utility\LanguageUtility::DOMAIN_DISABLED,`
- Mode 2 - example.de = `'process' => \App\Utility\LanguageUtility::LOCALE_URL | \App\Utility\LanguageUtility::DOMAIN_ENABLED,`
- Mode 3 - example.com (de-DE session) = `'process' => \App\Utility\LanguageUtility::LOCALE_SESSION | \App\Utility\LanguageUtility::DOMAIN_DISABLED,` (default)

It depends on your configuration what will be returned.

|                     | Mode 1 | Mode 2 | Mode 3 |
|---------------------|--------|--------|--------|
| locale code         | de-DE  | de-DE  | xx-XX  |
| generic locale code | de-DE  | xx-XX  | xx-XX  |

|                     | Twig        | PHP                                   | Twig Example                            | PHP Example                                                                   |
|---------------------|-------------|---------------------------------------|-----------------------------------------|-------------------------------------------------------------------------------|
| locale code         | `{{ lc }}`  | `LanguageUtility::getLocale()`        | `{{ path_for('user-register-' ~ lc) }}` | `$this->router->pathFor('user-register-' . LanguageUtility::getLocale())`     |
| generic locale code | `{{ glc }}` | `LanguageUtility::getGenericLocale()` | `{{ path_for('user-login-' ~ glc) }}`   | `$this->router->pathFor('user-login-' . LanguageUtility::getGenericLocale())` |

## How to create further localisations
- Duplicate one existing file in folder [`locale/`](https://github.com/CodelineRed/slim-skeleton/tree/master/locale) (e.g. copy `de-DE.php` to `fr-FR.php`)
- (if you use Mode 1 or 2) Duplicate one existing file in folder [`config/routes/`](https://github.com/CodelineRed/slim-skeleton/tree/master/config/routes) (e.g. copy `de-DE.php` to `fr-FR.php`)
- (if you use Mode 1 or 2) Change route prefix from `/de/` to `/fr/` in `config/routes/fr-FR.php`
- You can also define paths like `/fr-be/` (`locale/fr-BE.php`/ `config/routes/fr-BE.php`) for example
- If you want to show language in langswitch, add `fr-FR` and domain in `locale => active` ([`config/additional-settings.php`](https://github.com/CodelineRed/slim-skeleton/blob/master/config/additional-settings.dist.php#L56))
- (if you use Mode 1 or 2) Add case for `fr/` in [`src/localisation.php`](https://github.com/CodelineRed/slim-skeleton/blob/master/src/localisation.php#L47)

## How to switch between different url modes
### Mode 1
Example: example.com/de/
- EN is default language and DE is alternative language for this steps
- Got to `locale` in [`config/additional-settings.php`](https://github.com/CodelineRed/slim-skeleton/blob/master/config/additional-settings.dist.php#L52)
- Set `'process' => \App\Utility\LanguageUtility::LOCALE_URL | \App\Utility\LanguageUtility::DOMAIN_DISABLED,`
- Set up english routes with or without `/en` prefix in [`config/routes/en-US.php`](https://github.com/CodelineRed/slim-skeleton/blob/master/config/routes/en-US.php)
- Set up german routes with `/de` prefix in [`config/routes/de-DE.php`](https://github.com/CodelineRed/slim-skeleton/blob/master/config/routes/de-DE.php)
- [`config/routes/xx-XX.php`](https://github.com/CodelineRed/slim-skeleton/blob/master/config/routes/xx-XX.php) can be leave untouched

### Mode 2
Example: de.example.com or example.de
- EN is default language and DE is alternative language for this steps
- Got to `locale` in [`config/additional-settings.php`](https://github.com/CodelineRed/slim-skeleton/blob/master/config/additional-settings.dist.php#L52)
- Set `'process' => \App\Utility\LanguageUtility::LOCALE_URL | \App\Utility\LanguageUtility::DOMAIN_ENABLED,`
- Enter your domains in `active`
- Go to [`config/routes/de-DE.php`](https://github.com/CodelineRed/slim-skeleton/blob/master/config/routes/de-DE.php)
- Remove `/de` prefix from every `route`
- Go to [`config/routes/xx-XX.php`](https://github.com/CodelineRed/slim-skeleton/blob/master/config/routes/xx-XX.php)
- Insert all routes where the config is equal between [`config/routes/en-US.php`](https://github.com/CodelineRed/slim-skeleton/blob/master/config/routes/en-US.php) and [`config/routes/de-DE.php`](https://github.com/CodelineRed/slim-skeleton/blob/master/config/routes/de-DE.php)
- Remove these equal routes in [`config/routes/en-US.php`](https://github.com/CodelineRed/slim-skeleton/blob/master/config/routes/en-US.php) and [`config/routes/de-DE.php`](https://github.com/CodelineRed/slim-skeleton/blob/master/config/routes/de-DE.php)

### Mode 3 (default)
Example: example.com
- EN is default language and DE is alternative language for this steps
- Got to `locale` in [`config/additional-settings.php`](https://github.com/CodelineRed/slim-skeleton/blob/master/config/additional-settings.dist.php#L52)
- Set `'process' => \App\Utility\LanguageUtility::LOCALE_SESSION | \App\Utility\LanguageUtility::DOMAIN_DISABLED,`
- Set up all routes in [`config/routes/xx-XX.php`](https://github.com/CodelineRed/slim-skeleton/blob/master/config/routes/xx-XX.php)
- [`config/routes/en-US.php`](https://github.com/CodelineRed/slim-skeleton/blob/master/config/routes/en-US.php) can be leave untouched
- [`config/routes/de-DE.php`](https://github.com/CodelineRed/slim-skeleton/blob/master/config/routes/de-DE.php) can be leave untouched

## ACL settings
With [Geggleto ACL](https://github.com/geggleto/geggleto-acl), routes are protected by role the current user has. By default every new route is not accessable until you give the route roles.
Routes are defined in the route files (e.g. [`config/routes/de-DE.php`](https://github.com/CodelineRed/slim-skeleton/blob/master/config/routes/de-DE.php)).
Any other resource is defined in [`config/settings.php`](https://github.com/CodelineRed/slim-skeleton/blob/master/config/settings.php#L90).
Inside the Twig templates you can use ACL functions [`has_role`](https://github.com/CodelineRed/slim-skeleton/blob/master/templates/partials/navigation.html.twig#L23) and is_allowed.
Inside controllers you can also use this ACL functions and [many more](https://github.com/geggleto/geggleto-acl/blob/master/src/AclRepository.php) (e.g. [`isAllowed()`](https://github.com/CodelineRed/slim-skeleton/blob/master/src/Controller/UserController.php#L101)).

## Troubleshooting
### Error 1
In some cases you'll get the error message "Internal Server Error".

If this happened, go to [`public/.htaccess`](https://github.com/CodelineRed/slim-skeleton/blob/master/public/.htaccess) and enable `RewriteBase /`.

If project is in sub directory then `RewriteBase /project/public/`.

### Error 2
Message: is not resolvable
File: /var/www/vendor/slim/slim/Slim/CallableResolver.php

If this happened, your Doctrine host in `config\additional-settings.php` is wrong.

## Links
- [Slim Framework](https://www.slimframework.com/)
- [Twig](https://twig.symfony.com/)
- [Doctrine](https://www.doctrine-project.org/)
- [Slim 3 and Doctrine 2 Website](http://blog.sub85.com/slim-3-with-doctrine-2.html)
- [Slim 3 and Doctrine 2 Github](https://github.com/matthewfedak/slim-3-doctrine-2)
- [Adminer DB-GUI](https://www.adminer.org/)
- [Locale codes](https://www.science.co.il/language/Locale-codes.php)