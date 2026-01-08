#!/bin/bash

echo "🚀 Setting up Skill Swap Hub..."

# Install PHP extensions for SQLite
sudo apt-get update
sudo apt-get install -y php8.2-sqlite3

# Install Composer dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-interaction --prefer-dist

# Install Node dependencies
echo "📦 Installing Node dependencies..."
npm install

# Setup environment
echo "⚙️ Setting up environment..."
if [ ! -f .env ]; then
    cp .env.example .env
    php artisan key:generate
fi

# Create SQLite database
echo "🗄️ Setting up database..."
touch database/database.sqlite
php artisan migrate --force
php artisan db:seed --force

# Build frontend assets
echo "🎨 Building frontend assets..."
npm run build

# Set permissions
chmod -R 775 storage bootstrap/cache

echo "✅ Setup complete!"
echo ""
echo "To start the development server, run:"
echo "  php artisan serve --host=0.0.0.0 --port=8000"
echo ""
echo "Or for development with hot reload:"
echo "  npm run dev & php artisan serve --host=0.0.0.0 --port=8000"