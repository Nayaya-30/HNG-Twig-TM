# Ticket Management Application - Twig Version

This is the Twig/Symfony implementation of the ticket management application. It features a modern UI with responsive design, dark mode support, and full CRUD operations for tickets.

## 🧰 Frameworks and Libraries Used

- **PHP** - Server-side scripting language
- **Symfony** - PHP web application framework
- **Twig** - Templating engine for PHP
- **Tailwind CSS** - Utility-first CSS framework
- **Composer** - PHP dependency manager
- **npm** - JavaScript package manager (for Tailwind CSS)

## 🚀 Quick Start

1. Install PHP and Composer, then create a Symfony skeleton:
   ```bash
   composer create-project symfony/skeleton .
   ```

2. Require web and twig packages:
   ```bash
   composer require symfony/webapp-pack twig
   ```

3. Install Node.js dependencies:
   ```bash
   npm install
   ```

4. Build CSS:
   ```bash
   npm run build:css
   ```

## 🧩 Components and UI Features

### Public Pages
- **Landing Page** - Hero section with call-to-action buttons and feature highlights
- **Login Page** - Email/password authentication with validation
- **Signup Page** - User registration with password strength indicator

### Protected Pages
- **Dashboard** - Overview with statistics cards and quick actions
- **Ticket Management** - Full CRUD operations for tickets with search functionality

### UI Components
- **Dark Mode Toggle** - Theme switching capability
- **Responsive Navigation** - Adapts to mobile and desktop views
- **Statistics Cards** - Visual display of ticket metrics
- **Ticket Cards** - Display individual tickets with status and priority indicators
- **Form Validation** - Server-side validation
- **Toast Notifications** - User feedback messages

### UI Features
- **Responsive Design** - Works on mobile, tablet, and desktop
- **Dark/Light Theme** - User preference saved in localStorage
- **Interactive Elements** - Hover effects and transitions
- **Accessibility** - Semantic HTML and ARIA attributes

## 🗃️ State Structure

The application uses file-based storage for data persistence:

### Users (`var/data/users.json`)
```json
[
  {
    "id": 1,
    "name": "Test User",
    "email": "test@example.com",
    "password": "test123",
    "createdAt": "2023-01-01T00:00:00.000Z"
  }
]
```

### Tickets (`var/data/tickets.json`)
```json
[
  {
    "id": 1,
    "userId": 1,
    "title": "Urgent Bug Fix",
    "description": "Critical bug in production",
    "status": "open",
    "priority": "high",
    "createdAt": "2023-01-01T00:00:00.000Z",
    "updatedAt": "2023-01-01T00:00:00.000Z"
  }
]
```

## ♿ Accessibility Features

- Semantic HTML structure
- Proper heading hierarchy (h1-h3)
- ARIA labels for icon-only buttons
- Sufficient color contrast
- Focus indicators for keyboard navigation
- Screen reader-friendly content

## ⚠️ Known Issues

1. **Form Validation** - Currently only implemented server-side
2. **Ticket CRUD Operations** - Creation and editing forms are not fully implemented
3. **Session Management** - Uses basic PHP sessions, not suitable for production
4. **Data Persistence** - Uses JSON files, not a database
5. **Security** - Passwords stored in plain text, no encryption

## 🔐 Test Credentials

Use the following credentials to test the application:

- **Email:** test@example.com
- **Password:** test123

## 🔧 Setup and Usage

1. **Install PHP Dependencies:**
   ```bash
   composer install
   ```

2. **Install Node.js Dependencies:**
   ```bash
   npm install
   ```

3. **Build CSS:**
   ```bash
   npm run build:css
   ```

4. **Start Development Server:**
   ```bash
   symfony serve
   ```
   or
   ```bash
   php -S localhost:8000 -t public
   ```

## 🔄 Switching Between Versions

This project contains three different implementations of the same ticket management application:

1. **React version** (`app/` directory)
2. **Vue version** (`Vue-app/` directory)
3. **Twig version** (`twig-app/` directory)

To switch between versions, navigate to the respective directory and follow the setup instructions in each README.

## 📁 Project Structure

```
twig-app/
├── src/
│   ├── Controller/          # Symfony controllers
│   ├── Service/             # Service classes
│   └── Kernel.php           # Application kernel
├── templates/               # Twig templates
├── public/                  # Publicly accessible files
├── config/                  # Configuration files
├── var/                     # Variable data (cache, logs)
├── vendor/                  # Composer dependencies
├── package.json             # Frontend dependencies
└── README.md                # This file
```