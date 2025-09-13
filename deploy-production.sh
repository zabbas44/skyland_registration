#!/bin/bash

# SKYLAND Chat System - Production Deployment Script
# Run this script on your production server

set -e  # Exit on any error

echo "🚀 Starting SKYLAND Chat System Deployment..."

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Project directory (adjust if needed)
PROJECT_DIR="/home/skylandconstruction-registration/htdocs/registration.skylandconstruction.com/skyland_registration"

echo -e "${BLUE}📂 Project Directory: $PROJECT_DIR${NC}"

# Check if we're in the right directory
if [ ! -f "$PROJECT_DIR/artisan" ]; then
    echo -e "${RED}❌ Error: artisan file not found. Please check the project path.${NC}"
    echo -e "${YELLOW}Current path: $PROJECT_DIR${NC}"
    exit 1
fi

cd "$PROJECT_DIR"

echo -e "${GREEN}✅ Found Laravel project${NC}"

# 1. Pull latest code
echo -e "${BLUE}🔄 Pulling latest code...${NC}"
git pull origin main || git pull origin master

# 2. Install/Update Composer dependencies
echo -e "${BLUE}📦 Installing Composer dependencies...${NC}"
composer install --no-dev --optimize-autoloader --no-interaction

# 3. Check if Node.js is available
if command -v npm >/dev/null 2>&1; then
    echo -e "${GREEN}✅ Node.js/npm found${NC}"
    
    # Install npm dependencies
    echo -e "${BLUE}📦 Installing npm dependencies...${NC}"
    npm install --production=false
    
    # Build assets
    echo -e "${BLUE}🏗️  Building production assets...${NC}"
    npm run build
    
    if [ -f "public/build/manifest.json" ]; then
        echo -e "${GREEN}✅ Assets built successfully${NC}"
    else
        echo -e "${YELLOW}⚠️  Warning: Manifest not found, but continuing...${NC}"
    fi
else
    echo -e "${YELLOW}⚠️  Node.js/npm not found. Using CDN fallback for CSS.${NC}"
    echo -e "${YELLOW}   Consider installing Node.js for better performance.${NC}"
fi

# 4. Run migrations
echo -e "${BLUE}🗄️  Running database migrations...${NC}"
php artisan migrate --force

# 5. Create storage directories
echo -e "${BLUE}📁 Creating storage directories...${NC}"
mkdir -p storage/app/chat-attachments
mkdir -p storage/app/temp-attachments

# 6. Set permissions
echo -e "${BLUE}🔒 Setting permissions...${NC}"
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/

# If running as root, set ownership to web server user
if [ "$EUID" -eq 0 ]; then
    echo -e "${BLUE}👤 Setting ownership to www-data...${NC}"
    chown -R www-data:www-data storage/
    chown -R www-data:www-data bootstrap/cache/
    chown -R www-data:www-data public/build/ 2>/dev/null || true
fi

# 7. Clear and cache Laravel
echo -e "${BLUE}🧹 Clearing caches...${NC}"
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo -e "${BLUE}💾 Caching for production...${NC}"
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 8. Create storage link if it doesn't exist
if [ ! -L "public/storage" ]; then
    echo -e "${BLUE}🔗 Creating storage link...${NC}"
    php artisan storage:link
fi

# 9. Verify installation
echo -e "${BLUE}🔍 Verifying installation...${NC}"

# Check if chat routes exist
if php artisan route:list | grep -q "chat.index"; then
    echo -e "${GREEN}✅ Chat routes registered${NC}"
else
    echo -e "${RED}❌ Chat routes not found${NC}"
fi

# Check if migrations ran
if php artisan migrate:status | grep -q "chat_conversations"; then
    echo -e "${GREEN}✅ Chat database tables created${NC}"
else
    echo -e "${RED}❌ Chat database tables not found${NC}"
fi

# Check storage directories
if [ -d "storage/app/chat-attachments" ]; then
    echo -e "${GREEN}✅ Chat storage directories created${NC}"
else
    echo -e "${RED}❌ Chat storage directories not found${NC}"
fi

# 10. Final success message
echo ""
echo -e "${GREEN}🎉 DEPLOYMENT COMPLETE!${NC}"
echo ""
echo -e "${BLUE}📋 Next Steps:${NC}"
echo -e "1. Visit: ${YELLOW}https://registration.skylandconstruction.com/chat${NC}"
echo -e "2. Login as admin: ${YELLOW}admin@clientsvendors.local${NC} / ${YELLOW}password123${NC}"
echo -e "3. Test the chat functionality"
echo ""
echo -e "${BLUE}📊 System Status:${NC}"
php artisan --version
echo -e "PHP Version: $(php -v | head -n 1)"
if command -v npm >/dev/null 2>&1; then
    echo -e "Node.js Version: $(node -v)"
    echo -e "npm Version: $(npm -v)"
fi
echo ""
echo -e "${GREEN}✨ Chat system is ready to use!${NC}"
