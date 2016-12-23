Laravel  5.4 CRUD using AngularJS and AJAX
=====================

This laravel project contains the frontend and backend implementation on how to manipulate MySQL database( CRUD) using laravel's MVC framework and AngularJS for client side validation.

----------
> **Note:**  Assumed you have installed web server in your machine. In this example I used XAMPP for my windows machine.*

1. Create Laravel project
-------------

Laravel is a php open-source web framework that can be downloaded online. Use composer as a package manager to download necessary libraries for laravel project.

###1.1 Download composer and install in your system

>  https://getcomposer.org/download/

###1.2. Execute command to download laravel based project

 - Open command line interface
 - Set the current directory to where you want to save your laravel project. In my case since I used XAMPP it will be on "c:/program files/xampp/htdocs"
 - Enter  command  `composer create-project laravel/laravel Project Name`

###1.3. Database Migration

Create a migration class to manage database. In this example "registration" database was manually created.

 - Set up database connection by editing laravel project/.env file
 
     DB_CONNECTION=mysql
    DB_HOST=localhost
    DB_PORT=3306
    DB_DATABASE=registration
    DB_USERNAME=root
    DB_PASSWORD=
    
 -	Enter command `php artisan make:migration create_user_table`
 -	Under laravel project/database/migration folder a migration class will be created. It contains two methods, one is "up" method to upgrade database from its current state and second is "down" method to downgrade. Since this is a fresh project we will focus on upgrading our database. Add this code to "up" method.
 

     public function up()
    {
      Schema::create('registrationtable', function (Blueprint $table) {
      $table->increments('id');
      $table->string('firstname');
      $table->string('lastname');
      $table->string('username');
      $table->string('email');
      $table->string('password');
      $table->integer('age');
      $table->timestamps();
      });
    }

 -	Enter  command  `php artisan migrate` to start migration

###1.4 Create a model for the newly created table

 - Enter command `php artisan make:model ModelName` //RegUser
 -	Under laravel project/app/ a new model class is created.  Change the class code to this

     class RegUser extends Model
    {
        protected $table ='registrationtable';
    }

###1.5 Views

Create your views or web pages that will be shown in client side. All resources accessible to client must be stored in laravel project/public. These are the following view files involved:

 - master.php - html forms, fields, etc.
 -  css/style.css - css style for master.php
 - js/script.css - AngularJS validation and AJAX

> **Note:**  When you visit your laravel project on browser you are required to specifically locate the public folder which is set by the framework. Example "http://localhost/laravelproject/public/index.php". To remove the "public" in URL. Just rename the "server.php" to "index.php" under project's root folder. Basically to make "server.php" as the entry point page, while "server.php" contains a script to redirect the user going to public resource. Also place ".htaccess" in root folder to make apache gain access to your web resources configuration.

2. Create Controller class
-------------

Enter command `php artisan make:controller ControllerName` //RegistrationController. Controller class will be created under laravel project/app/http/controllers folder. Please see code

3. Set Route Configuration
-------------
Set route configuration in laravel project/routes/web.php by adding this code.
