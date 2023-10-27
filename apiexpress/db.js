// db.js
const mysql = require("mysql");

const connection = mysql.createConnection({
  host: "localhost",
  user: "root",
  port: 3306,
  password: "",
  database: "sakila", // Nombre de la base de datos Sakila
});

connection.connect((error) => {
  if (error) {
    console.error("Error de conexión a la base de datos: " + error.stack);
    return;
  }
  console.log(
    "Conexión a la base de datos establecida como el ID " + connection.threadId
  );
});

module.exports = connection;
