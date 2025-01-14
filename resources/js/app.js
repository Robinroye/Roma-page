import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import Alpine from 'alpinejs';
import { calculadora } from './calculadora.js';

// Si quieres usarlo globalmente:
window.calculadora = calculadora;


window.Alpine = Alpine;

Alpine.start();