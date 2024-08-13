<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import ProjectDetails from '@/Components/ProjectDetails.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

</script>



<script>
export default {

    props: {
        projects: Array
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
    <AppLayout title="Projects">

        <section class="bg-ctmblue py-10 md:py-16 xl:relative" id="projects">

            <div class="container max-w-screen-xl mx-auto px-4">

                <div class="flex flex-row items-start mb-8 items-center">
                    <h1
                        class="font-semibold text-gray-00 text-2xl md:text-4xl lg:text-6xl text-left leading-normal mb-6 font-dancing text-gray-300 mr-4">
                        Nuestros Proyectos</h1>
                    <!-- add new project button -->
                    <Link v-if="$page.props.auth.user" :href="route('projects.create')" class="">
                    <i data-feather="plus" class="h-6 w-6 text-2xl text-gray-200"></i>
                    </Link>

                </div>

                <div class="flex flex-wrap -mx-2">
                    <div v-for="(project, index) in projects" :key="index"
                        class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4 flex hover:animate-scaleIn cursor-pointer scroll-animation">
                        <div class="bg-gray-100 p-4 rounded-lg  w-full flex flex-col">
                            <Link :href="`/projects/${project.project_id}`"
                                class="bg-gray-100 p-4 rounded-lg w-full flex flex-col">
                            <div class="flex items-center justify-center bg-gray-200 rounded-lg  mb-4">
                                <img v-if="project.images.length > 0" :src="getPath(project.images[0]?.path)"
                                    :alt="project.images[0]?.name" class=" object-cover rounded-lg w-full h-48" />
                            </div>

                            <div class="flex flex-col justify-between h-full">
                                <h4 class="font-semibold text-blue-900 text-xl mb-2 text-center">{{ project.name }}</h4>
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
                                        <span>{{ project.status == 1 ? 'En Proceso' : 'Finalizado' }}</span>
                                    </div>

                                </div>
                            </div>
                            </Link>

                        </div>
                    </div>
                </div>
            </div> <!-- container.// -->

        </section>
    </AppLayout>
</template>
