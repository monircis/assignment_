# 📊 Financial Report System

A Laravel-based financial reporting system that allows users to filter data and generate reports in **Web View, PDF, and Excel formats**.

---

## 🚀 Project Setup Instructions

1. Clone the repository:

```bash
git clone https://github.com/monircis/assignment_.git
cd assignment_
```

2. Install dependencies:

```bash
composer install
```

3. Copy environment file:

```
cp .env.example .env
  ```

4. Generate application key:

```bash
php artisan key:generate
```

---

## ⚙️ Environment Requirements

* PHP >= 8.1
* Laravel >= 12
* MySQL / MariaDB
* Composer
---

## 🛠️ Database Setup

1. Configure `.env` file:

```env
DB_DATABASE=your_db_name
DB_USERNAME=root
DB_PASSWORD=your_password
```

2. Run migrations:

```bash
php artisan migrate
```

3. (Optional) Seed data:

```bash
php artisan db:seed
```

---

## ▶️ Steps to Run the Project

```bash
php artisan serve
```

Visit in browser:

```
http://127.0.0.1:8000
```
 You will can  generate report from this  page