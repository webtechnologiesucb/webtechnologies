const express = require("express");
const bodyParser = require("body-parser");
const cors = require("cors");

const app = express();
const port = process.env.PORT || 5000;

app.use(bodyParser.json());
app.use(cors());

let tasks = [];

app.get("/tasks", (req, res) => {
  res.json(tasks);
});

app.post("/tasks", (req, res) => {
  const { task } = req.body;
  tasks.push(task);
  res.json({ message: "Tarea ingresada con exito" });
});

app.delete("/tasks/:index", (req, res) => {
  const { index } = req.params;
  tasks.splice(index, 1);
  res.json({ message: "Tarea eliminada con exito" });
});

app.listen(port, () => {
  console.log(`El servidor esta corriendo en ${port}`);
});
