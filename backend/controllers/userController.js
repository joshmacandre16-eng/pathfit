const db = require('../config/database');

const userController = {
  // CREATE - Add new user
  createUser: async (req, res) => {
    try {
      const { name, email, age } = req.body;
      const [result] = await db.execute(
        'INSERT INTO users (name, email, age) VALUES (?, ?, ?)',
        [name, email, age]
      );
      res.status(201).json({
        message: 'User created successfully',
        userId: result.insertId
      });
    } catch (error) {
      res.status(500).json({ error: error.message });
    }
  },

  // READ - Get all users
  getAllUsers: async (req, res) => {
    try {
      const [rows] = await db.execute('SELECT * FROM users');
      res.json(rows);
    } catch (error) {
      res.status(500).json({ error: error.message });
    }
  },

  // READ - Get user by ID
  getUserById: async (req, res) => {
    try {
      const { id } = req.params;
      const [rows] = await db.execute('SELECT * FROM users WHERE id = ?', [id]);
      
      if (rows.length === 0) {
        return res.status(404).json({ message: 'User not found' });
      }
      
      res.json(rows[0]);
    } catch (error) {
      res.status(500).json({ error: error.message });
    }
  },

  // UPDATE - Update user
  updateUser: async (req, res) => {
    try {
      const { id } = req.params;
      const { name, email, age } = req.body;
      
      const [result] = await db.execute(
        'UPDATE users SET name = ?, email = ?, age = ? WHERE id = ?',
        [name, email, age, id]
      );
      
      if (result.affectedRows === 0) {
        return res.status(404).json({ message: 'User not found' });
      }
      
      res.json({ message: 'User updated successfully' });
    } catch (error) {
      res.status(500).json({ error: error.message });
    }
  },

  // DELETE - Delete user
  deleteUser: async (req, res) => {
    try {
      const { id } = req.params;
      const [result] = await db.execute('DELETE FROM users WHERE id = ?', [id]);
      
      if (result.affectedRows === 0) {
        return res.status(404).json({ message: 'User not found' });
      }
      
      res.json({ message: 'User deleted successfully' });
    } catch (error) {
      res.status(500).json({ error: error.message });
    }
  }
};

module.exports = userController;