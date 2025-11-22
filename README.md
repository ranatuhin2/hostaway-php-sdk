# 🏨 Hostaway PHP SDK

A modern PHP SDK for the [Hostaway API](https://api.hostaway.com/documentation), designed to simplify integration with Hostaway’s property management system — including reservations, listings, messages, guests, and more. 
  
---
   
## 🚀 Features   

- Clean, fluent API for all Hostaway endpoints  
- Built-in authentication with API Key  
- Full Laravel support (auto-discovery, facade, and config)  
- Pest-powered testing   
- PSR-4 compliant and publishable config 

--- 
 
## 📦 Installation

Install the package via Composer:

```bash
composer require rana-tuhin/hostaway-php-sdk
```

---

## ⚙️ Configuration

After installation, publish the configuration file:

```bash
php artisan vendor:publish --tag=hostaway-config
```

Then, set your credentials in `.env`:

```env
HOSTAWAY_API_KEY=your-hostaway-api-key
HOSTAWAY_ACCOUNT_ID=your-account-id
HOSTAWAY_BASE_URL=https://api.hostaway.com/v1/
```

Your `config/hostaway.php` will look like:

```php
return [
    'api_key' => env('HOSTAWAY_API_KEY'),
    'account_id' => env('HOSTAWAY_ACCOUNT_ID'),
    'base_url' => env('HOSTAWAY_BASE_URL', 'https://api.hostaway.com/v1/'),
];
```

### Example Usage in Laravel

```php
use Hostaway;

$listings = Hostaway::listings()->getAll();

$reservations = Hostaway::reservations()->getAll();

Hostaway::messages()->send([
    'reservationId' => 1001,
    'content' => 'Welcome to our property!',
]);
```

---

## 🧠 Usage (Standalone PHP)

You can use the client independently from Laravel too:

```php
use RanaTuhin\Hostaway\HostawayClient;

$client = new HostawayClient([
    'api_key' => 'your-api-key',
    'account_id' => 'your-account-id',
]);

$listings = $client->listings()->getAll();
$reservation = $client->reservations()->find(12345);
```

Example:

```php
$listings = $client->listings()->getAll();
$reservation = $client->reservations()->create([]);
```
