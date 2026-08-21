<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Tienda | Promociones y Novedades</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-gray-900 text-white sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="#" class="text-xl font-bold tracking-wide text-indigo-400">Mi Tienda</a>
                <div class="hidden md:flex space-x-6 font-medium">
                    <a href="#promociones" class="hover:text-indigo-400 transition-colors">Promociones</a>
                    <a href="#productos" class="hover:text-indigo-400 transition-colors">Productos</a>
                    <a href="#contacto" class="hover:text-indigo-400 transition-colors">Contacto</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="relative bg-cover bg-center bg-no-repeat min-h-[520px] flex items-center" style="background-image: url('{{ asset('images/hero-bg.jpg') }}');">
        <div class="absolute inset-0 bg-black/60 bg-gradient-to-r from-black/85 via-black/65 to-black/35"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 sm:py-28 w-full">
            <div class="max-w-2xl">
                <h1 class="text-3xl sm:text-5xl lg:text-5xl font-extrabold text-white leading-tight tracking-tight">
                    Todo lo que necesitas para tu evento en un solo lugar
                </h1>
                <p class="mt-4 text-base sm:text-lg text-gray-200 leading-relaxed font-normal">
                    Desde mobiliario exclusivo hasta catering de autor. Elevamos tus celebraciones con elegancia profesional y eficiencia moderna.
                </p>

                <div class="mt-8 flex flex-wrap items-center gap-4">
                    
                </div>
            </div>
        </div>
    </section>

    <!-- Seccion de Promociones (Carrusel con Tailwind + Alpine.js) -->
    <section id="promociones" class="py-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-center text-gray-900 mb-6">Promociones Especiales</h2>
            <p class="text-center text-gray-600 mb-6">En El Trébol nos preocupamos por brindarte un servicio de calidad a un precio justo. Por eso, hemos preparado una selección de promociones especiales para ti:</p>

            <!-- Contenedor del Carrusel Alpine -->
            <div 
                x-data="{ 
                    activeSlide: 0, 
                    slides: {{ json_encode($promociones) }},
                    timer: null,
                    startAutoPlay() {
                        this.timer = setInterval(() => {
                            this.next();
                        }, 5000);
                    },
                    stopAutoPlay() {
                        clearInterval(this.timer);
                    },
                    next() {
                        this.activeSlide = (this.activeSlide === this.slides.length - 1) ? 0 : this.activeSlide + 1;
                    },
                    prev() {
                        this.activeSlide = (this.activeSlide === 0) ? this.slides.length - 1 : this.activeSlide - 1;
                    }
                }"
                x-init="startAutoPlay()"
                @mouseenter="stopAutoPlay()"
                @mouseleave="startAutoPlay()"
                class="relative overflow-hidden rounded-2xl shadow-xl bg-gray-900"
            >
                <!-- Diapositivas -->
                <div class="relative h-64 sm:h-80 md:h-[400px] w-full">
                    <template x-for="(promo, index) in slides" :key="index">
                        <div 
                            x-show="activeSlide === index"
                            x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute inset-0 w-full h-full"
                        >
                            <img :src="promo.imagen" :alt="promo.titulo" class="w-full h-full object-cover">
                            <!-- Overlay / Caption -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent flex flex-col justify-end p-6 sm:p-8">
                                <h3 class="text-2xl sm:text-3xl font-bold text-white mb-2" x-text="promo.titulo"></h3>
                                <p class="text-gray-200 text-sm sm:text-base mb-4 max-w-xl" x-text="promo.descripcion"></p>
                                <div>
                                    <a :href="promo.link" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2.5 rounded-lg shadow transition-colors text-sm">
                                        Ver promoción
                                    </a>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Boton Anterior -->
                <button 
                    @click="prev()" 
                    class="absolute top-1/2 left-3 -translate-y-1/2 bg-black/40 hover:bg-black/70 text-white p-2 sm:p-3 rounded-full transition-colors focus:outline-none"
                    aria-label="Anterior"
                >
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>

                <!-- Boton Siguiente -->
                <button 
                    @click="next()" 
                    class="absolute top-1/2 right-3 -translate-y-1/2 bg-black/40 hover:bg-black/70 text-white p-2 sm:p-3 rounded-full transition-colors focus:outline-none"
                    aria-label="Siguiente"
                >
                    <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

                <!-- Indicadores (Puntos) -->
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2 z-10">
                    <template x-for="(promo, index) in slides" :key="index">
                        <button 
                            @click="activeSlide = index" 
                            :class="activeSlide === index ? 'bg-indigo-500 w-8' : 'bg-white/50 hover:bg-white w-2.5'"
                            class="h-2.5 rounded-full transition-all duration-300 focus:outline-none"
                        ></button>
                    </template>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contacto" class="bg-gray-900 text-gray-400 text-center py-6 mt-auto">
        <div class="max-w-7xl mx-auto px-4">
            <p>&copy; {{ date('Y') }} Mi Tienda. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>