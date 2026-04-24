# PathFit Backend API

Node.js Express backend with MySQL database connection to Railway.

## Setup Instructions

1. Install dependencies:
```bash
npm install
```

2. Create the database table by running the SQL in `database.sql`

3. Start the server:
```bash
npm run dev  # Development with nodemon
npm start    # Production
```

## API Endpoints

### Users CRUD Operations

- **GET** `/api/users` - Get all users
- **GET** `/api/users/:id` - Get user by ID
- **POST** `/api/users` - Create new user
- **PUT** `/api/users/:id` - Update user
- **DELETE** `/api/users/:id` - Delete user

### Example Requests

**Create User:**
```json
POST /api/users
{
  "name": "John Doe",
  "email": "john@example.com",
  "age": 25
}
```

**Update User:**
```json
PUT /api/users/1
{
  "name": "John Updated",
  "email": "john.updated@example.com",
  "age": 26
}
```

## Environment Variables

- `DB_HOST` - MySQL host
- `DB_PORT` - MySQL port
- `DB_DATABASE` - Database name
- `DB_USERNAME` - Database username
- `DB_PASSWORD` - Database password
- `PORT` - Server port (default: 3000)