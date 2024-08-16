<!-- form to add new services -->
<template>
    <div class="bg-gray-100 p-4 rounded-lg w-full flex flex-col">
        <div class="flex items-center justify-center  rounded-lg  mb-4">
            <h1 class="text-2xl text-ctmblue font-bold">
                <span v-if="service">Editar</span>
                <span v-else>Agregar</span> Servicio
            </h1>
        </div>
        <div class="flex flex-col">
            <div class="mb-4">
                <label for="name" class="text-gray-500 text-base font-semibold">¿Qué Servicio es?</label>
                <input type="text" class="w-full p-2 border border-gray-300 rounded" v-model="form.name">
                <span class="text-red-500 text-sm" v-if="form.errors.name">{{ form.errors.name[0] }}</span>
            </div>
            <div class="mb-4">
                <label for="description" class="text-gray-500 text-base font-semibold">Descripción</label>
                <QuillEditor v-model="form.description" />
                <span class="text-red-500 text-sm" v-if="form.errors.description">{{ form.errors.description[0]
                    }}</span>
            </div>
            <div class="flex flex-wrap">
                <div v-for="(image, index) in service?.images" :key="index"
                    class="p-3 w-full md:w-1/2 lg:w-1/3 xl:w-1/3">
                    <img :src="getPath(image.path)" :alt="image.alt" class="object-cover rounded-lg h-72 w-full">

                    <button class=" absolute top-2 right-2 bg-red-500 text-white p-1 rounded opacity-0
                                            group-hover:opacity-100 transition-opacity duration-300">
                        &times;
                    </button>
                </div>
            </div>

            <div class="bg-gray-200 w-100 p-8 mb-8 rounded-xl scroll-animation">
                <label for="content" class="block font-medium text-ctmblue mb-10">
                    Sube imágenes del Servicio
                </label>

                <ImageUploader ref="imageLoader" :projectId="service?.project_id || 0" :onUpload="() => { }" />

            </div>

            <div class="flex justify-center mb-6">
                <button @click="submit"
                    class="bg-ctmblue text-gray-200 font-bold px-8 py-4 rounded-md mt-4 text-base">Guardar
                </button>
            </div>
        </div>

    </div>
</template>

<script setup>
import QuillEditor from '@/Components/QuillEditor.vue';
import ImageUploader from '@/Components/ImageUploader.vue';
import { useForm } from '@inertiajs/vue3';
import { route } from '../../../../vendor/tightenco/ziggy/src/js';
import axios from 'axios';
import Swal from 'sweetalert2';

const emit = defineEmits(['formError']);

</script>

