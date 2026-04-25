const express = require('express');
const cors = require('cors');

const app = express();
const PORT = process.env.PORT || 3000;

// Middleware
app.use(cors());
app.use(express.json());

// Health check endpoint
app.get('/', (req, res) => {
  res.json({ 
    message: 'PathFit Backend API is running!',
    status: 'OK',
    timestamp: new Date().toISOString()
  });
});

// Test endpoint
app.get('/api/test', (req, res) => {
  res.json({ message: 'API is working!' });
});

// Start server
app.listen(PORT, () => {
  console.log(`✅ Server running on http://localhost:${PORT}`);
});