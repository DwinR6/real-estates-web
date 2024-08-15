<!-- Vista reutilizable para mostrar los detalles de un Diseño -->
<!-- Si no recibe un Diseño, mostrar formulario para crear uno nuevo -->
<!-- Si recibe un Diseño, mostrar los detalles -->
<!-- Si el hay un usuario autenticado, mostrar botones en cada detalle del Diseño para habilitar la edición -->
<!-- Solo se habilitara el campo correspondiente-->


<script setup>

import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import ImageSlider from '../../Components/ImageSlider.vue';
</script>


<script>
export default {
    components: {
        ImageSlider,
    },
    props: {
        design: Object,
    },

    data() {
        return {
            currentSlide: 0,
            intervalId: null,
            rotation: 0,
            radius: 300,
        };
    },

    methods: {
        initializeBorderScrollEffects() {
            const elements = document.querySelectorAll('.scroll-animation');

            const updateContentPosition = (element) => {
                const rect = element.getBoundingClientRect();
                const viewportHeight = window.innerHeight;

                if (rect.top < viewportHeight && rect.bottom > 0) {
                    element.classList.add('scroll-visible');
                } else {
                    element.classList.remove('scroll-visible');
                }
            };

            const onScroll = () => {
                elements.forEach(element => updateContentPosition(element));
            };

            window.addEventListener('scroll', onScroll);

            elements.forEach(element => updateContentPosition(element));


        },

    },
    mounted() {
        this.initializeBorderScrollEffects();
    },
    computed: {
        editdesignUrl() {
            return `/designs/${this.design.design_id}/edit`;
        },

        getPath() {
            return (path) => {
                return '/storage/' + path;
            };
        },
    },




};
</script>
<style>
/* title styles */
.home-title span {
    position: relative;
    overflow: hidden;
    display: block;
    line-height: 1.2;
}

.home-title span::after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    background: white;
    animation: a-ltr-after 2s cubic-bezier(.77, 0, .18, 1) forwards;
    transform: translateX(-101%);
}

.home-title span::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100%;
    height: 100%;
    background: var(--bg-color);
    animation: a-ltr-before 2s cubic-bezier(.77, 0, .18, 1) forwards;
    transform: translateX(0);
}

.home-title span:nth-of-type(1)::before,
.home-title span:nth-of-type(1)::after {
    animation-delay: 1s;
}

.home-title span:nth-of-type(2)::before,
.home-title span:nth-of-type(2)::after {
    animation-delay: 1.5s;
}

@keyframes a-ltr-after {
    0% {
        transform: translateX(-100%)
    }

    100% {
        transform: translateX(101%)
    }
}



@keyframes a-ltr-before {
    0% {
        transform: translateX(0)
    }

    100% {
        transform: translateX(200%)
    }
}

.custom-ordered-list ol {
    counter-reset: list-counter;
    /* Inicia un contador */
}

.custom-ordered-list ol li {
    counter-increment: list-counter;
    /* Incrementa el contador en cada <li> */
    position: relative;
    list-style-type: none;
    /* Elimina el estilo predeterminado de la lista */
    padding-left: 20px;
    /* Espacio para el número */
}

.custom-ordered-list ol li::before {
    content: counter(list-counter) ". ";
    /* Muestra el número */
    position: absolute;
    left: 0;
    font-weight: bold;
    /* Opcional: hace que el número sea negrita */
}

.carousel-container {
    perspective: 1000px;
    width: 100%;
    height: 400px;
    /* Ajusta según tu diseño */
    overflow: hidden;
}

.carousel-wrapper {
    width: 100%;
    height: 100%;
    position: relative;
    transform-style: preserve-3d;
    transform: rotateY(0deg);
}

.carousel-item {
    position: absolute;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.5s;
}

.carousel-image {
    max-width: 100%;
    max-height: 100%;
}
</style>


<template>
    <AppLayout title="Diseño & Construccion | {{ design.name }}">

        <Head>
            <title>{{ design.name }}</title>
        </Head>

        <section class=" py-10 md-py-16 xl:relative bg-ctmblue">
            <div class="container max-w-screen-xl mx-auto px-4">
                <div class="flex flex-wrap justify-center items-center gap-4 scroll-animation">
                    <!--back feather link icon-->
                    <Link href="/designs" class="">
                    <i data-feather="arrow-left" class="h-6 w-6 text-gray-200"></i>
                    </Link>
                    <h1
                        class="text-3xl md:text-4xl xl:text-6xl font-bold text-center font-dancing text-gray-200 scroll-animation">
                        {{ design.name }}
                    </h1>
                    <!--edit feather link icon-->
                    <Link v-if="$page.props.auth.user" :href="editdesignUrl" class="">
                    <i data-feather="edit-2" class="h-6 w-6 text-gray-200"></i>
                    </Link>
                </div>


                <div v-if="design.images.length > 0" class="mt-16 h-96">
                    <ImageSlider :images="design.images" />
                </div>
                <div v-else class="mt-16 h-96">

                    <div v-if="$page.props.auth.user" class="flex items-center justify-center h-full">
                        <div class="flex items-center gap-4 flex-col">


                            <!--si esta autenticado notificar que no hay imagenes-->
                            <p class="text-2xl text-gray-200 font-normal">No hay imagenes disponibles</p>
                            <!-- Quiere agregar una imagen?. Editar Diseño-->
                            <div class="flex items-center gap-4 mt-4">
                                <p class="text-2xl text-gray-200 font-normal">Ve a la seccion de edicion para agregar
                                    imagenes</p>

                            </div>
                            <!--Editar Diseño-->
                            <div class="flex items-center gap-4 mt-4">
                                <Link :href="editdesignUrl"
                                    class="bg-blue-900 text-white px-4 py-2 rounded-lg hover:bg-blue-800">Editar
                                Diseño</Link>
                            </div>

                        </div>

                    </div>
                </div>

                <!--description-->
                <div class="mt-16 scroll-animation">
                    <h2 class="text-2xl font-bold mb-4 text-gray-100">Descripcion</h2>
                    <div class="text-xl text-gray-200 font-normal">
                        <div v-html="design.description"></div>
                    </div>
                    <div class="mt-4">
                        <div class="w-full " id="map"></div>
                    </div>
                </div>


                <!--Videos-->
                <div class="flex flex-wrap gap-4 mt-8">
                    <div v-for="(video, index) in design.videos" :key="index" class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4">
                        <iframe :src="video.src" :alt="video.alt" class="w-full h-72 rounded-lg"></iframe>
                    </div>

                </div>


            </div>
        </section>

    </AppLayout>
</template>
