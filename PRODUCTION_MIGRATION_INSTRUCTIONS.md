# Production Migration Instructions

## Step 1: Run Migration on Production Server

SSH into your production server and execute the following commands:

```bash
# Navigate to your Laravel project directory
cd /home/skylandconstruction-registration/htdocs/registration.skylandconstruction.com/skyland_registration

# Run the migration to add user_type columns
php artisan migrate

# Verify the migration was successful
php artisan migrate:status
```

## Expected Output

You should see something like:
```
INFO  Running migrations.  
2025_09_13_140351_add_user_type_fields_to_users_table ........................ DONE
```

## Step 2: Verify Database Changes

The migration will add these columns to the `users` table:
- `user_type` (enum: 'admin', 'client', 'supplier') 
- `client_id` (foreign key to clients table)
- `supplier_id` (foreign key to vendors table)

## Step 3: Test the Complete System

After the migration runs successfully:

### Test Client Registration:
1. Go to: `https://registration.skylandconstruction.com/client`
2. Fill out and submit the form
3. Check email for login instructions
4. Login at: `https://registration.skylandconstruction.com/login`
5. Should redirect to client dashboard

### Test Supplier Registration:
1. Go to: `https://registration.skylandconstruction.com/supplier`
2. Fill out and submit the form  
3. Check email for login instructions
4. Login at: `https://registration.skylandconstruction.com/login`
5. Should redirect to supplier dashboard

## What Each User Will Receive

### Email Login Instructions:
- **Email**: Their registration email address
- **Password**: The password they created during registration
- **Login URL**: https://registration.skylandconstruction.com/login
- **Dashboard**: Read-only view of their registration details

## Troubleshooting

### If migration fails:
- Check database permissions
- Ensure Laravel can connect to the database
- Check for any conflicting column names

### If login doesn't work:
- Verify migration ran successfully
- Check that users table has the new columns
- Test with a fresh registration

## Features After Migration

✅ **Registration Forms**: Client and Supplier forms work perfectly
✅ **User Account Creation**: Automatic user accounts created on registration
✅ **Email Notifications**: Welcome emails with login instructions
✅ **Login System**: Users can login with their registration credentials
✅ **Dashboard Access**: Read-only view of registration details
✅ **Role-based Routing**: Clients see client dashboard, suppliers see supplier dashboard
✅ **Admin Access**: Admins still have access to admin dashboard

## Security Notes

- All passwords are properly hashed
- Users can only view their own registration data
- Registration data is read-only (users cannot modify it)
- Session management handled by Laravel
- CSRF protection enabled for all forms
