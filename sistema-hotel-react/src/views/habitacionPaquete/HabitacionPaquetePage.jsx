import { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import habitacionPaqueteService from "../../service/habitacionPaqueteService";

const HabitacionPaquetePage = () => {
  const [habitacionPaquetes, setHabitacionPaquetes] = useState([]);

  useEffect(() => {
    habitacionPaqueteService.getAll()
      .then((data) => {
        console.log("DATA DESDE API (HabitacionPaquete):", data);
        setHabitacionPaquetes(data);
      })
      .catch((error) => {
        console.error("Error al obtener habitacion-paquetes:", error);
      });
  }, []);

  return (
    <div>
      <h2 style={{ textAlign: "center" }}>Módulo de Habitación-Paquete</h2>

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
              <th>ID Paquete</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {habitacionPaquetes.length > 0 ? (
              habitacionPaquetes.map((item) => (
                <tr key={item.idHabitacionPaquete}>
                  <td>{item.idHabitacionPaquete}</td>
                  <td>{item.idHabitacion}</td>
                  <td>{item.idPaquete}</td>
                  <td>
                    <button>Actualizar</button>
                    <button>Eliminar</button>
                  </td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="4">No hay registros disponibles.</td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default HabitacionPaquetePage;
