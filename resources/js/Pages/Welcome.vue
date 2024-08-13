<script setup>
import { ref } from "vue";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";


import AppLayout from '@/Layouts/AppLayout.vue';



import { Head, Link } from "@inertiajs/vue3";

const isMenuOpen = ref(false);

defineProps({

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
            text: "Desarrolladora JC & DGD Urbano",
            animatedText: [],
            animationIndex: 0,
        };
    },
    mounted() {
        this.animateText();
        window.addEventListener('scroll', this.handleScroll);
    },
    methods: {
        animateText() {
            this.animatedText = [];
            this.animationIndex = 0; // Reset the index
            this.addCharacters();
        },
        addCharacters() {
            // Dividir el texto en caracteres
            const characters = this.text.split("");
            if (this.animationIndex < characters.length) {
                const char = characters[this.animationIndex];

                // Agregar el carácter al texto animado
                if (char === " ") {
                    this.animatedText.push({ type: 'space' }); // Manejar espacios en blanco
                } else if (char === "\n") {
                    this.animatedText.push({ type: 'break' }); // Manejar saltos de línea
                } else {
                    this.animatedText.push({ type: 'char', value: char });
                }
                this.animationIndex++;
                setTimeout(this.addCharacters, 100); // Continuar con el siguiente carácter
            } else {
                setTimeout(this.animateText, 6000); // Reiniciar la animación después de un retraso
            }
        },
        handleScroll() {
            const section = document.getElementById('services');
            const rect = section.getBoundingClientRect();
            const windowHeight = window.innerHeight;

            // Check if the section is in the viewport
            if (rect.top < windowHeight && rect.bottom > 0) {
                // Calculate the percentage of the section that is visible
                const visiblePercentage = Math.min(1, (windowHeight - rect.top) / rect.height);

                // Set the opacity based on the visible percentage
                section.style.opacity = visiblePercentage;
            } else {
                // Set opacity to 0 if the section is not in the viewport
                section.style.opacity = 0;
            }
        },

    },
    beforeUnmount() {
        window.removeEventListener('scroll', this.handleScroll);
    },
};


</script>
<style>
.letter {
    display: inline-block;
    opacity: 0;
    animation: fadeIn 0.5s forwards;
}

@keyframes fadeIn {
    to {
        opacity: 1;
    }
}


.section {
    position: relative;
    z-index: 1;
}

.transition-section {
    position: relative;
    min-height: 200px;
    max-height: 400px;

    /* Adjust as needed */
    background-size: cover;
    background-attachment: fixed;
    background-position: center;
    z-index: 0;
}

.transparent-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.1);
    /* Adjust the transparency as needed */
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1;
}

#services {
    position: relative;
    opacity: 0;
    transition: opacity 1s ease-in-out;
}

#services.fade-in {
    opacity: 1;
}

#content {
    opacity: 0.9;
    transform: translateX(-20%);
    transition: opacity 0.5s ease, transform 0.5s ease
}
</style>

