# School Management System

A comprehensive school management system built with the Laravel framework, designed to efficiently manage students, teachers, parents, and administrators. The system provides an easy-to-use interface and advanced tools to manage all aspects of the educational process.

## Overview

This system helps schools automate daily operations such as student registration, grade management, attendance tracking, financial fee management, and organizing exams and quizzes. The system supports multiple user roles with different permissions for each role.

## Key Features

### User and Role Management
- **Admins**: Full control over the system, user management, and general settings.
- **Teachers**: Manage grades, attendance, exams, and subjects.
- **Students**: View grades, attendance, fees, and subjects.
- **Parents**: Monitor their children's performance, fees, and attendance.

### Student Management
- Register new students and update their information.
- Manage classrooms and sections.
- Track graduation and promotions.
- Manage photos and personal attachments.

### Academic Management
- **Grades**: Manage educational levels.
- **Classrooms**: Organize classrooms and sections.
- **Subjects**: Add and manage subjects.
- **Quizzes & Exams**: Create and grade quizzes.
- **Degrees**: Record and manage grades.

### Financial Management
- **Fees**: Manage types of school fees.
- **Invoices**: Create and manage student invoices.
- **Payments**: Record payments and receipts.
- **Accounts**: Track student accounts and fund accounts.

### Attendance and Events Management
- **Attendance**: Daily student attendance recording.
- **Events**: Manage school events and calendar.

### Library and Settings
- **Library**: Manage books and educational resources.
- **Settings**: Customize general system settings.

### Technical Features
- **Multi-language Support**: Arabic and English.
- **Interactive Interface**: Using Livewire for dynamic interactions.
- **Responsive Design**: Using Tailwind CSS.
- **High Security**: Multi-level authentication and data encryption.

## Requirements

- **PHP**: Version 8.2 or higher
- **Laravel**: Version 11.0
- **Database**: MySQL or PostgreSQL
- **Node.js**: For managing frontend assets
- **Composer**: For managing PHP dependencies
- **NPM**: For managing JavaScript dependencies

## Installation

1. **Clone the Project**:
   ```bash
   git clone https://github.com/your-username/school-management-system.git
   cd school-management-system
   ```

2. **Install PHP Dependencies**:
   ```bash
   composer install
   ```

3. **Install JavaScript Dependencies**:
   ```bash
   npm install
   ```

4. **Set Up Environment File**:
   ```bash
   cp .env.example .env
   ```

5. **Generate Application Key**:
   ```bash
   php artisan key:generate
   ```

6. **Set Up Database**:
   - Update the `.env` file with your database information.
   - Run migrations:
     ```bash
     php artisan migrate
     ```

7. **Run Seeders**:
   ```bash
   php artisan db:seed
   ```

8. **Build Frontend Assets**:
   ```bash
   npm run build
   ```

## Running the Application

### For Development:
```bash
php artisan serve
npm run dev
```

### For Production:
```bash
php artisan serve --host=0.0.0.0 --port=8000
```

You can access the system via your browser at `http://localhost:8000`.

## Usage

### Login
- Use the default admin credentials for initial login.
- New accounts can be created from the admin dashboard.

### Student Management
- Navigate to the "Students" section in the control panel.
- Add a new student or edit existing data.

### Grade Management
- In the "Grades" section, you can add new grades or modify them.

### Reports
- Use the reports sections to view attendance and grade statistics.

## Contributing

We welcome contributions! Please follow these steps:

1. Fork the project.
2. Create a new branch for your feature: `git checkout -b feature/AmazingFeature`.
3. Commit your changes: `git commit -m 'Add some AmazingFeature'`.
4. Push the branch: `git push origin feature/AmazingFeature`.
5. Open a Pull Request.

## License

This project is licensed under the MIT License. See the `LICENSE` file for more details.

## Support

If you have any questions or issues, please open an Issue on GitHub or contact the development team.

## Developers

- Akram A. - AkramABarakat.2003@gmail.com

---

Thank you for using the School Management System!
