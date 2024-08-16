<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

</script>



<script>
export default {

    props: {
        designs: Array
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

<template>
    <AppLayout title="designs">

        <section class="bg-ctmblue py-10 md:py-16 xl:relative" id="designs">

            <div class="container max-w-screen-xl mx-auto px-4">

                <div class="flex flex-row items-start mb-8 items-center">
                    <h1
                        class="font-semibold text-gray-00 text-2xl md:text-4xl lg:text-6xl text-left leading-normal mb-6 font-dancing text-gray-300 mr-4">
                        Conoce Nuestros Diseños</h1>
                    <!-- add new design button -->
                    <Link v-if="$page.props.auth.user" :href="route('designs.create')" class="">
                    <i data-feather="plus" class="h-6 w-6 text-2xl text-gray-200"></i>
                    </Link>

                </div>

                <div class="flex flex-wrap -mx-2" v-if="designs.length > 0">
                    <div v-for="(design, index) in designs" :key="index"
                        class="w-full md:w-1/2 lg:w-1/3 mb-4 flex hover:animate-scaleIn cursor-pointer scroll-animation">
                        <div class="bg-gray-100 p-4 rounded-lg  w-full flex flex-col">
                            <Link :href="`/disenos/${design.design_id}`"
                                class="bg-gray-100 rounded-lg w-full flex flex-col">
                            <div class="flex items-center justify-center bg-gray-200 rounded-lg  mb-4">
                                <img v-if="design.images.length > 0" :src="getPath(design.images[0]?.path)"
                                    :alt="design.images[0]?.name" class=" object-cover rounded-lg w-full h-72" />
                            </div>

                            <div class="flex flex-col justify-between h-full">
                                <h4 class="font-semibold text-blue-900 text-xl mb-2 text-center">{{ design.name }}</h4>
                            </div>
                            </Link>

                        </div>
                    </div>
                </div>
                <div v-else class="flex items-center justify-center h-full">
                    <div class="flex items-center gap-4 flex-col">
                        <p class="text-2xl text-gray-200 font-normal">No hay diseños disponibles</p>
                        <div class="flex items-center gap-4 mt-4" v-if="$page.props.auth.user">
                            <p class="text-2xl text-gray-200 font-normal">Ve a la seccion de edicion para agregar
                                diseños</p>
                            <Link :href="route('designs.create')"
                                class="text-white px-4 py-2 rounded-lg hover:text-blue-900">
                            <i data-feather="edit-2" class="h-6 w-6 text-gray-200"></i>
                            </Link>


                        </div>
                    </div>
                </div>
            </div> <!-- container.// -->

        </section>
    </AppLayout>
</template>