<template>
    <AppLayout title="Home">
        <div class="bg-gray-100 w-full h-full">

            <Head title="Bienvenido" />
            <nav class=" bg-transparent fixed -top-5 left-0 right-0 z-10 flex-wrap lg:flex py-14 d-none"
                style="display: none;">

                <div class="max-w-10xl mx-auto px-4 sm:px-6 lg:px-8 d-none">
                    <div class="flex justify-between h-16 w-100">
                        <div class="flex">
                            <div class="shirnk-0 flex items-around ">
                                <Link href="/">
                                <div class="flex flex-row">
                                    <img src="../../image/logo-jc.jpg" alt="Logo img"
                                        class="w-28 md:w-80 lg:w-28 rounded-full border-r-2  border-gray-200">
                                    <img src="../../image/logo-dgd.jpg" alt="Logo img"
                                        class="w-28 md:w-80 lg:w-28 rounded-full border-r-2  border-gray-200">
                                </div>
                                </Link>

                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex lg:mx-48">
                                <NavLink class="text-blue-900 font-bold hover:text-red-500" href="/home">Home</NavLink>
                                <NavLink class="text-blue-900 font-bold hover:text-red-500" href="/services">Servicios
                                </NavLink>
                                <NavLink class="text-blue-900 font-bold hover:text-red-500" href="#projects">Proyectos
                                </NavLink>
                                <NavLink class="text-blue-900 font-bold hover:text-red-500" href="#properties">
                                    Propiedades
                                </NavLink>
                                <NavLink class="text-blue-900 font-bold hover:text-red-500" href="#constructions">
                                    Construcciones</NavLink>
                                <NavLink class="text-blue-900 font-bold hover:text-red-500" href="#renovations">
                                    Remodelaciones</NavLink>
                                <NavLink class="text-blue-900 font-bold hover:text-red-500" href="#contact">Contacto
                                </NavLink>

                            </div>
                            <div class="hidden sm:flex sm:items-center sm:ms-6">
                                <div class="ms-3 relative">
                                    <!-- Teams Dropdown -->
                                    <Dropdown v-if="$page.props.jetstream.hasTeamFeatures" align="right" width="60">
                                        <template #trigger>
                                            <span class="inline-flex rounded-md">
                                                <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                    {{ $page.props.auth.user.current_team.name }}

                                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <div class="w-60">
                                                <!-- Team Management -->
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    Manage Team
                                                </div>

                                                <!-- Team Settings -->
                                                <DropdownLink
                                                    :href="route('teams.show', $page.props.auth.user.current_team)">
                                                    Team Settings
                                                </DropdownLink>

                                                <DropdownLink v-if="$page.props.jetstream.canCreateTeams"
                                                    :href="route('teams.create')">
                                                    Create New Team
                                                </DropdownLink>

                                                <!-- Team Switcher -->
                                                <template v-if="$page.props.auth.user.all_teams.length > 1">
                                                    <div class="border-t border-gray-200" />

                                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                                        Switch Teams
                                                    </div>

                                                    <template v-for="team in $page.props.auth.user.all_teams"
                                                        :key="team.id">
                                                        <form @submit.prevent="switchToTeam(team)">
                                                            <DropdownLink as="button">
                                                                <div class="flex items-center">
                                                                    <svg v-if="team.id == $page.props.auth.user.current_team_id"
                                                                        class="me-2 h-5 w-5 text-green-400"
                                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round"
                                                                            d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                    </svg>

                                                                    <div>{{ team.name }}</div>
                                                                </div>
                                                            </DropdownLink>
                                                        </form>
                                                    </template>
                                                </template>
                                            </div>
                                        </template>
                                    </Dropdown>
                                </div>

                                <!-- Settings Dropdown -->
                                <div class="ms-3 relative" v-if="$page.props.auth.user">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <button v-if="$page.props.jetstream.managesProfilePhotos"
                                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                                <img class="h-8 w-8 rounded-full object-cover"
                                                    :src="$page.props.auth.user.profile_photo_url"
                                                    :alt="$page.props.auth.user.name">
                                            </button>

                                            <span v-else class="inline-flex rounded-md">
                                                <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                    {{ $page.props.auth.user.name ?? '' }}

                                                    <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <!-- Account Management -->
                                            <div class="block px-4 py-2 text-xs text-gray-400">
                                                Manage Account
                                            </div>

                                            <DropdownLink :href="route('profile.show')">
                                                Profile
                                            </DropdownLink>

                                            <DropdownLink v-if="$page.props.jetstream.hasApiFeatures"
                                                :href="route('api-tokens.index')">
                                                API Tokens
                                            </DropdownLink>

                                            <div class="border-t border-gray-200" />

                                            <!-- Authentication -->
                                            <form @submit.prevent="logout">
                                                <DropdownLink as="button">
                                                    Log Out
                                                </DropdownLink>
                                            </form>
                                        </template>
                                    </Dropdown>
                                </div>
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
            <section id="home"
                class="bg-ctmblue p-2 md:px-10 lg:px-16 md:py-16 xl:relative md:min-h-screen flex xl:items-center">

                <div
                    class="bg-gray-100 lg:max-w-screen-lg xl:max-w-screen-xl mx-auto px-0 md:px-2 border border-red-500 border-8 rounded-lg w-full">
                    <div
                        class="flex flex-col md:flex-row items-center justify-center xl:justify-start p-2 md:p-10 lg:p-20 flex-wrap">
                        <div class="text-center xl:text-left mb-20 xl:mb-0">

                            <div class="">
                                <h1
                                    class="font-semibold text-3xl md:text-5xl lg:text-6xl text-ctmblue leading-normal mb-0 font-dancing xl:w-1/2">
                                    <template v-for=" (item, index) in animatedText" :key="index">
                                        <span v-if="item.type === 'char'" :style="{ animationDelay: index * 0.1 + 's' }"
                                            class="letter font-dancing">
                                            {{ item.value }}
                                        </span>
                                        <span v-if="item.type === 'space'" class="letter">
                                            &nbsp;
                                        </span>
                                        <br v-if="item.type === 'break'" />
                                        <!-- No es necesario manejar espacios en blanco explícitamente si se usa br para saltos de línea -->
                                    </template>
                                </h1>
                            </div>

                            <!--<h1
                            class="font-semibold text-4xl md:text-6xl lg:text-7xl text-blue-900 leading-normal mb-6 font-dancing">
                            Desarrolladora JC <br> & DGD Urbano</h1>-->

                            <h2
                                class="font-semibold text-2xl md:text-2xl lg:text-3xl text-blue-900 leading-normal mb-6">
                                <span class="">Lotificadora</span> y <span class="">Constructora</span>
                            </h2>

                            <p
                                class="font-normal text-base md:text-xl text-gray-400 leading-relaxed mb-12 font-dancin  xl:w-1/2">
                                Fundada en Anamorós en el 2021, por <span class="font-semibold text-blue-900">Josefina
                                    Leonor
                                    Reyes de
                                    Cruz, </span>
                                <span class="font-semibold text-blue-900">Lidia Argentina Cruz Reyes </span>
                                <span class="font-semibold text-blue-900">y Juan Ubaldo Cruz Reyes.</span><br>
                                Con el objetivo de dignificar el sector inmobiliario en El Salvador,
                                a través del desarrollo de lotificaciones
                                planificadas que, ofrecen a sus residentes lotes de terrenos con
                                enfoque de <span class="text-blue-900">Privacidad, Seguridad y
                                    Recreación.</span>
                            </p>


                            <a href="#contact"
                                class="px-6 py-4 bg-ctmred text-gray-300 font-semibold text-lg rounded-xl hover:bg-green-900 transition ease-in-out duration-500">Contáctanos</a>
                        </div>
                        <!--video centrado verticalmente a la derecha-->
                        <div class="xl:flex xl:absolute z-10 right-0 items-center">
                            <video src="../../video/video-banner-jc.mp4" type="video/mp4" controls autoplay muted
                                class=""></video>
                        </div>

                    </div>
                </div>
            </section>

            <div class="transition-section bg-cover bg-center h-screen flex items-center justify-center"
                style="background-image: url('https://assets.easybroker.com/property_images/3736677/61148863/EB-NI6677.jpg?version=1683829538');">
                <div class="bg-ctmblue bg-opacity-50 p-8 rounded-lg text-gray-100">
                    <div class="flex justify-around md:items-center md:space-x-40 flex-wrap">
                        <div class=" text-center">
                            <div class="text-2xl md:text-4-xl xl:text-8xl font-bold">4</div>
                            <div class="text-base mt-2">Proyectos desarrollados</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl md:text-4-xl xl:text-8xl font-bold">40</div>
                            <div class="text-base mt-2">Casas Construidas</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl md:text-4-xl xl:text-8xl font-bold">546</div>
                            <div class="text-base mt-2">Empleos Generados</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- feature section -->
            <section id="services" class="bg-ctmred py-10 md:py-16 xl:relative">

                <div class="container max-w-screen-xl mx-auto px-4">

                    <div class="flex flex-col xl:flex-row justify-end">

                        <div class="hidden xl:block xl:absolute left-0">
                            <img src="../../image/banner-jc.jpg" alt="Feature img" width="80%">
                        </div>

                        <div class="">
                            <!--
                        <h1 class="font-semibold text-gray-900 text-xl md:text-4xl text-center leading-normal mb-6">
                            Choice
                            of various types of <br> house</h1>
                        -->

                            <!--spanish version-->
                            <h1
                                class="font-semibold text-3xl md:text-5xl text-center leading-normal mb-6 font-dancing text-gray-300">
                                Nuestra Filosofia</h1>

                            <!--
                        <p class="font-normal text-gray-400 text-md md:text-xl text-center mb-16">We provide a wide of
                            selection of home types for you and your <br> family and are free to choose a home model</p>-->

                            <!--spanish version-->
                            <p class="font-normal text-gray-300 text-xl md:text-1xl text-center mb-10">Compromiso con la
                                Excelencia y la Innovacións <br>
                                en el Desarrollo Inmobiliario de El Salvador</p>

                            <div class="flex flex-col md:flex-row justify-center xl:justify-start space-x-4 mb-5">
                                <div
                                    class="px-8 h-20 mx-auto md:mx-0 bg-gray-300 rounded-lg flex items-center justify-center mb-5 md:mb-0">
                                    <i data-feather="check-circle" class="text-red-500"></i>
                                </div>

                                <!--Spanish version-->
                                <div class="text-center md:text-left">
                                    <h4 class="font-semibold text-base md:text-2xl mb-2 text-gray-300">
                                        Nuestro
                                        Inicio
                                    </h4>
                                    <p class="font-normal text-gray-300 text-base leading-relaxed">
                                        Iniciamos con la visión de ser la empresa líder en la <br>comercialización de
                                        proyectos
                                        de lotificaciones y construcción <br>de viviendas a nivel nacional.
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-col md:flex-row justify-center xl:justify-start space-x-4 mb-5">
                                <div
                                    class="px-8 h-20 mx-auto md:mx-0 bg-gray-300 rounded-lg flex items-center justify-center mb-5 md:mb-0">
                                    <i data-feather="lock" class="text-red-500"></i>
                                </div>
                                <div class="text-center md:text-left">
                                    <h4 class="font-semibold text-xl md:text-2xl mb-2 text-gray-300">
                                        Soluciones Efectivas y Espíritu de Servicio</h4>
                                    <p class="font-normal text-gray-300 text-base leading-relaxed">
                                        Ofrecemos efectivas soluciones de terrenos<br> a los salvadoreños.<br>
                                        Desde entonces, se ha
                                        demostrado el verdadero espíritu y <br>mística en el servicio a nuestros
                                        clientes.
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-col md:flex-row justify-center xl:justify-start space-x-4">
                                <div
                                    class="px-8 h-20 mx-auto md:mx-0 bg-gray-300 rounded-lg flex items-center justify-center mb-5 md:mb-0">
                                    <i data-feather="credit-card" class="text-red-500"></i>
                                </div>
                                <div class="text-center md:text-left">
                                    <h4 class="font-semibold text-xl md:text-2xl mb-2 text-gray-300">
                                        Compromiso Social y
                                        Corporativo
                                    </h4>
                                    <p class="font-normal text-gray-300 text-base leading-relaxed">
                                        Desarrollamos proyectos de lotificaciones <br> con compromiso social y
                                        corporativo.
                                    </p>
                                </div>
                            </div>



                        </div>

                    </div>

                </div> <!-- container.// -->

            </section>


            <!-- feature section -->
            <section class="bg-gray-100 py-10 md:py-16 xl:relative" id="aboutUs">

                <div class="content-wrapper">
                    <div class="">
                        <div class="container max-w-screen-xl mx-auto px-4">
                            <h1
                                class="font-semibold text-3xl md:text-5xl text-center leading-normal mb-6 font-dancing text-ctmblue">
                                Mision y Vision</h1>
                            <div class="flex flex-col xl:flex-row justify-between scroll-animation">


                                <div
                                    class="flex flex-col md:flex-row justify-center xl:justify-start space-x-4 mb-5 lg:pr-10">

                                    <div class="text-center md:text-left">
                                        <h4 class="font-semibold text-red-500 text-xl md:text-3xl mb-2">Mision</h4>
                                        <p
                                            class="font-normal text-gray-400 text-base md:text-xl xl:text-2xl leading-relaxed">
                                            Satisfacer a nuestros compradores ofreciéndoles desarrollos en los terrenos
                                            <br>y
                                            viviendas habitacionales innovadoras e integrales a precios competitivos,
                                            certificando la excelencia en el producto y el servicio, de conformidad con
                                            la
                                            sociedad y el medio ambiente.
                                        </p>
                                    </div>
                                </div>



                                <div class="flex flex-col md:flex-row justify-center xl:justify-start space-x-4 mb-5">

                                    <div class="text-center md:text-left">

                                        <h4 class="font-semibold text-red-500 text-xl md:text-3xl mb-2">Vision</h4>
                                        <p
                                            class="font-normal text-gray-400 text-base md:text-xl xl:text-2xl leading-relaxed">
                                            Ser líderes en el Salvador, en la comercialización de proyectos de
                                            Lotificaciones y
                                            construcción de viviendas innovadoras de conformidad con la sociedad y el
                                            medio
                                            ambiente.
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <h1
                                class="font-semibold text-3xl md:text-5xl text-center leading-normal mb-6 font-dancing text-ctmblue">
                                Nuestros Valores</h1>
                            <div class="flex flex-col md:flex-row justify-between scroll-animation">

                                <div class="">
                                    <div
                                        class="flex flex-col md:flex-row justify-center xl:justify-start space-x-4 mb-5">
                                        <div
                                            class="px-8 h-20 mx-auto md:mx-0 bg-gray-200 rounded-lg flex items-center justify-center mb-5 md:mb-0">
                                            <i data-feather="heart" class="text-red-500"></i>
                                        </div>

                                        <div class="text-center md:text-left">
                                            <h4 class="font-semibold text-ctmblue text-xl md:text-2xl mb-2">Lealtad
                                            </h4>
                                            <p
                                                class="font-normal text-gray-400 text-base md:text-xl xl:text-1xl leading-relaxed">
                                                Ser leales a nuestros clientes, colaboradores y proveedores.
                                            </p>
                                        </div>

                                    </div>

                                    <div
                                        class="flex flex-col md:flex-row justify-center xl:justify-start space-x-4 mb-5">
                                        <div
                                            class="px-8 h-20 mx-auto md:mx-0 bg-gray-200 rounded-lg flex items-center justify-center mb-5 md:mb-0">
                                            <i data-feather="users" class="text-red-500"></i>
                                        </div>
                                        <div class="text-center md:text-left">
                                            <h4 class="font-semibold text-ctmblue text-xl md:text-2xl mb-2">Respeto
                                            </h4>
                                            <p
                                                class="font-normal text-gray-400 text-base md:text-xl xl:text-1xl leading-relaxed">
                                                Respetar a nuestros clientes, colaboradores y proveedores.</p>
                                        </div>
                                    </div>

                                    <div
                                        class="flex flex-col md:flex-row justify-center xl:justify-start space-x-4 mb-5">
                                        <div
                                            class="px-8 h-20 mx-auto md:mx-0 bg-gray-200 rounded-lg flex items-center justify-center mb-5 md:mb-0">
                                            <i data-feather="check-circle" class="text-red-500"></i>
                                        </div>

                                        <div class="text-center md:text-left">
                                            <h4 class="font-semibold text-ctmblue text-xl md:text-2xl mb-2 ">Eficacia
                                            </h4>
                                            <p
                                                class="font-normal text-gray-400 text-base md:text-xl xl:text-1xl leading-relaxed">
                                                Ser eficaces en la comercialización de proyectos de lotificaciones y
                                                construcción de
                                                viviendas.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div
                                        class="flex flex-col md:flex-row justify-center xl:justify-start space-x-4 mb-5">
                                        <div
                                            class="px-8 h-20 mx-auto md:mx-0 bg-gray-200 rounded-lg flex items-center justify-center mb-5 md:mb-0">
                                            <i data-feather="flag" class="text-red-500"></i>
                                        </div>
                                        <div class="text-center md:text-left">
                                            <h4 class="font-semibold text-ctmblue  text-xl md:text-2xl mb-2">Compromiso
                                            </h4>
                                            <p
                                                class="font-normal text-gray-400 text-base md:text-xl xl:text-1xl leading-relaxed">
                                                Ser comprometidos con nuestros clientes, colaboradores y proveedores.
                                            </p>
                                        </div>
                                    </div>

                                    <div
                                        class="flex flex-col md:flex-row justify-center xl:justify-start space-x-4 mb-5">
                                        <div
                                            class="px-8 h-20 mx-auto md:mx-0 bg-gray-200 rounded-lg flex items-center justify-center mb-5 md:mb-0">
                                            <i data-feather="share-2" class="text-red-500"></i>
                                        </div>
                                        <div class="text-center md:text-left">
                                            <h4 class="font-semibold text-ctmblue text-xl md:text-2xl mb-2">Solidaridad
                                            </h4>
                                            <p
                                                class="font-normal text-gray-400 text-base md:text-xl xl:text-1xl leading-relaxed">
                                                Ser solidarios con nuestros clientes, colaboradores y proveedores.</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div> <!-- container.// -->
                    </div>

                </div>
            </section>
            <div class="transition-section bg-cover bg-center h-screen flex items-center justify-center"
                style="background-image: url('https://homes-real-estate.easybroker.com/themes/merida/built_in_images/img-merida.png');">
                <div class="bg-ctmblue bg-opacity-50 p-8 rounded-lg text-gray-100">
                    <div class="flex justify-around items-center space-x-40">
                        <!--Mensaje de motivacion al visitante para que adquiera una propiedad con nosotros-->
                        <div class="text-center">
                            <div class="text-3xl md:text-5xl xl:text-6xl font-bold font-dancing">Desarrolladora JC & DGD
                                Urbano
                            </div>
                            <div class="text-lg mt-2">Adquiere tu propiedad con nosotros</div>
                            <div class="text-lg mt-2">y asegura tu futuro</div>
                        </div>


                    </div>
                </div>
            </div>
            <!-- top de propiedades en venta-->

            <!--
            <section class="bg-gray-100 py-10 md:py-16 xl:relative" id="properties">

            <div class="container max-w-screen-xl mx-auto px-4">

                <div class="flex flex-col md:flex-row justify-center">

                    <div class="text-center md:text-left">
                        <h1 class="font-semibold text-gray-900 text-2xl md:text-4xl text-center leading-normal mb-6">
                            Propiedades en venta</h1>
                    </div>

                </div>

                <p class="font-normal text-gray-400 text-md md:text-xl text-center mb-16">
                    Encuentra tu hogar ideal en una de nuestras propiedades en venta
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">

                    <div
                        class="mx-3 mt-6 flex flex-col rounded-lg bg-gray-100 text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-gray-500 sm:shrink-0 sm:grow sm:basis-0">
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
                    </div>

                    <div
                        class="mx-3 mt-6 flex flex-col rounded-lg bg-gray-100 text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-gray-500 sm:shrink-0 sm:grow sm:basis-0">
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
                    </div>

                </div>
            </div>

            <div class="container max-w-screen-xl mx-auto px-4">
                <div class="flex flex-col md:flex-row justify-center">
                    <div class="text-center md:text-left">
                        <a href="#"
                            class="px-6 py-4 bg-green-700 text-white font-semibold text-lg rounded-xl hover:bg-green-900 transition ease-in-out duration-500">Ver
                            todas las propiedades</a>
                    </div>

                    <div class="text-center md:text-left mx-2">
                        <a href="#"
                            class="px-2 py-4 bg-green-700 text-white font-semibold text-lg rounded-xl hover:bg-green-900 transition ease-in-out duration-500">
                            Agregar
                        </a>
                    </div>
                </div>
            </div>

        </section>-->

            <!-- top de proyectos-- diseñar card estatica para mostrar los proyectos mas recientes -->
            <!--
        <section class="bg-gray-100 py-10 md:py-16 xl:relative min-h-screen" id="services">

            <div class="container max-w-screen-xl mx-auto px-4">
                <div class="flex flex-col md:flex-row justify-center">
                    <div class="text-center md:text-left">
                        <h1 class="font-semibold text-gray-900 text-2xl md:text-4xl text-center leading-normal mb-6">
                            Proyectos</h1>
                    </div>

                </div>

                <p class="font-normal text-gray-400 text-md md:text-xl text-center mb-16">
                    Construye tu futuro en uno de nuestros proyectos, conoce los proyectos más recientes
                </p>
            </div>

            <div
                class="container max-w-screen-xl mx-auto px-4 grid-cols-1 sm:grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">

                <div
                    class="mx-3 mt-6 flex flex-col rounded-lg bg-gray-100 text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-gray-500 sm:shrink-0 sm:grow sm:basis-0">
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
                </div>

                <div
                    class="mx-3 mt-6 flex flex-col rounded-lg bg-gray-100 text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-gray-500 sm:shrink-0 sm:grow sm:basis-0">
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
                </div>

                <div
                    class="mx-3 mt-6 flex flex-col rounded-lg bg-gray-100 text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-gray-500 sm:shrink-0 sm:grow sm:basis-0">
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
                </div>

                <div
                    class="mx-3 mt-6 flex flex-col rounded-lg bg-gray-100 text-surface shadow-secondary-1 dark:bg-surface-dark dark:text-gray-500 sm:shrink-0 sm:grow sm:basis-0">
                    <a href="#!">
                        <img class="rounded-t-lg" src="https://tecdn.b-cdn.net/img/new/standard/city/043.webp"
                            alt="Los Angeles Skyscrapers" />
                    </a>
                    <div class="p-6">
                        <h5 class="mb-2 text-xl font-medium leading-tight">Card title</h5>
                        <p class="mb-4 text-base">
                            This is a longer card with supporting text below as a natural
                            lead-in to additional content. This content is a little bit
                            longer.
                        </p>
                    </div>
                </div>
            </div>

            <div class="container max-w-screen-xl mx-auto px-4">
                <div class="flex flex-col md:flex-row justify-center">
                    <div class="text-center md:text-left">
                        <a href="#"
                            class="px-6 py-4 bg-green-700 text-white font-semibold text-lg rounded-xl hover:bg-green-900 transition ease-in-out duration-500">Ver
                            todos los proyectos</a>
                    </div>

                    <div class="text-center md:text-left mx-2">
                        <a href="#"
                            class="px-2 py-4 bg-green-700 text-white font-semibold text-lg rounded-xl hover:bg-green-900 transition ease-in-out duration-500">
                            Agregar
                        </a>
                    </div>
                </div>

            </div>
        </section>-->


            <!-- gallery section -->
            <!--
        <section id="gallery" class="bg-white py-10 md:py-16">

            <div class="container max-w-screen-xl mx-auto px-4">

                <h1 class="font-semibold text-gray-900 text-4xl text-center mb-10">Galeria</h1>

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

            </div>

        </section>-->
            <!-- gallery section //end -->

            <!-- testimoni section -->
            <!--
        <section class="bg-white py-10 md:py-16" id="testimonials">

            <div class="container max-w-screen-xl mx-auto px-4 xl:relative">

                <p class="font-normal text-gray-400 text-lg md:text-xl text-center uppercase mb-6">
                    Testimonios</p>

                <h1 class="font-semibold text-gray-900 text-2xl md:text-4xl text-center leading-normal mb-14">
                    Lo que
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


                        <p class="font-normal text-sm lg:text-md text-gray-400 mx-8 my-8">Recomiendo a
                            cualquiera que
                            compre
                            una casa en D’house. Recibí un excelente servicio al cliente de los
                            especialistas que me
                            ayudaron.</p>

                        <h3 class="font-semibold text-gray-900 text-xl md:text-2xl lg:text-3xl mx-8 mb-8">
                            Brooklyn
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
                        <p class="font-normal text-sm lg:text-md text-gray-400 mx-8 my-8">D’house es el
                            mejor agente
                            de
                            propiedades del mundo. Recibí un excelente servicio al cliente del agente de
                            D’house</p>

                        <h3 class="font-semibold text-gray-900 text-xl md:text-2xl lg:text-3xl mx-8 mb-8">
                            Ralph Edwards
                        </h3>
                    </div>

                </div>

            </div>
        </section>-->
            <!-- testimoni section //end -->


            <!-- book section //end -->


        </div>
    </AppLayout>
</template>
