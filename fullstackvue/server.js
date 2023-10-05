const express = require("express");
const bodyParser = require("body-parser");
const cors = require("cors");

const app = express();
const port = process.env.PORT || 3000;

app.use(bodyParser.json());
app.use(cors());

let tasks = [];

app.get("/tasks", (req, res) => {
  res.json(tasks);
});

app.post("/tasks", (req, res) => {
  const { task } = req.body;
  tasks.push(task);
  res.status(201).json({ message: "Tarea adicionada exitosamente" });
});

app.delete("/tasks/:id", (req, res) => {
  const id = parseInt(req.params.id);
  tasks.splice(id, 1);
  res.json({ message: "Tarea borrada exitosamente" });
});

app.listen(port, () => {
  console.log(`El servidor corre en el puerto ${port}`);
});
