import { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import servicioExtraService from "../../service/servicioExtraService";

const ServicioExtraPage = () => {
  const [servicios, setServicios] = useState([]);

  useEffect(() => {
    servicioExtraService.getAll()
      .then((data) => {
        console.log("Servicios extra desde API:", data);
        setServicios(data);
      })
      .catch((error) => {
        console.error("Error al obtener servicios extra:", error);
      });
  }, []);

  return (
    <div>
      <h2 className="centrado">Módulo de Servicios Extra</h2>

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
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {servicios.length > 0 ? (
              servicios.map((item) => (
                <tr key={item.idServicio}>
                  <td>{item.idServicio}</td>
                  <td>{item.nombre}</td>
                  <td>{item.descripcion}</td>
                  <td>
                    <button>Actualizar</button>
                    <button>Eliminar</button>
                  </td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="4">No hay servicios extra disponibles.</td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default ServicioExtraPage;
