# ALiNE GLOBAL Employee QR Profile System

A professional digital employee profile system for ALiNE GLOBAL. Employees get a unique public profile with a QR code that can be printed on business cards. When scanned, the QR code opens the employee's digital profile.

## Features

- 🎫 **QR Code Generation** - Unique QR code for each employee profile
- 👤 **Public Digital Profiles** - Mobile-first, professional employee profiles
- 📱 **Contact Actions** - Call, WhatsApp, Email, and Save Contact buttons
- 🏢 **Company Management** - Manage company information and offices
- 👨‍💼 **Employee Management** - Admin panel for managing all employees
- 📊 **Scan Analytics** - Track profile views and scan counts
- 💾 **vCard Export** - Download employee details as contact file
- 🔒 **Role-Based Access** - Admin authentication and permissions
- 🌐 **Railway Deployment** - Ready for cloud deployment

## Tech Stack

- **Laravel 12** - Web framework
- **Filament Admin Panel** - Admin dashboard
- **PostgreSQL** - Database (production)
- **SQLite** - Database (local development)
- **Tailwind CSS** - Responsive UI styling
- **SimpleSoftwareIO/QR Code** - QR code generation
- **Blade** - Template engine

## Local Installation

### Prerequisites

- PHP 8.3 or higher
- Composer
- Node.js and npm
- Git

### Quick Start

1. **Clone and Install**
   ```bash
   cd "d:\Aline Global\alineglobal-employee"
   composer install
   npm install
   ```

2. **Setup Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Database & Seed**
   ```bash
   php artisan migrate --seed
   ```

4. **Build Assets & Link Storage**
   ```bash
   npm run build
   php artisan storage:link
   ```

5. **Start Server**
   ```bash
   php artisan serve
   ```

Access the app at `http://localhost:8000`

## Admin Panel

- **URL**: http://localhost:8000/admin
- **Email**: `admin@alineglobalbd.com`
- **Password**: `password`

⚠️ Change password immediately after login!

## Public Employee Profile Routes

- Profile: `/e/{slug}` - Example: `/e/bijit-das`
- vCard Download: `/e/{slug}/vcard`
- Home: `/` - Redirects to company website

## Key Features

### QR Code System

Each employee gets an auto-generated QR code containing only the profile URL:
```
https://employee.alineglobalbd.com/e/bijit-das
```

Download from the admin panel by clicking **Download QR** on any employee record.

### Admin Functions

**Companies**
- Add/edit company info, logo, offices
- Manage social links
- Activate/deactivate company

**Employees**
- Add/edit employees
- Upload photos
- Configure visibility settings
- Download QR codes
- View public profile
- Track scan statistics

**Users**
- Manage admin accounts
- Create/edit/delete users

### Visibility Controls

For each employee, control what appears on the public profile:
- Phone number
- WhatsApp
- Email
- Photo
- Company address

### Profile Analytics

Track:
- Total profile scans (scan_count)
- Last scanned date/time
- Visitor IP (hashed, not stored raw)
- User agent
- Referrer source

## Database

### Key Tables

**companies** - Store company information  
**employees** - Employee records with visibility flags  
**profile_views** - Track each profile visit with hashed IP

SoftDeletes enabled on employees for data safety.

## Testing

```bash
php artisan test tests/Feature/EmployeeProfileTest.php
```

Tests cover:
- ✅ Active profiles display correctly
- ✅ Inactive profiles show unavailable
- ✅ vCard downloads work
- ✅ Scan count increments
- ✅ Hidden fields respected

## Railway Deployment

### Setup

1. Create Railway project
2. Connect GitHub repo
3. Add PostgreSQL service
4. Set environment variables
5. Configure custom domain (employee.alineglobalbd.com)

### Environment Variables

```
APP_NAME=ALiNE Employee Profile
APP_ENV=production
APP_KEY=base64:...
APP_DEBUG=false
APP_URL=https://employee.alineglobalbd.com
DB_CONNECTION=pgsql
FILESYSTEM_DISK=public
```

### Deploy Commands

```bash
php artisan migrate --force
php artisan db:seed --force
php -S 0.0.0.0:$PORT -t public
```

## Security

✅ Admin routes protected  
✅ IP addresses hashed (SHA-256)  
✅ Rate limiting on public routes (30/min)  
✅ Soft deletes for employees  
✅ Automatic HTML escaping  
✅ Only active employees visible  

## Sample Data

Default seeder creates:
- **Company**: ALiNE GLOBAL with all office info
- **Employee**: Bijit Das (Brand Acquisition Manager)
- **Admin**: admin@alineglobalbd.com / password

## File Uploads

- **Logos**: `/storage/companies/`
- **Photos**: `/storage/employees/`

Requires `php artisan storage:link`

## Troubleshooting

**404 on /admin**  
Check `bootstrap/providers.php` includes AdminPanelProvider

**Photos not showing**  
Run `php artisan storage:link`

**Database errors**  
Local: Ensure `DB_CONNECTION=sqlite`  
Production: Check PostgreSQL credentials

## Support

- **Email**: info@alineglobalbd.com
- **Website**: https://www.alineglobalbd.com
- **Bangladesh**: Borak Mehnur, 51/B, Kemal Ataturk Avenue, Banani, Dhaka-1213
- **UK**: 167-169 Great Portland Street, 5th Floor, London W1W 5PF

## License

© ALiNE GLOBAL - All rights reserved
