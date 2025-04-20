# Computing Hardware Through Time Historical Database

A historical website showcasing significant contributions to computing hardware over time. This site functions as an MVP.

### Prerequisites For Running Locally
- [Docker](https://www.docker.com/get-started)
- [Docker Compose](https://docs.docker.com/compose/)

### Docker Compose

```bash
docker compose up -d
```

This will start all necessary services (e.g., Site, MySQL, PHPMyAdmin).

> Visit `http://localhost:8080` in your browser.

## Admin Login 
- **Username:** `admin`  
- **Password:** `admin`  

## Site Screenshots

### Homepage

![Homepage](/assets/homepage.png)

### Contributions Page

![Contributions](/assets/contributions.png)

### Individual Contributions Page

![Individual Contribution](/assets/individual.png)

### Admin Login Page

![Admin Login](/assets/login.png)

### Admin Dashboard

![Admin Dashboard](/assets/dashboard.png)

## Features

- View hardware milestones by year, manufacturer, type (CPU, GPU, RAM, etc.), and support status.
- Search and filter listings dynamically (AJAX-based).
- Admin dashboard for adding/editing/removing listings.
- Tracks listing history and view count.
- Secure login using hashed passwords and session management.

## Application Structure

### Presentation Layer
- HTML templates and partials (`src/partials/`, root, and `admin/`).
- Styles: `assets/main.css`
- JS (frontend logic): `assets/index.js`

### Logic Layer
- Object-oriented PHP classes in `src/classes/`
- API endpoints for CRUD operations in `/api/`
- Autoload and bootstrap handled by `src/autoloader.php` and `src/bootstrap.php`

### Data Layer
- MySQL with tables for `hardware`, `admin_users`, and `user_activity`
- SQL initialization: `src/db/chtt_db.sql`
- Image uploads saved in `hardware_image_uploads` (not stored as BLOBs)

## Security & Performance
- Uses prepared statements to prevent SQL injection.
- Image uploads validated (file type/size).

## Usability & Accessibility
- Responsive design for desktop, tablet, and mobile.
- Semantic HTML and good color contrast for accessibility.
- Consistent UX across pages.

## Future Improvements
- Move view files to a `public/` directory for better security.
- Improve mobile nav (hamburger menu).
- Enhance admin role functionality (e.g., add content editors).
- Add image preview during updates.
- Improve filter memory on form submissions.
- Markdown/WYSIWYG support for richer listing content.
