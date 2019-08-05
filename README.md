Acme Gif Searcher
=
The application is made of two parts: webapp (Vue) and backend (Laravel API).

Webapp live demo: http://acme-gif-searcher-webapp.sg8iabcwyc.sa-east-1.elasticbeanstalk.com/

Live API demo: http://acme-gif-searcher.sg8iabcwyc.sa-east-1.elasticbeanstalk.com/api/

Webapp
-
This is my first project with Vue.JS.

```
git clone https://github.com/cesarkohl/acme-gif-searcher-webapp.git
cd acme-gif-searcher-webapp
npm install
npm run serve
```

Backend
-
I've been working with PHP since 2010 and done my first project using Laravel in 2016.

```
git clone https://github.com/cesarkohl/acme-gif-searcher-backend.git
cd acme-gif-searcher-backend
npm install
composer install
php artisan serve
```

If you change the .env DB_{} variables the following command is mandatory after database installation and configuration:
```
php artisan passport:install
```

I will be waiting your considerations.

Best,

Cesar 
