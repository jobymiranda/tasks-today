# Tasks for Today Management System

A secure, responsive task-management web application developed with CodeIgniter 4 and MySQL.

This project was created for IT0049 – Web System Technologies. It demonstrates Model-View-Controller architecture, database-backed task management, authentication, sessions, validation, route protection, and archive-based record removal.

## Project Overview

Tasks for Today allows public visitors to review active tasks while authenticated users can manage task records securely.

The application provides a modern editorial productivity dashboard with task statistics, status summaries, responsive data tables, validated forms, and protected management actions.

## Assessment

**Course:** IT0049 – Web System Technologies  
**Assessment:** TSA2 – Tasks for Today Management System, Full CRUD and Authentication  
**Developer:** Joby Mae M. Miranda  
**Framework:** CodeIgniter 4.7.4  
**Database:** MySQL / MariaDB

## Main Features

### Public Features

Public visitors can:

- View the welcome dashboard
- View tasks scheduled for today
- View the complete active task list
- View the profile page
- View the about page
- Open the login page

### Authentication Features

The system includes:

- Username and password authentication
- Secure password verification using `password_verify()`
- Password hashes stored in the database
- Session-based login state
- Session regeneration after login and logout
- Protected management routes
- Guest-only login routes
- Logout through a protected POST request
- Intended URL redirection after login

### Task Management Features

Authenticated users can:

- Create new tasks
- Edit existing tasks
- Update task titles, statuses, and dates
- Archive task records
- View validation messages
- Preserve entered form values when validation fails

### Task Validation

The task form validates:

- Task title is required
- Task title must contain at least 3 characters
- Task title must not exceed 150 characters
- Status must be pending, in progress, or completed
- Task date is required
- Task date must use a valid date format

### Archive-Based Removal

The application uses archive-based removal instead of permanently deleting records.

When a task is archived:

- Its `is_archived` value is changed to `1`
- The record remains safely stored in the database
- The archived record is hidden from the welcome dashboard
- The archived record is hidden from the Task List page

This approach prevents accidental permanent data loss.

## User Interface

The interface uses a modern editorial productivity-dashboard design featuring:

- Responsive bento-grid dashboard cards
- Daily task statistics
- Completion percentage indicator
- Task-status breakdown
- Editorial typography
- Tactile buttons and cards
- Responsive task tables
- Accessible status indicators
- Mobile-friendly layouts
- Reduced-motion support
- Clear validation and notification messages

## Technologies Used

- PHP 8.2 or later
- CodeIgniter 4.7.4
- MySQL / MariaDB
- HTML5
- CSS3
- CodeIgniter Validation
- CodeIgniter Sessions
- CodeIgniter Filters
- CodeIgniter CSRF Protection
- Composer
- XAMPP
- Git
- GitHub

## MVC Architecture

The application follows CodeIgniter's Model-View-Controller architecture.

### Models

Models communicate with the database and manage application data.

- `TaskModel` manages task records
- `UserModel` manages user records

### Views

Views contain the application's user interface.

Views are provided for:

- Welcome dashboard
- Task listing
- New Task form
- Edit Task form
- Login page
- Profile page
- About page
- Shared header
- Shared footer

### Controllers

Controllers receive route requests, validate input, communicate with models, and return views or redirects.

The application includes:

- `Home`
- `Tasks`
- `Auth`
- `Profile`
- `Pages`

### Filters

Filters protect routes and control access.

- `AuthFilter` prevents unauthenticated visitors from opening protected pages
- `GuestFilter` prevents authenticated users from returning to the login page

## Project Structure

```text
tasks-today/
├── app/
│   ├── Config/
│   │   ├── Filters.php
│   │   └── Routes.php
│   ├── Controllers/
│   │   ├── Auth.php
│   │   ├── Home.php
│   │   ├── Pages.php
│   │   ├── Profile.php
│   │   └── Tasks.php
│   ├── Filters/
│   │   ├── AuthFilter.php
│   │   └── GuestFilter.php
│   ├── Models/
│   │   ├── TaskModel.php
│   │   └── UserModel.php
│   └── Views/
│       ├── auth/
│       │   └── login.php
│       ├── home/
│       │   └── index.php
│       ├── pages/
│       │   └── about.php
│       ├── profile/
│       │   └── index.php
│       ├── tasks/
│       │   ├── form.php
│       │   └── index.php
│       └── templates/
│           ├── footer.php
│           └── header.php
├── database/
│   └── tasks_today_db.sql
├── public/
│   └── css/
│       └── style.css
├── writable/
├── .gitignore
├── composer.json
├── composer.lock
├── env
├── LICENSE
├── README.md
└── spark
```

## Database Structure

The project uses the `tasks_today_db` database.

### Tasks Table

The `tasks` table contains:

| Column | Purpose |
|---|---|
| `id` | Unique task identifier |
| `title` | Task title |
| `status` | Pending, in progress, or completed |
| `task_date` | Date assigned to the task |
| `is_archived` | Determines whether the task is hidden |
| `created_at` | Date and time the record was created |

