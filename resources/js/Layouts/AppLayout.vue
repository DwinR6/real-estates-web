<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import HeaderIcon from '@/Components/HeaderIcon.vue';
defineProps({
    title: String,
});


const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};

</script>
<script>
export default {

    updated() {
        this.$nextTick(() => {
            this.initializeScrollEffects();
        });
    },
    data() {
        return {
            isMenuOpen: false,

        }
    },
    methods: {
        initializeScrollEffects() {
            const elements = document.querySelectorAll('.scroll-animation');

            const updateContentPosition = (element) => {
                const rect = element.getBoundingClientRect();
                const viewportHeight = window.innerHeight;

                if (rect.top < viewportHeight && rect.bottom > 0) {
                    const visibility = Math.min(Math.max(0.9, (viewportHeight - Math.abs(rect.top - viewportHeight / 2)) / viewportHeight), 1);

                    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                    const scrollDirection = scrollTop > this.lastScrollTop ? 'down' : 'up';
                    this.lastScrollTop = scrollTop;

                    const maxTranslateX = 5;
                    const translateX = scrollDirection === 'down'
                        ? -((1 - visibility - 0.3) * maxTranslateX)
                        : (1 - visibility - 0.3) * maxTranslateX;

                    element.style.opacity = visibility;
                    element.style.transform = `translateX(${translateX}%)`;
                } else {
                    element.style.opacity = 0.9;
                    element.style.transform = `translateX(${this.lastScrollTop > window.pageYOffset ? '-10%' : '10%'})`;
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
        this.initializeScrollEffects();
        //listen for scroll event si el scroll no esta a 40px de la parte superior añadir la clase bg-white y bg-opacity-20 si no quitarla
        window.addEventListener('scroll', function () {
            var header = document.querySelector('#navbar');

            header.classList.toggle('fixed', window.scrollY > 100);
            header.classList.toggle('bg-opacity-90', window.scrollY > 100);
            header.classList.toggle('shadow-2xl', window.scrollY > 100);
        });
        feather.replace();


    },

}
</script>
<style>
.scroll-animation {
    opacity: 0.5;
    transform: translateX(-10%);
    transition: opacity 0.8s ease, transform 0.8s ease;
}
</style>

<template>
    <div>

        <Head :title="title" />

        <Banner />

        <div class="min-h-screen bg-gray-100 bg-gradient-to-b  from-gray-10 to-blue-90 bg-ctmred">

            <nav id="navbar" class="bg-gray-200  left-0 right-0 z-10 flex-wrap lg:flex py-6 h-auto">

                <div class="max-w-10xl mx-auto px-4 sm:px-6 lg:px-8">
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
                                <NavLink class="text-blue-900 font-bold hover:text-red-800 text-base" href="/">Inicio
                                </NavLink>
                                <NavLink class="text-blue-900 font-bold hover:text-red-800 text-base" href="/advices">
                                    Asistencia
                                </NavLink>
                                <NavLink class="text-blue-900 font-bold hover:text-red-800 text-base" href="/projects">
                                    Proyectos
                                </NavLink>
                                <NavLink class="text-blue-900 font-bold hover:text-red-800 text-base"
                                    href="/maquinaria">
                                    Maquinaria
                                </NavLink>
                                <NavLink class="text-blue-900 font-bold hover:text-red-800 text-base" href="#contact">
                                    Contacto
                                </NavLink>

                            </div>
                            <div class="sm:flex sm:items-center sm:ms-6">
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
                                            <!-- Account Management
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

                                            <div class="border-t border-gray-200" />-->

                                            <!-- Authentication -->
                                            <form @submit.prevent="logout">
                                                <DropdownLink as="button">
                                                    Cerar Sesión
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
                    <div class="bg-gray-200 pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('projects')" :active="route().current('projects')">
                            Proyectos
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('advices')" :active="route().current('advices')">
                            Servicios
                        </ResponsiveNavLink>



                    </div>
                </div>

            </nav>
            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
            <!-- book section -->
            <section class="bg-ctmblue py-10 md:py-16" id="contact">

                <div class="container max-w-screen-xl mx-auto px-4 xl:relative ">

                    <div
                        class="bg-gray-100 flex flex-col lg:flex-row items-center justify-evenly py-10  rounded-3xl  scroll-animation">


                        <div class="flex flex-col items-center justify-center w-full md:w-1/2">
                            <!--Angent profile-->
                            <div class="flex flex-col items-center justify-center w-full md:w-1/2">
                                <img src="/image/agent.jpg" alt="Image" class="w-60 h-60 rounded-full">

                                <div class="flex items-center justify-center mt-5 flex-col w-100">
                                    <h2 class="font-semibold text-ctmblue text-xl md:text-2xl lg:text-2xl  ">
                                        Lic. Juan Carlos Saravia</h2>
                                    <p class="font-semibold text-ctmblue text-base lg:text-xl">
                                        Director de Ventas
                                    </p>
                                </div>
                                <!--cel . +5...-->
                                <div class="flex items-center justify-center flex-col w-100 mb-3">
                                    <p class="font-semibold text-ctmblue text-base lg:text-xl">
                                        Cel. +503941-4021
                                    </p>
                                    <p class="font-semibold text-gray-900 text-base lg:text-xl">
                                        <a href="mailto:ventas@constructoras.com" class="text-blue-800">
                                            <i data-feather="mail"></i> ventas@constructoras.com
                                        </a>
                                    </p>
                                </div>

                            </div>

                            <div class="text-center lg:text-left mb-10 lg:mb-0 mt-4">

                                <p class="font-normal text-blue-800 text-xl md:text-3xl font-dancing">
                                    <span class="text-gray-400">
                                        Gracias por tu interés en nuestros servicios.

                                        <br> Si tienes preguntas, comentarios o necesitas más
                                        información,
                                        <br> por favor llena el formulario a continuación.
                                        <br>Nos pondremos en contacto contigo a la brevedad.</span>
                                </p>
                            </div>
                        </div>


                        <div class="bg-ctmred xl:relative px-6 py-3 rounded-3xl text-ctmblue">
                            <!-- <div class="py-3">
                            <h3 class="font-semibold text-gray-900 text-3xl">Book a meeting</h3>
                        </div> -->

                            <!--spanish version-->
                            <div class="py-3">
                                <h1
                                    class="font-semibold text-gray-200 text-xl md:text-2xl lg:text-3xl leading-normal mb-4">
                                    Contáctanos <br> para mas información
                                </h1>

                            </div>
                            <div class="py-3">
                                <input type="text" placeholder="Nombre Completo"
                                    class="px-4 py-4 w-96 bg-gray-100 placeholder-gray-400 rounded-xl outline-none border-red-500 text-ctmblue">
                            </div>

                            <div class="py-3">
                                <input type="text" placeholder="Correo Electrónico"
                                    class="px-4 py-4 w-96 bg-gray-100 placeholder-gray-400 rounded-xl outline-none border-red-500 text-ctmblue">
                            </div>

                            <div class="py-3 relative">
                                <!--Cuentanos en que estas interesado-->
                                <select
                                    class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded-xl leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option>Selecciona un servicio</option>
                                    <option>Asesoría</option>
                                    <option>Proyectos</option>
                                    <option>Maquinaria</option>
                                    <option>Otro</option>
                                </select>
                            </div>

                            <div class="py-3">
                                <textarea placeholder="Mensaje"
                                    class="px-4 py-4 w-96 bg-gray-100 placeholder-gray-400 rounded-xl outline-none border-red-500 text-ctmblue"
                                    rows="5"></textarea>
                            </div>

                            <div class="py-3">
                                <!-- <button
                                class="w-full py-4 font-semibold text-lg text-white bg-green-700 rounded-xl hover:bg-green-900 transition ease-in-out duration-500">Booking</button> -->

                                <!--spanish version-->
                                <button
                                    class="w-full py-4 font-semibold text-lg text-gray-100 bg-ctmblue rounded-xl hover:bg-blue-800 transition ease-in-out duration-500">Enviar</button>
                            </div>
                        </div>

                    </div>

                </div> <!-- container.// -->

            </section>

            <!-- footer -->
            <footer class="bg-ctmblue py-10 md:py-16">

                <div class="container max-w-screen-xl mx-auto px-4">

                    <div class="flex flex-col lg:flex-row justify-between">
                        <div class="text-center lg:text-left mb-10 lg:mb-0">
                            <div class="flex justify-center lg:justify-start mb-5 w-60">
                                <img src="../../image/logo-jc.jpg" alt="Image">
                                <img src="../../image/logo-dgd.jpg" alt="Image">
                            </div>

                            <p class="font-light text-gray-400 text-xl mb-10">¿Tienes alguna pregunta o necesitas
                                asistencia?<br> ¡Estamos aquí para ayudarte!
                                <br>No dudes en ponerte en contacto con nosotros y
                                <br>déjanos saber cómo podemos asistirte.
                            </p>

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

                        <div class="text-center lg:text-left mb-10 lg:mb-0 w-1/1 md:w-1/2 xl:w-1/3">
                            <h4 class="font-semibold text-gray-900 text-2xl mb-6"></h4>

                            <a href="#home"
                                class="block font-light text-gray-400 text-xl mb-6 hover:text-gray-800 transition ease-in-out duration-300">Inicio</a>

                            <a href="/advices"
                                class="block font-light text-gray-400 text-xl mb-6 hover:text-gray-800 transition ease-in-out duration-300">Servicios</a>

                            <a href="/projects"
                                class="block font-light text-gray-400 text-xl mb-6 hover:text-gray-800 transition ease-in-out duration-300">Proyectos</a>


                            <a href="#book"
                                class="block font-light text-gray-400 text-xl mb-6 hover:text-gray-800 transition ease-in-out duration-300">Contacto</a>
                        </div>


                    </div>

                </div> <!-- container.// -->

            </footer>
        </div>
    </div>
</template>
