# AFG Sign-In Web app ✈️

## Overview
A secure registration web application designed for flight simulation training centers. The system manages access control for crew members and visitors to ensure security compliance and track facility attendance.

## 🎯 Purpose
- **Crew Member Registration**: Mandatory sign-in for flight simulation training sessions
- **Visitor Management**: Secure registration and tracking of all facility visitors
- **Security Compliance**: Meets aviation security requirements for access control
- **Real-time Monitoring**: Live tracking of personnel within the facility

## 🚀 Features

### Authentication & Access
- Dual authentication system (Crew/Visitors)
- IP-based location detection
- Dynamic logo display based on geographic location
- Role-based access control

### Registration Management
- Visitor check-in/check-out
- Crew member registration system
- Warehouse access control (Development)
- Training session (TC Sessions) tracking

### Reporting & Monitoring
- Administrative reporting dashboard
- Real-time session filtering

## 🛠️ Technical Stack

### Backend
- **PHP** (Custom implementation)
- MySQL Database
- Custom Router System
- JSON-based configuration

### Frontend
- Custom CSS styling
- Responsive design

## 📁 Project Structure
afg-signin-laravel/
├── app/
│ ├── controllers/ # Application controllers
│ ├── models/ # Data models & configurations
│ └── views/ # View templates
├── public/
│ ├── assets/ # CSS and images
│ └── services/ # API endpoints
├── templates/ # Reusable components
├── utilities/ # Core utilities
└── config.php # Main configuration


## 🚦 Quick Start

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7+
- Web server (Apache)

### Installation
1. Clone the repository:
```bash
git clone https://github.com/alfredo-celso/afg-signin-laravel.git
cd afg-signin-laravel
Configure database connection in config.php

Set up web server to point to /public directory

Ensure proper file permissions:

bash
chmod -R 755 public/
chmod 755 templates/
⚙️ Configuration
Database Setup
Update config.php with your database credentials:

php
define('DB_HOST', 'your_database_host');
define('DB_NAME', 'your_database_name');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
IP & Country Configuration
Modify app/models/country_ip.json for IP range mappings

Update app/models/2alpha_country_code.json for country codes

🌐 Usage
For Crew Members
Navigate to the sign-in portal

Select training session type

Complete registration process

Receive confirmation

For Administrators
Access /admin-signin for admin dashboard

View reports at /admin-reports

Monitor sessions at /tc-sessions

🔧 API Endpoints
The system provides these services in /public/services/:

insert-signin-form.php - Crew registration

query-visitor-checkin.php - Visitor queries

admin-query-reports.php - Report generation

insert-warehouse-checkin.php - Warehouse access

🚀 Deployment
Production Deployment
Configure web server (Apache)

Set document root to /public

Configure PHP settings for production

AWS Deployment
The project uses Git-based deployment to AWS:

bash
git add .
git commit -m "Deployment ready"
git push origin main
🔒 Security Notes
IP-based access restrictions implemented

Input validation on all forms

Secure database queries

Session management system

📊 Maintenance
Regular Checks
Database connection status

File permission validation

Log rotation management

No Backup procedure implemented

Updates
Test changes in development environment

Deploy updates via Git push

Verify functionality post-deployment

🤝 Support
For technical issues or questions:

Check existing documentation

Review configuration files

Contact Alfredo Celso

📄 License
Proprietary software - Developed by Alfredo Celso for AFG as initiative to be greener.
