# A Symfony project 3.x

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

### app
```app``` is one of the main directories of Symfony. Inside you'll have all the config yaml files needed to work with your framework.

let's get a deep overview at the 
##### config yaml files :

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

##### routing.yml

The routing yaml file is the very first routing file you encounter during your 
first approach to Symfony. It is the general one and in fact is not really 
touched by developers at first sight. Inside our routiing file it could be found
directives for using annotation in the bundle we specified :

```yaml
app:
    resource: '@AppBundle/Controller/'
    type: annotation
```

### bin
Bin directory contains the **console** command which is more or less the command you execute
every single moment when you work with Symfony : clearing caches, mapping doctrine info, load fixtures,
etc etc. In general you can find other executabels usefuls for debugging with Symfony.

### src
it the root of ur project! All the source code should be placed in this directory

### var
Var is a very important directory, you'll find inside cache directory, logs directory
and session one. Logs file for a developer are sux important, start using terminal with *tail -f var/logs/dev.log*
always open!
 
### web  
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

## Branch `doctrine 1` 

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

#### RouteCollection [link](https://api.symfony.com/3.4/Symfony/Component/Routing/RouteCollection.html)

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
##### Route
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

#### Identty Strategy generation
- AUTO (default): Tells Doctrine to pick the strategy that is preferred by the used database platform. The preferred strategies are IDENTITY for MySQL, SQLite, MsSQL and SQL Anywhere and SEQUENCE for Oracle and PostgreSQL. This strategy provides full portability.

- SEQUENCE: Tells Doctrine to use a database sequence for ID generation. This strategy does currently not provide full portability. Sequences are supported by Oracle, PostgreSql and SQL Anywhere.

- IDENTITY: Tells Doctrine to use special identity columns in the database that generate a value on insertion of a row. This strategy does currently not provide full portability and is supported by the following platforms: MySQL/SQLite/SQL Anywhere (AUTO\_INCREMENT), MSSQL (IDENTITY) and PostgreSQL (SERIAL).

- UUID: Tells Doctrine to use the built-in Universally Unique Identifier generator. This strategy provides full portability.

- TABLE: Tells Doctrine to use a separate table for ID generation. This strategy provides full portability. This strategy is not yet implemented!

- NONE: Tells Doctrine that the identifiers are assigned (and thus generated) by your code. The assignment must take place before a new entity is passed to EntityManager#persist. NONE is the same as leaving off the @GeneratedValue entirely.

- CUSTOM: With this option, you can use the @CustomIdGenerator annotation. It will allow you to pass a class of your own to generate the identifiers.

### Command with Doctrine
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


Play a bit with these commands in order to understand their meaning and how to execute them.

### Doctrine Entities and Doctrine EntityManager

Always remember to use the doctrine documentation, for a good starting point on it have a look it [here](https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/tutorials/getting-started.html)

When you need to work with the Entities and doctrine you need access to the EntityManager which
is a Doctrine object responsible for the whole Entity lifecyle.

To get the manager from Symfony get the manager from the container :
``$this->get('doctrine')``

Inside a Controller you can use :

- $this->getDoctrine
- $this->get('doctrine');

the first is a shortcut to the second: 

``return $this->container->get('doctrine');``


Controller uses a Trait which is
``Symfony\Bundle\FrameworkBundle\Controller\ControllerTrait``

Inside the Trait you'll find :
```php
    /**
     * Shortcut to return the Doctrine Registry service.
     *
     * @return ManagerRegistry
     *
     * @throws \LogicException If DoctrineBundle is not available
     *
     * @final since version 3.4
     */
    protected function getDoctrine()
    {
        if (!$this->container->has('doctrine')) {
            throw new \LogicException('The DoctrineBundle is not registered in your application. Try running "composer require symfony/orm-pack".');
        }

        return $this->container->get('doctrine');
    }
```

So if the service exists inside the container the method return the service itself. So this two calls are identical.
The object returned is a 

``Doctrine\Bundle\DoctrineBundle\Registry``

which extends :

``Symfony\Bridge\Doctrine\ManagerRegistry``

which is in the BridgeBundle for Symfony & Doctrine. This class extends :

``Doctrine\Common\Persistence\AbstractManagerRegistry``

Which can make you understand what that call (``$this->getDoctrine()``) do.
This class can give you a lot of informations:

- getManager($name = null) Returns the default EntityManager if not specified anything else

```php    /**
        * {@inheritdoc}
        *
        * @throws \InvalidArgumentException
        */
       public function getManager($name = null)
       {
           if (null === $name) {
               $name = $this->defaultManager;
           }
   
           if (!isset($this->managers[$name])) {
               throw new \InvalidArgumentException(sprintf('Doctrine %s Manager named "%s" does not exist.', $this->name, $name));
           }
   
           return $this->getService($this->managers[$name]);
       }
```

