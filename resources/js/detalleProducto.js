export function detalleProducto() {
    return {
        producto: {
            id: '',
            nombre: '',
            precio: '',
            descripcion: '',
            imagenes: [],
        },
        async cargarDetalle(id) {
            try {
                const response = await fetch(`/variedades/producto/${id}`);
                if (!response.ok) {
                    throw new Error('No se pudo cargar el detalle del producto');
                }
                const data = await response.json();
                this.producto = data;
                this.producto.imagenes= JSON.parse(this.producto.imagenes)
            } catch (error) {
                console.error('Error:', error);
                alert('Hubo un problema al cargar los datos del producto.');
            }
        },
    };
}