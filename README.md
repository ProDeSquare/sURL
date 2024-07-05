# sURL

**sURL** is an URL Shortener made with **Laravel Jetstream** using **Inertia.js** intended to be deployed on short domains.

![Screenshot](https://cdn.prodesquare.com/gh/img/sURL.jpg)

### Installation

#### Prerequisites:
- **PHP** v8 along with **composer**
- **Node.js** along with **PNPM**
- **MySQL** or **MariaDB**

Copy `.env.example` to `.env` and fill in database details in `.env` file.
```shell
$ cp .env.example .env
```

#### Follow these steps then
```shell
$ composer install # install composer dependencies
$ php artisan key:generate # generate application key
$ php artisan storage:link # link storage to public directory
$ pnpm install # install node dependencies
```

In `.env` file, fill in the database and mail configuration details
```env
# database details
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=surl
DB_USERNAME=hamza
DB_PASSWORD=1234
```

sURL requires email verification for registration and password reset processes, this is also a required step that'll help with registration and password resets.
```env
# mail config
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
```

After filling in the database details, run database migrations
```shell
$ php artisan migrate # migrate database tables
```

#### Serve the app with
```shell
$ pnpm run dev # compile js and css resources
$ php artisan serve # serve the application
```

### Deployment
Optimizing for production is straightforward, you need to run the following commands to optimize the app.
```shell
$ php artisan optimize # cache config, views and routes
$ pnpm run build # minify compiled javascript
$ composer dump-autoload # optimize composer
```

### Compatibility and Tested Environments
**sURL** is tested and verified to work seamlessly with/on:
- PHP v8.3.9
- Composer v2.7.7
- MariaDB v11.4.2
- Node.js v22.3.0
- PNPM v9.1.0
- Arch GNU/Linux

### License
**sURL** is licensed under **GNU General Public License v3.0**, check [LICENSE](./LICENSE) file for more info.

### Donate
- Bitcoin: `18Hd1waYh5uG6nWRboXGD3Q3vaPzWRMgQH`
- Ethereum: `0x90b3f1495724e9e6a18372cb939df1d7166337b9`

### Contributors
Coded with `<Love />` by **[Hamza The ProDeSquare Mughal](https://prodesquare.com)** on **VS Codium** using the **[Marine Dark](https://surl.prodesquare.com/l/marine-dark-marketplace)** theme.

#### Links:
- [Portfolio](https://prodesquare.com)
- [Email Address](mailto:hamza@prodesquare.com)
