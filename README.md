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


## Assignment 2 – Part E (Auth)

### Setup Sanctum
- Installed Sanctum
- Published config & migrations
- Ran migration

### Endpoints Tested (Bruno)
- POST /auth/register (201)
- POST /auth/login (200) -> returns token
- GET /auth/me (200) with Bearer token
- POST /auth/logout (200)

### Screenshots
- ![E1 Branch](screenshots/19.%20Part%20E1-feature-authz-spatie.png)
- ![E2 Sanctum install](screenshots/20.%20Part%20E2-01-sanctum-install-migrate.png)
- ![E2 Migrate](screenshots/21.%20Part%20E2-02-sanctum-install-migrate.png)
- ![Login OK](screenshots/22.%20Part%20E2-Log%20In%20Sucess-Bruno-200%20OK.png)
- ![Auth Me OK](screenshots/23.%20Part%20E2-Get-Auth-Me-200%20OK.png)
- ![Logout OK](screenshots/24.%20Part%20E2-Log%20Out%20Berjaya-200%20OK.png)
