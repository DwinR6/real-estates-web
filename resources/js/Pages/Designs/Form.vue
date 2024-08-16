<!-- resources/js/Pages/CreatePost.vue -->


<script setup>
import { ref } from 'vue'
import { useForm, Link } from '@inertiajs/vue3'
import QuillEditor from '../../Components/QuillEditor.vue';
import ImageUploader from '../../Components/ImageUploader.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { route } from '../../../../vendor/tightenco/ziggy/src/js';
import Swal from 'sweetalert2';




</script>
<script>
export default {
    props: {
        error: Object,
        design: Object
    },
    components: {
        QuillEditor,
        ImageUploader,
        AppLayout,
    },

    data() {
        return {
            editorContent: '<p>Contenido inicial</p>',
            form: useForm({
                design_id: this.design?.design_id || null,
                name: this.design?.name || '',
                description: this.design?.description || '',
            }),
            uploadedImages: [],
        };
    },
    methods: {
        async handleUpload() {
            try {
                await this.$refs.imageLoader.uploadImages();
            } catch (error) {
                console.error(error);
            }


        },
        async submit() {

            try {
                if (this.design?.design_id) {

                    // Luego, envía la solicitud de actualización del Diseño
                    const response = await axios.put(route('designs.update', this.design.design_id), this.form.data());
                    const formData = new FormData();
                    this.$refs.imageLoader.files
                        .forEach((image) => {
                            formData.append('images[]', image);
                        });
                    const imageResponse = await axios.post(route('designs.images.store', this.design.design_id), formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });

                    console.log({
                        response,
                        imageResponse
                    });

                    if (response.data.design_id && imageResponse.data.design_id) {
                        //lanzar una notificación
                        this.succesNotification();
                        //reload the page

                        this.$inertia.reload();
                    } else {
                        await Swal.fire({
                            title: 'Ocurrió un error',
                            text: 'Por favor intente de nuevo',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                } else {
                    // Si es un nuevo Diseño, envía la solicitud de creación
                    const response = await axios.post(route('designs.store'), this.form.data());
                    console.log(response);
                    const formData = new FormData();

                    this.$refs.imageLoader.files
                        .forEach((image) => {
                            formData.append('images[]', image);
                        });

                    const imageResponse = await axios.post(route('designs.images.store', response.data.design_id), formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });


                    console.log({
                        response,
                        imageResponse
                    });

                    if (response.data.design_id && imageResponse.data.design_id) {
                        //lanzar una notificación
                        this.succesNotification();
                        //reload the page
                        this.$inertia.reload();
                    } else {
                        await Swal.fire({
                            title: 'Ocurrió un error',
                            text: 'Por favor intente de nuevo',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }

                    // Si la solicitud es exitosa, puedes manejar la respuesta aquí
                    this.$inertia.visit(route('designs.edit', response.data.design_id));
                }
            } catch (error) {


                // Captura los errores y maneja cualquier error de validación u otros errores
                if (error.response) {
                    console.log('Error de respuesta:', error.response);
                    // Errores de la respuesta del servidor (código de estado no 2xx)
                    if (error.response && error.response.data.errors) {

                        this.form.errors = error.response.data.errors;


                        //toast error
                        await Swal.fire({
                            text: 'Datos incorrectos, por favor revise los campos',
                            icon: 'error',
                            toast: true,
                            position: 'top-end',
                            timer: 3000,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            background: '#142040',
                            color: '#fff'

                        });

                        // Muestra los errores en el formulario
                    }
                } else if (error.request) {
                    // La solicitud fue hecha pero no hubo respuesta
                    console.log('Error:', error.request);
                    await Swal.fire({
                        title: 'Ocurrió un error',
                        text: 'Por favor intente de nuevo',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                } else {
                    // Algo pasó al configurar la solicitud que activó un error
                    console.log('Error:', error.message);
                    await Swal.fire({
                        title: 'Ocurrió un error',
                        text: 'Por favor intente de nuevo',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    });
                }


            }
        },

        //Swal process t submit the form //if works then submit before method will be removed
        async submitForm() {
            const result = await Swal.fire({
                title: '¿Estás seguro?',
                text: '¿Deseas guardar el Diseño?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Si, Guardar',
                cancelButtonText: 'Cancelar'
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

                    if (this.design?.design_id) {
                        // Luego, envía la solicitud de actualización del Diseño
                        const response = await axios.put(route('designs.update', this.design.design_id), this.form.data());
                        const formData = new FormData();
                        this.$refs.imageLoader.files
                            .forEach((image) => {
                                formData.append('images[]', image);
                            });
                        const imageResponse = this.$refs.imageLoader.files.length > 0 ? await axios.post(route('designs.images.store', this.design.design_id), formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }) : {
                            data: {
                                design_id: this.design.design_id
                            }
                        };

                        console.log({
                            response,
                            imageResponse
                        });

                        if (response.data.design_id && imageResponse.data.design_id) {
                            Swal.fire({
                                title: 'Diseño Guardado',
                                text: 'El Diseño se ha guardado correctamente',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            });
                            this.$refs.imageLoader.files = [];
                            this.$refs.imageLoader.previewImages = [];
                            this.$inertia.reload();
                        } else if (response.data.design_id && !imageResponse.data.design_id) {
                            Swal.fire({
                                title: 'Los datos se guardaron, pero parece que hubo un error con las imágenes',
                                text: 'Por favor intente de nuevo',
                                icon: 'warning',
                                confirmButtonText: 'Ok',

                            });

                            this.$inertia.reload();

                        } else if (!response.data.design_id && imageResponse.data.design_id) {
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
                        const response = await axios.post(route('designs.store'), this.form.data());
                        console.log(response);
                        const formData = new FormData();

                        this.$refs.imageLoader.files
                            .forEach((image) => {
                                formData.append('images[]', image);
                            });

                        const imageResponse = this.$refs.imageLoader.files.length > 0 ? await axios.post(route('designs.images.store', response.data.design_id), formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        }) : {
                            data: {
                                design_id: response.data.design_id
                            }
                        };
                        console.log({
                            response,
                            imageResponse
                        });

                        if (response.data.design_id && imageResponse.data.design_id) {
                            Swal.fire({
                                title: 'Diseño Guardado',
                                text: 'El Diseño se ha guardado correctamente',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            });
                            this.$refs.imageLoader.files = [];
                            this.$refs.imageLoader.previewImages = [];
                            this.$inertia.visit(route('designs.edit', response.data.design_id));
                        } else if (response.data.design_id && !imageResponse.data.design_id) {
                            Swal.fire({
                                title: 'Los datos se guardaron, pero parece que hubo un error con las imágenes',
                                text: 'Por favor intente de nuevo',
                                icon: 'warning',
                                confirmButtonText: 'Ok',

                            });

                            this.$inertia.visit(route('designs.edit', response.data.design_id));

                        } else if (!response.data.design_id && imageResponse.data.design_id) {
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
        },
        onUpload(savedImages) {
            const images = savedImages.map(image => {
                return {
                    name: image.name,
                    path: image.path
                }
            });


            //map images to set object

            //set images to form
            this.uploadedImages = images.map(image => {
                return {
                    name: image.name,
                    path: image.path
                }
            });

            this.form.images = this.uploadedImages;
            //current route reload
            this.$inertia.reload();

        },
        async succesNotification() {
            await Swal.fire({
                title: 'Diseño Guardado',
                text: 'El Diseño se ha guardado correctamente',
                icon: 'success',
                confirmButtonText: 'Ok'
            });
        }
    },
    computed: {
        errors() {
            console.log(this);
            return this.$page.props.error || {};
        },
        getPath() {
            return (path) => {
                return path ? `/storage/${path}` : '';
            }
        },
        getBackUrl() {
            return () => {
                const url = this.$inertia.page.props.design?.design_id ? route('designs.edit', this.$inertia.page.props.design.design_id) : route('designs');

                console.log(url);
                return url;
            }

        }

    }
}
</script>
<template>
    <AppLayout title="Diseño">
        <div class="bg-gray-100 w-full h-full">

            <section class="bg-ctmblue py-10 md:py-16 xl:relative">
                <div class="container max-w-screen-xl mx-auto px-4">
                    <div class="flex flex-wrap justify-start items-center gap-4">
                        <!--back feather button icon-->
                        <Link v-if="design?.design_id" :href="route('designs.show', design.design_id)"
                            class="text-gray-200">
                        <i data-feather="arrow-left" class="h-6 w-6"></i>
                        </Link>
                        <Link v-else :href="route('designs')" class="text-gray-200">
                        <i data-feather="arrow-left" class="h-6 w-6"></i>
                        </Link>


                        <h1
                            class="text-3xl md:text-4xl xl:text-6xl font-bold text-center font-dancing text-gray-200 scroll-animation">
                            <span v-if="design?.design_id">Editar Diseño</span>
                            <span v-else>Crear Diseño</span>
                        </h1>
                    </div>
                </div>
                <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                    <div class="shadow-sm sm:rounded-lg">
                        <div class="border-b border-gray-20 ">
                            <form @submit.prevent="submit">
                                <div class="bg-gray-200 w-100 p-8 mb-8 rounded-2xl scroll-animation">
                                    <!--inputs -- name, location, status, category-->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <!--name-->
                                        <div>
                                            <label for="name" class="block font-medium text-ctmblue">
                                                ¿Como se llama el Diseño?</label>
                                            <input type="text" name="name" id="name" v-model="form.name"
                                                autocomplete="name"
                                                class="mt-1 focus:ring-ctmblue focus:border-cmtblue block w-full shadow-sm  border-gray-300 rounded-md text-ctmblue">
                                            <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">
                                                {{ form.errors.name[0] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!--Description Quill Editor-->
                                <div class="bg-gray-200 w-100 p-8  mb-8 rounded-2xl  scroll-animation">
                                    <label for="content" class="block font-medium text-ctmblue">
                                        Agrega una descripción al Diseño
                                    </label>
                                    <QuillEditor v-model="form.description" />
                                    <div v-if="form.errors.description" class="text-red-500 text-sm mt-1">
                                        {{ form.errors.description[0] }}
                                    </div>

                                </div>

                            </form>

                            <!--design gallery-->
                            <div v-if="design?.design_id"
                                class="bg-gray-200 w-100 p-8 mb-8 rounded-xl scroll-animation">
                                <label for="content" class="block font-medium text-ctmblue mb-10">
                                    Imagenes del Diseño
                                </label>

                                <div class="flex flex-wrap">
                                    <div v-for="(image, index) in design.images" :key="index"
                                        class="p-3 w-full md:w-1/2 lg:w-1/3 xl:w-1/3">
                                        <img :src="getPath(image.path)" :alt="image.alt"
                                            class="object-cover rounded-lg h-72 w-full">

                                        <button class=" absolute top-2 right-2 bg-red-500 text-white p-1 rounded opacity-0
                                            group-hover:opacity-100 transition-opacity duration-300">
                                            &times;
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <!--it will mobed to the edit design page-->

                            <!--image files upload-->

                            <div class="bg-gray-200 w-100 p-8 mb-8 rounded-xl scroll-animation">
                                <label for="content" class="block font-medium text-ctmblue mb-10">
                                    Sube imágenes del Diseño
                                </label>

                                <ImageUploader ref="imageLoader" :projectId="design?.design_id || 0"
                                    :onUpload="onUpload" />
                                <!--button to save images test-->
                                <!--<button @click="handleUpload"
                                    class="bg-gray-200 text-ctmblue text-semibold px-4 py-2 rounded-md mt-4">Guardar
                                    Imágenes</button>-->
                            </div>

                            <!--submit button-->
                            <div class="flex justify-center mb-6">
                                <button @click="submitForm"
                                    class="bg-gray-200 text-ctmblue font-bold px-8 py-4 rounded-md mt-4 text-2xl">Guardar
                                    Diseño</button>
                            </div>

                        </div>

                    </div>
                </div>


            </section>


        </div>



    </AppLayout>
</template>
