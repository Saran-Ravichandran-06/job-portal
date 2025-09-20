document.addEventListener("DOMContentLoaded", function () {
  const navbar = document.getElementById("navbar");
  if (!navbar) return;

  const role = navbar.getAttribute("data-role"); // seeker / recruiter

  let links = [];

  if (role === "seeker") {
    links = [
      { name: "Dashboard", url: "../seeker/dashboard.html" },
      { name: "Apply Job", url: "../seeker/apply_jobs.html" },
      { name: "Applied Jobs", url: "../seeker/applied_jobs.html" },
      { name: "Service & Contact", url: "../seeker/service_contact.html" },
      { name: "Logout", url: "../../php/logout.php" }
    ];
  } else if (role === "recruiter") {
    links = [
      { name: "Dashboard", url: "../recruiter/dashboard.html" },
      { name: "Post Job", url: "../recruiter/post_job.html" },
      { name: "Manage Jobs", url: "../recruiter/manage_jobs.html" },
      { name: "Applicants", url: "../recruiter/applicants.html" },
      { name: "Service & Contact", url: "../recruiter/service_contact.html" },
      { name: "Logout", url: "../../php/logout.php" }
    ];
  }

  navbar.innerHTML = `
    <nav class="navbar">
      <div class="navbar-brand">Job Portal</div>
      <ul class="navbar-links">
        ${links.map(link => `<li><a href="${link.url}">${link.name}</a></li>`).join("")}
      </ul>
    </nav>
  `;
});
