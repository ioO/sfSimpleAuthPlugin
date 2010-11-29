# symfony 1.4 a single account authentification

## Use with Caution

I recommand to use encryption for your password in app.yml file, as it will be avaible from others persons.

## What is it ?

sfSimpleAuth is a symfony 1.4 plugin that permit a single account authentification from an app.yml file.
sfSimpleAuth comes with several default configuration config/

Default configuration could be overided in your project config/ folder.
see http://www.symfony-project.org/reference/1_4/en/ for more details.

For severals accounts and/or group permission managment, see sfGuardPlugin.

## How to install ?

symfony plugin:install sfSimpleAuthPlugin

## How to run ?

Check if plugin is correctly enabled in your project config/ProjectConfiguration.class.php

sfSimpleAuth comes with his default config/settings.yml.

edit /apps/appname/config/setting.yml :

    enabled_modules:        [sfSimpleAuth]

## How to configure

sfSimpleAuth comes with default login / password in sfSimpleAuthPlugin/config/app.yml for dev and test environment.

Set values for prod environment in your apps/appname/config/app.yml

## Use password encryption

You can use an php encryption function like md5 or sha1. Check your php server version provide this functions.
If you use encryption you have to put in apps/appname/config/app.yml file the encrypted password not the human readable.

For example you want an sha1 password for prod.

With php cli

    php -r 'print(sha1("password"))."\n";'

Edit app.yml and put the hash in password.

prod:
  sf_simple_auth:
    username:                 username
    password:                 28de1b112c04960b043d9fc2f02c160f95a299cd
    encryption:               sha1

## Change template.

By default symfony use signinSuccess template. To override plugins in symfony create an module in your project.
But if you only have to override the template you can use the template var in app.yml

prod:
  sf_simple_auth:
    username:                 username
    password:                 28de1b112c04960b043d9fc2f02c160f95a299cd
    encryption:               sha1
    template:                 [module,partial]

Module is module name where you save your partial in template folder. For example you make a template apps/appname/template/_signin.php

prod:
  sf_simple_auth:
    template:                 [global,signin]

The partial name is passed througth the default plugin template in sfSimpleAuth/template with the $form var.

## Enable plugin tests with your project

edit /config/ProjectConfiguration.class.php and add this

  public function setupPlugins()
  {
    $this->pluginConfigurations['sfSimpleAuthPlugin']->connectTests();
  }

## How to help ?

  * uses it and get me back feedback.
  * fork it from github : https://github.com/ioO/sfSimpleAuthPlugin

I will have a look to your pull request.


## TODO
  * add task to generate password with encryption
  * add task to create an account in app.yml
  * add task to modify account
  * add a retrieve password method by email.
  

## About

The lead developer is Lionel Chanson <lionel.chanson@particul.es>.