export function adminGiros() {
    return {
        completionOrders: {},
        showPending: true,
        showCompleted: false,
        allOrders: [],
        orders: [],
        init() {
            this.getOrders();
            this.$watch('showPending', () => {
                this.filter();
            });
            this.$watch('showCompleted', () => {
                this.filter();
            });
        },
        async getOrders() {
            try {
                const response = await fetch('/girosOrders');
                if (!response.ok) {
                    throw new Error('Failed to fetch orders');
                }
                const data = await response.json();
                this.orders = data.orders;
                this.allOrders = data.orders;
                data.orders.forEach(order => {
                    this.completionOrders[order.id] = {};
                    order.detalles.forEach(detalle => {
                        this.completionOrders[order.id][detalle.id] = this.checkCompletion(order.id, detalle.id);
                    });
                });
                this.filter()
            } catch (error) {
                console.error('Error fetching orders:', error);
            }
        },
        filter(){
            this.orders = this.allOrders.filter(order => {
                if (this.showPending && this.showCompleted) return true;
                if (this.showPending && order.estado === 'pendiente') return true;
                if (this.showCompleted && order.estado === 'despachado') return true;
                return false;
            });
        },
        saveCompletion(pedido, detalle, checked) {
            localStorage.setItem(`giros_${pedido}_detalle_${detalle}`, JSON.stringify(checked));
        },
        checkCompletion(pedido, detalle) {
            return JSON.parse(localStorage.getItem(`giros_${pedido}_detalle_${detalle}`)) || false;
        },
        allDetailsCompleted(pedido) {
            let allCompleted = true;
            Object.values(this.completionOrders[pedido]).forEach(completed => {
                if (!completed) {
                    allCompleted = false;
                }
            });
            return allCompleted;
        },
        async completeOrder(pedido) {
            try {
                const response = await fetch(`/girosOrders/${pedido}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ estado: 'despachado' })
                });

                if (!response.ok) {
                    throw new Error('Failed to update order status');
                }

                const data = await response.json();
                console.log(`Order ${pedido} marked as completed:`, data);

                // Update estado in allOrders and orders
                this.allOrders = this.allOrders.map(order => {
                    if (order.id === pedido) {
                        order.estado = 'despachado';
                    }
                    return order;
                });

                this.orders = this.orders.map(order => {
                    if (order.id === pedido) {
                        order.estado = 'despachado';
                    }
                    return order;
                });

                this.filter(); // Reapply filters to reflect changes
            } catch (error) {
                console.error('Error completing order:', error);
            }
        },
        async dontCompleteOrder(pedido) {
            try {
                const response = await fetch(`/girosOrders/${pedido}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ estado: 'pendiente' })
                });

                if (!response.ok) {
                    throw new Error('Failed to update order status');
                }

                const data = await response.json();
                console.log(`Order ${pedido}
                marked as not completed:`, data);
                this.allOrders = this.allOrders.map(order => {
                    if (order.id === pedido) {
                        order.estado = 'pendiente';
                    }
                    return order;
                });

                this.orders = this.orders.map(order => {
                    if (order.id === pedido) {
                        order.estado = 'pendiente';
                    }
                    return order;
                });

                this.filter();
            } catch (error) {
                console.error('Error reverting order:', error);
            }
        },
        destroyOrder(pedido) {
            if (!confirm('Are you sure you want to delete this order?')) {
                return;
            }

            fetch(`/girosOrders/${pedido}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to delete order');
                }
                return response.json();
            })
            .then(data => {
                console.log(`Order ${pedido} deleted:`, data);

                // Remove the deleted order from allOrders and orders
                this.allOrders = this.allOrders.filter(order => order.id !== pedido);
                this.orders = this.orders.filter(order => order.id !== pedido);

                this.filter(); // Reapply filters to reflect changes
            })
            .catch(error => {
                console.error('Error deleting order:', error);
            });
        }
    }
}
