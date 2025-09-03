# Smart Clothesline 🌟

A modern, intelligent web application built with Laravel for monitoring and controlling smart clothesline systems. Experience seamless automation with real-time monitoring, weather integration, and intelligent drying optimization.

## Description

Smart Clothesline is an innovative IoT-enabled web application that revolutionizes the way you manage your clothesline system. Built on Laravel's robust foundation, it provides a comprehensive dashboard for monitoring drying conditions, automating clothesline operations, and optimizing energy usage based on weather patterns and usage statistics.

## Features

### Core Functionality
- 🌐 **Smart Dashboard**: Centralized web interface for complete clothesline management
- 🔄 **Real-time Monitoring**: Live status updates and system health monitoring
- 🌤️ **Weather Integration**: Automatic weather-based decision making
- ⚡ **Automation Rules**: Intelligent drying optimization and scheduling
- 📊 **Analytics & Statistics**: Weekly usage patterns and performance insights
- 🔔 **Smart Notifications**: Alerts for optimal drying conditions

### Technical Features
- ⚡ **Laravel 12**: Robust backend with modern PHP 8.2+ features
- 🎨 **Tailwind CSS 4.0**: Utility-first responsive design
- 📱 **Mobile-First**: Optimized for all device sizes
- 🛡️ **Secure Authentication**: Laravel's built-in security features
- 🚀 **High Performance**: Server-side rendering with optimized caching
- 🔧 **Developer-Friendly**: PSR-12 standards with comprehensive testing

## Tech Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade Templates, Tailwind CSS 4.0
- **Build Tool**: Vite
- **Testing**: Pest PHP
- **Package Manager**: Composer, NPM

## System Requirements

### Server Requirements
- **PHP**: 8.2 or higher with extensions:
  - BCMath PHP Extension
  - Ctype PHP Extension
  - cURL PHP Extension
  - DOM PHP Extension
  - Fileinfo PHP Extension
  - JSON PHP Extension
  - Mbstring PHP Extension
  - OpenSSL PHP Extension
  - PCRE PHP Extension
  - PDO PHP Extension
  - Tokenizer PHP Extension
  - XML PHP Extension

### Development Tools
- **Composer**: Latest stable version
- **Node.js**: 18.x or higher
- **NPM**: 8.x or higher

### Database Support
- **MySQL**: 8.0+ (recommended)
- **PostgreSQL**: 13+ 
- **SQLite**: 3.35+
- **MariaDB**: 10.6+

### Optional
- **Redis**: For enhanced caching and session management
- **Supervisor**: For queue management in production

## Quick Start Installation

### 1. Clone & Setup
```bash
git clone <repository-url>
cd Smart-Clothesline
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Environment Configuration
```bash
# Copy environment file
copy .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup
```bash
# Create your database first, then update .env with your database credentials:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=smart_clothesline
# DB_USERNAME=your_username
# DB_PASSWORD=your_password

# Run migrations
php artisan migrate

# Optional: Seed with sample data
php artisan db:seed
```

### 5. Build Assets & Start Development
```bash
# Build frontend assets
npm run build

# Clear any cached configurations
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Start the development server
php artisan serve
```

🎉 **Visit** `http://localhost:8000` to access your Smart Clothesline dashboard!

## Development Workflow

### Quick Development Start
```bash
# Option 1: Single command (if configured)
composer run dev

# Option 2: Manual setup (recommended for debugging)
# Terminal 1: Laravel development server
php artisan serve

# Terminal 2: Vite dev server (hot reload)
npm run dev

# Terminal 3: Queue worker (for background jobs)
php artisan queue:work
```

### Available NPM Scripts
```bash
npm run dev          # Start Vite dev server with hot reload
npm run build        # Build assets for production
npm run preview      # Preview production build locally
```

### Testing & Code Quality
```bash
# Run all tests
php artisan test

# Run tests with coverage
php artisan test --coverage

# Watch mode for continuous testing
php artisan test --watch

# Code formatting (PSR-12)
vendor/bin/pint

# Dry run formatting check
vendor/bin/pint --test
```

### Debugging & Monitoring
```bash
# View application logs
tail -f storage/logs/laravel.log

# Clear all caches during development
php artisan optimize:clear

# Check application status
php artisan about
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

## Production Deployment

### Pre-Deployment Checklist
- [ ] Set `APP_ENV=production` and `APP_DEBUG=false` in `.env`
- [ ] Configure production database credentials
- [ ] Set up SSL certificates
- [ ] Configure mail settings for notifications
- [ ] Set up backup strategy

### Deployment Steps

#### 1. Environment Setup
```bash
# Copy and configure production environment
cp .env.example .env
# Edit .env with production settings
```

#### 2. Install Dependencies
```bash
# Install optimized PHP dependencies
composer install --optimize-autoloader --no-dev --no-interaction

# Install and build frontend assets
npm ci --production
npm run build
```

#### 3. Database & Optimization
```bash
# Run migrations (use --force in production)
php artisan migrate --force

# Cache everything for performance
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

#### 4. Security & Performance
```bash
# Set proper permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

# Generate application key (if not set)
php artisan key:generate --force
```

### Web Server Configuration

**Apache (.htaccess)**
```apache
RewriteEngine On
RewriteCond %{REQUEST_URI} !^/public/
RewriteRule ^(.*)$ /public/$1 [L]
```

**Nginx**
```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/Smart-Clothesline/public;
    
    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    
    index index.php;
    
    charset utf-8;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }
    
    error_page 404 /index.php;
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## Troubleshooting

### Common Issues

#### Cache Path Errors
```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Rebuild cache
php artisan config:cache
```

#### Permission Issues
```bash
# Fix storage permissions (Linux/macOS)
sudo chmod -R 755 storage bootstrap/cache
sudo chown -R $USER:www-data storage bootstrap/cache
```

#### Database Connection Issues
- Verify database credentials in `.env`
- Ensure database server is running
- Check firewall settings
- Verify PHP PDO extensions are installed

### Performance Optimization

```bash
# Enable OPcache in production
# Add to php.ini:
# opcache.enable=1
# opcache.memory_consumption=128
# opcache.interned_strings_buffer=8
# opcache.max_accelerated_files=4000

# Use Redis for sessions and cache (optional)
# Update .env:
# CACHE_STORE=redis
# SESSION_DRIVER=redis
```

## Contributing

We welcome contributions! Please follow these guidelines:

### Development Process
1. Fork the repository
2. Create a feature branch: `git checkout -b feature/amazing-feature`
3. Make your changes following PSR-12 standards
4. Add tests for new functionality
5. Run the test suite: `php artisan test`
6. Format code: `vendor/bin/pint`
7. Commit changes: `git commit -m 'Add amazing feature'`
8. Push to branch: `git push origin feature/amazing-feature`
9. Open a Pull Request

### Code Standards
- Follow PSR-12 coding standards
- Write comprehensive tests
- Document new features
- Use semantic commit messages

## License

This project is open-sourced software licensed under the [MIT License](https://opensource.org/licenses/MIT).

## Support & Community

- 📖 **Documentation**: Check the `/docs` directory for detailed guides
- 🐛 **Bug Reports**: [Create an issue](https://github.com/your-repo/Smart-Clothesline/issues)
- 💡 **Feature Requests**: [Discussion board](https://github.com/your-repo/Smart-Clothesline/discussions)
- 📧 **Email**: support@smart-clothesline.com

---

<div align="center">

**Built with ❤️ using Laravel & Modern Web Technologies**

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind](https://img.shields.io/badge/Tailwind-4.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-Latest-646CFF?style=for-the-badge&logo=vite&logoColor=white)

</div>
