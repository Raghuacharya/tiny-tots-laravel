# tiny-tots-laravel

Tiny Tots - A Laravel-based school fee management system with PDF receipt generation and shared hosting deployment support.

## Features

- Manage students, classes, and sections
- Handle multiple fee types and payments
- Generate receipts as PDFs using DomPDF
- Email receipts to parents automatically
- Designed for shared hosting environments

## Requirements

- PHP 8.x or higher
- Composer
- MySQL or MariaDB database
- Shared hosting with SSH or File Manager access

## Developer Setup

1. Clone the repository:
```
git clone https://github.com/Raghuacharya/tiny-tots-laravel.git
cd tiny-tots-laravel
```

2. Install dependencies:
```
composer install
```

3. Copy `.env.example` to `.env` and update database, mail, and app settings:
```
cp .env.example .env
php artisan key:generate
```

4. Run migrations and seed data (optional):
```
php artisan migrate --seed
```

5. Serve locally:
```
php artisan serve
```
--or--
```
composer run dev
```



---

## Deployment on Shared Hosting

To run on shared hosting, the Laravel structure requires some adjustments:

1. Zip and upload the entire application.

2. Extract files on the server.

3. Move everything inside the `/public` folder into the `public_html` directory.

4. Create an empty folder named `public` in two locations:
- Inside `public_html`
- Outside `public_html` alongside your Laravel files

This fixes path issues with packages like DomPDF.

5. Create a folder named `laravel_app` (or any name you prefer) outside `public_html` and move all Laravel application folders and files there except the contents of `public`.

6. Modify your email receipt blade template (`laravel_app/resources/views/emails/receipt.blade.php`) to load images from the local file system rather than using URLs.
Change:
```
<img src="{{ asset('storage/' . getSchoolProfile()->logo) }}" alt="{{ getSchoolProfile()->name }}" width="120px">
```
To:
```
<img src="{{ public_path('storage/logos/pYiGe2ojlsLRzhtDatbeQ9RImW0MQPOanq11I0b4.png') }}" alt="{{ getSchoolProfile()->name }}" width="120px">
```

7. Edit `public_html/index.php` to update autoload and bootstrap paths:

From:
```
require DIR.'/../vendor/autoload.php';
$app = require_once DIR.'/../bootstrap/app.php';
```
To:
```
require DIR.'/../laravel_app/vendor/autoload.php';
$app = require_once DIR.'/../laravel_app/bootstrap/app.php';
```

8. Update the `.env` file inside the `laravel_app` directory to include:
- Your database credentials
- `APP_URL` set to your site URL
- `APP_DEBUG=false` for production

9. Set proper folder permissions for directories:
- `storage`
- `bootstrap/cache`
Use `chmod -R 775` or as your host requires.

10. If SSH is available, consider running:
 ```
 php artisan config:cache
 php artisan route:cache
 ```
 to improve performance.

11. Upload your `vendor` folder after running `composer install` locally if SSH/composer is not available on the host.

---

## Notes for Developers

- Use absolute filesystem paths in Blade views for PDFs to avoid DomPDF image loading issues.
- Mail configuration must match your hosting provider’s SMTP or sendmail settings for email functionality.
- Always test changes locally before deploying.
- Contributions and issues are welcome.

---

## License

MIT License


