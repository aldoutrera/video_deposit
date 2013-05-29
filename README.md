###USAGE

All you need to do is to add the youtube video url, if the video is valid and not already registered, it will be added.

The web app would get some data for the video, like the title, thumbnail, user who updated the video, etc. If the user who
uploaded the video is already created, the video will be added, but if not, the user will be created first.

It's possible to browse the videos through the video page or by the user who uploaded it.

No user login is in place, because I wanted to keep the app very simple, but It can be added without much problem

###INSTALLATION

- Create a virtual server or set the webroot directory to the public folder

###CONFIG

- application/config/database.php To modify the database settings
- application/config/cache.php To modify the cache settings

###SQL

- The database.sql file contains the code to build the database

###REQUIREMENTS

- At least PHP 5.3 with support for Mcrypt and FileInfo.
- MySQL Server
- Memcached server
- Apache webserver with mod_rewrite enabled

###BUILT WITH

- Vagrant: For building the development enviroment
- Laravel: PHP Framework
- Grunt: Nodejs task manager, I used it to concatenate and minify the
  js and css files
- Bootstrap: To build the site structure

###TESTED ON

- Ubuntu 12.04
- Apache 2.2.22
- PHP 5.3.10
- Memcached 1.0.2
- MySQL 5.5.31
- Laravel 3.2.14

###OPTIMIZATIONS

- JS and CSS files minified and concatenated to reduce http requests
- Far future expires, browsers will use the cache version of the
  images, css, js, etc instead of re-downloading them.
- If the webserver has the mod_deflate enabled, all the web app will be gzip'd
- Using server cache to store the results of the database queries to reduce
  the server load
