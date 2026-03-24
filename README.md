# 📋 Task Manager
[![Actions Status](https://github.com/ElenaManukyan/php-project-57/actions/workflows/hexlet-check.yml/badge.svg)](https://github.com/ElenaManukyan/php-project-57/actions)
[![PHP Tests and Linter](https://github.com/ElenaManukyan/php-project-57/actions/workflows/php-tests.yml/badge.svg)](https://github.com/ElenaManukyan/php-project-57/actions/workflows/php-tests.yml)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=ElenaManukyan_php-project-57&metric=coverage)](https://sonarcloud.io/summary/new_code?id=ElenaManukyan_php-project-57)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=ElenaManukyan_php-project-57&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=ElenaManukyan_php-project-57)
[![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=ElenaManukyan_php-project-57&metric=security_rating)](https://sonarcloud.io/summary/new_code?id=ElenaManukyan_php-project-57)
## 📖 Description
**Task Manager** is a modern web application designed for team collaboration and task management. It allows users to create tasks, assign statuses, set executors, and categorize work using a flexible labeling system. 
The project was built as a graduation project, demonstrating proficiency in the Laravel framework, database architecture, and professional development workflows (CI/CD, automated testing, and error tracking).
## 🌐 Demo:
[Demo](https://php-project-57-cahu.onrender.com)  
### 💻 Stack:
![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=flat&logo=php&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-4169E1?style=flat&logo=postgresql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=flat&logo=tailwind-css&logoColor=white)
## ✨ Key Features
* **Full Authentication:** Secure registration and login system.
* **Task CRUD:** Comprehensive management of tasks, including descriptions and metadata.
* **Status Management:** Dynamic task workflows (e.g., New, In Progress, Testing, Completed).
* **Many-to-Many Relationships:** Implementation of a labeling system where tasks can have multiple tags.
* **Advanced Filtering:** Powerful search and filter capabilities using `spatie/laravel-query-builder` (filter by status, author, or assignee).
* **Access Control:** Integrated authorization logic (Policies/Gates) ensuring users can only modify their own content.
* **Production Monitoring:** Real-time error tracking and reporting via **SonarQube**.
* **Localization:** Fully translatable interface (English and Russian supported).

## Installation

### Prerequisites
* PHP >= 8.2
* Composer
* Node.js & NPM

### ⚙️ Setup
1. **Clone the repository:**
   ```bash
   git clone https://github.com/ElenaManukyan/php-project-57.git
   cd php-project-57
   ```
2. **Install PHP and JS dependencies:**
   ```bash
   composer install
    npm install && npm run build
   ```
3. **Environment setup:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. **Database migration & Seeding:**
   ```bash
   php artisan migrate --seed
   ```
5. **Open app:**
   ```bash
   make start
   ```

## ✅ Testing & Quality
Automated tests ensure the stability of the core features:
```bash
make test
```


Developed by Elena Manukyan as part of the Hexlet PHP Developer program.
