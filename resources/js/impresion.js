import axios from "axios";

function impresionData() {
    return {
        whatsapp: '',
        direccion: '',
        papel: 'bond',
        color: 'bn',
        caras: '1',
        cantidad: 0,
        total: 0,
        envio: 10000,
        archivos: [],
        vistasPrevias: [],
        indice: 0,
        indicaciones: '',
        init(){
            this.calcularTotal();
        },
        calcularTotal() {
            axios.post('/calcular-precio', {
                papel: this.papel,
                color: this.color,
                caras: this.caras,
                cantidad: this.cantidad
            })
            .then(response => {
                this.total = response.data.total;
                this.envio = response.data.envio;
            })
            .catch(error => {
                console.error("Error en el cálculo de precio:", error);
            });
        },

        cargarArchivos(event) {
            this.archivos = Array.from(event.target.files);
            this.vistasPrevias = [];
            this.indice = 0; // Reiniciar índice al cargar nuevos archivos

            this.archivos.forEach((archivo, index) => {
                if (archivo.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.vistasPrevias.push(e.target.result);
                    };
                    reader.readAsDataURL(archivo);
                } else {
                    this.vistasPrevias.push(null);
                }
            });
        }
    };
}

export default impresionData;