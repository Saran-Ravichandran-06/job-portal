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

## 📂 Project Structure
job_portal/
│
├── index.html                # Landing page (redirects seeker/recruiter dashboard after login)
├── login.html                # Login page (form posts to php/login.php)
├── register.html             # Registration page (form posts to php/register.php)
│
├── css/
│   ├── style.css             # Global styles
│   ├── navbar.css            # Navbar styles
│   └── responsive.css        # Responsive design
│
├── js/
│   ├── main.js               # General JS (form validation, etc.)
│   └── navbar.js             # Navbar interactions
│
├── includes/
│   ├── s_header.html         # seeker page's navbar 
│   |── r_header.html         # seeker page's navbar 
│   |__ footer.html           # common for all
|
├── pages/
│   ├── seeker/               
│   │   ├── dashboard.html        # Trending jobs for seekers
│   │   ├── apply_jobs.html       # Search & apply for jobs
│   │   ├── applied_jobs.html     # Jobs already applied
│   │   └── service_contact.html  # Services & Contact info
│   │
│   └── recruiter/
│       ├── dashboard.html        # Trending jobs for recruiters
│       ├── post_job.html         # Post new jobs
│       ├── manage_jobs.html      # Edit/Delete jobs
│       ├── applicants.html       # View applicants & update status
│       |── update_jobs.html      # Updating the already posted jobs
│       |__ service_contact.html  # Services & Contact info
|
├── assets/
│   ├── images/               # Logos, icons, banners
│   └── fonts/                # Custom fonts
│
├── sql/
│   └── job_portal.sql        # Database schema + sample data
│
└── php/                        # All backend functionality
    ├── config.php              # Database connection
    ├── login.php               # Login processing
    ├── register.php            # Registration processing
    ├── logout.php              # Logout script
    ├── post_job.php            # Recruiter job posting
    ├── manage_jobs.php         # Recruiter manage jobs
    ├── apply_job.php           # Seeker applies for job
    ├── fetch_jobs.php          # Fetch jobs dynamically
    |── update_status.php       # Recruiter updates applicant status
    |__ applicants.php          # Lists seekers applied for job
    |__ applied_jobs.php        # Seeker managing jobs
    |__ delete_job.php          # Recruiter deleting job
    |__ update_job.php          # Recruiter updating job
    |__ get_job.php             # Retrieves job for updating
    |__ cancel_application.php  # Seeker cancelling applied job



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