<template>
    <div>
        <AppLayout title="Maquinaria">
            <section class="bg-ctmblue py-10 md:py-16 xl:relative" id="maquinaria">
                <div class="container max-w-screen-xl mx-auto px-4 min-h-full">
                    <div class="flex flex-row items-center mb-8  ">
                        <h1
                            class="font-semibold text-gray-00 text-2xl md:text-4xl lg:text-6xl text-left leading-normal mb-6 font-dancing text-gray-300 mr-4">
                            Servicio de Alquiler de Maquinaria</h1>
                        <!-- add new project button --> <!-- Show modal button -->
                        <button v-if="$page.props.auth.user" @click="openModal" class="text-white p-2 rounded">
                            <i data-feather="plus" class="h-6 w-6 text-2xl text-gray-200"></i>
                        </button>


                    </div>
                    <div v-for="(machinary, index) in machinaries" :key="index"
                        class="w-full md:w-1/2 lg:w-1/3 px-2 mb-4 flex hover:animate-scaleIn cursor-pointer scroll-animation">

                        <div class="bg-gray-100 p-4 rounded-lg  w-full flex flex-col">
                            <div class="bg-gray-100  rounded-lg w-full flex flex-col"
                                @click="selectMachinary(machinary)">
                                <div class="flex items-center justify-center bg-gray-200 rounded-lg  mb-4">
                                    <img v-if="machinary?.images?.length > 0" :src="getPath(machinary?.images[0]?.path)"
                                        :alt="machinary.images[0]?.name" class=" object-cover rounded-lg w-full h-75" />
                                </div>

                                <div class="flex flex-col justify-between h-full">
                                    <div class="flex flex-col">
                                        <h2 class="text-ctmblue text-xl font-semibold mb-2">{{ machinary.name }}</h2>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
            <!-- Modal Component -->
            <Modal :show="showModal" @close="closeModal">
                <Form v-if="$page.props.auth.user" @formError="handleFormError" @close="closeModal"
                    :machinary="machinarySelected" />
                <div v-else>
                    <div class="py-10 md-py-16 xl:relative">
                        <div class=" container max-w-screen-xl mx-auto px-4">
                            <div class="flex flex-row items-center mb-8  ">
                                <h1
                                    class="font-semibold text-blue-900 text-xl md:text-2xl lg:text-3xl text-left leading-normal mb-6 font-dancing text-ctmblue mr-4">
                                    {{ machinarySelected?.name }}</h1>
                            </div>

                            <div v-if="machinarySelected?.images?.length > 0" class="mt-16 h-96">
                                <ImageSlider :images="machinarySelected?.images" />
                            </div>
                            <div class="flex flex-col justify-between h-full">
                                <div class="flex flex-col">
                                    <h2 class="text-ctmblue text-xl font-semibold mb-2">{{ machinarySelected?.name }}
                                    </h2>
                                    <div class="text-gray-500 text-base font-semibold"
                                        v-html="machinarySelected?.description"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </Modal>



        </AppLayout>
    </div>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';
import Form from './Machinaries/Form.vue';
import ImageSlider from '@/Components/ImageSlider.vue';
import { ref } from 'vue';
import Swal from 'sweetalert2';


const showModal = ref(false);
let machinarySelected = ref(null);

const openModal = () => {
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    machinarySelected = null;
};

const selectMachinary = (machinary) => {
    console.log(machinary);
    machinarySelected = machinary;
    showModal.value = true;
};

const unsetMachinary = () => {
    this.machinarySelected = null;
};


const handleFormError = async (error) => {
    console.log(error);
    // Mostrar SweetAlert con el mensaje de error
    await Swal.fire({
        icon: 'error',
        title: 'Form Error',
        text: 'error.message,',
        customClass: {
            confirmButton: 'bg-ctmblue text-white px-8 py-4 rounded-md mt-4 text-base',
            popup: 'bg-white p-4 rounded-lg z-50'
        },
    });
};
</script>

<script>


export default {
    components: {
        AppLayout,
        Link,
        Modal
    },
    props: {
        machinaries: Array,

    },

    data() {
        return {
            showModal: false,
            machinarySelected: null,
        }
    },

    mounted() {
        feather.replace();
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
