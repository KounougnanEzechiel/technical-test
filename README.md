# Please fork this project to make your work invisible to other candidates :)

# Technical test

Hello there !

If you are here, there is a lot of chance that you passed an interview with Fanny and it went well.
You're now here to show what you're capable of !
**This test will show us your capacity to read unknown code, react to bugs, work in team, understand the purpose of a project and show your vision of a proper user experience.**

## The App

The Customer Success team, managed by Ramzi needs an application to manage and follow tasks for our customers. 

## Goal

* Install the project and let it work on your development environment.
* Find bugs, create issues, then debug the app.
* Have some ideas to complete the app, create issues, and, if possible, push some codes to close them !
* Try to understand and respect the coding standards
  
**Don't try to close all your improvement issues**. Some ambitious ideas deserve to remain pending documented issues.
  
## Rules

* The project is in english, but feel free to **answer with any language your comfortable with**. _Why English then and not French ? Because it is beaucoup plus cool quand même ..._
* **There is no time limit**. You can work on it 20 minutes or few days. Just tell us, when you delivered your code, how much time you did pass on each part of the test to let us appreciate the quality of the answer versus the time you worked on it. _On average, you can expect to work about 4 hours on it._
* Use the **graphical kit** we used on the app : [Tabler](https://preview.tabler.io/).
* Just **fork this git repository** and work on yours.
* When you are done with your app, **send the git URL to me** : [thibault@fidcar.com](mailto:thibault@fidcar.com).
* Of course, this app is totally fictional. **Your work is yours only and will never be used** in any other context than having a preview of your capacities for the job you applied for.

**If the installation process is challenging to you, or if you have some doubt, any question, we will work in team. So, please, contact me : [thibault@fidcar.com](mailto:thibault@fidcar.com).**

## Requirements

* PHP 7.4
* Composer
* Git
* PostgreSQL
* Symfony CLI

## Installation

First, copy the `.env` file to `.env.local`. Complete your `env.local` file with your own environment variables.
Copy `.env.local` to `.env.test.local` to enable tests.

Then, execute those scripts :

    composer install
    bin/console doctrine:database:create
    bin/console doctrine:migrations:migrate
    bin/console doctrine:fixtures:load
    bin/phpunit
    symfony serve

You can now login to the app. _Just find how ..._

