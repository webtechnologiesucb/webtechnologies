import React from "react";
import { NavLink } from "react-router-dom";

const Header = () => {
  return (
    <header>
      <h1>Aplicación de Administración de Categorias</h1>
      <hr />
      <div className="links">
        <NavLink to="/" className="link" activeClassName="active" exact>
          Lista de Categorias
        </NavLink>
        <NavLink to="/add" className="link" activeClassName="active">
          Agrega Categoria
        </NavLink>
      </div>
    </header>
  );
};

export default Header;
