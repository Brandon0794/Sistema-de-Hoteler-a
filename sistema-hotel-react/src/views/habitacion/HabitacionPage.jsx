import { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import habitacionService from "../../service/habitacionService";

const HabitacionPage = () => {
  const [habitaciones, setHabitaciones] = useState([]);

  useEffect(() => {
    habitacionService.getAll()
      .then((data) => {
        console.log("Habitaciones desde API:", data);
        setHabitaciones(data);
      })
      .catch((error) => {
        console.error("Error al obtener habitaciones:", error);
      });
  }, []);

  return (
    <div>
      <h2 style={{ textAlign: "center" }}>Módulo de Habitaciones</h2>

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
              <th>Número</th>
              <th>ID Tipo</th>
              <th>Precio</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {habitaciones.length > 0 ? (
              habitaciones.map((item) => (
                <tr key={item.idHabitacion}>
                  <td>{item.idHabitacion}</td>
                  <td>{item.numero}</td>
                  <td>{item.idTipo}</td>
                  <td>{item.precio}</td>
                  <td>
                    <button>Actualizar</button>
                    <button>Eliminar</button>
                  </td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="5">No hay habitaciones disponibles.</td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default HabitacionPage;