- getRepository($persistentObjectName, $persistentManagerName = null) this method returns the Repository and it is
very interesting... *you must have a look a it!* 

```php
    /**
     * {@inheritdoc}
     */
    public function getRepository($persistentObjectName, $persistentManagerName = null)
    {
        return $this->getManager($persistentManagerName)->getRepository($persistentObjectName);
    }
```

Through this bunch of classes... (is it really a bunch ?) you can have access at your persistence.
to be clear, the best way to access the Entity manager is through its own name. You can have multiple
EntityManager with multiple connections and if you use the proper name you will follow a best practice.

In order to access to the entity manager you should call:

``$this->get('doctrine.orm.entity_manager');`` 

This call gives you access to the default entity manager; one of your best friend when you work with
Symfony is the command :

``bin/console debug:container``

it shows all the public services available in the container, executing the command "grepping" doctrine words it will
filter only the services for doctrine.

```text
  ...
  doctrine                                     Doctrine\Bundle\DoctrineBundle\Registry
  doctrine.dbal.default_connection             Doctrine\DBAL\Connection
  doctrine.orm.default_entity_manager          Doctrine\ORM\EntityManager
  doctrine.orm.entity_manager                  alias for "doctrine.orm.default_entity_manager"
  ...
``` 
As you can see entity_manager is an alias for default_entity_manager which of type ``Doctrine\ORM\EntityManager``.
The EntityManager has access to a method ``getRepository`` and also extends ObjectManager which gives
you access to methods like persists & flush. Through the EM you have access to these methods :

- persist
- remove
- flush

When you need to update or create an object you'll call *persist()*
When you need to remove an object you'll call *remove()*

But in order to start the transaction that will do an INSERT|UPDATE|DELETE in the database layer you need to call
the **flush()** after the persist or remove.

#### Entity Repositories
Every time you need to access data from doctrine you need to call queries from a **Repository**. 
A Repository is in fact a Finder Object available for every Entity, which gives you access to some methods already implemented 
inside Doctrine and also you can implement yours inside the Repository class itself.
To have a Repository available you need to specify the proper annotation in the class doc-block; have a look at
the Account class :

```php
/**
 * @ORM\Entity
 * @ORM\Table(name="account")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AccountRepository")
 */
class Account
{
.....
```

The repository is a class for convention has the suffix 'Repository' and the filename is usually
is {ENTITYNAME}Repository.php placed in a directory ``Repository``.

If you have a look at the repository Account class :

```php
<?php declare(strict_types=1);

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class AccountRepository extends EntityRepository
{

}
```

it's super Simple! .... and **EMPTY!**
Why empty ? Beacause the ObjectRepository class (*Doctrine\Common\Persistence\ObjectRepository*) forces the EntityManager (which extends it),
to implement these methods, which are common to all Repositories :

```php
- public function find($id, $lockMode = null, $lockVersion = null)
- public function findAll()
- public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
- public function findOneBy(array $criteria, array $orderBy = null)
```

That's why the AccountRepository class is empty, you already have methods available in order to make
queries against the Entity on DB.

##### findAll()
is a self explaining : fetch all Entities

##### find
Finds an entity by its primary key / identifier.

##### findBy
Finds entities by a set of criteria.

##### findOneBy
Finds a single entity by a set of criteria.

##### Magic methods --> findBy and findOneBy
Thanks to the use of __call magic methods you can call in the repository directly this methods in our
Account example :

``findByType``

``findOneByType``

even if these methods are not really defined. This magic is possible with the use of __call() :

```__call() is triggered when invoking inaccessible methods in an object context.```
 
 
## END of branch : doctrine1
if you have properly :
- created the database
- updated the schema
- cleared cache

you can load the application with these two endpoints:

http://localhost/accounts/list
http://localhost/accounts/add


## Branch `doctrine 2`

### Doctrine Association Mapping

##### Update our vendor directory :

``docker exec -it doctrine_training_php composer install``


##### In this new branch we will use webpack + yarn to manage assets dependencies
and to build SCSS and Javascripts.

You need to have installed npm and node.js

```npm install```

```npm run encore -- dev```

##### Let's update the database :

- ./con.sh "doctrine:database:drop --force"
- ./con.sh "doctrine:database:create"
- ./con.sh "doctrine:schema:create"

now check if everything is ok :

- ./con.sh "doctrine:schema:validate"
- ./con.sh "doctrine:mapping:info"

Now that the application has been updated let's see what has been updated.
In the new branch we have more entities more entities relationships
a lot of FormType and also implemented webpack with Symfony webpack encore (a new direcotry /assets with
custom CSS|JS has been updated).

The application is still available on port 80 with the same endpoint of the previous branch.

### One-to-One unidirectional relationship
Let's analyse our first example, our domain model tell us that an Account has a one-to-one relationship with a Contact.
Every Contact has an account and vice-versa.

