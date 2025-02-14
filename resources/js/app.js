import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import Alpine from 'alpinejs';
import { carrito } from './carrito.js';
import { calculadora } from './calculadora.js';
import { detalleProducto } from './detalleProducto.js';
import impresionData from "./impresion";

// ✅ Hacer que las funciones sean accesibles globalmente si es necesario
window.Alpine = Alpine;
window.carritoGlobal = carrito;
window.calculadora = calculadora;
window.detalleProducto = detalleProducto;
window.impresionData = impresionData;

// ✅ Iniciar Alpine.js
Alpine.start();
