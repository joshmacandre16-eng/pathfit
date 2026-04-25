const mysql = require('mysql2/promise');

async function initializeDatabase() {
  console.log('🚀 Starting database migration...');
  
  const connection = await mysql.createConnection(process.env.DATABASE_URL);
  
  try {
    console.log('📦 Creating tables...');
    
    // Users table
    await connection.execute(`
      CREATE TABLE IF NOT EXISTS users (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        email_verified_at TIMESTAMP NULL,
        password VARCHAR(255) NOT NULL,
        role ENUM('Admin', 'Coach', 'Athlete') DEFAULT 'Athlete',
        coach_id BIGINT UNSIGNED NULL,
        photo VARCHAR(255) NULL,
        fname VARCHAR(255) NULL,
        mname VARCHAR(255) NULL,
        lname VARCHAR(255) NULL,
        course VARCHAR(255) NULL,
        gender VARCHAR(255) NULL,
        specialization VARCHAR(255) NULL,
        experience INT NULL,
        remember_token VARCHAR(100) NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (coach_id) REFERENCES users(id) ON DELETE SET NULL
      )
    `);
    
    // Training schedules table
    await connection.execute(`
      CREATE TABLE IF NOT EXISTS training_schedules (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT NULL,
        date DATE NOT NULL,
        start_time TIME NOT NULL,
        end_time TIME NOT NULL,
        coach_id BIGINT UNSIGNED NOT NULL,
        user_id BIGINT UNSIGNED NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (coach_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
      )
    `);
    
    // Sport activities table
    await connection.execute(`
      CREATE TABLE IF NOT EXISTS sport_activities (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        description TEXT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
      )
    `);
    
    // Sport availables table
    await connection.execute(`
      CREATE TABLE IF NOT EXISTS sport_availables (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        description TEXT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
      )
    `);
    
    // Activity reports table
    await connection.execute(`
      CREATE TABLE IF NOT EXISTS activity_reports (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id BIGINT UNSIGNED NOT NULL,
        activity_date DATE NOT NULL,
        activity_type ENUM('training', 'competition', 'practice', 'recovery', 'other') NOT NULL,
        duration INT NOT NULL,
        description TEXT NOT NULL,
        performance_rating INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
      )
    `);
    
    // Sport requirements table
    await connection.execute(`
      CREATE TABLE IF NOT EXISTS sport_requirements (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        sport_available_id BIGINT UNSIGNED NOT NULL,
        coach_id BIGINT UNSIGNED NOT NULL,
        sport_name VARCHAR(255) NULL,
        min_height INT NULL,
        max_height INT NULL,
        min_weight INT NULL,
        max_weight INT NULL,
        min_age INT NULL,
        max_age INT NULL,
        required_gender ENUM('male', 'female', 'both') DEFAULT 'both',
        min_experience_years INT NULL,
        required_level VARCHAR(255) NULL,
        required_positions JSON NULL,
        preferred_attributes JSON NULL,
        medical_restrictions JSON NULL,
        additional_notes TEXT NULL,
        is_active BOOLEAN DEFAULT TRUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (sport_available_id) REFERENCES sport_availables(id) ON DELETE CASCADE,
        FOREIGN KEY (coach_id) REFERENCES users(id) ON DELETE CASCADE,
        UNIQUE KEY unique_sport_coach (sport_available_id, coach_id)
      )
    `);
    
    // Messages table
    await connection.execute(`
      CREATE TABLE IF NOT EXISTS messages (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        sender_id BIGINT UNSIGNED NOT NULL,
        receiver_id BIGINT UNSIGNED NOT NULL,
        content TEXT NOT NULL,
        is_read BOOLEAN DEFAULT FALSE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (receiver_id) REFERENCES users(id) ON DELETE CASCADE
      )
    `);
    
    // Session schedules table
    await connection.execute(`
      CREATE TABLE IF NOT EXISTS session_schedules (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT NULL,
        date DATE NOT NULL,
        start_time TIME NOT NULL,
        end_time TIME NOT NULL,
        coach_id BIGINT UNSIGNED NOT NULL,
        athlete_id BIGINT UNSIGNED NOT NULL,
        duration INT NOT NULL,
        status ENUM('scheduled', 'completed', 'cancelled') DEFAULT 'scheduled',
        notes TEXT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (coach_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (athlete_id) REFERENCES users(id) ON DELETE CASCADE
      )
    `);
    
    // Welcome contents table
    await connection.execute(`
      CREATE TABLE IF NOT EXISTS welcome_contents (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        section VARCHAR(255) NOT NULL,
        \`key\` VARCHAR(255) NOT NULL,
        value VARCHAR(255) NULL,
        content TEXT NULL,
        \`order\` INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
      )
    `);
    
    // Footer links table
    await connection.execute(`
      CREATE TABLE IF NOT EXISTS footer_links (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        slug VARCHAR(255) UNIQUE NOT NULL,
        \`column\` VARCHAR(255) NOT NULL,
        \`order\` INT DEFAULT 0,
        content TEXT NULL,
        is_active BOOLEAN DEFAULT TRUE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
      )
    `);
    
    console.log('✅ Tables created');
    
    // ========== SEED DATA ==========
    console.log('🌱 Seeding data...');
    
    const [userRows] = await connection.execute('SELECT COUNT(*) as count FROM users');
    
    if (userRows[0].count === 0) {
      const users = [
        ['Admin User', 'Admin', null, 'User', 'Administration', 'male', 'admin@pathfit.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin'],
        ['Coach Michael Johnson', 'Michael', 'James', 'Johnson', 'Sports Science', 'male', 'coach.johnson@pathfit.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Coach'],
        ['Coach Sarah Williams', 'Sarah', 'Marie', 'Williams', 'Physical Education', 'female', 'coach.williams@pathfit.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Coach'],
        ['John Doe Smith', 'John', 'Doe', 'Smith', 'Computer Science', 'male', 'john.smith@pathfit.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Athlete'],
        ['Emma Rose Davis', 'Emma', 'Rose', 'Davis', 'Business Administration', 'female', 'emma.davis@pathfit.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Athlete']
      ];
      
      for (const user of users) {
        await connection.execute(
          'INSERT INTO users (name, fname, mname, lname, course, gender, email, password, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)',
          user
        );
      }
      console.log(`✅ Added ${users.length} users`);
    }
    
    const [sportRows] = await connection.execute('SELECT COUNT(*) as count FROM sport_availables');
    
    if (sportRows[0].count === 0) {
      const sports = [
        ['Basketball', 'Team sport played on a court'],
        ['Football', 'Popular team sport'],
        ['Swimming', 'Individual water sport'],
        ['Track and Field', 'Athletics events']
      ];
      
      for (const sport of sports) {
        await connection.execute(
          'INSERT INTO sport_availables (name, description) VALUES (?, ?)',
          sport
        );
      }
      console.log(`✅ Added ${sports.length} sports`);
    }
    
    console.log('✅ Database initialization complete!');
    
  } catch (error) {
    console.error('❌ Migration failed:', error);
    throw error;
  } finally {
    await connection.end();
  }
}

if (require.main === module) {
  initializeDatabase().catch(console.error);
}

module.exports = initializeDatabase;
