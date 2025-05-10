export function calculadora() {
    return {
        // Intentamos tomar la tasa desde Laravel desde el inicio si ya está disponible
        tasa: window.tasaDesdeLaravel ?? 0,
        oficial: 0,
        dolares: 0,
        bss: 0,
        cop: 0,

        async getDolar() {
            try {
                let response = await fetch(
                    "https://pydolarve.org/api/v1/dollar?page=bcv&monitor=usd"
                );
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                let data = await response.json();
                this.oficial = data.price;
            } catch (error) {
                console.error("Error fetching the dollar rate:", error);
            }
        },

        init() {
            this.getDolar();

            // Aseguramos que si la tasa no se capturó en el momento de inicialización, se actualice aquí
            if (typeof window.tasaDesdeLaravel !== 'undefined') {
                this.tasa = window.tasaDesdeLaravel;
            } else {
                console.warn("La tasa desde Laravel no está disponible.");
            }
        },

        convertir(origen) {
            const tasaDolar = this.oficial;

            if (origen === "dolares") {
                this.bss = Math.trunc(this.dolares * tasaDolar);
                this.cop = Math.trunc(this.bss * this.tasa);
            } else if (origen === "bss") {
                this.dolares = Math.trunc(this.bss / tasaDolar);
                this.cop = Math.trunc(this.bss * this.tasa);
            } else if (origen === "cop") {
                this.bss = Math.trunc(this.cop / this.tasa);
                this.dolares = Math.trunc(this.bss / tasaDolar);
            }
        },
    };
}
