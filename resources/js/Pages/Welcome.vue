<script setup>
import { ref } from "vue";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";

import { Head, Link } from "@inertiajs/vue3";

const isMenuOpen = ref(false);

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById("screenshot-container")?.classList.add("!hidden");
    document.getElementById("docs-card")?.classList.add("!row-span-1");
    document.getElementById("docs-card-content")?.classList.add("!flex-row");
    document.getElementById("background")?.classList.add("!hidden");
}
</script>

<script>
export default {
    data() {
        return {
            isScrolling: false,

            scrollOpacity: 0,

            scrolled: false,
        };
    },
    mounted() {
        feather.replace();
        window.addEventListener('scroll', () => {
            this.isScrolling = window.scrollY > 0;

            const maxScroll = 200;

            this.scrollOpacity = Math.min(window.scrollY / maxScroll, 1);
            this.scrolled = window.scrollY > 20;
        });
    },
}
</script>
<style>
@keyframes fade-in-down {
    0% {
        opacity: 0;
        transform: translateY(-20px);
    }

    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-down {
    animation: fade-in-down 0.3s ease-out both;
}
</style>

<template>

    <div class="bg-gray-100 w-full h-full">

        <Head title="Welcome" />
        <nav class="bg-transparent sticky -top-5 left-0 right-0 z-10 flex-wrap lg:flex py-14">

            <div class=" max-w-10xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 w-100">
                    <div class="flex">
                        <div class="shirnk-0 flex items-center">
                            <Link href="/">
                            <img src="../../image/navbar-logo.png" alt="Logo img" class="w-52 md:w-80 lg:w-full">
                            </Link>

                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex lg:mx-48">
                            <NavLink href="/">Home</NavLink>
                            <NavLink href="#services">Servicios</NavLink>
                            <NavLink href="#gallery">Galería</NavLink>
                            <NavLink href="#testimonials">Recomendaciones</NavLink>
                            <NavLink href="#boot">Contacto</NavLink>

                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-me-2 flex items-center sm:hidden">
                        <button
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            @click="isMenuOpen = !isMenuOpen">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ 'hidden': isMenuOpen, 'inline-flex': !isMenuOpen }"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ 'hidden': !isMenuOpen, 'inline-flex': isMenuOpen }"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{ 'block': isMenuOpen, 'hidden': !isMenuOpen }" class="sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                        Dashboard
                    </ResponsiveNavLink>
                </div>
            </div>

        </nav>
        <section id="home" class="bg-gray-100 py-10 md:py-16 xl:relative min-h-screen">
            <div class="min-h-screen bg-gray-100 container lg:max-w-screen-lg 2xl:max-w-screen-2xl mx-auto px-4">

                <div class="flex items-center justify-center xl:justify-start">

                    <!--<div class="mt-28 text-center xl:text-left">
                        <h1 class="font-semibold text-4xl md:text-6xl lg:text-7xl text-gray-900 leading-normal mb-6">Get
                            your dream <br> house now</h1>

                        <p class="font-normal text-xl text-gray-400 leading-relaxed mb-12">Having a sweet home is
                            everyone's
                            dream. Have you <br> owned your dream house?</p>

                        <button
                            class="px-6 py-4 bg-green-700 text-white font-semibold text-lg rounded-xl hover:bg-green-900 transition ease-in-out duration-500">Contact
                            us</button>
                    </div>-->
                    <!--spanish version-->
                    <div class="mt-28 text-center xl:text-left">
                        <h1 class="font-semibold text-4xl md:text-6xl lg:text-7xl text-gray-900 leading-normal mb-6">
                            Obtenga
                            su casa de <br> ensueño ahora</h1>

                        <p class="font-normal text-xl text-gray-400 leading-relaxed mb-12">Tener una casa dulce es
                            el
                            sueño de
                            todos. ¿Has <br> tenido tu casa de ensueño?</p>

                        <button
                            class="px-6 py-4 bg-green-700 text-white font-semibold text-lg rounded-xl hover:bg-green-900 transition ease-in-out duration-500">Contáctenos</button>
                    </div>




                    <div class="hidden xl:block xl:absolute z-0 top-0 right-0">
                        <img src="../../image/home-img.png" alt="Home img">
                    </div>

                </div>
            </div>
        </section>
        <!-- feature section -->
        <section class="bg-white py-10 md:py-16 xl:relative min-h-screen" id="services">

            <div class="container max-w-screen-xl mx-auto px-4">

                <div class="flex flex-col xl:flex-row justify-end">

                    <div class="hidden xl:block xl:absolute left-0 bottom-0 w-full">
                        <img src="../../image/feature-img.png" alt="Feature img">
                    </div>

                    <div class="">
                        <!--
                        <h1 class="font-semibold text-gray-900 text-xl md:text-4xl text-center leading-normal mb-6">
                            Choice
                            of various types of <br> house</h1>
                        -->

                        <!--spanish version-->
                        <h1 class="font-semibold text-gray-900 text-xl md:text-4xl text-center leading-normal mb-6">
                            Elección de varios tipos de <br> casa</h1>

                        <!--
                        <p class="font-normal text-gray-400 text-md md:text-xl text-center mb-16">We provide a wide of
                            selection of home types for you and your <br> family and are free to choose a home model</p>-->

                        <!--spanish version-->
                        <p class="font-normal text-gray-400 text-md md:text-xl text-center mb-16">Ofrecemos una amplia
                            selección de tipos de viviendas para usted y su <br> familia y son libres de elegir un
                            modelo de vivienda</p>

                        <div class="flex flex-col md:flex-row justify-center xl:justify-start space-x-4 mb-20">
                            <div
                                class="px-8 h-20 mx-auto md:mx-0 bg-gray-200 rounded-lg flex items-center justify-center mb-5 md:mb-0">
                                <i data-feather="check-circle" class=" text-green-900"></i>
                            </div>

                            <!-- <div class="text-center md:text-left">
                                <h4 class="font-semibold text-gray-900 text-2xl mb-2">Best Home Guarantee</h4>
                                <p class="font-normal text-gray-400 text-xl leading-relaxed">We guarantees the quality
                                    of
                                    your home you bought <br> from D’house</p>
                            </div>-->

                            <!--Spanish version-->
                            <div class="text-center md:text-left">
                                <h4 class="font-semibold text-gray-900 text-2xl mb-2">Mejor garantía de hogar</h4>
                                <p class="font-normal text-gray-400 text-xl leading-relaxed">Garantizamos la calidad de
                                    su
                                    hogar que compró <br> en D’house</p>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row justify-center xl:justify-start space-x-4 mb-20">
                            <div
                                class="px-8 h-20 mx-auto md:mx-0 bg-gray-200 rounded-lg flex items-center justify-center mb-5 md:mb-0">
                                <i data-feather="lock" class="text-green-900"></i>

                            </div>
                            <!--
                            <div class="text-center md:text-left">
                                <h4 class="font-semibold text-gray-900 text-2xl mb-2">Safe Transaction</h4>
                                <p class="font-normal text-gray-400 text-xl leading-relaxed">Your transactions will
                                    always
                                    be kept confidential <br> and will get discounted</p>
                            </div>-->

                            <!--Spanish version-->
                            <div class="text-center md:text-left">
                                <h4 class="font-semibold text-gray-900 text-2xl mb-2">Transacción segura</h4>
                                <p class="font-normal text-gray-400 text-xl leading-relaxed">Sus transacciones siempre
                                    se
                                    mantendrán confidenciales <br> y obtendrá un descuento</p>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row justify-center xl:justify-start space-x-4">
                            <div
                                class="px-8 h-20 mx-auto md:mx-0 bg-gray-200 rounded-lg flex items-center justify-center mb-5 md:mb-0">
                                <i data-feather="credit-card" class=" text-green-900"></i>
                            </div>

                            <!--<div class="text-center md:text-left">
                                <h4 class="font-semibold text-gray-900 text-2xl mb-2">Low and Cost Home Taxes</h4>
                                <p class="font-normal text-gray-400 text-xl leading-relaxed">By buying a house from
                                    D’house,
                                    you will get a tax <br> discount</p>
                            </div>-->

                            <!--Spanish version-->
                            <div class="text-center md:text-left">
                                <h4 class="font-semibold text-gray-900 text-2xl mb-2">Impuestos bajos y económicos
                                    para
                                    el hogar</h4>
                                <p class="font-normal text-gray-400 text-xl leading-relaxed">Al comprar una casa de
                                    D’house,
                                    obtendrá un descuento fiscal</p>
                            </div>
                        </div>

                    </div>

                </div>

            </div> <!-- container.// -->

        </section>
        <!-- gallery section -->
        <section id="gallery" class="bg-white py-10 md:py-16">

            <div class="container max-w-screen-xl mx-auto px-4">

                <!--<h1 class="font-semibold text-gray-900 text-4xl text-center mb-10">Our Gallery</h1>-->
                <h1 class="font-semibold text-gray-900 text-4xl text-center mb-10">Galeria</h1>

                <!-- <div class="hidden md:block flex items-center text-center space-x-10 lg:space-x-20 mb-12">
                    <a href="#"
                        class="px-6 py-2 bg-green-800 text-white font-semibold text-xl rounded-lg hover:bg-green-600 transition ease-in-out duration-500">All</a>
                    <a href="#"
                        class="px-6 py-2 text-gray-900 font-normal text-xl rounded-lg hover:bg-gray-200 hover:text-gray-400 transition ease-in-out duration-500">Exterior</a>
                    <a href="#"
                        class="px-6 py-2 text-gray-900 font-normal text-xl rounded-lg hover:bg-gray-200 hover:text-gray-400 transition ease-in-out duration-500">Interior</a>
                    <a href="#"
                        class="px-6 py-2 text-gray-900 font-normal text-xl rounded-lg hover:bg-gray-200 hover:text-gray-400 transition ease-in-out duration-500">Building</a>
                </div> -->

                <div class="hidden md:block flex items-center text-center space-x-10 lg:space-x-20 mb-12">
                    <a href="#"
                        class="px-6 py-2 bg-green-800 text-white font-semibold text-xl rounded-lg hover:bg-green-600 transition ease-in-out duration-500">Todo</a>
                    <a href="#"
                        class="px-6 py-2 text-gray-900 font-normal text-xl rounded-lg hover:bg-gray-200 hover:text-gray-400 transition ease-in-out duration-500">Exterior</a>
                    <a href="#"
                        class="px-6 py-2 text-gray-900 font-normal text-xl rounded-lg hover:bg-gray-200 hover:text-gray-400 transition ease-in-out duration-500">Interior</a>
                    <a href="#"
                        class="px-6 py-2 text-gray-900 font-normal text-xl rounded-lg hover:bg-gray-200 hover:text-gray-400 transition ease-in-out duration-500">Edificio</a>
                </div>

                <div class="flex space-x-4 md:space-x-6 lg:space-x-8">
                    <div>
                        <img src="../../image/gallery-1.png" alt="image"
                            class="mb-4 md:mb-6 lg:mb-8 hover:opacity-75 transition ease-in-out duration-500">
                        <img src="../../image/gallery-4.png" alt="image"
                            class="hover:opacity-75 transition ease-in-out duration-500">
                    </div>

                    <div>
                        <img src="../../image/gallery-2.png" alt="image"
                            class="mb-4 md:mb-6 lg:mb-8 hover:opacity-75 transition ease-in-out duration-500">
                        <img src="../../image/gallery-5.png" alt="image"
                            class="mb-3 md:mb-6 lg:mb-8 hover:opacity-75 transition ease-in-out duration-500">
                        <img src="../../image/gallery-6.png" alt="image"
                            class="hover:opacity-75 transition ease-in-out duration-500">
                    </div>

                    <div>
                        <img src="../../image/gallery-3.png" alt="image"
                            class="mb-4 md:mb-6 lg:mb-8 hover:opacity-75 transition ease-in-out duration-500">
                        <img src="../../image/gallery-7.png" alt="image"
                            class="hover:opacity-75 transition ease-in-out duration-500">
                    </div>
                </div>

            </div> <!-- container.// -->

        </section>
        <!-- gallery section //end -->

        <!-- testimoni section -->
        <section class="bg-white py-10 md:py-16" id="testimonials">

            <div class="container max-w-screen-xl mx-auto px-4 xl:relative">

                <!-- <p class="font-normal text-gray-400 text-lg md:text-xl text-center uppercase mb-6">Testimonial</p> -->
                <p class="font-normal text-gray-400 text-lg md:text-xl text-center uppercase mb-6">Testimonios</p>

                <!--<h1 class="font-semibold text-gray-900 text-2xl md:text-4xl text-center leading-normal mb-14">What
                    People
                    Say <br> About D’house</h1>-->

                <h1 class="font-semibold text-gray-900 text-2xl md:text-4xl text-center leading-normal mb-14">Lo que
                    la
                    gente dice <br> sobre D’house</h1>


                <div class="hidden xl:block xl:absolute top-0">
                    <img src="../../image/testimoni-1.png" alt="Image">
                </div>

                <div class="hidden xl:block xl:absolute top-32">
                    <img src="../../image/testimoni-2.png" alt="Image">
                </div>

                <div
                    class="flex flex-col md:flex-row md:items-center justify-center md:space-x-8 lg:space-x-12 mb-10 md:mb-20">

                    <div class="bg-gray-100 rounded-lg mb-10 md:mb-0">
                        <img src="../../image/testimoni-3.png" alt="Image" class="mx-8 my-8">

                        <div class="flex items-center gap-5 mx-8">
                            <i data-feather="star" class="text-yellow-500"></i>
                            <i data-feather="star" class="text-yellow-500"></i>
                            <i data-feather="star" class="text-yellow-500"></i>
                            <i data-feather="star" class="text-yellow-500"></i>
                            <i data-feather="star" class="text-yellow-500"></i>
                        </div>

                        <!-- <p class="font-normal text-sm lg:text-md text-gray-400 mx-8 my-8">I recommend anyone to buy
                            house on
                            <br> D’house. I received great customer service <br> from the specialists who helped me.
                        </p> -->
                        <!--spanish version-->

                        <p class="font-normal text-sm lg:text-md text-gray-400 mx-8 my-8">Recomiendo a cualquiera que
                            compre
                            una casa en D’house. Recibí un excelente servicio al cliente de los especialistas que me
                            ayudaron.</p>

                        <h3 class="font-semibold text-gray-900 text-xl md:text-2xl lg:text-3xl mx-8 mb-8">Brooklyn
                            Simmons
                        </h3>
                    </div>

                    <div class="bg-gray-100 rounded-lg">
                        <img src="../../image/testimoni-4.png" alt="Image" class="mx-8 my-8">

                        <div class="flex items-center gap-5 mx-8">
                            <i data-feather="star" class="text-yellow-500"></i>
                            <i data-feather="star" class="text-yellow-500"></i>
                            <i data-feather="star" class="text-yellow-500"></i>
                            <i data-feather="star" class="text-yellow-500"></i>
                            <i data-feather="star" class="text-yellow-500"></i>
                        </div>

                        <!-- <p class="font-normal text-sm lg:text-md text-gray-400 mx-8 my-8">D’house is the best property
                            agent
                            in the <br> world. I received great customer service <br> from the D’house agent</p> -->

                        <!--spanish version-->
                        <p class="font-normal text-sm lg:text-md text-gray-400 mx-8 my-8">D’house es el mejor agente
                            de
                            propiedades del mundo. Recibí un excelente servicio al cliente del agente de D’house</p>

                        <h3 class="font-semibold text-gray-900 text-xl md:text-2xl lg:text-3xl mx-8 mb-8">Ralph Edwards
                        </h3>
                    </div>

                </div>

            </div> <!-- container.// -->

        </section>
        <!-- testimoni section //end -->

        <!-- book section -->
        <section class="bg-white py-10 md:py-16" id="book">

            <div class="container max-w-screen-xl mx-auto px-4 xl:relative">

                <div class="bg-green-800 flex flex-col lg:flex-row items-center justify-evenly py-14 rounded-3xl">

                    <!-- <div class="text-center lg:text-left mb-10 lg:mb-0">
                        <h1 class="font-semibold text-white text-4xl md:text-5xl lg:text-7xl leading-normal mb-4">Talk
                            to us
                            <br> to discuss
                        </h1>

                        <p class="font-normal text-white text-md md:text-xl">Need more time to discuss? Won’t worry, we
                            are
                            <br> ready to help you. You can fill in the column on the <br> right to book a meeting with
                            us.
                            Totally free.
                        </p>
                    </div> -->

                    <!--spanish version-->
                    <div class="text-center lg:text-left mb-10 lg:mb-0">
                        <h1 class="font-semibold text-white text-4xl md:text-5xl lg:text-7xl leading-normal mb-4">Hable
                            con
                            nosotros
                            <br> para discutir
                        </h1>

                        <p class="font-normal text-white text-md md:text-xl">¿Necesita más tiempo para discutir? No se
                            preocupe, estamos <br> listos para ayudarte. Puede completar la columna de la <br> derecha
                            para
                            reservar una reunión con nosotros. Totalmente gratis.
                        </p>
                    </div>

                    <div class="hidden xl:block xl:absolute right-0">
                        <img src="../../image/book.png" alt="Image">
                    </div>

                    <div class="hidden md:block bg-white xl:relative px-6 py-3 rounded-3xl">
                        <!-- <div class="py-3">
                            <h3 class="font-semibold text-gray-900 text-3xl">Book a meeting</h3>
                        </div> -->

                        <!--spanish version-->
                        <div class="py-3">
                            <h3 class="font-semibold text-gray-900 text-3xl">Reservar una reunión</h3>
                        </div>
                        <div class="py-3">
                            <input type="text" placeholder="Full Name"
                                class="px-4 py-4 w-96 bg-gray-100 placeholder-gray-400 rounded-xl outline-none">
                        </div>

                        <div class="py-3">
                            <input type="text" placeholder="Email"
                                class="px-4 py-4 w-96 bg-gray-100 placeholder-gray-400 rounded-xl outline-none">
                        </div>

                        <div class="py-3 relative">
                            <input type="text" placeholder="Date"
                                class="px-4 py-4 w-96 bg-gray-100 font-normal text-lg placeholder-gray-400 rounded-xl outline-none">

                            <div class="absolute inset-y-0 left-80 ml-6 flex items-center text-xl text-gray-600">
                                <i data-feather="calendar"></i>
                            </div>
                        </div>

                        <div class="py-3 relative">
                            <input type="text" placeholder="Virtual Meeting"
                                class="px-4 py-4 w-96 bg-gray-100 placeholder-gray-400 rounded-xl outline-none">

                            <div class="absolute inset-y-0 left-80 ml-6 flex items-center text-xl text-gray-600">
                                <i data-feather="chevron-down"></i>
                            </div>
                        </div>

                        <div class="py-3">
                            <!-- <button
                                class="w-full py-4 font-semibold text-lg text-white bg-green-700 rounded-xl hover:bg-green-900 transition ease-in-out duration-500">Booking</button> -->

                            <!--spanish version-->
                            <button
                                class="w-full py-4 font-semibold text-lg text-white bg-green-700 rounded-xl hover:bg-green-900 transition ease-in-out duration-500">Reserva</button>
                        </div>
                    </div>

                </div>

            </div> <!-- container.// -->

        </section>
        <!-- book section //end -->

        <!-- footer -->
        <footer class="bg-white py-10 md:py-16">

            <div class="container max-w-screen-xl mx-auto px-4">

                <div class="flex flex-col lg:flex-row justify-between">
                    <div class="text-center lg:text-left mb-10 lg:mb-0">
                        <div class="flex justify-center lg:justify-start mb-5">
                            <img src="../../image/footer-logo.png" alt="Image">
                        </div>

                        <p class="font-light text-gray-400 text-xl mb-10">Get your dream house with <br> D’house</p>

                        <div class="flex items-center justify-center lg:justify-start space-x-5">
                            <a href="#"
                                class="px-3 py-3 bg-gray-200 text-gray-700 rounded-full hover:bg-green-800 hover:text-white transition ease-in-out duration-500">
                                <i data-feather="facebook"></i>
                            </a>

                            <a href="#"
                                class="px-3 py-3 bg-gray-200 text-gray-700 rounded-full hover:bg-green-800 hover:text-white transition ease-in-out duration-500">
                                <i data-feather="twitter"></i>
                            </a>

                            <a href="#"
                                class="px-3 py-3 bg-gray-200 text-gray-700 rounded-full hover:bg-green-800 hover:text-white transition ease-in-out duration-500">
                                <i data-feather="linkedin"></i>
                            </a>
                        </div>
                    </div>

                    <div class="text-center lg:text-left mb-10 lg:mb-0">
                        <h4 class="font-semibold text-gray-900 text-2xl mb-6">Sitemap</h4>

                        <a href="#home"
                            class="block font-light text-gray-400 text-xl mb-6 hover:text-gray-800 transition ease-in-out duration-300">Home</a>

                        <a href="#services"
                            class="block font-light text-gray-400 text-xl mb-6 hover:text-gray-800 transition ease-in-out duration-300">Features</a>

                        <a href="#gallery"
                            class="block font-light text-gray-400 text-xl mb-6 hover:text-gray-800 transition ease-in-out duration-300">Gallery</a>

                        <a href="#testimonials"
                            class="block font-light text-gray-400 text-xl mb-6 hover:text-gray-800 transition ease-in-out duration-300">Testimonials</a>

                        <a href="#book"
                            class="block font-light text-gray-400 text-xl mb-6 hover:text-gray-800 transition ease-in-out duration-300">Book
                            a meeting</a>
                    </div>

                    <!-- <div class="text-center lg:text-left mb-10 lg:mb-0">
                        <h4 class="font-semibold text-gray-900 text-2xl mb-6">Landing</h4>

                        <a href="#"
                            class="block font-light text-gray-400 text-xl mb-6 hover:text-gray-800 transition ease-in-out duration-300">Mobile
                            App</a>

                        <a href="#"
                            class="block font-light text-gray-400 text-xl mb-6 hover:text-gray-800 transition ease-in-out duration-300">Property</a>

                        <a href="#"
                            class="block font-light text-gray-400 text-xl mb-6 hover:text-gray-800 transition ease-in-out duration-300">Personal
                            Website</a>

                        <a href="#"
                            class="block font-light text-gray-400 text-xl mb-6 hover:text-gray-800 transition ease-in-out duration-300">Web
                            Developer</a>

                        <a href="#"
                            class="block font-light text-gray-400 text-xl mb-6 hover:text-gray-800 transition ease-in-out duration-300">Online
                            Course</a>

                        <a href="#"
                            class="block font-light text-gray-400 text-xl mb-6 hover:text-gray-800 transition ease-in-out duration-300">Donation</a>
                    </div> -->

                    <div class="text-center lg:text-left">
                        <h4 class="font-semibold text-gray-900 text-2xl mb-6">Utility</h4>

                        <a href="#"
                            class="block font-light text-gray-400 text-xl mb-6 hover:text-gray-800 transition ease-in-out duration-300">FAQ</a>

                        <a href="#"
                            class="block font-light text-gray-400 text-xl mb-6 hover:text-gray-800 transition ease-in-out duration-300">Terms
                            & Conditions</a>
                    </div>
                </div>

            </div> <!-- container.// -->

        </footer>
    </div>
</template>
