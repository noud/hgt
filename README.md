HGT website
=============================

Technische afhankelijkheden
---------------------------

Dit project heeft de volgende afhankelijkheden:

  * PHP 5.5.9
  * MySQL 5.5
  * Symfony 3.4
 
Installatie: development
------------------------

Voor het opzetten van een developmentomgeving zijn de volgende stappen nodig.

Draai composer:

```
$ composer install
```

Aan het eind wordt je gevraagd om parameters in te geven. Voor de meeste parameters kun je de default waarde kiezen.

Vervolgens draai je de Doctrine Migrations:

```
$ app/console doctrine:migrations:migrate
```

Tot slot stel je in Apache je webroot in op `/path-to-project/web/`. In deze directory vind je een `.htaccess` met alle rewrite rules, die hoe je dus niet meer in te stellen.
Open de site en voeg `app_dev.php` aan de URL toe. Je krijgt nu de melding dat je geen toegang hebt. Om dat te verhelpen voeg je je IP toe aan de whitelist in `web/app_dev.php`.


Installatie: production
------------------------

Voor het opzetten van een live omgeving zijn de volgende stappen nodig. Mogelijk is composer niet geinstalleerd, deze kan je downloaden (en als bestandsnaam composer.phar gebruiken).

Draai composer:

```
$ SYMFONY_ENV=prod composer install --no-dev --optimize-autoloader
```

Aan het eind wordt je gevraagd om parameters in te geven. Voor de meeste parameters kun je de default waarde kiezen.

Vervolgens draai je de Doctrine Migrations:

```
$ app/console doctrine:migrations:migrate --env=prod
```