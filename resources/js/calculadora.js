export function calculadora() {
    return {
        tasa: 77, // Valor por defecto de la tasa
        oficial: 53.8, // Valor fijo del dólar oficial
        dolares: 0, // Valor inicial de dólares
        bss: 0, // Valor inicial de bolívares
        cop: 0, // Valor inicial de pesos colombianos

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
