<template>
    <div>
        <AppLayout title="Maquinaria">
            <section class="bg-ctmblue py-10 md:py-16 xl:relative" id="maquinaria">
                <div class="container max-w-screen-xl mx-auto px-4 min-h-full">
                    <div class="flex flex-row items-center mb-8  ">
                        <h1
                            class="font-semibold text-gray-00 text-2xl md:text-4xl lg:text-6xl text-left leading-normal mb-6 font-dancing text-gray-300 mr-4">
                            Servicio de Alquiler de Maquinaria</h1>
                        <!-- add new project button -->
                        <Link v-if="$page.props.auth.user" class="" href="/">
                        <i data-feather="plus" class="h-6 w-6 text-2xl text-gray-200"></i>
                        </Link>
                    </div>
                    <div class="flex flex-wrap -mx-2" v-if="services?.length > 0">
                        <div v-for="(service, index) in services" :key="index"
                            class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4 flex hover:animate-scaleIn cursor-pointer scroll-animation">
                            <div class="bg-gray-100 p-4 rounded-lg  w-full flex flex-col">
                                <div class="bg-gray-100 p-4 rounded-lg w-full flex flex-col">
                                    <div class="flex items-center justify-center bg-gray-200 rounded-lg  mb-4">
                                        <img v-if="service.images.length > 0" :src="getPath(service.images[0]?.path)"
                                            :alt="service.images[0]?.name"
                                            class=" object-cover rounded-lg w-full h-48" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-else>
                        <div class="flex flex-col items-center justify-center h-96">
                            <h1 class="text-2xl text-gray-300">No hay maquinaria disponible</h1>
                        </div>
                    </div>

                </div>
            </section>

        </AppLayout>
    </div>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
</script>

<script>
export default {
    props: {
        services: Array
    },
    methods: {
    },
    computed: {
        getPath() {
            return (path) => {
                //env
                return path ? `/storage/${path}` : '';
            }
        },
    }
}
</script>
