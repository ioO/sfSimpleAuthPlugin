# symfony 1.4 a single account authentification

## Use with Caution

As sfSimpleAuth is a alpha release. Please report bugs !

## What is it ?

sfSimpleAuth is a symfony 1.4 plugin that permit a single account authentification from an app.yml file.
sfSimpleAuth comes with several default configuration in sfSimpleAuthPlugin/config/

Default configuration could be overided in your project config/ folder.
see http://www.symfony-project.org/reference/1_4/en/ for more details.

For severals accounts and/or group permission managment, see sfGuardPlugin.

## How to install ?

Download PEAR package and install with :

symfony plugin:install /absolute/path/sfSimpleAuthPlugin-0.1.1.tar.gz

## How to run ?

Check if plugin is correctly enabled in your project config/ProjectConfiguration.class.php

sfSimpleAuth comes with his default config/settings.yml.

edit /apps/_your\_app_/config/setting.yml :

    enabled_modules:        [sfSimpleAuth]

## How to configure

sfSimpleAuth comes with default login / password in sfSimpleAuthPlugin/config/app.yml for dev and test environment.

Set values for prod environment in your apps/_your\_app_/config/app.yml

## Use password encryption

You can use an php encryption function like md5 or sha1. Check your php server version provide this functions.
If you use encryption you have to put in apps/_your\_app_/config/app.yml file the encrypted password not the human readable.

For example you want an sha1 password for prod.

With php cli

    php -r 'echo sha1("_your_password_")."\n";'

Edit app.yml and put

prod:
  sf_simple_auth:
    username:                 username
    password:                 28de1b112c04960b043d9fc2f02c160f95a299cd
    encryption:               sha1

## Use plugin tests with your project

edit /config/ProjectConfiguration.class.php and add this

  public function setupPlugins()
  {
    $this->pluginConfigurations['sfSimpleAuthPlugin']->connectTests();
  }

## How to help ?

You can participate by many ways :

*   Spreading the link
*   Debugging, improving, testing, forking, adapting, patching the source code
*   Mailing me to let me know what you think of it


## TODO
  * add task to generate password with encryption
  * add task to create an account in app.yml
  * add task to modify account
  * add a retrieve password method by email.
  * unit test sfSimpleAuth actions
  

## About

The lead developer is Lionel Chanson <lionel.chanson@particul.es>.