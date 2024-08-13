<!-- Vista reutilizable para mostrar los detalles de un proyecto -->
<!-- Si no recibe un proyecto, mostrar formulario para crear uno nuevo -->
<!-- Si recibe un proyecto, mostrar los detalles -->
<!-- Si el hay un usuario autenticado, mostrar botones en cada detalle del proyecto para habilitar la edición -->
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
        //project: {
        'name': 'Lotificacion El Papalon Poniente',

        'location': 'Santa Rosa de Lima, La Union',
        'status': 'En construccion',
        'category': 'Urabnizacion',
        'start_date': '2021-01-01',
        'end_date': '2022-01-01',
        'coordinates': {
            'latitude': 13.4847,
            'longitude': -88.1776
        },
        'description': 'Lotificacion El Papalon Poniente, es un proyecto de lotificacion de terrenos, que ofrece la opción de comprar su LOTE y le construimos su vivienda innovadora a precios accesibles. LOTIFICACION EL PAPALON PONIENTE, es totalmente privada y está ubicada a un minuto del desvió agua caliente salida a la carretera Ruta militar, salida a San Salvado y San Migue, y la Unión y se encuentra a cinco minutos de la Ciudad de Santa Rosa de Lima, esta Ciudad cuenta con un Hospital Nacional, Centros comerciales y Mercado Municipal, Gasolineras Puma, y Restaurante la Pema, todos accesibles a la Lotificación.',

        'lot_description': 'Los Lotes disponibles cuentan son de 200 metros cuadros; con las siguientes medidas de 10 Metros de Ancho, por 20 Metros de Largo, la LOTIFICACION EL PAPALON PONIENTE, es un de Proyecto de DGD URBANO, que ofrece la opción de comprar su LOTE y le construimos su vivienda innovadora aprecios Accesibles". LOTIFICACION EL PAPALON PONIENTE, es totalmente privada y está ubicada a un minuto del desvió agua caliente salida a la carretera Ruta militar, salida a San Salvado y San Migue, y la Unión y se encuentra a cinco minutos de la Ciudad de Santa Rosa de Lima, esta Ciudad cuenta con un Hospital Nacional, Centros comerciales y Mercado Municipal, Gasolineras Puma, y Restaurante la Pema, todos accesibles a la Lotificación. ',
        'infrastruture_descriptions': [
            'Agua Potable',
            'Energia Electrica en todas las vias',
            'Tratamiento de aguas lluvias, mediante cordones de cuneta, badenes, canaletas y canaletas con parrilla',
            'Vías de Circulación, con concreto o asfalto. (sujeto a modificaciones)',
            'Aceras con concreto simple.',
            'Cordón- Cuneta, con concreto Ciclópeo Revestido.',
            'Obras de protección, Muro perimetral y Taludes.',
            'Tendrá Muro perimetral en todo el perímetro de la urbanización.'
        ],
        'area_descriptions': [
            'Amplias zonas de área verde ecológica y recreativa.',
            'Área de equipamiento social.',
            'Área de circulación Redondel.'
        ],
        'developer': {
            'name': 'Constructora El Bosque',
            'description': 'Las empresas salvadoreñas que inicia operaciones en el ano 2021, a través del desarrollo de Lotificaciones planificadas que, ofrecen a sus residentes lotes de terrenos con un enfoque de Privacidad, Seguridad y Recreación.',
            'address': 'Calle El Tizate, Canton los Reyes, Anamoros, la Union.',
            'managers': [
                'Juan Ubaldo Cruz Reyes',
                'Tania Vanessa Cruz de Reyes'
            ],
            'phones': [
                '7545-0689  ',
                '2222-2222'
            ],
        },
        'images': [
            {
                'src': 'https://via.placeholder.com/400x300',
                'alt': 'Imagen 1'
            },
            {
                'src': 'https://via.placeholder.com/800x600',
                'alt': 'Imagen 2'
            },
            {
                'src': 'https://via.placeholder.com/800x600',
                'alt': 'Imagen 3'
            },
            {
                'src': 'https://via.placeholder.com/800x600',
                'alt': 'Imagen 4'
            }
        ],
        'videos': [
            {
                'src': 'https://www.youtube.com/embed/1a2b3c4d5e',
                'alt': 'Video 1'
            },
            {
                'src': 'https://www.youtube.com/embed/1a2b3c4d5e',
                'alt': 'Video 2'
            }
        ],


        //},
        project: Object
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
        editProjectUrl() {
            return `/projects/${this.project.project_id}/edit`;
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
    <AppLayout title="Proyecto | {{ project.name }}">

        <Head>
            <title>{{ project.name }}</title>
        </Head>

        <section class=" py-10 md-py-16 xl:relative bg-ctmblue">
            <div class="container max-w-screen-xl mx-auto px-4">
                <div class="flex flex-wrap justify-center items-center gap-4 scroll-animation">
                    <!--back feather link icon-->
                    <Link href="/projects" class="">
                    <i data-feather="arrow-left" class="h-6 w-6 text-gray-200"></i>
                    </Link>
                    <h1
                        class="text-3xl md:text-4xl xl:text-6xl font-bold text-center font-dancing text-gray-200 scroll-animation">
                        {{ project.name }}
                    </h1>
                    <!--edit feather link icon-->
                    <Link v-if="$page.props.auth.user" :href="editProjectUrl" class="">
                    <i data-feather="edit-2" class="h-6 w-6 text-gray-200"></i>
                    </Link>
                </div>
                <!--location, status, category, start_date, end_date-->
                <div class=" flex flex-wrap justify-center items-center gap-4 mt-4 text-red-500">
                    <div class="flex items-center gap-2">
                        <!--feather location icon-->
                        <i data-feather="map-pin" class="h-6 w-6 text-gray-400"></i>
                        <span>{{ project.location }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <!--data-feahter icon of category alternative-->
                        <i data-feather="tag" class="h-6 w-6 text-gray-400"></i>
                        <span>{{ project.category.name }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <!--data-feahter icon of status alternative-->
                        <i data-feather="activity" class="h-6 w-6 text-gray-400"></i>
                        <span>{{ project.status == 1 ? 'En construccion' : 'Finalizado' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <!--data-feahter icon of start_date alternative-->
                        <i data-feather="calendar" class="h-6 w-6 text-gray-400"></i>

                        <span>{{ project.start_date }} - {{ project.end_date }}</span>
                    </div>
                </div>

                <div v-if="project.images.length > 0" class="mt-16 h-96">
                    <ImageSlider :images="project.images" />
                </div>
                <div v-else class="mt-16 h-96">

                    <div v-if="$page.props.auth.user" class="flex items-center justify-center h-full">
                        <div class="flex items-center gap-4 flex-col">


                            <!--si esta autenticado notificar que no hay imagenes-->
                            <p class="text-2xl text-gray-200 font-normal">No hay imagenes disponibles</p>
                            <!-- Quiere agregar una imagen?. Editar proyecto-->
                            <div class="flex items-center gap-4 mt-4">
                                <p class="text-2xl text-gray-200 font-normal">Ve a la seccion de edicion para agregar
                                    imagenes</p>

                            </div>
                            <!--Editar proyecto-->
                            <div class="flex items-center gap-4 mt-4">
                                <Link :href="editProjectUrl"
                                    class="bg-blue-900 text-white px-4 py-2 rounded-lg hover:bg-blue-800">Editar
                                Proyecto</Link>
                            </div>

                        </div>

                    </div>
                </div>

                <!--description-->
                <div class="mt-16 scroll-animation">
                    <h2 class="text-2xl font-bold mb-4 text-gray-100">Descripcion</h2>
                    <div class="text-xl text-gray-200 font-normal">
                        <div v-html="project.description"></div>
                    </div>
                    <div class="mt-4">
                        <div class="w-full " id="map"></div>
                    </div>
                </div>

                <!--lot Descripcion-->
                <div class="mt-16 scroll-animation">
                    <h2 class="text-2xl font-bold mb-4 text-gray-200">Lotes</h2>
                    <div class="text-xl text-gray-200 font-normal">
                        <div v-html="project.lot_description"></div>
                    </div>
                </div>

                <div class="" style="height: 10%;"></div>


                <!--Infraestructura-->
                <div class="mt-16 scroll-animation">
                    <h2 class="text-2xl font-bold mb-4 text-gray-200">Infraestructura</h2>
                    <div class="text-xl text-gray-200 font-normal custom-oredered-list">
                        <div v-html="project.infrastructure_description"></div>
                    </div>
                </div>

                <!--Areas-->
                <div class="mt-16 scroll-animation">
                    <h2 class="text-2xl font-bold mb-4 text-gray-200">Areas</h2>
                    <div class="text-xl text-gray-200 font-normal">
                        <div v-html="project.area_description"></div>
                    </div>
                </div>



                <!--Videos-->
                <div class="flex flex-wrap gap-4 mt-8">
                    <div v-for="(video, index) in project.videos" :key="index"
                        class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4">
                        <iframe :src="video.src" :alt="video.alt" class="w-full h-72 rounded-lg"></iframe>
                    </div>

                </div>

                <!--Desarrolladora nuevo formato-->
                <div class="mt-16 mb-16">
                    <h2 class="text-2xl md:text-4xl  xl:text-6xl font-bold mb-4 text-gray-400">{{ project.developer.name
                        }}</h2>
                    <!--address-->
                    <div class="flex items-center gap-2 text-red-500 txt-base">
                        <!--feather location icon-->
                        <i data-feather="map-pin" class="h-4 w-4 text-red-500"></i>
                        <span>{{ project.developer.address }}</span>
                    </div>

                    <p class="text-2xl text-gray-300 font-normal">{{ project.developer.description }}</p>


                    <!--Managers-->
                    <div class="mt-4">
                        <h3 class="text-2xl md:text-3xl text-4xl  font-bold mb-2 text-gray-400">Directores</h3>
                        <ul class="list-disc list-inside text-gray-300 text-base md:text-xl xl:text-2xl">
                            <li v-for="(manager, index) in project.developer.managers" :key="index">
                                {{ manager.first_name + ' ' + manager.last_name }}
                            </li>
                        </ul>
                    </div>

                    <!--Managers-->
                    <div class="mt-4">
                        <h3 class="text-2xl md:text-3xl text-4xl  font-bold mb-2 text-gray-400">Emails</h3>
                        <ul class="list-disc list-inside text-gray-300 text-base md:text-xl xl:text-2xl">
                            <li v-for="(email, index) in project.developer.emails" :key="index">
                                {{ email.email_address }}
                            </li>
                        </ul>
                    </div>

                    <!--Phones-->
                    <div class="mt-4">
                        <h3 class="text-2xl text-3xl font-bold mb-2 text-gray-400">Telefonos</h3>
                        <ul class="list-disc list-inside text-gray-300 text-base md:text-xl">
                            <li v-for="(phone, index) in project.developer.phones" :key="index">
                                {{ phone.phone_number }}
                            </li>
                        </ul>
                    </div>

                </div>

                <!-- Desarrolladora | Agente | Contact Us-->
                <div class="mt-8  bg-gray-200 p-4 rounded-3xl">
                    <div class="flex flex-wrap mt-4">
                        <div class="flex flex-wrap w-full md:w-1/2 ">
                            <!--big message Estas interesado en este proyecto? centered vertically and horizontally-->
                            <div class="w-full flex flex-col items-center justify-center">
                                <h2 class="text-4xl font-bold mb-4 text-blue-900">Estas interesado en este proyecto?
                                </h2>
                                <p class="text-xl text-gray-600 font-normal">Envianos un mensaje y te contactaremos lo
                                    mas
                                    pronto posible.</p>
                            </div>


                        </div>
                        <!-- Contact Us -- Form -- Estas interesa en este proyecto? Envianos un mensaje-->
                        <div class="w-full md:w-1/2">
                            <h2 class="text-2xl font-bold mb-4  text-blue-900">Contactanos</h2>


                            <form action="" method="post">
                                <div class="flex flex-wrap gap-4">

                                    <div class="w-full">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                                        <input type="text" name="name" id="name" autocomplete="given-name"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div class="w-full">
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" name="email" id="email" autocomplete="email"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div class="w-full">
                                        <label for="phone"
                                            class="block text-sm font-medium text-gray-700">Telefono</label>
                                        <input type="tel" name="phone" id="phone" autocomplete="tel"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <div class="w-full">
                                        <label for="message"
                                            class="block text-sm font-medium text-gray-700">Mensaje</label>
                                        <textarea id="message" name="message" rows="4"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                                    </div>
                                    <div class="w-full">
                                        <button type="submit"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Enviar
                                        </button>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </AppLayout>
</template>