The first example show us the simplest relationship : OneToOne unidirectional

```sql
CREATE TABLE account (
  id INT AUTO_INCREMENT NOT NULL, 
  contact_id INT DEFAULT NULL, 
  type TINYINT(1) NOT NULL, 
  tax_code VARCHAR(100) NOT NULL, 
  UNIQUE INDEX UNIQ_7D3656A4E7A1254A (contact_id), 
  PRIMARY KEY(id)) 
    DEFAULT CHARACTER SET utf8mb4 
    COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;
    
CREATE TABLE contact (
  id INT AUTO_INCREMENT NOT NULL, 
  name VARCHAR(100) NOT NULL, 
  surname VARCHAR(100) NOT NULL, 
  PRIMARY KEY(id)) 
    DEFAULT CHARACTER SET utf8mb4 
    COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;
    
ALTER TABLE account 
  ADD CONSTRAINT FK_7D3656A4E7A1254A 
  FOREIGN KEY (contact_id) 
  REFERENCES contact (id);
```

Defining a relationship as Unidirectional introduces a new set of concepts :

A unidirectional relationship only has an **owning side**.

- Owning side
- Inverse side

#### Owning Side
- The Owning Side of a relationship is the side which **hold** the relation.
- The owning side has to have the inversedBy attribute of the OneToOne, ManyToOne, or ManyToMany mapping declaration.
- The inversedBy attribute contains the name of the association-field on the inverse-side.
- The owning side of a OneToOne association is the entity with the table containing **the foreign key**.
 

#### Inverse Side
- The inverse side has to have the mappedBy attribute of the OneToOne, OneToMany, or ManyToMany mapping declaration. The mappedBy attribute contains the name of the association-field on the owning side.


### One-to-One Bidirectional relationship

Bidirectional relationships have both owning side and inverse side. Thiis could be useful when you need
to access a related property from one side to another. When you should do it ? Well actually it depends...
it depends from your business case, the idea behind this is : 

``if you don't need it don't use it`` 

Let's make some examples :

- User <-> Email 

The key point is trying to understand the use case, and then how the application will be modeled, don't think about the DATABASE at this stage of your analysis

Think about an application where has a relationshitp with an Entity called Email. A User in our particular busiiness case
could have only *One* email, so the OneToOne relationships is a perfect match for our needs.

Now let's think about owning side and inverse side, who should own the side we want to persist and maybe
if we want to cascade the persist.

```text
Changes made only to the inverse side of an association are ignored. 
Make sure to update both sides of a bidirectional association 
(or at least the owning side, from Doctrine's point of view)

The owning side of a bidirectional association is the side Doctrine 
"looks at" when determining the state of the association, and 
consequently whether there is anything to do to update 
the association in the database.
```

If in our business use-case we usually use to amend the User and from the User its own email, and not the contrary (from email amending the User).

We should **use** an unidirectional relationship with the User has the **owning side**.
Every time we amend an email from the User relationship it the cascade will respected also for the Email entity.
This Doctrine's behaviour.  
- User <-> Cart

Let's analyse a different example: an e-commerce website where User can register and buy things with a classic
cart system.

If we think at this use case a User can have a list of all of its carts and their statuses, but also an Administrator
can amend a User or view its data, by inspecting a list of all the carts available.

This is a perfect example where both sides of the relationships **should** be *Owning* and *Inverse* side.
In both cases your cascades will be *respected* by Doctrine. 

``Rememeber that apart from Doctrine your strategies on business entities should managed by developers.`` 

  
If we had a look at our example on source code now we've implemented a bidirectional relationships between 
*Account <-> Contact* have a look at the query to create the schema for this particular relation.

```sql
CREATE TABLE account (
  id INT AUTO_INCREMENT NOT NULL, 
  account_id INT DEFAULT NULL, 
  type TINYINT(1) NOT NULL, 
  tax_code VARCHAR(100) NOT NULL, 
    UNIQUE INDEX UNIQ_7D3656A49B6B5FBA (account_id), 
    PRIMARY KEY(id))
        DEFAULT CHARACTER SET utf8mb4 
        COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;
    
CREATE TABLE contact (
  id INT AUTO_INCREMENT NOT NULL, 
  name VARCHAR(100) NOT NULL, 
  surname VARCHAR(100) NOT NULL, 
  PRIMARY KEY(id)) 
        DEFAULT CHARACTER SET utf8mb4 
        COLLATE utf8mb4_unicode_ci ENGINE = InnoDB;

ALTER TABLE account 
  ADD CONSTRAINT FK_7D3656A49B6B5FBA 
  FOREIGN KEY (account_id) 
  REFERENCES contact (id);
```

### One-To-Many Bidirectional relationship

Remember these things on One-To-Many relationships

