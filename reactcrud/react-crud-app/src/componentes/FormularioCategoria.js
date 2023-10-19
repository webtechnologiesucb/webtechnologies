import React, { useState } from "react";
import { Form, Button } from "react-bootstrap";
//import { v4 as uuidv4 } from "uuid";

const FormularioCategoria = (props) => {
  const [categoria, setCategoria] = useState({
    nombreCategoria: props.categoria ? props.categoria.nombre : "",
  });

  const [errorMsg, setErrorMsg] = useState("");
  const { nombreCategoria } = categoria;

  const handleOnSubmit = (event) => {
    event.preventDefault();
    const valores = [nombreCategoria];
    let errorMsg = "";

    const todosLosCamposLlenos = valores.every((campo) => {
      const valor = `${campo}`.trim();
      return valor !== "" && valor !== "0";
    });

    if (todosLosCamposLlenos) {
      const categoria = {
        nombreCategoria,
      };
      props.handleOnSubmit(categoria);
    } else {
      errorMsg = "Por favor, rellene todos los campos.";
    }
    setErrorMsg(errorMsg);
  };

  const handleInputChange = (event) => {
    const { nombre, valor } = event.target;
    switch (nombre) {
      case "cantidad":
        if (valor === "" || parseInt(valor) === +valor) {
          setCategoria((prevState) => ({
            ...prevState,
            [nombre]: valor,
          }));
        }
        break;
      case "precio":
        if (valor === "" || valor.match(/^\d{1,}(\.\d{0,2})?$/)) {
          setCategoria((prevState) => ({
            ...prevState,
            [nombre]: valor,
          }));
        }
        break;
      default:
        setCategoria((prevState) => ({
          ...prevState,
          [nombre]: valor,
        }));
    }
  };

  return (
    <div className="main-form">
      {errorMsg && <p className="errorMsg">{errorMsg}</p>}
      <Form onSubmit={handleOnSubmit}>
        <Form.Group controlId="nombre">
          <Form.Label>Nombre de Categoria</Form.Label>
          <Form.Control
            className="input-control"
            type="text"
            name="nombreCategoria"
            value={nombreCategoria}
            placeholder="Ingrese el nombre de categoria"
            onChange={handleInputChange}
          />
        </Form.Group>
        <Button variant="primary" type="submit" className="submit-btn">
          Enviar
        </Button>
      </Form>
    </div>
  );
};

export default FormularioCategoria;
