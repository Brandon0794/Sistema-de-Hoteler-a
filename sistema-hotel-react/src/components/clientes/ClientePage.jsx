import { useState, useEffect } from 'react';
import clienteService from '../../service/clientesService';

const ClientePage = () => {

  // Estado: lista de clientes
  const [clientes, setClientes] = useState([]);

  // Cargar clientes al montar
  useEffect(() => {
    clienteService.getAll()
      .then((respuesta) => {
        console.log('Datos:', respuesta);
        setClientes(respuesta);
      })
      .catch((error) => {
        console.error('Error al cargar clientes:', error);
      });
  }, []);

  return (
    <div>
      <h2>Módulo de Clientes</h2>
      <table border="1" cellPadding="5">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          {
            clientes.map((cliente) => (
              <tr key={cliente.idCliente}>
                <td>{cliente.idCliente}</td>
                <td>{cliente.nombre}</td>
                <td>{cliente.correo}</td>
                <td>
                  Actualizar | Eliminar
                </td>
              </tr>
            ))
          }
        </tbody>
      </table>
    </div>
  );
};

export default ClientePage;
