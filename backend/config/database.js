const mysql = require("mysql2/promise");
require("dotenv").config();

const databaseUrl = process.env.MYSQL_URL;
const pool = mysql.createPool(databaseUrl);

module.exports = pool;
