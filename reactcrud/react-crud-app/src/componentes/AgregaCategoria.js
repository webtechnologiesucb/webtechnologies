import React from "react";
import FormularioCategoria from "./FormularioCategoria";

const AgregaCategoria = () => {
  const handleOnSubmit = (categoria) => {
    console.log(categoria);
  };

  return (
    <React.Fragment>
      <FormularioCategoria handleOnSubmit={handleOnSubmit} />
    </React.Fragment>
  );
};

export default AgregaCategoria;