### Users Table

The `users` table contains:

| Column | Purpose |
|---|---|
| `id` | Unique user identifier |
| `username` | Unique login username |
| `password` | Securely hashed password |
| `full_name` | User's complete name |
| `email` | User's email address |
| `created_at` | Date and time the user was created |

## System Requirements

Before installing the project, make sure the computer has:

- PHP 8.2 or later
- Composer
- MySQL or MariaDB
- XAMPP or an equivalent PHP development environment
- Git
- A modern web browser

Required PHP extensions include:

- `intl`
- `mbstring`
- `mysqli`
- `json`
- `curl`

## Installation Instructions

### 1. Clone the Repository

Open PowerShell or a VS Code terminal and run:

```powershell
git clone https://github.com/jobymiranda/tasks-today.git
cd tasks-today
```

### 2. Install PHP Dependencies

Run:

```powershell
composer install
```

Composer will install the required CodeIgniter dependencies inside the `vendor` directory.

### 3. Create the Environment File

Run:

```powershell
Copy-Item env .env
```

Open `.env` and configure the application environment:

```ini
CI_ENVIRONMENT = development
```

Configure the local base URL:

```ini
app.baseURL = 'http://localhost:8080/'
```

Configure the MySQL connection:

```ini
database.default.hostname = localhost
database.default.database = tasks_today_db
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306
```

If the local MySQL installation uses a password, enter that password after:

```ini
database.default.password =
```

The `.env` file contains machine-specific configuration and is intentionally excluded from Git.

### 4. Create and Import the Database

Start Apache and MySQL through XAMPP.

Open:

```text
http://localhost/phpmyadmin
```

The included SQL export can create the database automatically. To import it:

1. Click **Import** in phpMyAdmin.
2. Click **Choose File**.
3. Select:

```text
database/tasks_today_db.sql
```

4. Confirm the format is **SQL**.
5. Click **Import**.

The import creates the `tasks_today_db` database, its tables, sample tasks, and the demonstration user account.

### 5. Start the Application

From the project directory, run:

```powershell
php spark serve
```

Open:

```text
http://localhost:8080
```

Keep the terminal running while using the application.

## Demonstration Login

Use the following account for local assessment testing:

```text
Username: jobymiranda
Password: Admin@123
```

The database stores only the secure password hash. It does not store the plain-text password.

## Application Routes

### Public Routes

| Method | Route | Purpose |
|---|---|---|
| GET | `/` | Welcome dashboard |
| GET | `/tasks` | Active task list |
| GET | `/profile` | User profile |
| GET | `/about` | Project information |
| GET | `/login` | Login page |
| POST | `/login` | Process login |

### Protected Routes

The following routes require authentication:

| Method | Route | Purpose |
|---|---|---|
| GET | `/tasks/new` | Display the New Task form |
| POST | `/tasks` | Create a new task |
| GET | `/tasks/{id}/edit` | Display the Edit Task form |
| POST | `/tasks/{id}` | Update an existing task |
| POST | `/tasks/{id}/archive` | Archive a task |
| POST | `/logout` | End the authenticated session |

## Security Features

The project includes the following security practices:

- Password hashing
- Password verification
- Session regeneration
- Authentication filters
- Guest filters
- CSRF protection
- POST requests for state-changing actions
- Escaped output using CodeIgniter's `esc()` function
- Server-side validation
- Restricted model fields
- Disabled legacy auto-routing
- Archive-based record removal
- Environment variables excluded from Git

## Testing Checklist

The application was tested for the following behavior:

- [x] Welcome page loads correctly
- [x] Task List page displays active records
- [x] Profile page loads correctly
- [x] About page loads correctly
- [x] Valid credentials successfully authenticate the user
- [x] Invalid credentials are rejected
- [x] Login form displays validation errors
- [x] Authenticated users can create tasks
- [x] New Task form rejects invalid values
- [x] Form values remain visible after validation failure
- [x] Authenticated users can edit tasks
- [x] Existing task information is pre-filled during editing
- [x] Authenticated users can archive tasks
- [x] Archived tasks remain in the database
- [x] Archived tasks are hidden from public task lists
- [x] Logged-out visitors are redirected away from protected routes
- [x] Logout ends the authenticated session
- [x] CSRF protection is enabled
- [x] The layout works on desktop and mobile screens

## Running Syntax Checks

Individual PHP files can be checked with:

```powershell
php -l app/Controllers/Auth.php
php -l app/Controllers/Tasks.php
php -l app/Filters/AuthFilter.php
php -l app/Filters/GuestFilter.php
php -l app/Models/TaskModel.php
php -l app/Models/UserModel.php
```

Display all registered application routes with:

```powershell
php spark routes
```

## Repository

GitHub repository:

[https://github.com/jobymiranda/tasks-today](https://github.com/jobymiranda/tasks-today)

## Author

**Joby Mae M. Miranda**  
IT0049 – Web System Technologies