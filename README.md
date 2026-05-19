# Job Portal System

A simple **Job Portal Web Application** built with **PHP, MySQL, HTML, CSS, and JavaScript**.  
It allows **job seekers** to search/apply for jobs and **recruiters** to post/manage jobs.

## 🚀 Features
### For Job Seekers
- Register/Login as a seeker
- Browse and apply for jobs
- View applied jobs with status
- Cancel applications

### For Recruiters
- Register/Login as a recruiter
- Post new jobs
- Manage applicants (approve/reject/cancel)
- Update job postings

## 🛠️ Tech Stack
- **Frontend:** HTML, CSS, JavaScript  
- **Backend:** PHP (Procedural + PDO/MySQLi)  
- **Database:** MySQL  
- **Server:** XAMPP (Apache + MySQL)  

## ⚙️ Installation
1. Clone the repository:

   git clone https://github.com/Saran-Ravichndran-06/job-portal.git

2. Move the project to your XAMPP htdocs folder.

3. Import the database:

    Open phpMyAdmin
    Create a new database (e.g., job_portal)
    Import job_portal.sql file (if included).

4. Update php/config.php with your database credentials:

    $host = "localhost";
    $dbname = "job_portal";
    $username = "root";
    $password = "";

5. Start Apache and MySQL from XAMPP control panel.

5. Visit the project in your browser:

    http://localhost/job_portal/