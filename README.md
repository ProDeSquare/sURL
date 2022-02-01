# sURL

sURL is an URL Shortener made with Laravel Jetstream intended to be deployed on short domains.

### Installation
Copy `.env.example` to `.env` and fill in database details in `.env` file.
```
cp .env.example .env
```

Follow these steps then
```
composer install # install composer dependencies
php artisan key:generate # generate application key
php artisan migrate # migrate database tables
php artisan storage:link # link storage to public directory
npm install # install npm dependencies
npm run dev # compile js and css resources
```

### Contributors
[Hamza Mughal](https://prodesquare.com)