import React from "react";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import Header from "../componentes/Header";
import AgregaCategoria from "../componentes/AgregaCategoria";
import ListaCategorias from "../componentes/ListaCategorias";

const EnrutadorApp = () => {
  return (
    <BrowserRouter>
      <div>
        <Header />
        <div className="main-content">
          <Routes>
            <Route component={ListaCategorias} path="/" exact={true} />
            <Route component={AgregaCategoria} path="/add" />
          </Routes>
        </div>
      </div>
    </BrowserRouter>
  );
};

export default EnrutadorApp;
