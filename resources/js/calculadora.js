export function calculadora() {
    return {
        tasa: 79, // Valor por defecto de la tasa
        oficial: 0, // Valor fijo del dólar oficial
        dolares: 0, // Valor inicial de dólares
        bss: 0, // Valor inicial de bolívares
        cop: 0, // Valor inicial de pesos colombianos

        async getDolar(){
            try {
                let response = await fetch("https://pydolarve.org/api/v1/dollar?page=bcv&monitor=usd");
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                let data = await response.json();
                this.oficial= data.price
            } catch (error) {
                console.error("Error fetching the dollar rate:", error);
            }
        },
        init(){
            this.getDolar()
        },
        convertir(origen) {
            const tasaDolar = this.oficial; // Usar siempre el dólar oficial

            // Calcular los valores en función del campo de origen
            if (origen === "dolares") {
                this.bss = Math.trunc(this.dolares * tasaDolar); // Convertir dólares a bolívares
                this.cop = Math.trunc(this.bss * this.tasa); // Convertir dólares a pesos
            } else if (origen === "bss") {
                this.dolares = Math.trunc(this.bss / tasaDolar); // Convertir bolívares a dólares
                this.cop = Math.trunc(this.bss * this.tasa); // Convertir bolívares a pesos
            } else if (origen === "cop") {
                this.bss = Math.trunc(this.cop / this.tasa); // Convertir pesos a bolívares
                this.dolares = Math.trunc(this.bss / tasaDolar); // Convertir pesos a dólares
            }
        },
    };
}
