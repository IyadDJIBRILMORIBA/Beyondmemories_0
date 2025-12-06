#!/bin/sh
set -e

echo "🚀 Starting Beyondmemories backend..."

# Wait a bit for the filesystem to be ready
sleep 2

# Ensure database directory exists
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite

# Set proper permissions
chown -R www-data:www-data /var/www/html/database
chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Run migrations
echo "📦 Running database migrations..."
php artisan migrate --force || echo "⚠️ Migrations failed, database might already be initialized"

# Cache config for better performance
echo "⚡ Optimizing Laravel..."
php artisan config:cache || true
php artisan route:cache || true

echo "✅ Backend initialized successfully!"

# Start supervisord
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
