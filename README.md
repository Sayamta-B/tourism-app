# 🌍 Tourism Map Web Application

A Laravel-based web application that allows users to explore tourist places on an interactive map. The system includes an admin panel for managing places, cities, and categories, while the public map remains accessible without authentication.

---

## 🚀 Features

### 🗺️ Public Map
- Interactive map using **Leaflet.js**
- View all tourist places on a map
- Filter places by:
  - City
  - Category
- Click markers to view place details
- Sidebar with place information (image, description, location)

### 🔐 Authentication System
- User registration
- Login / Logout
- Session-based authentication (Laravel Auth)
- CSRF protection enabled

### 🧑‍💼 Admin Panel
- Manage Places (CRUD)
- Manage Cities (CRUD)
- Manage Categories (CRUD)
- Upload and display place images
- Filter and organize data

---

## 🏗️ Tech Stack

- **Backend:** Laravel 10+
- **Frontend:** Blade Templates, HTML, CSS
- **Map:** Leaflet.js (OpenStreetMap)
- **Database:** MySQL
- **Authentication:** Laravel Auth (Session-based)

---

## 📁 Project Structure


<img width="259" height="326" alt="image" src="https://github.com/user-attachments/assets/9bc2e336-4ccf-4b0b-9b9f-54bc3d6cd49a" />



---

## ⚙️ Installation

### 1. Clone the repository
```
bash
git clone https://github.com/your-username/tourism-map.git
cd tourism-map
```
### 2. Install dependencies
```
composer install
npm install
```
### 3. Setup environment
```
cp .env.example .env
php artisan key:generate
```
### 4. Configure database in .env
```
DB_DATABASE=your_database
DB_USERNAME=root
DB_PASSWORD=
```
### 5. Run migrations
php artisan migrate
### 6. Start development server
php artisan serve
### 🔑 Authentication Flow
- Users register via /register
- Login via /login
- Session is created using Auth::attempt()
- Logout destroys session using Auth::logout()
### 🗺️ Map Flow
- Fetch all places from database
- Display markers using Leaflet.js
- On marker click:
    - Open sidebar
    - Show place details
    - Filters update results dynamically

 ## 👨‍💻 Author

Developed as a learning project using Laravel and Leaflet.js.
