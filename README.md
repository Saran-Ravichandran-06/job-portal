<div align="center">

# 💼 Job Portal System

[![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
[![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/HTML)
[![CSS3](https://img.shields.io/badge/css3-%231572B6.svg?style=for-the-badge&logo=css3&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/CSS)
[![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)

**A simple Job Portal Web Application built with PHP, MySQL, HTML, CSS, and JavaScript.**

</div>

---

## 🚀 Overview

> [!NOTE]
> This platform allows **job seekers** to search/apply for jobs and **recruiters** to post/manage jobs seamlessly.

## 🚀 Features

### For Job Seekers
- 📝 Register/Login as a seeker
- 🔍 Browse and apply for jobs
- 📊 View applied jobs with status
- ❌ Cancel applications

### For Recruiters
- 🏢 Register/Login as a recruiter
- ➕ Post new jobs
- 👥 Manage applicants (approve/reject/cancel)
- 🔄 Update job postings

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| **Frontend** | HTML, CSS, JavaScript |
| **Backend** | PHP (Procedural + PDO/MySQLi) |
| **Database** | MySQL |
| **Server** | XAMPP (Apache + MySQL) |

## ⚙️ Installation

> [!IMPORTANT]
> Make sure you have XAMPP installed and running before starting the installation process.

**1. Clone the repository:**
```bash
git clone https://github.com/Saran-Ravichndran-06/job-portal.git
```

**2. Setup XAMPP:**
Move the cloned project to your XAMPP `htdocs` folder.

**3. Import the database:**
- Open phpMyAdmin (`http://localhost/phpmyadmin/`)
- Create a new database named `job_portal`
- Import the `job_portal.sql` file (if included in the repository).

**4. Database Configuration:**
Update `php/config.php` with your database credentials:
```php
$host = "localhost";
$dbname = "job_portal";
$username = "root";
$password = "";
```

**5. Start the Application:**
Start Apache and MySQL from the XAMPP control panel.
Visit the project in your browser:
```text
http://localhost/job_portal/
```