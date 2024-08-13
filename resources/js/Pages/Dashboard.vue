<script setup>

import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';

</script>


<template>
    <AppLayout title="Dashboard">

        <!--dashboard resume section 4 cards-->
        <section class="bg-gray-100 py-10 md-py-16 x-relative">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-white p-4 rounded-lg shadow-lg">
                        <div class="flex items center justify-between">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Total Users</h2>
                                <p class="text-gray-500">Total users in the system</p>
                            </div>
                            <div class="bg-blue-500 text-white p-2 rounded-full">
                                <span>100</span>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="text-blue-500">View Details</a>
                            <a href="#" class="text-blue-500">Add New</a>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-lg">
                        <div class="flex items center justify-between">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Total Users</h2>
                                <p class="text-gray-500">Total users in the system</p>
                            </div>
                            <div class="bg-blue-500 text-white p-2 rounded-full">
                                <span>100</span>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="text-blue-500">View Details</a>
                            <a href="#" class="text-blue-500">Add New</a>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-lg">
                        <div class="flex items center justify-between">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Total Users</h2>
                                <p class="text-gray-500">Total users in the system</p>
                            </div>
                            <div class="bg-blue-500 text-white p-2 rounded-full">
                                <span>100</span>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="text-blue-500">View Details</a>
                            <a href="#" class="text-blue-500">Add New</a>
                        </div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-lg">
                        <div class="flex items center justify-between">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">Total Users</h2>
                                <p class="text-gray-500">Total users in the system</p>
                            </div>
                            <div class="bg-blue-500 text-white p-2 rounded-full">
                                <span>100</span>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="text-blue-500">View Details</a>
                            <a href="#" class="text-blue-500">Add New</a>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- carrousel de cards de proyectos -->
        <section class="bg-gray-100 py-10 md-py-16 x-relative">
            <div class="container mx-auto px-4">
                <h2 class="text-2xl font-bold text-gray-800">Projects</h2>
                <swiper :spaceBetween="30" :centeredSlides="false" :autoplay="{
                    delay: 2500,
                    disableOnInteraction: false,
                }" :navigation="false" :modules="modules" class="mySwiper" :slidesPerView="1" :pagination="{
                    clickable: true,
                }" :breakpoints="{
                    '640': {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    '768': {
                        slidesPerView: 3,
                        spaceBetween: 40,
                    },
                    '1024': {
                        slidesPerView: 4,
                        spaceBetween: 50,
                    },
                }">

                    <swiper-slide
                        class="mx-3 mt-6 flex flex-col rounded-lg bg-white text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-white sm:shrink-0 sm:grow sm:basis-0">
                        <a href="#!">
                            <img class="rounded-t-lg" src="https://tecdn.b-cdn.net/img/new/standard/city/041.webp"
                                alt="Hollywood Sign on The Hill" />
                        </a>
                        <div class="p-6">
                            <h5 class="mb-2 text-xl font-medium leading-tight">Card title</h5>
                            <p class="mb-4 text-base">
                                This is a longer card with supporting text below as a natural
                                lead-in to additional content. This content is a little bit
                                longer.
                            </p>
                        </div>


                    </swiper-slide>
                    <swiper-slide
                        class="mx-3 mt-6 flex flex-col rounded-lg bg-white text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-white sm:shrink-0 sm:grow sm:basis-0">
                        <a href="#!">
                            <img class="rounded-t-lg" src="https://tecdn.b-cdn.net/img/new/standard/city/042.webp"
                                alt="Palm Springs Road" />
                        </a>
                        <div class="p-6">
                            <h5 class="mb-2 text-xl font-medium leading-tight">Card title</h5>
                            <p class="mb-4 text-base">
                                This is a longer card with supporting text below as a natural
                                lead-in to additional content. This content is a little bit
                                longer.
                            </p>
                        </div>


                    </swiper-slide>
                    <swiper-slide
                        class="mx-3 mt-6 flex flex-col rounded-lg bg-white text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-white sm:shrink-0 sm:grow sm:basis-0">
                        <a href="#!">
                            <img class="rounded-t-lg" src="https://tecdn.b-cdn.net/img/new/standard/city/044.webp"
                                alt="Skyscrapers" />
                        </a>
                        <div class="p-6">
                            <h5 class="mb-2 text-xl font-medium leading-tight">Card title</h5>
                            <p class="mb-4 text-base">
                                This is a longer card with supporting text below as a natural
                                lead-in to additional content.
                            </p>
                        </div>


                    </swiper-slide>
                    <swiper-slide
                        class="mx-3 mt-6 flex flex-col rounded-lg bg-white text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-white sm:shrink-0 sm:grow sm:basis-0">
                        <a href="#!">
                            <img class="rounded-t-lg" src="https://tecdn.b-cdn.net/img/new/standard/city/041.webp"
                                alt="Hollywood Sign on The Hill" />
                        </a>
                        <div class="p-6">
                            <h5 class="mb-2 text-xl font-medium leading-tight">Card title</h5>
                            <p class="mb-4 text-base">
                                This is a longer card with supporting text below as a natural
                                lead-in to additional content. This content is a little bit
                                longer.
                            </p>
                        </div>


                    </swiper-slide>
                    <swiper-slide
                        class="mx-3 mt-6 flex flex-col rounded-lg bg-white text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-white sm:shrink-0 sm:grow sm:basis-0">
                        <a href="#!">
                            <img class="rounded-t-lg" src="https://tecdn.b-cdn.net/img/new/standard/city/042.webp"
                                alt="Palm Springs Road" />
                        </a>
                        <div class="p-6">
                            <h5 class="mb-2 text-xl font-medium leading-tight">Card title</h5>
                            <p class="mb-4 text-base">
                                This is a longer card with supporting text below as a natural
                                lead-in to additional content. This content is a little bit
                                longer.
                            </p>
                        </div>
                    </swiper-slide>
                </swiper>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                </div>

            </div>
        </section>


        <!--dashboard resume section 4 cards-->

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <Welcome />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>


import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import { Autoplay, Navigation, Pagination } from 'swiper/modules';

const swiperOptions = {
    autoplay: {
        delay: 5000,
    },
    navigation: true,
    pagination: {
        clickable: true,
    },
};



export default {
    components: {
        Swiper,
        SwiperSlide,
    },
    setup() {
        return {
            modules: [Autoplay, Pagination, Navigation],
        };
    },
};
</script>
