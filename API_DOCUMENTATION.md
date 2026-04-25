# API Registration Documentation

## Base URL
```
http://localhost:8000/api
```

## Endpoints

### 1. Register User
Create a new user account.

**Endpoint:** `POST /api/register`

**Headers:**
```
Content-Type: application/json
Accept: application/json
```

**Request Body:**
```json
{
  "fname": "John",
  "mname": "M",
  "lname": "Doe",
  "course": "Computer Science",
  "gender": "male",
  "email": "john@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

**Field Validation:**
- `fname` (required, string, max:255)
- `mname` (optional, string, max:255)
- `lname` (required, string, max:255)
- `course` (required, string, max:255)
- `gender` (required, enum: male|female)
- `email` (required, email, unique, max:255)
- `password` (required, string, min:8, confirmed)
- `password_confirmation` (required, must match password)

**Success Response (201):**
```json
{
  "success": true,
  "message": "User registered successfully",
  "data": {
    "user": {
      "id": 1,
      "name": "John M Doe",
      "email": "john@example.com",
      "role": "Athlete"
    },
    "token": "1|abc123xyz..."
  }
}
```

**Error Response (422):**
```json
{
  "success": false,
  "message": "Validation failed",
  "errors": {
    "email": [
      "The email has already been taken."
    ]
  }
}
```

**Error Response (500):**
```json
{
  "success": false,
  "message": "Registration failed",
  "error": "Error details..."
}
```

---

### 2. Login User
Authenticate and get access token.

**Endpoint:** `POST /api/login`

**Headers:**
```
Content-Type: application/json
Accept: application/json
```

**Request Body:**
```json
{
  "email": "john@example.com",
  "password": "password123"
}
```

**Success Response (200):**
```json
{
  "success": true,
  "message": "Login successful",
  "data": {
    "user": {
      "id": 1,
      "name": "John M Doe",
      "email": "john@example.com",
      "role": "Athlete"
    },
    "token": "2|xyz789abc..."
  }
}
```

**Error Response (401):**
```json
{
  "success": false,
  "message": "Invalid credentials"
}
```

---

### 3. Get Current User
Get authenticated user details.

**Endpoint:** `GET /api/user`

**Headers:**
```
Content-Type: application/json
Accept: application/json
Authorization: Bearer {token}
```

**Success Response (200):**
```json
{
  "id": 1,
  "name": "John M Doe",
  "fname": "John",
  "mname": "M",
  "lname": "Doe",
  "email": "john@example.com",
  "role": "Athlete",
  "course": "Computer Science",
  "gender": "male",
  "created_at": "2026-04-25T05:00:00.000000Z",
  "updated_at": "2026-04-25T05:00:00.000000Z"
}
```

---

### 4. Logout User
Revoke current access token.

**Endpoint:** `POST /api/logout`

**Headers:**
```
Content-Type: application/json
Accept: application/json
Authorization: Bearer {token}
```

**Success Response (200):**
```json
{
  "success": true,
  "message": "Logged out successfully"
}
```

---

## Testing with cURL

### Register
```bash
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "fname": "John",
    "mname": "M",
    "lname": "Doe",
    "course": "Computer Science",
    "gender": "male",
    "email": "john@example.com",
    "password": "password123",
    "password_confirmation": "password123"
  }'
```

### Login
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "email": "john@example.com",
    "password": "password123"
  }'
```

### Get User
```bash
curl -X GET http://localhost:8000/api/user \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

### Logout
```bash
curl -X POST http://localhost:8000/api/logout \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN_HERE"
```

---

## Testing with Postman

1. **Create New Request**
   - Method: POST
   - URL: `http://localhost:8000/api/register`

2. **Set Headers**
   - Content-Type: application/json
   - Accept: application/json

3. **Set Body (raw JSON)**
   ```json
   {
     "fname": "John",
     "mname": "M",
     "lname": "Doe",
     "course": "Computer Science",
     "gender": "male",
     "email": "john@example.com",
     "password": "password123",
     "password_confirmation": "password123"
   }
   ```

4. **Send Request**

---

## Notes

- All API responses are in JSON format
- Passwords are automatically hashed using bcrypt
- Default role for new users is "Athlete"
- Tokens are generated using Laravel Sanctum
- Tokens should be included in Authorization header for protected routes
- Token format: `Bearer {token}`

---

## Error Codes

- **200** - Success
- **201** - Created
- **401** - Unauthorized
- **422** - Validation Error
- **500** - Server Error
