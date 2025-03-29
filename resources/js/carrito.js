
export function carrito() {
    return {
        carrito:  [],
        
        itemCount: 0,
        
        totalCarrito: 0,
        
        init(){
            this.carrito= JSON.parse(localStorage.getItem('carrito')) || [];
            this.updateCart();
        },
        addToCart(tipo, producto) {
            let index = this.carrito.findIndex(p => p.id === producto.id && p.tipo === tipo);
            
            if (index !== -1) {
                this.carrito[index].cantidad = Number(this.carrito[index].cantidad) + Number(producto.cantidad);
            } else {
                this.carrito.push({ ...producto, tipo });
            }

            this.updateCart();
        },
        editarProducto (){
            this.editing= true;
        },
        guardarEdiciones(index, type, conversion){
            this.editing= false;
            switch(type){
                case 'variedades':
                    this.carrito[index].cantidad= this.cantidadVariedad;
                    break;
                case 'giro':
                    this.convertir(conversion)
                    this.carrito[index].monto_bss= this.bss;
                    this.carrito[index].monto_dolares= this.dolares;
                    this.carrito[index].monto_cop= this.cop; 
                    this.carrito[index].precio= this.cop; 
                    break;
                case 'impresion':
                    this.carrito[index].cantidad= this.cantidadImpresion;
                    break;
            }
            this.updateCart();
        },
        descartarEdiciones(){
            this.editing= false;
        },
        eliminarDelCarrito(ind) {
            this.carrito.splice(ind, 1);
            this.updateCart();
        },
        updateCart() {

            this.totalCarrito = this.carrito.reduce((total, item) => total + (Number(item.precio) * Number(item.cantidad)), 0).toFixed(2);
            this.itemCount = this.carrito.reduce((total, item) => total + Number(item.cantidad), 0);

            localStorage.setItem('carrito', JSON.stringify(this.carrito));
        }
    };
}
