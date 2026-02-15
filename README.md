# Livewire App

Laravel 12 application using Livewire 4 and Flux UI Free.

## Requirements

- PHP 8.4.16
- Composer
- Node.js + npm
- A database supported by Laravel

## Setup

1. Install PHP dependencies:

```bash
composer install
```

2. Install Node dependencies:

```bash
npm install
```

3. Create environment file:

```bash
Copy-Item .env.example .env
```

4. Generate application key:

```bash
php artisan key:generate
```

5. Configure your database in `.env`, then run migrations:

```bash
php artisan migrate
```

6. Build assets (or run the dev server):

```bash
npm run dev
```

## Testing

```bash
php artisan test --compact
```

## Formatting

```bash
vendor/bin/pint --dirty --format agent
```
