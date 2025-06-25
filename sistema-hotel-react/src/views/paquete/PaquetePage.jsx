import { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import paqueteService from "../../service/paqueteService";

const PaquetePage = () => {
  const [paquetes, setPaquetes] = useState([]);

  useEffect(() => {
    paqueteService.getAll()
      .then((data) => {
        console.log("Paquetes desde API:", data);
        setPaquetes(data);
      })
      .catch((error) => {
        console.error("Error al obtener paquetes:", error);
      });
  }, []);

  return (
    <div>
      <h2 className="centrado">Módulo de Paquetes</h2>

      <div className="centrado margen-superior">
        <Link to="/">
          <button>Volver al Inicio</button>
        </Link>
      </div>

      <div className="tabla-container">
        <table border="1">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Precio</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {paquetes.length > 0 ? (
              paquetes.map((item) => (
                <tr key={item.idPaquete}>
                  <td>{item.idPaquete}</td>
                  <td>{item.nombre}</td>
                  <td>{item.descripcion}</td>
                  <td>{item.precio}</td>
                  <td>
                    <button>Actualizar</button>
                    <button>Eliminar</button>
                  </td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="5">No hay paquetes disponibles.</td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default PaquetePage;
