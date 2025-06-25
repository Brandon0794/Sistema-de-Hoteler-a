import { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import detalleReservacionService from "../../service/detalleReservacionService";

const DetalleReservacionPage = () => {
  const [detalles, setDetalles] = useState([]);

  useEffect(() => {
    detalleReservacionService.getAll()
      .then((data) => {
        console.log("DATA DESDE API (detalleReservacion):", data);
        setDetalles(data);
      })
      .catch((error) => {
        console.error("Error al obtener detalles de reservación:", error);
      });
  }, []);

  return (
    <div>
      <h2 style={{ textAlign: "center" }}>Módulo de Detalle de Reservación</h2>

      <div className="centrado margen-superior">
        <Link to="/">
          <button>Volver al Inicio</button>
        </Link>
      </div>

      <div className="tabla-container">
        <table border="1">
          <thead>
            <tr>
              <th>ID Detalle</th>
              <th>ID Reservación</th>
              <th>ID Habitación</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {detalles.length > 0 ? (
              detalles.map((item) => (
                <tr key={item.idDetalle}>
                  <td>{item.idDetalle}</td>
                  <td>{item.idReservacion}</td>
                  <td>{item.idHabitacion}</td>
                  <td>
                    <button>Actualizar</button>
                    <button>Eliminar</button>
                  </td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="4">No hay detalles de reservación disponibles.</td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default DetalleReservacionPage;
