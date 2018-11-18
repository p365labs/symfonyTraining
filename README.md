#A Symfony project 3.x

=====================

A Symfony project 3.x
The Symfony project setup is delivered with a Docker Compose file which setup and environment with three containers:

- ``doctrine_training_php`` : which has all the PHP (PHP 7.1.22) extension needed for the project.
- ``doctrine_training_mysql`` : a MySql server container (Mysql 5.7.23)
- ``doctrine_training_nginx`` : an Nginx server which exposes port 80 as external port and forward request to the PHP-FPM process (port 9000)

to have it properly working you just need ``DOCKER`` installed and executing the command  ```docker-compose up```
    
As a facility it's available a command called ``con.sh`` that give you quick access to Symfony console, if fact executes this command :

``docker exec -it doctrine_training_php bin/console $1``

and the first parameter is the Symfony console command you want to execute. So a cache clear from your host machine could be possible this way
``
./con.sh ca:cl``

## Composer.json

```json
    "require": {
        "php": ">=7.1",
        "doctrine/doctrine-bundle": "^1.6",
        "doctrine/orm": "^2.5",
        "incenteev/composer-parameter-handler": "^2.0",
        "sensio/distribution-bundle": "^5.0.19",
        "sensio/framework-extra-bundle": "^5.0.0",
        "symfony/monolog-bundle": "^3.1.0",
        "symfony/polyfill-apcu": "^1.0",
        "symfony/swiftmailer-bundle": "^2.6.4",
        "symfony/symfony": "3.4.*",
        "symfony/webpack-encore-pack": "^1.0",
        "twig/twig": "^1.0||^2.0"
    },
    "require-dev": {
        "sensio/generator-bundle": "^3.0",
        "symfony/phpunit-bridge": "^3.0"
    }
```

The base installation has a very few dependencies in the *require* section :

- define projects ```php``` and ```php-extensions dependencies```
- doctrine libraries
    Doctrine is the ORM most used in Symfony. ORM stands for **O**bject**R**elational**M**apper. 
    It's a dfferent approach for people not used to ORM: the application and the domain model of your
    application will drive the DB design. 
