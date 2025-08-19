# Spect2 – Equipment Specifications Publishing System

This repository contains resources and documentation for **Spect2**, the **Equipment Specifications Publishing System** used by the Royal Irrigation Department (RID).  
The system is designed to publish, search, and manage official equipment specification documents for internal use.

## Overview
Spect2 is an internal **intranet-based application** that enables staff to:
- Publish official equipment specification (SPEC) documents.
- Search and view documents by department or keyword.
- Upload new specifications and update existing ones.
- Organize equipment into categories and subcategories.

The system supports PDF uploads, detailed metadata entry, and document visibility controls.

---

## System Features
- **Search by department or keyword** for faster access to specifications.
- **View and download** official SPEC documents in PDF format.
- **Add, edit, or delete equipment data** through an intuitive interface.
- **Manage categories and subcategories** for better document organization.
- **Control document visibility** (show/hide in the published list).
- **Secure login** for authorized users.

---

## 🛠️ Technology Stack
- **Framework:** [CodeIgniter 4](https://codeigniter.com/)
- **Backend:** PHP 8+ (via XAMPP)
- **Database:** MySQL (MariaDB in XAMPP)
- **Frontend:** HTML, CSS, JavaScript (with Bootstrap)

---

## ⚙️ Installation

### 1. Clone the repository
```bash
git clone https://github.com/PongkunSK/Goods_Projects.git
cd Goods_Projects
```


### 2. Install dependencies
Make sure you have Composer installed:
```bash
composer install
```


### 3. Configure environment
Copy the example environment file and set your configuration:
```bash
cp env .env
```

Then edit .env:
```ini
CI_ENVIRONMENT = development

database.default.hostname = localhost
database.default.database = goods
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306
```


### 4. Set writable permissions
Ensure the following folders are writable:
```
writable/
```


### 5. Import the database from database folder
Create a new database in MySQL (via phpMyAdmin or CLI):
```sql
CREATE DATABASE spect2_db CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
```

Then import the provided SQL dump file:
```bash
mysql -u root -p goods < database/goods.sql
```
The database/goods.sql file contains all required tables and seed data.


### 6. Run the application
Start the development server:
```bash
php spark serve
```
Access the system at:
```
http://localhost:8080/spec
```

### Project Structure
```php
app/            # Application code (Controllers, Models, Views, Config)
public/         # Publicly accessible files (index.php, assets)
writable/       # Logs, cache, session data
database/       # SQL schema and migration files
```

### User Roles
Admin: Manage categories, documents, and user accounts.
Staff: Upload and manage equipment specifications.
Viewer: Search and download published documents.

### Security Notes
Change the default database username/password before deploying.
Use HTTPS for production environments.
Ensure proper access control for sensitive documents.

### 📜 License
This project is developed for the Royal Irrigation Department (RID).
Usage outside the RID requires permission.
