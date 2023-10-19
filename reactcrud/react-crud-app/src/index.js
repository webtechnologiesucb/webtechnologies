import React from "react";
import ReactDOM from "react-dom/client";
import EnrutadorApp from "./enrutadores/EnrutadorApp";
import "bootstrap/dist/css/bootstrap.min.css";
import "./styles.scss";

const root = ReactDOM.createRoot(document.getElementById("root"));
root.render(<EnrutadorApp />);