- [sensio/distribution-bundle](https://github.com/sensiolabs/SensioDistributionBundle). This bundle won't be
used in Symfony 4.x anymore
- [sensio/framewrok-extra-bundle](https://github.com/sensiolabs/SensioFrameworkExtraBundle) : An extension to Symfony FrameworkBundle that adds annotation configuration for Controller classes.
There are five types of [annotations](https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html) available :
    - @Route and @Method
    - @ParamConverter
    - @Template
    - @Cache
    - @Security & @IsGranted
- [swiftmailer-bundle](https://swiftmailer.symfony.com/) : the Email library for Symfony
- [webpack-encore-pack](https://github.com/symfony/webpack-encore) : Webpack Encore is a simpler way to integrate [Webpack](https://webpack.js.org/) into your application. It wraps Webpack, giving you a clean & powerful API for bundling JavaScript modules, pre-processing CSS & JS and compiling and minifying assets. Encore gives you a professional asset system that's a delight to use.
- [twig](https://twig.symfony.com/doc/2.x/): Twig is a template engine. Used in Symfony.

What's in the required-dev dependencies*

- [sensio/generator-bundle](https://github.com/sensiolabs/SensioGeneratorBundle) : Generates Symfony bundles, entities, forms, CRUD, and more...
Is not supported by Symfony 4.x anymore. 
- [phpunit-bridge](https://symfony.com/doc/3.4/components/phpunit_bridge.html) :The PHPUnit Bridge provides utilities to report legacy tests and usage of deprecated code and a helper for time-sensitive tests. 





## **Symfony Directory Structure**

```bash
.
├── app
├── AppCache.php
├── AppKernel.php
├── Resources
│   └── views
│       ├── base.html.twig
│       └── default
└── config
    ├── config.yml
    ├── config_dev.yml
    ├── config_prod.yml
    ├── config_test.yml
    ├── parameters.yml
    ├── parameters.yml.dist
    ├── routing.yml
    ├── routing_dev.yml
    ├── security.yml
    └── services.yml
├── assets
└── bin
    ├── console
    └── symfony_requirements
├── src
├── storage
├── tests
└── var
    ├── SymfonyRequirements.php
    ├── bootstrap.php.cache
    ├── cache
    ├── logs
    └── sessions
├── vendor
└── web
    ├── app.php
    ├── app_dev.php
    ├── apple-touch-icon.png
    ├── build
        ...
    ├── config.php
    ├── favicon.ico
    └── robots.txt

```

the directories of Symfony you should absolutely know and with which you will work a **LOT** are:
- app
- bin
- src
- var
- web

###app
```app``` is one of the main directories of Symfony. Inside you'll have all the config yaml files needed to work with your framework.

let's get a deep overview at the 
#####config yaml files :

- config.yml
- config_dev.yml 
- config_prod.yml 
- config_test.yml 

These files are all for config, the ones with `_env` are specific configuration options for
different environments (Development, Production, Test). Symfony has been developed since the
very beginning with the idea of environments. So you could develop your code with 
specific configurations for your workstation, and having different configs for staging and
production env.

In config you define the main behaviour of the framework on many different aspcts, the doctrine configuration, 
swiftmailer etc... 

##### parameters.yml 

Parameters file is the place where you define the value parameters for configuration files:
db configuration o mail server configuration. In symfony 4.x the approach to parameters has been
completely redesing and changed.

```yaml
parameters:
    database_host: doctrine_training_mysql
    database_port: null
    database_name: symfony_doctrine1
    database_user: root
    database_password: root
```

#####routing.yml

The routing yaml file is the very first routing file you encounter during your 
first approach to Symfony. It is the general one and in fact is not really 
touched by developers at first sight. Inside our routiing file it could be found
directives for using annotation in the bundle we specified :

```yaml
app:
    resource: '@AppBundle/Controller/'
    type: annotation
```

###bin
Bin directory contains the **console** command which is more or less the command you execute
every single moment when you work with Symfony : clearing caches, mapping doctrine info, load fixtures,
etc etc. In general you can find other executabels usefuls for debugging with Symfony.

###src
it the root of ur project! All the source code should be placed in this directory

###var
Var is a very important directory, you'll find inside cache directory, logs directory
and session one. Logs file for a developer are sux important, start using terminal with *tail -f var/logs/dev.log*
always open!
 
###web  
This directory contains the Front-Controller which is where all requests coming
from the Internet come from.

You have 2 different front controller file you are responsible to implement depending on the environment.
```bash
app.php
app_dev.php
``` 

app.php should be used in production and only in production, otherwise you must use 
the app_dev.php in your development environment.

```php
// If you don't want to setup permissions the proper way, just uncomment the following PHP line
// read https://symfony.com/doc/current/setup.html#checking-symfony-application-configuration-and-setup
// for more information
//umask(0000);
//
// This check prevents access to debug front controllers that are deployed by accident to production servers.
// Feel free to remove this, extend it, or make something more sophisticated.
if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !(in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'], true) || PHP_SAPI === 'cli-server')
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

require __DIR__.'/../vendor/autoload.php';
Debug::enable();

$kernel = new AppKernel('dev', true);
if (PHP_VERSION_ID < 70000) {
    $kernel->loadClassCache();
}
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
```
The files itself are really similar the main difference is this one:

``
$kernel = new AppKernel('dev', true);
``

The dev file load the AppKernel with dev environment and debug set to true

##Branch `doctrine 1` 

**Application Architecture**

```bash
.
└── AppBundle
    ├── AppBundle.php
    ├── Controller
    │   ├── AccountController.php
    │   └── DefaultController.php
    ├── Entity
    │   ├── Account.php
    │   └── Contact.php
    ├── Form
    │   ├── AccountType.php
    │   ├── AddressType.php
    │   └── ContactType.php
    ├── Model
    ├── Repository
    │   ├── AccountRepository.php
    │   ├── AddressRepository.php
    │   └── ContactRepository.php
    └── Resources
        └── views
            ├── Account
            │   ├── add.html.twig
            │   └── list.html.twig
            └── base.html.twig
```


### Main Bundle file

The main bundle file is placed at root level in the bundle, so in our example is 
```AppBundle.php``` 
it is used to do some magic for the Container and to setup and register Commands.

### Routing

In order to create a working example we need to have a route or a set of routes defined to allow 
the framework feeding the right Response to the Browser. Routing is one of the most important part
inside Symfony, and after all is a library in pure PHP which could be used in every project.

Have a look at [GitHub](https://github.com/symfony/routing), this library is completely agnostic 
to Symfony, have a look at its composer.json :

```json
    "require": {
        "php": "^7.1.3"
    }
```

Only PHP (this is the require for dev/master version)!

Let's dive a bit inside Routing Component :

``The Routing component maps an HTTP request to a set of configuration variables.``

The Routing library has 3 main basic components :

- RouteCollection
- RouteContext
- UrlMatcher

####RouteCollection [link](https://api.symfony.com/3.4/Symfony/Component/Routing/RouteCollection.html)

The idea behind routing is pretty simple :)

```php
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route
```

1. Create a Route
2. Create a RouteCollection
3. add the route or routes to the RouteCollection
4. create a RouteContext
5. create an UrlMatcher
6. use the UrlMatcher to match a route against a request which is parsed by a RouteContext

A RouteContext contains all the informations from a Request. This is the constructor of the RequestContext : 
```php
public function __construct(
    string $baseUrl = '', 
    string $method = 'GET', 
    string $host = 'localhost', 
    string $scheme = 'http', 
    int $httpPort = 80, 
    int $httpsPort = 443, A
    string $path = '/', 
    string $queryString = ''
)
```  

All these informations could be taken from the PHP super global `````$_SERVER````` or if you want you can
use another library created by Symfony which is, as the Router one,
completely agnostic from  the framework: [HttpFoundation](https://github.com/symfony/http-foundation).

The component is pretty simple, and you can add to your RouteCollection as many routes you want;
at the same time you can add RouteCollections to RouteCollections.
Till now we've seen how the Route component works for matching routes against
a collection of routes, but how to do when we need to generate a URL from a route name ?


```php
$route = new Route('/foo', array('_controller' => 'MyController'));
$routes = new RouteCollection();
$routes->add('route_name', $route);

$context = new RequestContext('/');

$matcher = new UrlMatcher($routes, $context);

$parameters = $matcher->match('/foo');
// array('_controller' => 'MyController', '_route' => 'route_name')
```
#####Route
The Route object accept accept many values on constructor

```php
__construct(
    string $path, 
    array $defaults = array(), 
    array $requirements = array(), 
    array $options = array(), 
    string $host = '', 
    string|string[] $schemes = array(), 
    string|string[] $methods = array(), 
    string $condition = ''
)
```
  
The most important ones are ``$path`` and ``$defaults``, the first defines the path to be matched 
and the latter one the defaults values that should be return when the url matches.
  
  
### Controller
The Controller is the second element that you should know about Symfony. In the MVC pattern what is
the controller responsibility ? The controller is in charge to manage the behaviour of your
application. It react to actions, routing defaults 99% are controllers actions. 
When an URL is matched the controller action in the Route($path, **$defaults**) is called and the Controller
do the dirty work.

What are you thinking about Controller in Symfony ??? 
The first to know, a practical one about Controllers is that:
1. they should be place in a specific directory
Symfony in fact allows you to whatever you what and in many many many many ways (you'll discover that !)
Inside ``app\config\services.yml`` you'll find this configuration :

```yaml
    AppBundle\Controller\:
        resource: '../../src/AppBundle/Controller'
        public: true
        tags: ['controller.service_arguments']
```
You tell the frameowrk where to find your controller; these are defaults values, you can change them but 
for conventions *Controller* are in a Directory called Controller.... and that's enough! 
2. every Controller filename should have a suffix *YourControllername***Controler**.php

3. The Controller should extends ``Symfony\Bundle\FrameworkBundle\Controller\Controller``

 
### Entity
The Entity is the **M** in the model of the MVC pattern.
```text
Objects that have a distinct 
identity that runs through time and different 
representations. You also hear these called 
"reference objects".

cit. Eric Evand "Domain Driven Design"
``` 

It is a basic class which holds the data, and helps you to implements the business requirements of your object in the applications.
Entities are simple PHP class which in Symfony are placed for conventions inside a directory called *Entity*.
In our project we've added the Entity directory and also created a couple of Entities : *Account* and *Contact*

In our example application Contact represent a single user's personal informations as email, phone and so on.
A contact has only one Account, in which we specify the type of account and the tax code. This need
explain clearly that an Account has a one-to-one relationship with the Contact. 

The Entities are managed by Doctrine to persist business information ... somewhere. Doctrine hides
where data is placed and it is absolutely not important to know for a developer where this data is (or at leat at the beginning!).

In order to allow the ORM to manage our Entity we need explicitly tells Symfony through Annotations.

```php
/**
 * @ORM\Entity
 * @ORM\Table(name="account")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AccountRepository")
 */
class Account
```

We're telling that the class is a Doctrine managed Entity, we can define the table name, otherwise the class name is used.
and we can optionally specify a Repository. More than that we can set specific annotations on class properties:

```php
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;
```

This annotation in specific has reference to the primary key of the Entity, which is particular important
and has some property more than usual property. 

Every Entity *must* have and Identifier which should be identified by the annotation : **@Id**
You can implement different strategies for Identity generation.

####Identty Strategy generation
- AUTO (default): Tells Doctrine to pick the strategy that is preferred by the used database platform. The preferred strategies are IDENTITY for MySQL, SQLite, MsSQL and SQL Anywhere and SEQUENCE for Oracle and PostgreSQL. This strategy provides full portability.

- SEQUENCE: Tells Doctrine to use a database sequence for ID generation. This strategy does currently not provide full portability. Sequences are supported by Oracle, PostgreSql and SQL Anywhere.

- IDENTITY: Tells Doctrine to use special identity columns in the database that generate a value on insertion of a row. This strategy does currently not provide full portability and is supported by the following platforms: MySQL/SQLite/SQL Anywhere (AUTO\_INCREMENT), MSSQL (IDENTITY) and PostgreSQL (SERIAL).

- UUID: Tells Doctrine to use the built-in Universally Unique Identifier generator. This strategy provides full portability.

- TABLE: Tells Doctrine to use a separate table for ID generation. This strategy provides full portability. This strategy is not yet implemented!

- NONE: Tells Doctrine that the identifiers are assigned (and thus generated) by your code. The assignment must take place before a new entity is passed to EntityManager#persist. NONE is the same as leaving off the @GeneratedValue entirely.

- CUSTOM: With this option, you can use the @CustomIdGenerator annotation. It will allow you to pass a class of your own to generate the identifiers.

###Command with Doctrine
One of the very first thing you need to know when working with doctrine is a set of commmand that could make your life easier.

The very first time you setup a Symfony project with doctrine you have to create a new database, defined in the parameters.yml,
for this purpose you have available the following command: *create/drop* setup a new database or drop it

``bin/console doctrine:database:create``
``bin/console doctrine:database:drop``

at the same time schama:create or drop allows 

``bin/console doctrine:schema:create``
``bin/console doctrine:schema:drop``

useful to se if something's broke and if your entities are valid doctrine entities.

``bin/console doctrine:schema:validate``
``bin/console doctrine:mapping:info``


``bin/console doctrine:schema:update --dump-sql``
``bin/console doctrine:schema:update --force``
``bin/console doctrine:schema:update --force``
 