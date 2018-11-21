# Symfony project doctrine training

This project aim is to build a small application which face and show how to solve problems with Symfony 3.4. 
Is not meant to be a tutorial, but more similar to a on the job training. 

## Use case
The use-case taken as example at first is very simple: We have some simple entities (Account, Contact, Phone, Address)
which should work together and have some relationships to be managed.

Since the very beginning you'll see and try yourself on these topics :

- Symfony setup
- Route
- Entity
- Controller
- Repository 
- webpack encore
- Doctrine's Entities
- Doctrine's Association Mappings
- Symfony forms and types
- Doctrine cascades
- Doctrine Identity strategies

## Requirements
- Docker
- node.js
- npm 

## Installation
- composer install
- docker-compose up

The application will be available on port 80 with these two endpoints :

- [http://localhost/accounts/list](http://localhost/accounts/list)
- [http://localhost/accounts/add](http://localhost/accounts/add)


## How to start working with code

you have master wich is an empty branch, just with a README.md to start setting up the environment.
All the different examples are in different branches:

-  1_doctrine_training_setup
-  2_doctrine_training_OneToOne_Unidirectional
-  3_doctrine_training_OneToOne_Bidirectional
-  4_doctrine_training_OneToMany_Bidirectional
-  5_doctrine_training_OneToMany_Bidirectional_doctrine_persist
-  6_doctrine_training_2_5_Identity_Strategies

Checkout branches starting from the ``1_doctrine_training_setup`` and changing branch incrementally : 2_.., 3_... etc.
Everytime you checkout a new branch the Readme will be updated with new explanations.
The idea is not just to read the file but more having a look at the code, in a deep way. 

**Play with it, change things, broke them and learn from errors!**

