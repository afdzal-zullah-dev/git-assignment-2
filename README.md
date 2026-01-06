# Assignment 2 – RESTful Product API with Authentication (Laravel)

This project is developed as part of **Assignment 2** to demonstrate the implementation of
a RESTful API using **Laravel**, including **token-based authentication using Laravel Sanctum**.

---

## 👨‍💻 Student Information
- **Name**: Afdzal Zullah  
- **Project**: Product API  
- **Framework**: Laravel  
- **Authentication**: Laravel Sanctum (Personal Access Token)

---

## 🚀 Features Implemented

### ✅ Product API (CRUD)
- Get all products
- Create product
- Get product by ID
- Update product
- Delete product

### ✅ Authentication (Part E)
- User Registration
- User Login (Token Generated)
- Get Authenticated User Profile
- User Logout (Token Revoked)

---

## 🔐 Authentication Flow (Laravel Sanctum)

1. User registers via `/api/auth/register`
2. User logs in via `/api/auth/login`
3. API returns **Bearer Token**
4. Token is used in request header:
   ```http
   Authorization: Bearer {token}


## Assignment 2 – Part E (Authentication)

### Features Implemented
- Laravel Sanctum Authentication
- Login API
- Get Authenticated User (/auth/me)
- Logout API

### Screenshots
![Login Success](screenshots/22. Part E2-Login-Success-200.png)
![Get Profile](screenshots/23. Part E2-Get-Me-200.png)
![Logout Success](screenshots/24. Part E2-Logout-200.png)
