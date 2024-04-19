# Task Management System with Background Processing

## Project Name and Description

a comprehensive task management system using Laravel

### Installation Instructions

1. Clone the repository.

   ```bash
   git clone "https://gitlab.com/ixcorders.groub/task.for.interview/task.management.system.git"
   ```

2. Navigate to the project directory.

   ```bash
   cd "task.management.system/"
   ```

3. Run composer install to install dependencies.

   ```bash
   composer install
   ```

4. Create a .env file from .env.example and configure your settings.

   - Duplicate .env.example and rename it to .env.

   ```bash
   cp .env.example .env
   ```

5. Generate an application key.

   ```bash
   php artisan key:generate
   ```

6. Migrate the database schema.

   ```bash
   php artisan migrate
   ```
   - it should ask you if you want to create a new database : `(yes/no)` and of course it `yes` 👍🏻😅
   - the name of the database will be in the `.env` under the name of `"DB_DATABASE=laravel_laravel_taskmanagementsystem"`

7. Optionally, seed the database with initial data.

   ```bash
   php artisan db:seed
   ```

8. Serve the application. Start your local server with 'php artisan serve' and open your web browser.

   ```bash
   php artisan serve
   ```

   Navigate to [http://localhost:8000](http://localhost:8000) (make sure to check the port number).

   Note: You might need to set up XAMPP, WAMP, or any other local server environment.

### Task List Feature

- User Management.
- Task Management.
- Collaboration Features.
- Recurring Tasks.
- Notifications and Reminders.
- Task Statuses.
- Searchable Tasks.
- `SOLID Principles` and `Design Patterns`.
- Blade Templates and `Laravel` Components.
- Caching Strategies : for frequently accessed data to improve performance.
- Automated Testing : verify core `functionalities`.

### Technologies Used

- **Programming Languages:** PHP, HTML, JavaScript
- **Framework:** Laravel
- **Database:** MySQL
- **Frontend Libraries:** Blade system, Bootstrap 5, 
- **Other Tools:** Composer, Laragon, Visual Studio Code, MarkDown

### Folder Structure

- **/app:** Contains controllers, models, and other PHP files.
- **/database:** Migrations and seeders.
- **/resources:** Views and frontend assets.
- **/routes:** Defines application routes.
- **/public:** Publicly accessible assets and the entry point (index.php).

### Database Schema

The system uses the following tables:

- **table_name:**
  - properties

### Contact Information

Connect with us on:

- **LinkedIn:**
  - [Abdullah Alhabal](https://www.linkedin.com/in/abdullahalhabalse/)
- **Github:**
  - [Abdullah Alhabal](https://github.com/abdullahalhabal)
- **Email:**
  - [abdulllah.al.habbal](mailto:abdulllah.al.habbal@gmail.com)

### Notes

Feel free to explore our repository and join us on this exciting journey of learning and growth in Software Engineering!
