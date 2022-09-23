## Simple REST API implementation by Laravel 9

+ BREAD
+ Error json response
+ Nested/Sub Resources
+ Side load nested data
+ Download/upload files
+ Middleware
+ Basic Authentication
+ OAuth2
+ Laravel Passport
+ Testing API

## Server Environment and workflow
+ Run rest-app http://localhost:8000
+ Run third-party-app http://localhost:8001
+ Collect Client Id and Client Secret: php artisan passport:client
+ Put Client Id and Secret on third-party-app/app/Http/Controllers/ClientController
+ http://localhost:8001/redirect
+ To Authorize you have to login: http://localhost:8000/login
+ Authorize and Bearer type access/authorization token
+ Now in rest-app app/Http/Kernel.php > In api middleware group:
  Disable BasicAuth and place new 'auth:api'.
  auth.api: Use the configured authentication setup -> Passport
+ Now in Insomnia: Place the Bearer type access token
+ Install Behat/Behat
+ After Behat install run this command To test: vendor\bin\behat

## Tools/Packages

+ Insomnia
+ Laravel Passport
+ Behat/Behat

## What is BDD framework?

+ Behavior Driven Development (BDD) Framework enables software testers to complete test scripting in plain English.
  BDD mainly focuses on the behavior of the product and user acceptance criteria.

+ Behavior Driven Development (BDD) framework is a software development process that is an offshoot of Test Driven Development (TDD) framework.
  BDD is an agile testing methodology. It is the process of development, based on test-driven development and domain-driven, object-oriented analysis.
  However, it can be organized with traditional testing as well.
  Link: https://blog.trigent.com/behavior-driven-development-bdd-framework/
