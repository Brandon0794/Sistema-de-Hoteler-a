import { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import mantenimientoHabitacionService from "../../service/mantenimientoHabitacionService";

const MantenimientoHabitacionPage = () => {
  const [mantenimientos, setMantenimientos] = useState([]);

  useEffect(() => {
    mantenimientoHabitacionService.getAll()
      .then((data) => {
        console.log("MANTENIMIENTOS:", data);
        setMantenimientos(data);
      })
      .catch((error) => {
        console.error("Error al obtener mantenimientos:", error);
      });
  }, []);

  return (
    <div>
      <h2 style={{ textAlign: "center" }}>Módulo de Mantenimiento de Habitaciones</h2>

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
              <th>ID Habitación</th>
              <th>Descripción</th>
              <th>Fecha</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {mantenimientos.length > 0 ? (
              mantenimientos.map((item) => (
                <tr key={item.idMantenimiento}>
                  <td>{item.idMantenimiento}</td>
                  <td>{item.idHabitacion}</td>
                  <td>{item.descripcion}</td>
                  <td>{item.fecha}</td>
                  <td>
                    <button>Actualizar</button>
                    <button>Eliminar</button>
                  </td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="5">No hay mantenimientos registrados.</td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default MantenimientoHabitacionPage;

