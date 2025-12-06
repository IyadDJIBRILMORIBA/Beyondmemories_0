#!/bin/sh
set -e

echo "🚀 Starting Beyondmemories backend..."

# Wait a bit for the filesystem to be ready
sleep 2

# Ensure database directory exists
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite

# Ensure storage directories exist
mkdir -p /var/www/html/storage/app/public/memories
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/storage/framework/{sessions,views,cache}

# Ensure tmp directory has correct permissions for PHP uploads
mkdir -p /tmp
chmod 1777 /tmp

# Create Nginx temp directories with correct permissions
mkdir -p /var/lib/nginx/tmp/client_body
mkdir -p /var/lib/nginx/tmp/proxy
mkdir -p /var/lib/nginx/tmp/fastcgi
mkdir -p /var/lib/nginx/tmp/uwsgi
mkdir -p /var/lib/nginx/tmp/scgi
chown -R www-data:www-data /var/lib/nginx/tmp
chmod -R 755 /var/lib/nginx/tmp

# Set proper permissions
chown -R www-data:www-data /var/www/html/database /var/www/html/storage
chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Run migrations
echo "📦 Running database migrations..."
php artisan migrate --force || echo "⚠️ Migrations failed, database might already be initialized"

# Run seeders to create default user
echo "🌱 Running database seeders..."
php artisan db:seed --force || echo "⚠️ Seeders failed or already run"

# Create storage symlink
echo "🔗 Creating storage symlink..."
php artisan storage:link || echo "⚠️ Symlink already exists"

# Cache config for better performance
echo "⚡ Optimizing Laravel..."
php artisan config:cache || true
php artisan route:cache || true

echo "✅ Backend initialized successfully!"

# Start supervisord
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
