# School ePramaan Integration Setup

## Overview
This document outlines the complete setup for school portal with ePramaan authentication integration.

## Backend Setup ✅ COMPLETE

### 1. ePramaan Service
- **File**: `app/Services/EPramaanService.php`
- **Features**:
  - Login URL generation
  - Access token exchange
  - AES decryption support
  - Configurable via environment variables

### 2. ePramaan Controller
- **File**: `app/Http/Controllers/EPramaanController.php`
- **Methods**:
  - `redirectToEPramaan()` - API-based login URL
  - `handleCallback()` - API callback handler
  - `webRedirectToEPramaan()` - Web-based redirect
  - `webHandleCallback()` - Web callback handler

### 3. Configuration
- **File**: `config/epramaan.php`
- **Environment Variables**:
  ```env
  EPRAMAAN_URL=https://epramaan.gov.in
  EPRAMAAN_AES_KEY=e0681502-a91b-4868-b8c0-4274b0144e1a
  EPRAMAAN_SCOPE=openid
  EPRAMAAN_RESPONSE_TYPE=code
  EPRAMAAN_CODE_METHOD=POST
  EPRAMAAN_CLIENT_ID=your_client_id
  EPRAMAAN_CLIENT_SECRET=your_client_secret
  ```

### 4. Routes
- **API Routes** (`routes/api.php`):
  - `GET /api/epramaan/e-login` - Get login URL
  - `GET /api/epramaan/callback` - Handle callback

- **Web Routes** (`routes/web.php`):
  - `GET /epramaan/login` - Direct redirect to ePramaan
  - `GET /epramaan/callback` - Handle web callback

## Frontend Setup ✅ COMPLETE

### 1. School Landing Page
- **File**: `resources/views/school/landing.blade.php`
- **URL**: `/school`
- **Features**:
  - Government-style design
  - School information display
  - Login button in hero section and navigation

### 2. School Login Page
- **File**: `resources/views/school/login.blade.php`
- **URL**: `/school/login`
- **Features**:
  - ePramaan authentication button
  - Regular email/password login form
  - Government-themed design
  - Loading states and error handling
  - Session flash message support

### 3. School Dashboard
- **File**: `resources/views/school/dashboard.blade.php`
- **URL**: `/school/dashboard` (protected by auth middleware)
- **Features**:
  - Statistics cards (students, teachers, classes, attendance)
  - Quick actions panel
  - Recent activities feed
  - Upcoming events display
  - Sidebar navigation

### 4. School Controller
- **File**: `app/Http/Controllers/SchoolController.php`
- **Methods**:
  - `landing()` - School landing page
  - `login()` - Login page
  - `dashboard()` - Protected dashboard

## Authentication Flow

### ePramaan Authentication
1. User clicks "Login with ePramaan" on `/school/login`
2. System redirects to `/epramaan/login`
3. Controller redirects to ePramaan government portal
4. User authenticates on ePramaan
5. ePramaan redirects back to `/epramaan/callback`
6. System processes callback, creates/updates user
7. User is logged in and redirected to `/school/dashboard`

### Regular Authentication
1. User fills email/password form on `/school/login`
2. AJAX request to `/api/login`
3. On success, token stored and redirect to `/school/dashboard`

## File Structure
```
app/
├── Http/Controllers/
│   ├── EPramaanController.php
│   └── SchoolController.php
├── Services/
│   └── EPramaanService.php
config/
└── epramaan.php
resources/views/school/
├── landing.blade.php
├── login.blade.php
└── dashboard.blade.php
routes/
├── web.php (school + epramaan web routes)
└── api.php (epramaan API routes)
```

## Environment Configuration Required

Before using ePramaan in production, update these values in `.env`:

```env
EPRAMAAN_CLIENT_ID=your_actual_client_id
EPRAMAAN_CLIENT_SECRET=your_actual_client_secret
```

## Testing the Setup

1. **Access School Landing**: Visit `http://localhost/school`
2. **Test Login Page**: Click "School Portal Login" or visit `http://localhost/school/login`
3. **Test ePramaan Flow**: Click "Login with ePramaan" (will redirect to ePramaan)
4. **Test Regular Login**: Use email/password form
5. **Access Dashboard**: After login, should redirect to `http://localhost/school/dashboard`

## Security Features

- CSRF protection on forms
- Authentication middleware on protected routes
- Session-based authentication
- Secure token handling
- Government-grade ePramaan integration

## Next Steps

1. **Configure Real ePramaan Credentials**: Update client ID and secret
2. **Add User Roles**: Implement school-specific user roles
3. **Extend Dashboard**: Add more school management features
4. **Add API Endpoints**: Create APIs for mobile app integration
5. **Testing**: Comprehensive testing with real ePramaan environment

## Notes

- The setup is fully functional with mock ePramaan credentials
- All views use government-themed styling
- Both API and web-based authentication flows are supported
- Error handling and loading states are implemented
- Responsive design for mobile compatibility