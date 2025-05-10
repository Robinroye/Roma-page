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
        totalConCopias: 0,
        envio: 0,
        archivos: [],
        paginas: [],
        paginasAImprimir: "0-0",
        vistasPrevias: [],
        indice: 0,
        indicaciones: '',
        paginasTotales: 0,
        started: false,
        impresionBNPermitido: [
            "bond"
        ],
        settings: [ 
            {papel: 'bond',
                color: 'bn',
                caras: '1',
                cantidad: 0,
                total: 0,
                paginas: 0,
                paginasAImprimir: "0-0",
                indicaciones: '',
                paginasTotales: 0,}  
        ],
        init(){
            this.calcularTotal();
        },
        calcularTotal() {
            this.calculateTotalPages();
            axios.post('/calcular-precio', {
                papel: this.settings[this.indice].papel,
                color: this.impresionBNPermitido.includes(this.settings[this.indice].papel)?this.settings[this.indice].color: "color",
                caras: this.settings[this.indice].caras,
                cantidad: this.settings[this.indice].paginasTotales,
                copias: 1
            })
            .then(response => {
                this.settings[this.indice].total = response.data.total;
                this.actualizarTotal();
            })
            .catch(error => {
                console.error("Error en el cálculo de precio:", error);
            });
            console.log(this.settings)

        },
        prevFile(){
            this.indice = (this.indice - 1 + this.vistasPrevias.length) % this.vistasPrevias.length
        },
        nextFile(){
            this.indice = (this.indice + 1) % this.vistasPrevias.length
        },
        cargarArchivos(event) {
            this.archivos = [...this.archivos, event.target.files[0]];
            console.log(this.archivos, "sd")
            this.archivos.forEach((archivo, index) => {
                if(!this.started){
                    this.settings= []
                    this.started= true
                }
                if(index != this.settings.length)return
                this.settings= [...this.settings,
                    {papel: 'bond',
                      color: 'bn',
                      caras: '1',
                      cantidad: 0,
                      total: 0,
                      paginas: 0,
                      paginasAImprimir: "0-0",
                      indicaciones: '',
                      paginasTotales: 0,}  
                  ];
                if (archivo.type.startsWith("image/")) {
                    // IMAGE PREVIEW
                    const reader = new FileReader();
                    reader.onload = (e) => {
                            this.paginas[index] = 1;
                            this.settings[index].paginas= 1;
                            this.settings[index].paginasAImprimir = `1-1`;
                            this.settings[index].paginasTotales= 1;
                            this.vistasPrevias.push({type:"img", src: e.target.result});
                            this.indice= this.vistasPrevias.length - 1;
                        
                    };
                    reader.readAsDataURL(archivo);
                } else if (archivo.type === "application/pdf") {
                    // PDF PREVIEW & PAGE COUNT
                    this.countPdfPages(archivo, index);
                    const pdfURL = URL.createObjectURL(archivo);
                    this.vistasPrevias.push({ type: "pdf", src: pdfURL });
                } else if (archivo.type === "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
                    // DOCX PREVIEW & PAGE COUNT
                    this.countDocxPages(archivo, index);
                } else {
                    // OTHER FILES
                    this.vistasPrevias.push(null);
                    this.paginas.push(0); // Unknown file type
                }
            });

        },
        actualizarTotal(){
            this.total = 0;
            this.totalConCopias = 0;
            this.settings.forEach((setting) => {
                this.total += setting.total;
                this.totalConCopias += setting.total * setting.cantidad;
            });
        },
        async countPdfPages(file, index) {
            const reader = new FileReader();
            reader.onload = async (e) => {
                const typedArray = new Uint8Array(e.target.result);
                const pdf = await pdfjsLib.getDocument({ data: typedArray }).promise;
        
                this.paginas.splice(index, 1, pdf.numPages);
                this.settings[index].paginas= pdf.numPages;
                this.settings[index].paginasAImprimir = `1-${pdf.numPages}`;
                this.settings[index].paginasTotales= pdf.numPages;
                this.indice= this.vistasPrevias.length - 1;
            };
            reader.readAsArrayBuffer(file);

        },
        async countDocxPages(archivo, index) {
            const reader = new FileReader();
            reader.onload = async (e) => {
                const container = document.createElement("div");
                container.classList.add("docx-wrapper");
                container.style.width = "316px";
                container.style.visibility = "hidden"; // Prevent flickering
                document.body.appendChild(container);
        
                // Render DOCX
                await docxPreview.renderAsync(new Uint8Array(e.target.result), container);
                const docxElements = container.querySelectorAll(".docx");
                docxElements.forEach((docx) => {
                    docx.style.transform = "scale(0.5)"; // Scale down to fit
                    docx.style.transformOrigin = "top"; // Scale from top left
                    docx.style.width = "200%"; // Compensate for scaling
                    docx.style.marginBottom = "-100%"; // Reduce space between pages
                    docx.style.paddingBottom = "0"; // Remove unnecessary padding
                });
                // Count pages based on <section class="docx">
                const pageCount = container.querySelectorAll("section.docx").length;
        
                // Store Preview & Page Count
                this.vistasPrevias.push({ type: "docx", html: container.innerHTML });
                this.$nextTick(() => {
                    this.paginas[index] = pageCount;
                    this.settings[index].paginas= pageCount;
                    this.settings[index].paginasAImprimir = `1-${pageCount}`;
                    this.settings[index].paginasTotales= pageCount;
                    this.indice= this.vistasPrevias.length - 1;
                });
        
                // Remove hidden container
                document.body.removeChild(container);
            };
            reader.readAsArrayBuffer(archivo);

        },

        calculateTotalPages() {
            this.settings[this.indice].paginasTotales = 0;
        
            let parts = this.settings[this.indice].paginasAImprimir.replaceAll(" ", "").split(',');
        
            for (let part of parts) {
                if (/^\d+$/.test(part)) { 
                    // Single number (e.g., "1")
                    this.settings[this.indice].paginasTotales += 1;
                } else if (/^\d+-\d+$/.test(part)) { 
                    // Range (e.g., "3-5")
                    let [start, end] = part.split('-').map(Number);
                    if (start <= end) {
                        this.settings[this.indice].paginasTotales += (end - start + 1);
                    }
                }
            }
        }
        
    };
}

export default impresionData;