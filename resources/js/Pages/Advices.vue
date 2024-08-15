<script setup>

import AppLayout from '@/Layouts/AppLayout.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';
const showModal = ref(false);

let serviceSelected = ref(null);

const openModal = () => {
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    serviceSelected = null;
};

const selectService = (service) => {
    serviceSelected = service;
    showModal.value = true;
};

const unsetService = () => {
    serviceSelected = null;
};


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
                    'icon': 'user-check',
                    'indicaciones': [
                        {
                            'title': 'Formulario de solicitud de reserva',
                            'description': 'Descarga el formulario de solicitud de reserva.',
                            'downloadFile': 'solicitud_reserva.pdf'
                        },
                        {
                            'title': 'Llenado de formulario',
                            'description': 'Llena el formulario con tus datos.',

                        },
                        {
                            'title': 'Envio de formulario',
                            'description': 'Envia el formulario ocn tus datos a nuestro correo electronico. asistencia@jcdgd.com',

                        },
                        {
                            'title': 'Espera de respuesta',
                            'description': 'Espera la respuesta de nuestro equipo de asistencia.',
                        },

                    ]
                },
                {
                    'category': 'documentation',
                    'name': 'Llenado de solicitudes de reserva de propiedades',
                    'description': 'Nos encargamos de llenar las solicitudes de reserva de propiedades.',
                    'image': 'request.jpg',
                    'icon': 'file-text',
                    'indicaciones': [
                        {
                            'title': 'Formulario de solicitud de reserva',
                            'description': 'Descarga el formulario de solicitud de reserva.',
                            'downloadFile': 'solicitud_reserva.pdf'
                        },
                        {
                            'title': 'Llenado de formulario',
                            'description': 'Llena el formulario con tus datos.',

                        },
                        {
                            'title': 'Envio de formulario',
                            'description': 'Envia el formulario ocn tus datos a nuestro correo electronico. asistencia@jcdgd.com',
                        },
                    ]
                },
                {
                    'category': 'documentation',
                    'name': 'Conoce a tu cliente',
                    'description': 'Registramos tus datos para que puedas formar parte de nuestra base de datos.',
                    'image': 'conoce.jpg',
                    'icon': 'user',
                    'indicaciones': [
                        {
                            'title': 'Formulario de registro',
                            'description': 'Descarga el formulario de registro.',
                            'downloadFile': 'conoce_tu_cliente.pdf'
                        },
                        {
                            'title': 'Llenado de formulario',
                            'description': 'Llena el formulario con tus datos.',

                        },
                        {
                            'title': 'Envio de formulario',
                            'description': 'Envia el formulario ocn tus datos a nuestro correo electronico. asistencia@jcdgd.com',
                        },
                    ]
                },
                {
                    'category': 'documentation',
                    'name': 'Llenado de declaracion jurada',
                    'description': 'Nos encargamos de llenar las declaraciones juradas necesarias.',
                    'image': 'declaracion.jpg',
                    'icon': 'file-text',
                    'indicaciones': [
                        {
                            'title': 'Formulario de declaracion jurada',
                            'description': 'Descarga el formulario de declaracion jurada.',
                            'downloadFile': 'declaracion_jurada.docx'
                        },
                        {
                            'title': 'Llenado de formulario',
                            'description': 'Llena el formulario con tus datos.',

                        },
                        {
                            'title': 'Envio de formulario',
                            'description': 'Envia el formulario ocn tus datos a nuestro correo electronico. asistencia@jcdgd.com',
                        },]
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
                return path ? `/image/${path}` : '';
            }
        },
    }

}
</script>

<style></style>

<template>
    <AppLayout title="Asistencia">

        <div class="w-full h-full">
            <section class="bg-ctmblue py-10 md:py-16 xl:relative" id="service">

                <div class="container max-w-screen-xl md:min-h-screen mx-auto px-4">

                    <h1 class=" font-semibold text-gray-300 text-3xl md:text-6xl text-left leading-normal mb-6
                    font-dancing ">
                        Soluciones de Asistencia Personalizada</h1>

                    <div class="flex flex-wrap -mx-2">
                        <div v-for="(service, index) in services" :key="index"
                            class="w-full px-2 py-16 my-16 mb-4 flex  cursor-pointer scroll-animation">
                            <div class="bg-gray-100 p-4 rounded-lg  w-full flex  flex-col md:flex-row items-center  "
                                @click="selectService(service)">


                                <div class="flex flex-col mb-8 px-10">
                                    <h4
                                        class="font-semibold text-blue-900 text-xl  md:text-2xl xl:text-4xl mb-2 text-center">
                                        {{
                                            service.name }}
                                    </h4>
                                    <p
                                        class="font-normal text-gray-400 text-base leading-relaxed text-center flex-grow">
                                        {{ service.description }}
                                    </p>
                                </div>

                                <div v-if="service.image"
                                    class="flex items-center justify-center bg-gray-200 rounded-lg  mb-4  w-full">
                                    <img :src="getPath(service.image)" :alt="service.name" class="object-cover w-full">
                                </div>
                                <div v-else
                                    class="flex items-center justify-center bg-gray-200 h-20 w-20 rounded-lg mx-auto mb-4">
                                    <i :data-feather="service.icon" class="text-4xl text-ctmred"></i>


                                </div>
                            </div>
                        </div>

                    </div>
                </div> <!-- container.// -->

            </section>

            <Modal :show="showModal" @close="closeModal">
                <!--CCard ti show indicaciones-->
                <div v-if="serviceSelected?.indicaciones" class="bg-white p-4 rounded-lg  w-full flex flex-col">
                    <h4 class="font-semibold text-blue-900 text-xl mb-2 text-center">Indicaciones</h4>
                    <div v-for="(indicacion, index) in serviceSelected.indicaciones" :key="index"
                        class="bg-gray-100 p-4 rounded-lg  w-full flex flex-col">
                        <h4 class="font-semibold text-blue-900 text-xl mb-2 text-left">{{ indicacion.title }}</h4>
                        <p class="font-normal text-gray-400 text-base leading-relaxed text-left flex-grow">
                            {{ indicacion.description }}
                        </p>
                        <a v-if="indicacion.downloadFile" :href="`/documents/download/${indicacion.downloadFile}`"
                            target="_blank" class="text-blue-500 text-base font-semibold">Descargar archivo</a>
                    </div>
                </div>
            </Modal>
        </div>

    </AppLayout>
</template>
