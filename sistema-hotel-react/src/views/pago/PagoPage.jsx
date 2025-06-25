import { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import pagoService from "../../service/pagoService";

const PagoPage = () => {
  const [pagos, setPagos] = useState([]);

  useEffect(() => {
    pagoService.getAll()
      .then((data) => {
        console.log("Pagos desde API:", data);
        setPagos(data);
      })
      .catch((error) => {
        console.error("Error al obtener pagos:", error);
      });
  }, []);

  return (
    <div>
      <h2 className="centrado">Módulo de Pagos</h2>

      <div className="centrado margen-superior">
        <Link to="/">
          <button>Volver al Inicio</button>
        </Link>
      </div>

      <div className="tabla-container">
        <table border="1">
          <thead>
            <tr>
              <th>ID Pago</th>
              <th>ID Reservación</th>
              <th>Monto</th>
              <th>Método de Pago</th>
              <th>Fecha de Pago</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {pagos.length > 0 ? (
              pagos.map((item) => (
                <tr key={item.idPago}>
                  <td>{item.idPago}</td>
                  <td>{item.idReservacion}</td>
                  <td>{item.monto}</td>
                  <td>{item.metodoPago}</td>
                  <td>{item.fechaPago}</td>
                  <td>
                    <button>Actualizar</button>
                    <button>Eliminar</button>
                  </td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="6">No hay pagos disponibles.</td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default PagoPage;
