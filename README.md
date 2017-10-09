## Laravel 5-3 example ##

**Laravel 5-3 example** is a tutorial application.

It's an upgrade of [this repository](https://github.com/bestmomo/laravel5-example) for Laravel 5.3 with big code cleaning and refactoring and application tests.

For a Laravel 5.5 new great example [it's there](https://github.com/bestmomo/laravel5-5-example).

### Installation (the slow way) ###

* type `git clone https://github.com/bestmomo/laravel5-3-example.git projectname` to clone the repository 
* type `cd projectname`
* type `composer install`
* type `composer update`
* copy *.env.example* to *.env*
* type `php artisan key:generate`to regenerate secure key
* if you use MySQL in *.env* file :
   * set DB_CONNECTION
   * set DB_DATABASE
   * set DB_USERNAME
   * set DB_PASSWORD
* if you use sqlite :
   * type `touch database/database.sqlite` to create the file
* type `php artisan migrate --seed` to create and populate tables
* edit *.env* for emails configuration
* optionaly type `npm install` to manage assets

### Installation (the fast way) ###

* **for sqlite :** upload [this zip file](http://laravel.sillo.org/tuto/laravel5-3-example.zip) and unzip it in your folder. It's done with sqlite database ! You can make a *composer update* to refresh vendor.
* **for mysql :** upload [this zip file](http://laravel.sillo.org/tuto/laravel5-3-example-mysql.zip) and unzip it in your folder. Create an empty database and follow the installer instructions. You can make a *composer update* to refresh vendor. The installer was made with [this package](https://github.com/bestmomo/laravel5-3-installer).

### Include ###

* [Bootstrap](http://getbootstrap.com) for CSS and jQuery plugins
* [Font Awesome](http://fortawesome.github.io/Font-Awesome) for the nice icons
* [Highlight.js](https://highlightjs.org) for highlighting code
* [Startbootstrap](http://startbootstrap.com) for the free templates
* [CKEditor](http://ckeditor.com) the great editor
* [Elfinder](https://github.com/Studio-42/elFinder) the nice file manager
* [laravel-lipsum](https://github.com/magyarjeti/laravel-lipsum) for the lipsum generator
* [Laravel Collective](https://laravelcollective.com/) for Forms and Html 
* [Sweat Alert](http://t4t5.github.io/sweetalert/) for the cool alerts

### Features ###

* Home page
* Custom error pages 403, 404 and 503
* Authentication (registration, login, logout, password reset, mail confirmation, throttle)
* Users roles : administrator (all access), redactor (create and edit post, upload and use medias in personnal directory), and user (create comment in blog)
* Blog with comments
* Search in posts
* Tags on posts
* Contact us page
* Admin dashboard with messages, users, posts, roles and comments
* Users admin (roles filter, show, edit, delete, create, blog report)
* Posts admin (list with dynamic order, show, edit, delete, create)
* Multi users medias gestion
* Localization
* Application tests
* Use of new notifications to send emails and notify redactors for new comments

### Assets ###

CSS is compiled with Elixir, look at **gulpfile.js** for details.

### Tricks ###

To use application the database is seeding with users :

* Administrator : email = admin@la.fr, password = admin
* Redactor : email = redac@la.fr, password = redac
* User : email = walker@la.fr, password = walker
* User : email = slacker@la.fr, password = slacker

### Tests ###

When you want to launch the tests first rollback the database :

`php artisan migrate:rollback`

Then migrate and seed :

`php artisan migrate --seed`

You can then use PHPUnit

### License ###

This example for Laravel is open-sourced software licensed under the MIT license
