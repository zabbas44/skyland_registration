# Chat System - Production Deployment Commands

## 🚀 **ESSENTIAL COMMANDS FOR SERVER DEPLOYMENT**

### **1. Database Migration Commands**
```bash
# Run the new chat system migrations
php artisan migrate

# If you need to refresh (CAUTION: This will drop all data)
php artisan migrate:fresh --seed
```

### **2. Storage & Permissions Setup**
```bash
# Create necessary storage directories
mkdir -p storage/app/chat-attachments
mkdir -p storage/app/temp-attachments

# Set proper permissions (adjust based on your server setup)
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/

# Create storage link if not exists
php artisan storage:link
```

### **3. Cache & Optimization Commands**
```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### **4. Composer Dependencies** 
```bash
# Install/update dependencies (production mode)
composer install --no-dev --optimize-autoloader

# Or if you need dev dependencies for debugging
composer install
```

### **5. File Permissions (Linux/Unix servers)**
```bash
# Set ownership (replace 'www-data' with your web server user)
sudo chown -R www-data:www-data storage/
sudo chown -R www-data:www-data bootstrap/cache/

# Set permissions
sudo chmod -R 755 storage/
sudo chmod -R 755 bootstrap/cache/
```

---

## 📋 **STEP-BY-STEP DEPLOYMENT PROCESS**

### **Step 1: Backup Current Database**
```bash
# For SQLite
cp database/database.sqlite database/database_backup_$(date +%Y%m%d_%H%M%S).sqlite

# For MySQL (adjust credentials)
mysqldump -u username -p database_name > backup_$(date +%Y%m%d_%H%M%S).sql
```

### **Step 2: Pull Latest Code**
```bash
# Pull from your repository
git pull origin main
# or
git pull origin master
```

### **Step 3: Run Migration & Setup**
```bash
# Install dependencies
composer install --no-dev --optimize-autoloader

# Run migrations (this adds the new chat tables)
php artisan migrate

# Create storage directories
mkdir -p storage/app/chat-attachments
mkdir -p storage/app/temp-attachments

# Set permissions
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

### **Step 4: Clear & Cache**
```bash
# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Cache for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### **Step 5: Restart Services**
```bash
# Restart web server (choose your server)
sudo systemctl restart nginx
# or
sudo systemctl restart apache2

# Restart PHP-FPM if using it
sudo systemctl restart php8.2-fpm
# or
sudo systemctl restart php-fpm
```

---

## 🔧 **ENVIRONMENT CONFIGURATION**

### **Required .env Settings**
```env
# Mail Configuration (for chat notifications)
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-email@domain.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@domain.com
MAIL_FROM_NAME="SKYLAND"

# File Upload Limits
UPLOAD_MAX_FILESIZE=10M
POST_MAX_SIZE=10M

# App Settings
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

### **Web Server Configuration**

#### **Nginx Configuration Addition**
```nginx
# Add to your server block
client_max_body_size 10M;

# For file uploads
location ~ ^/chat/upload-attachment {
    client_max_body_size 10M;
    try_files $uri $uri/ /index.php?$query_string;
}
```

#### **Apache Configuration Addition**
```apache
# Add to .htaccess or virtual host
LimitRequestBody 10485760
php_value upload_max_filesize 10M
php_value post_max_size 10M
php_value max_execution_time 300
```

---

## 🗄️ **DATABASE CHANGES SUMMARY**

The following new tables will be created:
- `chat_conversations` - Stores conversation metadata
- `chat_messages` - Stores individual messages
- `chat_attachments` - Stores file attachment information

**No existing data will be affected** - these are purely additive migrations.

---

## ✅ **VERIFICATION COMMANDS**

### **Test Database Connection**
```bash
php artisan migrate:status
```

### **Test Chat Routes**
```bash
php artisan route:list | grep chat
```

### **Test File Permissions**
```bash
ls -la storage/app/
ls -la storage/app/chat-attachments/
```

### **Test Email Configuration**
```bash
php artisan tinker
# Then run:
Mail::raw('Test email', function($message) {
    $message->to('test@example.com')->subject('Test');
});
```

---

## 🚨 **TROUBLESHOOTING**

### **Common Issues & Solutions**

#### **Permission Denied Errors**
```bash
sudo chown -R www-data:www-data storage/
sudo chmod -R 755 storage/
```

#### **Migration Errors**
```bash
# Check migration status
php artisan migrate:status

# Rollback if needed
php artisan migrate:rollback

# Re-run migrations
php artisan migrate
```

#### **File Upload Issues**
```bash
# Check PHP limits
php -i | grep upload_max_filesize
php -i | grep post_max_size

# Check storage permissions
ls -la storage/app/
```

#### **Route Not Found Errors**
```bash
php artisan route:clear
php artisan route:cache
```

---

## 🔄 **ROLLBACK PLAN (If Needed)**

If something goes wrong, you can rollback:

```bash
# Rollback chat migrations
php artisan migrate:rollback --step=3

# Restore database backup
cp database/database_backup_YYYYMMDD_HHMMSS.sqlite database/database.sqlite

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 📱 **POST-DEPLOYMENT TESTING**

1. **Login as Admin** → Check if "Chat" appears in sidebar
2. **Login as Approved Client/Vendor** → Check if "Chat" button appears on dashboard
3. **Test New Conversation** → Admin should be able to start new chats
4. **Test File Upload** → Try uploading a small file in chat
5. **Test Email Notifications** → Send a message and check email delivery

---

## 🎯 **MINIMAL DEPLOYMENT (If you want to be extra safe)**

If you want to deploy step by step:

```bash
# 1. Just run migrations first
php artisan migrate

# 2. Test the site still works
# 3. Then clear caches
php artisan cache:clear
php artisan route:clear

# 4. Test again
# 5. Then optimize
php artisan config:cache
php artisan route:cache
```

---

**🎉 That's it! Your chat system should be live and ready to use!**

**Need help?** Check the troubleshooting section or contact support.
