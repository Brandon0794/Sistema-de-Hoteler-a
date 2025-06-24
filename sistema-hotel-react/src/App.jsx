import { useState } from 'react'
import reactLogo from './assets/react.svg'
import viteLogo from '/vite.svg'
import './App.css'
import ClientePage from './components/clientes/ClientePage'
import {Routes, Route,Link} from 'react-router-dom'
import ConsumoPage from './components/consumo/ConsumoPage'
import DetalleReservacionPage from './components/detalleReservacion/DetalleReservacionPage'
import HabitacionPage from './components/habitacion/habitacionPage'
import HabitacionPaquetePage from './components/habitacionPaquete/habitacionPaquetePage'
import MantenimientoPage from './components/mantenimientoHabitacion/MantenimientoHabitacionPage'
import PagoPage from './components/pago/PagoPage'
import PaquetePage from './components/paquete/PaquetePage'
import ReservacionPage from './components/reservacion/ReservacionPage'
import ServicioExtraPage from './components/servicioExtra/ServicioExtraPage'
import TipoHabitacionPage from './components/tipoHabitacion/TipoHabitacionPage'
import UsuarioPage from './components/usuario/UsuarioPage'



function App() {
  const [count, setCount] = useState(0)

  return (
    <>
      <div>
        <a href="https://vite.dev" target="_blank">
          <img src={viteLogo} className="logo" alt="Vite logo" />
        </a>
        <a href="https://react.dev" target="_blank">
          <img src={reactLogo} className="logo react" alt="React logo" />
        </a>
      </div>
      <h1>Vite + React</h1>

      <div>
        <nav>
          <ul>
            <li>
              <Link to="clientes">Clientes</Link>
              
            </li>
            <li>
              <Link to="consumo">Consumo</Link>
              
            </li>

            <li>
              <Link to="detalleReservacion">Detalle Reservación</Link>
              
            </li>

            <li>
              <Link to="habitacion">Habitación</Link>
              
            </li>

            <li>
              <Link to="habitacionPaquete">Paquete Habitación</Link>
              
            </li>

            <li>
              <Link to="pago">Pago</Link>
              
            </li>

            <li>
              <Link to="paquete">Paquete</Link>
              
            </li>

            <li>
              <Link to="mantenimientoHabitacion">Mantenimiento de Habitación</Link>
              
            </li>

            <li>
              <Link to="reservacion">Reservación</Link>
              
            </li>

            <li>
              <Link to="servicioExtra">Servicio Extra</Link>
              
            </li>

            <li>
              <Link to="tipoHabitacion">Tipo de Habitación</Link>
              
            </li>

            <li>
              <Link to="usuario">Usuario</Link>
              
            </li>

            
          </ul>
        </nav>
      </div>

      <Routes>
        <Route path='clientes' element={<ClientePage/>}>  </Route>
        <Route path='consumo' element={<ConsumoPage/>}>  </Route>
        <Route path='detalleReservacion' element={<DetalleReservacionPage/>}>  </Route>
        <Route path='habitacion' element={<HabitacionPage/>}>  </Route>
        <Route path='habitacionPaquete' element={<HabitacionPaquetePage/>}>  </Route>
        <Route path='mantenimientoHabitacion' element={<MantenimientoPage/>}>  </Route>
        <Route path='pago' element={<PagoPage/>}>  </Route>
        <Route path='paquete' element={<PaquetePage/>}>  </Route>
        <Route path='reservacion' element={<ReservacionPage/>}>  </Route>
        <Route path='servicioExtra' element={<ServicioExtraPage/>}>  </Route>
        <Route path='tipoHabitacion' element={<TipoHabitacionPage/>}>  </Route>
        <Route path='usuario' element={<UsuarioPage/>}>  </Route>

      </Routes>
 


    

  

      <div className="card">
        <button onClick={() => setCount((count) => count + 1)}>
          count is {count}
        </button>
        <p>
          Edit <code>src/App.jsx</code> and save to test HMR
        </p>
      </div>
      <p className="read-the-docs">
        Click on the Vite and React logos to learn more
      </p>
    </>
  )
}

export default App
