import { Routes, Route } from 'react-router-dom';
import './App.css';

import ClientePage from './views/clientes/ClientePage';
import ConsumoPage from './views/consumo/ConsumoPage';
import DetalleReservacionPage from './views/detalleReservacion/DetalleReservacionPage';
import HabitacionPage from './views/habitacion/HabitacionPage';
import HabitacionPaquetePage from './views/habitacionPaquete/HabitacionPaquetePage';
import MantenimientoPage from './views/mantenimientoHabitacion/MantenimientoHabitacionPage';
import PagoPage from './views/pago/PagoPage';
import PaquetePage from './views/paquete/PaquetePage';
import ReservacionPage from './views/reservacion/ReservacionPage';
import ServicioExtraPage from './views/servicioExtra/ServicioExtraPage';
import TipoHabitacionPage from './views/tipoHabitacion/TipoHabitacionPage';
import UsuarioPage from './views/usuario/UsuarioPage';
import Home from './views/Home';

function App() {
  return (
    <Routes>
      <Route path="/" element={<Home />} />
      <Route path="/clientes" element={<ClientePage />} />
      <Route path="/consumo" element={<ConsumoPage />} />
      <Route path="/detalleReservacion" element={<DetalleReservacionPage />} />
      <Route path="/habitacion" element={<HabitacionPage />} />
      <Route path="/habitacionPaquete" element={<HabitacionPaquetePage />} />
      <Route path="/mantenimientoHabitacion" element={<MantenimientoPage />} />
      <Route path="/pago" element={<PagoPage />} />
      <Route path="/paquete" element={<PaquetePage />} />
      <Route path="/reservacion" element={<ReservacionPage />} />
      <Route path="/servicioExtra" element={<ServicioExtraPage />} />
      <Route path="/tipoHabitacion" element={<TipoHabitacionPage />} />
      <Route path="/usuario" element={<UsuarioPage />} />
    </Routes>
  );
}

export default App;
