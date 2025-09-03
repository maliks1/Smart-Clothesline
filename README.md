# Smart Clothesline

A modern web application built with Laravel for managing smart clothesline systems.

## Description

Smart Clothesline is a web-based application that provides an interface for monitoring and controlling automated clothesline systems. This project leverages the power of Laravel framework to deliver a robust and scalable solution.

## Features

- 🌐 Web-based interface for clothesline management
- ⚡ Built with Laravel 12 for robust backend functionality
- 🎨 Modern frontend with Tailwind CSS
- 📱 Responsive design for mobile and desktop
- 🔧 Real-time monitoring capabilities
- 🛡️ Secure authentication system

## Tech Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade Templates, Tailwind CSS 4.0
- **Build Tool**: Vite
- **Testing**: Pest PHP
- **Package Manager**: Composer, NPM

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL/PostgreSQL/SQLite

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd Smart-Clothesline
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure your database**
   - Update database settings in `.env` file
   - Create your database

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Build assets**
   ```bash
   npm run build
   ```

## Development

### Running the application

**Option 1: Development server (recommended)**
```bash
composer run dev
```
This command starts the PHP server, queue worker, and Vite dev server concurrently.

**Option 2: Manual setup**
```bash
# Terminal 1: Start PHP server
php artisan serve

# Terminal 2: Start Vite dev server
npm run dev

# Terminal 3: Start queue worker (if needed)
php artisan queue:work
```

### Building for production

```bash
npm run build
```

### Running tests

```bash
composer run test
# or
php artisan test
```

### Code formatting

```bash
vendor/bin/pint
```

## Project Structure

```
Smart-Clothesline/
├── app/                    # Application logic
│   ├── Http/Controllers/   # Controllers
│   ├── Models/            # Eloquent models
│   └── Providers/         # Service providers
├── config/                # Configuration files
├── database/              # Migrations, seeders, factories
├── public/                # Public assets
├── resources/             # Views, CSS, JS
├── routes/                # Route definitions
├── tests/                 # Test files
└── storage/               # Logs, cache, uploads
```

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## Code Style

This project follows PSR-12 coding standards. Use Laravel Pint for code formatting:

```bash
vendor/bin/pint
```

## Testing

Run the test suite with:

```bash
php artisan test
```

For continuous testing:

```bash
php artisan test --watch
```

## Deployment

1. Set up your production environment
2. Configure your `.env` file for production
3. Install dependencies:
   ```bash
   composer install --optimize-autoloader --no-dev
   npm ci
   npm run build
   ```
4. Run migrations:
   ```bash
   php artisan migrate --force
   ```
5. Cache configuration:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

If you encounter any issues or have questions, please file an issue on the GitHub repository.

---

**Built with ❤️ using Laravel**
