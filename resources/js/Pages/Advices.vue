<script setup>

import AppLayout from '@/Layouts/AppLayout.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
</script>

<script>
export default {
    extends: AppLayout,
    mounted() {
        this.$nextTick(() => {
            this.initializeScrollEffects();
        });
    },
    updated() {
        this.$nextTick(() => {
            this.initializeScrollEffects();
        });
    },
    data() {
        return {
            services: [
                {
                    'category': 'client_attendance',
                    'name': 'Asesoria para la eleccion de proyectos',
                    'description': 'Te ayudamos a elegir el proyecto que mejor se adapte a tus necesidades.',
                    'image': 'advice.jpg',
                    'icon': 'user-check'
                },
                {
                    'category': 'documentation',
                    'name': 'Llenado de solicitudes de reserva de propiedades',
                    'description': 'Nos encargamos de llenar las solicitudes de reserva de propiedades.',
                    'image': 'request.jpg',
                    'icon': 'file-text'
                },
                {
                    'category': 'documentation',
                    'name': 'Conoce a tu cliente',
                    'description': 'Registramos tus datos para que puedas formar parte de nuestra base de datos.',
                    'icon': 'user'
                },
                {
                    'category': 'documentation',
                    'name': 'Llenado de declaracion jurada',
                    'description': 'Nos encargamos de llenar las declaraciones juradas necesarias.',
                    'icon': 'file-text'
                },

            ],
        }
    },

    methods: {

    },
    computed: {
        getPath() {
            return (path) => {
                //env
                return path ? `../../image/${path}` : '';
            }
        },
    }

}
</script>

<style></style>

<template>
    <AppLayout title="Services">

        <div class="w-full h-full">
            <section class="bg-ctmblue py-10 md:py-16 xl:relative" id="service">

                <div class="container max-w-screen-xl md:min-h-screen mx-auto px-4">

                    <h1 class=" font-semibold text-gray-300 text-3xl md:text-6xl text-left leading-normal mb-6
                    font-dancing ">
                        Nuestros Servicios</h1>

                    <div class="flex flex-wrap -mx-2">
                        <div v-for="(service, index) in services" :key="index"
                            class="w-full md:w-1/2 lg:w-1/ px-2 mb-4 flex scroll-animation">
                            <div class="bg-gray-100 p-4 rounded-lg  w-full flex flex-col">

                                <div v-if="service.image"
                                    class="flex items-center justify-center bg-gray-200  rounded-lg mx-auto mb-4 h-75">
                                    <img :src="getPath(service.image)" :alt="service.name"
                                        class="w-full h-full object-cover">
                                </div>
                                <div v-else
                                    class="flex items-center justify-center bg-gray-200 h-20 w-20 rounded-lg mx-auto mb-4">
                                    <i :data-feather="service.icon" class="text-4xl text-ctmred"></i>


                                </div>
                                <h4 class="font-semibold text-blue-900 text-xl mb-2 text-center">{{ service.name }}</h4>
                                <p class="font-normal text-gray-400 text-base leading-relaxed text-center flex-grow">
                                    {{ service.description }}
                                </p>
                            </div>
                        </div>

                    </div>
                </div> <!-- container.// -->

            </section>
        </div>

    </AppLayout>
</template>
