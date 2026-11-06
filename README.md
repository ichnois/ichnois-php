# Official Ichnois SDK for PHP

[![Latest Stable Version](https://poser.pugx.org/ichnois/ichnois/v/stable)](https://packagist.org/packages/ichnois/ichnois)
[![Total Downloads](https://poser.pugx.org/ichnois/ichnois/downloads)](https://packagist.org/packages/ichnois/ichnois)
[![License](https://poser.pugx.org/ichnois/ichnois/license)](https://packagist.org/packages/ichnois/ichnois)

The **Ichnois PHP SDK** provides real-time error tracking, crash reporting, and distributed tracing for PHP applications, connected directly to the [Ichnois Cloud Ingestion Gateway](https://ichnois-h2jw.onrender.com).

---

## 🚀 Getting Started

### 1. Installation

Install the package via [Composer](https://getcomposer.org/):

```bash
composer require ichnois/ichnois
```

---

### 2. Configuration & Initialization

Initialize the SDK as early as possible in your application's bootstrap lifecycle:

```php
use Ichnois\Ichnois;

Ichnois::init([
    'dsn' => 'https://<public_key>@ichnois-h2jw.onrender.com/api/<project_id>',
    'environment' => 'production',
    'release' => '1.0.0',
]);
```

> **Environment Variables Support**: You can also configure the SDK via environment variables (`ICHNOIS_DSN`, `ICHNOIS_ENVIRONMENT`, `ICHNOIS_RELEASE`).

---

### 3. Basic Usage

#### Capturing Exceptions
```php
use Ichnois\Ichnois;

try {
    processPayment($order);
} catch (\Throwable $exception) {
    Ichnois::captureException($exception);
}
```

#### Capturing Messages & Logs
```php
use Ichnois\Ichnois;
use Ichnois\Severity;

Ichnois::captureMessage('Order #1042 processed successfully', Severity::info());
```

#### Adding Breadcrumbs
```php
use Ichnois\Ichnois;
use Ichnois\Breadcrumb;

Ichnois::addBreadcrumb(new Breadcrumb(
    Breadcrumb::LEVEL_INFO,
    Breadcrumb::TYPE_DEFAULT,
    'checkout',
    'User clicked place order'
));
```

#### Scopes & Context Enrichment
```php
use Ichnois\Ichnois;
use Ichnois\Scope;

Ichnois::configureScope(function (Scope $scope): void {
    $scope->setUser([
        'id' => '12345',
        'email' => 'user@example.com',
    ]);
    $scope->setTag('service', 'checkout-service');
});
```

---

## 🔄 Dual Namespace Compatibility

The Ichnois PHP SDK includes seamless backwards compatibility. If your application or existing third-party packages import the `Sentry\` namespace, it works out of the box without any code changes:

```php
// Existing code using Sentry namespace continues to work seamlessly:
\Sentry\init([
    'dsn' => 'https://<key>@ichnois-h2jw.onrender.com/api/<project>',
]);

\Sentry\captureException($exception);
```

---

## 🛠️ Framework Integrations

Compatible with all modern PHP frameworks:
- **Laravel / Lumen** (Supports Octane, RoadRunner, Swoole)
- **Symfony** (5.x, 6.x, 7.x)
- **WordPress, Drupal, Magento**
- **Vanilla PHP** (PHP 7.2 - 8.4)

---

## 📄 License

Licensed under the [MIT License](LICENSE).
