import { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import consumoService from "../../service/consumoService";


const ConsumoPage = () => {
  const [consumos, setConsumos] = useState([]);

  useEffect(() => {
    consumoService.getAll()
      .then((data) => {
        console.log("DATA DESDE API:", data);
        setConsumos(data);
      })
      .catch((error) => {
        console.error("Error al obtener consumos:", error);
      });
  }, []);

  return (
    <div>
      <h2 style={{ textAlign: "center" }}>Módulo de Consumo</h2>

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
              <th>Reservación</th>
              <th>Servicio</th>
              <th>Cantidad</th>
              <th>Fecha</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {consumos.length > 0 ? (
              consumos.map((item) => (
                <tr key={item.idConsumo}>
                  <td>{item.idConsumo}</td>
                  <td>{item.idReservacion}</td>
                  <td>{item.idServicio}</td>
                  <td>{item.cantidad}</td>
                  <td>{item.fecha}</td>
                  <td>
                    <button>Actualizar</button>
                    <button>Eliminar</button>
                  </td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="6">No hay consumos disponibles.</td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default ConsumoPage;
