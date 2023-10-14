// app.js
const express = require("express");
const app = express();
const bodyParser = require("body-parser");
const cors = require("cors");

const categoryRoutes = require("./categoryRoutes");

// Middleware para el análisis de solicitudes JSON
app.use(bodyParser.json());
app.use(cors());

// Rutas de la categoría
app.use("/api", categoryRoutes);

const puerto = 3000;

app.listen(puerto, () => {
  console.log(`Servidor en ejecución en http://localhost:${puerto}`);
});
