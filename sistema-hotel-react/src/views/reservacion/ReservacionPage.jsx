import { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import reservacionService from "../../service/reservacionService";

const ReservacionPage = () => {
  const [reservaciones, setReservaciones] = useState([]);

  useEffect(() => {
    reservacionService.getAll()
      .then((data) => {
        console.log("DATA RESERVACIONES:", data);
        setReservaciones(data);
      })
      .catch((error) => {
        console.error("Error al obtener reservaciones:", error);
      });
  }, []);

  return (
    <div>
      <h2 className="centrado">Módulo de Reservaciones</h2>

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
              <th>ID Cliente</th>
              <th>Fecha Inicio</th>
              <th>Fecha Fin</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {reservaciones.length > 0 ? (
              reservaciones.map((item) => (
                <tr key={item.idReservacion}>
                  <td>{item.idReservacion}</td>
                  <td>{item.idCliente}</td>
                  <td>{item.fechaInicio}</td>
                  <td>{item.fechaFin}</td>
                  <td>{item.estado}</td>
                  <td>
                    <button>Actualizar</button>
                    <button>Eliminar</button>
                  </td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="6">No hay reservaciones disponibles.</td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default ReservacionPage;
