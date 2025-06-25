import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import usuarioService from "../../service/usuarioService";

const UsuarioPage = () => {
  const [usuarios, setUsuarios] = useState([]);

  useEffect(() => {
    usuarioService.getAll()
      .then((data) => {
        console.log("Datos de usuarios:", data);
        setUsuarios(data);
      })
      .catch((error) => {
        console.error("Error al obtener usuarios:", error);
      });
  }, []);

  return (
    <div>
      <h2 className="centrado">Módulo de Usuarios</h2>

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
              <th>Nombre de Usuario</th>
              <th>Clave (Hash)</th>
              <th>Rol</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            {usuarios.length > 0 ? (
              usuarios.map((item) => (
                <tr key={item.idUsuario}>
                  <td>{item.idUsuario}</td>
                  <td>{item.nombreUsuario}</td>
                  <td>{item.claveHash}</td>
                  <td>{item.rol}</td>
                  <td>{item.estado}</td>
                  <td>
                    <button>Actualizar</button>
                    <button>Eliminar</button>
                  </td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="6">No hay usuarios disponibles.</td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default UsuarioPage;