````
The inverse side has to have the mappedBy attribute of the OneToOne, OneToMany, or ManyToMany mapping declaration. The mappedBy attribute contains the name of the association-field on the owning side.

The owning side has to have the inversedBy attribute of the OneToOne, ManyToOne, or ManyToMany mapping declaration.
The inversedBy attribute contains the name of the association-field on the inverse-side.

ManyToOne is always the owning side of a bidirectional association.

OneToMany is always the inverse side of a bidirectional association.
````

In our example Contact has a many relationship with Phone and Address.

```mysql
CREATE TABLE address (
  id INT AUTO_INCREMENT NOT NULL, 
  contact_id INT DEFAULT NULL, 
  address VARCHAR(100) NOT NULL, 
  zip VARCHAR(100) NOT NULL, 
  country VARCHAR(100) NOT NULL, 
    INDEX IDX_D4E6F81E7A1254A (contact_id), 
    PRIMARY KEY(id)) 
      DEFAULT CHARACTER SET utf8mb4 
      COLLATE utf8mb4_unicode_ci 
      ENGINE = InnoDB;
    
CREATE TABLE contact (
  id INT AUTO_INCREMENT NOT NULL, 
  name VARCHAR(100) NOT NULL, 
  surname VARCHAR(100) NOT NULL, 
    PRIMARY KEY(id)) 
      DEFAULT CHARACTER SET utf8mb4 
      COLLATE utf8mb4_unicode_ci 
      ENGINE = InnoDB;
    
CREATE TABLE phone (
  id INT AUTO_INCREMENT NOT NULL, 
  contact_id INT DEFAULT NULL, 
  number VARCHAR(100) NOT NULL, 
    INDEX IDX_444F97DDE7A1254A (contact_id), 
    PRIMARY KEY(id)) 
      DEFAULT CHARACTER SET utf8mb4 
      COLLATE utf8mb4_unicode_ci 
      ENGINE = InnoDB;
      
ALTER TABLE address 
  ADD CONSTRAINT FK_D4E6F81E7A1254A 
  FOREIGN KEY (contact_id) 
    REFERENCES contact (id);
    
ALTER TABLE phone 
  ADD CONSTRAINT FK_444F97DDE7A1254A 
  FOREIGN KEY (contact_id) 
    REFERENCES contact (id);
```

In this case the owning side has the foreign key, so Address and Phone will have a contact_id key
which refers to the Contact primary key.
On the other hand Contact will hold a collection of ``phones`` and ``addresses`` which are only used by 
Doctrine.

The mapping tells Doctrine to use the contact_id column on the phone and address tables
to relate each record in that table with a record in the contact table.

Next, since a single Contact object will relate to many [Phones|Addresses] objects, a [Phones|Addresses]
property can be added to the Contact class to hold those associated objects.

this is the implementation on the Phone  class :


```php
    /**
    * @ORM\Entity
    * @ORM\Table(name="phone")
    * @ORM\Entity(repositoryClass="AppBundle\Repository\PhoneRepository")
    */
   class Phone
   {
   ...
   ...
    /**
     * Many Phones have One Contact.
     * @ORM\ManyToOne(targetEntity="Contact", inversedBy="phones")
     * @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
     */
    public $contact;
    
    
```

The most interesting part is on The inverse side of the relationship, the ``One`` side will 
hold a collection of objects.

The Contact class will look like this one :

```php
    /**
     * @ORM\OneToMany(targetEntity="Phone", mappedBy="contact", cascade={"persist"})
     *
     * @var Collection $phone
     */
    public $phones;
```

So phone will be a collection an object of type ``Doctrine\Common\Collections\Collection``
And in order to be successful to manage objects inside the collection you have to properly implement 
adder and remover inside the class Contact.

```php
    /**
     * @param Phone $phone
     */
    public function addPhone(Phone $phone)
    {
        // needed to update the owning side of the relationship!
        $phone->setContact($this);
        $this->phones->add($phone);
    }

    /**
     * @param Phone $phone
     */
    public function removePhone(Phone $phone)
    {
        $this->phones->removeElement($phone);
    }
```

On the collection you can access the methods ``add`` or ``remove``.



#### Collections
You **should** always initialise Collections when using @OneToMany or @ManyToMany relationship inside the constructor
of the class which has to access them.

```php
    public function __construct()
    {
        ...
        $this->addresses    = new ArrayCollection();
        $this->phones       = new ArrayCollection();
    }
```

```
Doctrine\Common\Collections\ArrayCollection;
Doctrine\Common\Collections\Collection;
```

These Collection is the Interface implemented by the concrete class ArrayCollection which belong to the Doctrine's
namespace. Doctrine Collections are simple PHP arrays with custom implementations in order to work properly
with the lazy loading functionality.

Actually Collection interface as this signature :

``interface Collection extends Countable, IteratorAggregate, ArrayAccess``