<script>
export default {

    props: {
        service: Object
    },
    components: {
        QuillEditor,
        ImageUploader
    },
    data() {
        return {
            form: useForm({
                name: this.service?.name || '',
                description: this.service?.description || '',
                images: [],
            }),
        }
    },
    methods: {
        openModal() {
            console.log('open modal');
        },
        async submit() {
            try {
                if (this.service) {

                    const response = await axios.put(route('services.update', this.service.service_id), this.form.data());
                    const imageForm = new FormData();
                    this.$refs.imageLoader.files
                        .forEach((image) => {
                            imageForm.append('images[]', image);
                        });
                    const imageResponse = await axios.post(route('services.images.store', this.service.service_id), imageForm, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });

                    console.log({
                        response,
                        imageResponse
                    });

                    if (response.data.service_id && imageResponse.data.service_id) {
                        this.$emit('close');
                        await Swal.fire({
                            icon: 'success',
                            title: 'Guardado',
                            text: 'El servicio y las imágenes han sido guardadas con éxito',
                            customClass: {
                                popup: 'z-[99999] absolute'
                            },
                        });

                        this.$inertia.reload();

                    } else {
                        this.$emit('close');
                        await Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Ha ocurrido un error, por favor intente de nuevo',
                            customClass: {
                                popup: 'z-[99999] absolute'
                            },
                        });
                    }


                } else {


                    const response = await axios.post(route('services.store'), this.form.data());

                    const imageForm = new FormData();

                    this.$refs.imageLoader.files
                        .forEach((image) => {
                            imageForm.append('images[]', image);
                        });

                    const imageResponse = await axios.post(route('services.images.store', response.data.service_id), imageForm, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });
                    console.log({
                        response,
                        imageResponse
                    });
                    if (response.data.service_id && imageResponse.data.service_id) {
                        console.log('emit close');
                        this.$emit('close');
                        await Swal.fire({
                            icon: 'success',
                            title: 'Guardado',
                            text: 'El servicio ha sido guardada y las imágenes han sido guardadas',
                            customClass: {
                                popup: 'z-[99999] absolute'
                            },
                        });

                        this.$inertia.reload();

                    } else {
                        console.log({
                            response,
                            imageResponse
                        });
                    }
                    this.$emit('close');
                    await Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ha ocurrido un error, por favor intente de nuevo',
                        customClass: {
                            popup: 'z-[99999] absolute'
                        },
                    });
                }

            } catch (error) {
                console.log(error);
                if (error.response && error.response.data.errors) {
                    this.form.errors = error.response.data.errors;
                } else if (error.response && error.response.data.message) {
                    this.$emit('formError', error.response.data.message);
                    this.$emit('close');
                    await Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.response.data.message,
                        customClass: {
                            popup: 'z-[99999] absolute'
                        },
                    });
                } else if (error.response && error.response.data) {
                    this.$emit('formError', error.response.data);
                    this.$emit('close');
                    await Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.response.data,
                        customClass: {
                            popup: 'z-[99999] absolute'
                        },

                    });
                } else {
                    this.$emit('formError', 'Ha ocurrido un error, por favor intente de nuevo');
                    this.$emit('close');
                    await Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ha ocurrido un error, por favor intente de nuevo',
                        customClass: {
                            popup: 'z-[99999] absolute'
                        },

                    });
                }

            }
        },

        async submitForm() {
            const result = await Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Deseas guardar el Diseño?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Si, Guardar',
                cancelButtonText: 'Cancelar',
                customClass: {
                    confirmButton: 'bg-ctmblue text-white px-8 py-4 rounded-md mt-4 text-base',
                    cancelButton: 'bg-gray-200 text-gray-500 px-8 py-4 rounded-md mt-4 text-base',
                    popup: 'bg-white p-4 rounded-lg z-[1000]',
                },
            });

            if (result.isConfirmed) {
                try {
                    Swal.fire({
                        title: 'Guardando Diseño',
                        text: 'Por favor espere un momento',
                        icon: 'info',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    console.log(this.service);
                    if (this.service?.service_id) {
                        // Luego, envía la solicitud de actualización del Diseño
                        const response = await axios.put(route('services.update', this.service.service_id), this.form.data());
                        const formData = new FormData();
                        console.log(this.$refs.imageLoader);
                        this.$refs.imageLoader.files
                            .forEach((image) => {
                                formData.append('images[]', image);
                            });
                        const imageResponse = await axios.post(route('services.images.store', this.service.service_id), formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        });

                        console.log({
                            response,
                            imageResponse
                        });

                        if (response.data.service_id && imageResponse.data.service_id) {
                            Swal.fire({
                                title: 'Diseño Guardado',
                                text: 'El Diseño se ha guardado correctamente',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            });
                            this.$refs.imageLoader.files = [];
                            this.$refs.imageLoader.previewImages = [];
                            this.$inertia.reload();
                        } else if (response.data.service_id && !imageResponse.data.service_id) {
                            Swal.fire({
                                title: 'Los datos se guardaron, pero parece que hubo un error con las imágenes',
                                text: 'Por favor intente de nuevo',
                                icon: 'warning',
                                confirmButtonText: 'Ok',

                            });

                            this.$inertia.reload();

                        } else if (!response.data.service_id && imageResponse.data.service_id) {
                            Swal.fire({
                                title: 'Ocurrió un error',
                                text: 'Por favor intente de nuevo',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        } else {
                            Swal.fire({
                                title: 'Ocurrió un error',
                                text: 'Por favor intente de nuevo',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        }

                    } else {
                        // Si es un nuevo Diseño, envía la solicitud de creación
                        const response = await axios.post(route('services.store'), this.form.data());
                        console.log(response);
                        const formData = new FormData();

                        this.$refs.imageLoader.files
                            .forEach((image) => {
                                formData.append('images[]', image);
                            });

                        const imageResponse = await axios.post(route('services.images.store', response.data.service_id), formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        });

                        console.log({
                            response,
                            imageResponse
                        });

                        if (response.data.service_id && imageResponse.data.service_id) {
                            Swal.fire({
                                title: 'Diseño Guardado',
                                text: 'El Diseño se ha guardado correctamente',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            });
                            this.$refs.imageLoader.files = [];
                            this.$refs.imageLoader.previewImages = [];
                            this.$inertia.visit(route('services.edit', response.data.service_id));
                        } else if (response.data.service_id && !imageResponse.data.service_id) {
                            Swal.fire({
                                title: 'Los datos se guardaron, pero parece que hubo un error con las imágenes',
                                text: 'Por favor intente de nuevo',
                                icon: 'warning',
                                confirmButtonText: 'Ok',

                            });

                            this.$inertia.visit(route('services.edit', response.data.service_id));

                        } else if (!response.data.service_id && imageResponse.data.service_id) {
                            Swal.fire({
                                title: 'Ocurrió un error',
                                text: 'Por favor intente de nuevo',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        } else {
                            Swal.fire({
                                title: 'Ocurrió un error',
                                text: 'Por favor intente de nuevo',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        }


                    }




                } catch (error) {
                    console.error(error);
                    if (error.response) {
                        console.log('Error de respuesta:', error.response);
                        // Errores de la respuesta del servidor (código de estado no 2xx)
                        if (error.response && error.response.data.errors) {
                            Swal.fire({
                                title: 'Ocurrió un error',
                                text: 'Por favor intente de nuevo',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        } else {
                            Swal.fire({
                                title: 'Ocurrió un error',
                                text: 'Por favor intente de nuevo',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        }
                    } else if (error.request) {
                        // La solicitud fue hecha pero no hubo respuesta
                        console.log('Error:', error.request);
                        Swal.fire({
                            title: 'Ocurrió un error',
                            text: 'Por favor intente de nuevo',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    } else {
                        // Algo pasó al configurar la solicitud que activó un error
                        console.log('Error:', error.message);
                        Swal.fire({
                            title: 'Ocurrió un error',
                            text: 'Por favor intente de nuevo',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                }
            }
        }
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

<style scoped>
.animate-scaleIn {
    animation: scaleIn 0.3s ease;
}

@keyframes scaleIn {
    0% {
        transform: scale(0.9);
    }

    100% {
        transform: scale(1);
    }
}
</style>
