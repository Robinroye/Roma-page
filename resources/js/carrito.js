export function carrito() {
    return {
        carrito:  [],
        
        itemCount: 0,
        
        totalCarrito: 0,

        userPhone: '',
        
        init(){
            this.carrito= JSON.parse(localStorage.getItem('carrito')) || [];
            this.updateCart();
        },
        addToCart(tipo, producto, impresionArchivos) {
            if (tipo === 'impresion') {
                producto.forEach((setting, index) => {
                    let archivo = impresionArchivos[index];
                    if (archivo) {
                        const formData = new FormData();
                        formData.append('file', archivo);

                        // Upload the file asynchronously
                        fetch('/upload-file', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                let impresion = {
                                    id: `${Math.random().toString(36).substr(2, 9)}`,
                                    impresion_papel: setting.papel,
                                    impresion_color: setting.color,
                                    impresion_caras: setting.caras,
                                    impresion_indicaciones: setting.indicaciones,
                                    impresion_archivos: data.file_url, // Store the uploaded file URL
                                    impresion_paginas_totales: setting.paginasTotales,
                                    impresion_paginas: setting.paginas,
                                    impresion_paginas_a_imprimir: setting.paginasAImprimir,
                                    precio: setting.total,
                                    cantidad: setting.cantidad || 1,
                                };

                                this.carrito.push({ ...impresion, tipo });
                                this.updateCart();
                            } else {
                                alert('Error al subir el archivo.');
                            }
                        })
                        .catch(error => {
                            console.error('Error al subir el archivo:', error);
                            alert('Error inesperado al subir el archivo.');
                        });
                    }
                });
                return;
            }
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
            this.generateWompi()
        },
        async generateWompi(){
            fetch('/carrito/pago', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    amount: this.totalCarrito * 100,
                    detalles: this.carrito,
                })
            })
            .then(res => res.json())
            .then(data => {
                let script = document.createElement('script');
                script.src = 'https://checkout.wompi.co/widget.js';
                script.setAttribute('data-render', 'button');
                script.setAttribute('data-public-key', data.publicKey);
                script.setAttribute('data-currency', data.currency);
                script.setAttribute('data-amount-in-cents', data.amountInCents);
                script.setAttribute('data-reference', data.reference);
                script.setAttribute('data-signature:integrity', data.firma);

                document.getElementById('contenedor-wompi').innerHTML = ''; // Limpia anterior
                document.getElementById('contenedor-wompi').appendChild(script);
            });
        },
        enviarPedido(userPhone) {
            if (!userPhone) {
                alert('Por favor ingresa tu número de celular.');
                return;
            }
            const pedido = {
                user_phone: userPhone,
                tipo: 'pedido', // puedes ajustar según el tipo si lo necesitas
                total: this.totalCarrito,
                detalles: this.carrito
            };
            this.generateWompi(pedido);

            // NOTA:
            // Si estás en localhost, no puedes recibir el webhook de Wompi para crear el pedido automáticamente después del pago.
            // Debes crear el pedido ANTES de mostrar el botón de pago, o pedir al usuario que confirme manualmente después del pago.
            // Ejemplo para desarrollo local: crea el pedido antes del pago (descomenta si lo deseas):

            /*
            fetch('/guardar-pedido', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(pedido)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Pedido registrado localmente. Ahora realiza el pago.');
                    this.carrito = [];
                    this.updateCart();
                    localStorage.removeItem('carrito');
                } else {
                    alert('Error al guardar el pedido.');
                }
            })
            .catch(error => {
                console.error('Error al enviar el pedido:', error);
                alert('Error inesperado al enviar el pedido.');
            });
            */
        },
        agregarMasProductos() {
            window.location.href = '/';
        }

    };
}
