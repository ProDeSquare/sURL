# sURL

sURL is an URL Shortener made with Laravel Jetstream intended to be deployed on short domains.

### Installation
Copy `.env.example` to `.env` and fill in database details in `.env` file.
```shell
$ cp .env.example .env
```

Follow these steps then
```shell
$ composer install # install composer dependencies
$ php artisan key:generate # generate application key
$ php artisan migrate # migrate database tables
$ php artisan storage:link # link storage to public directory
$ npm install # install npm dependencies
$ npm run dev # compile js and css resources
```

### Donate
- Bitcoin: `18Hd1waYh5uG6nWRboXGD3Q3vaPzWRMgQH`
- Ethereum: `0x90b3f1495724e9e6a18372cb939df1d7166337b9`

### Contributors
[Hamza Mughal](https://prodesquare.com)
