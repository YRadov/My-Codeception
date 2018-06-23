# My-Codeception
Using Codeception testing framework

## Before using
### Execute the command to installing the dependencies
 - composer update (php composer.phar update)
 
## Usage
- start selenium.jar
- execute command in root folder:
    - vendor/bin/codecept bootstrap - before first usage
    - vendor/bin/codecept build - after add/remove modules to *.suite.yml
    - vendor/bin/codecept run - start all kind of tests
    - vendor/bin/codecept run acceptance - run only acceptance tests
    
#### to see execution step-by-step you can add --steps after the command