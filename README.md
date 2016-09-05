## Laravel 5-3 example ##

**Laravel 5-3 example** is a tutorial application.

It's an upgrade of [this repository](https://github.com/bestmomo/laravel5-example) for Laravel 5.3 with big code cleaning and refactoring and application tests.

### Installation ###

* `git clone https://github.com/bestmomo/laravel5-3-example.git projectname`
* `cd projectname`
* `composer install`
* `touch database/database.sqlite`
* Copy *.env.example* to *.env*; set DB_DATABASE to the absolute path of the file created above
* `php artisan key:generate`
* `php artisan migrate --seed` to create and populate tables
* Edit *.env* for emails configuration
* Optionaly `npm install` to manage assets

### Include ###

* [Bootstrap](http://getbootstrap.com) for CSS and jQuery plugins
* [Font Awesome](http://fortawesome.github.io/Font-Awesome) for the nice icons
* [Highlight.js](https://highlightjs.org) for highlighting code
* [Startbootstrap](http://startbootstrap.com) for the free templates
* [CKEditor](http://ckeditor.com) the great editor
* [Elfinder](https://github.com/Studio-42/elFinder) the nice file manager
* [laravel-lipsum](https://github.com/magyarjeti/laravel-lipsum) for the lipsum generator
* [Laravel Collective](https://laravelcollective.com/) for Forms and Html 

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
* Use of new notifications to send emails

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
