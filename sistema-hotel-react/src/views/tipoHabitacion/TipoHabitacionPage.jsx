import { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import tipoHabitacionService from "../../service/tipoHabitacionService";

const TipoHabitacionPage = () => {
  const [tipos, setTipos] = useState([]);

  useEffect(() => {
    tipoHabitacionService.getAll()
      .then((data) => {
        console.log("TIPOS DE HABITACIÓN DESDE API:", data);
        setTipos(data);
      })
      .catch((error) => {
        console.error("Error al obtener tipos de habitación:", error);
      });
  }, []);

  return (
    <div>
      <h2 className="centrado">Módulo de Tipos de Habitación</h2>

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
            {tipos.length > 0 ? (
              tipos.map((tipo) => (
                <tr key={tipo.idTipo}>
                  <td>{tipo.idTipo}</td>
                  <td>{tipo.nombre}</td>
                  <td>{tipo.descripcion}</td>
                  <td>
                    <button>Actualizar</button>
                    <button>Eliminar</button>
                  </td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="4">No hay tipos de habitación disponibles.</td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default TipoHabitacionPage;
