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
        project: Object
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
                project_id: this.project?.project_id || null,
                name: this.project?.name || '',
                location: this.project?.location || '',
                status: this.project?.status || '',
                category: this.project?.category_id || '',
                developer: this.project?.developer_id || {},
                coordinates: this.project?.coordinates || '',
                start_date: this.project?.start_date || '',
                end_date: this.project?.end_date || '',
                description: this.project?.description || '',
                lot_description: this.project?.lot_description || '',
                infrastructure_description: this.project?.infrastructure_description || '',
                area_description: this.project?.area_description || '',
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
                if (this.project?.project_id) {
                    // Primero, sube las imágenes
                    if (this.$refs.imageLoader.files.length > 0) {
                        await this.$refs.imageLoader.uploadImages();

                    } else {
                        console.log('No hay imágenes para subir');
                    }

                    // Luego, envía la solicitud de actualización del proyecto
                    const response = await axios.put(route('projects.update', this.project.project_id), this.form.data());

                    // Si la solicitud es exitosa, puedes manejar la respuesta aquí
                    console.log('Proyecto actualizado:', response.data);

                    //lanzar una notificación
                    this.succesNotification();
                    //reload the page

                    this.$inertia.reload();
                } else {
                    // Si es un nuevo proyecto, envía la solicitud de creación
                    const response = await axios.post(route('projects.store'), this.form.data());

                    //set the this.$refs.imageLoader.projectId
                    this.$refs.imageLoader.projectId = response.data.project_id;

                    //subir las imagenes
                    if (this.$refs.imageLoader.files.length > 0 && response.data.project_id) {
                        await this.$refs.imageLoader.uploadImages();
                    } else {
                        console.log('No hay imágenes para subir');
                    }



                    // Si la solicitud notifica se 44
                    await Swal.fire({
                        title: 'Proyecto Guardado',
                        text: 'El proyecto se ha guardado correctamente',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    });


                    // Si la solicitud es exitosa, puedes manejar la respuesta aquí
                    this.$inertia.visit(route('projects.edit', response.data.project_id));
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

                    if (this.project?.project_id) {
                        // Luego, envía la solicitud de actualización del Diseño
                        const response = await axios.put(route('projects.update', this.project.project_id), this.form.data());
                        const formData = new FormData();
                        this.$refs.imageLoader.files
                            .forEach((image) => {
                                formData.append('images[]', image);
                            });
                        const imageResponse = await axios.post(route('projects.images.store', this.project.project_id), formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        });

                        console.log({
                            response,
                            imageResponse
                        });

                        if (response.data.project_id && imageResponse.data.project_id) {
                            Swal.fire({
                                title: 'Diseño Guardado',
                                text: 'El Diseño se ha guardado correctamente',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            });
                            this.$refs.imageLoader.files = [];
                            this.$refs.imageLoader.previewImages = [];
                            this.$inertia.reload();
                        } else if (response.data.project_id && !imageResponse.data.project_id) {
                            Swal.fire({
                                title: 'Los datos se guardaron, pero parece que hubo un error con las imágenes',
                                text: 'Por favor intente de nuevo',
                                icon: 'warning',
                                confirmButtonText: 'Ok',

                            });

                            this.$inertia.reload();

                        } else if (!response.data.project_id && imageResponse.data.project_id) {
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
                        const response = await axios.post(route('projects.store'), this.form.data());
                        console.log(response);
                        const formData = new FormData();

                        this.$refs.imageLoader.files
                            .forEach((image) => {
                                formData.append('images[]', image);
                            });

                        const imageResponse = await axios.post(route('projects.images.store', response.data.project_id), formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        });

                        console.log({
                            response,
                            imageResponse
                        });

                        if (response.data.project_id && imageResponse.data.project_id) {
                            Swal.fire({
                                title: 'Diseño Guardado',
                                text: 'El Diseño se ha guardado correctamente',
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            });
                            this.$refs.imageLoader.files = [];
                            this.$refs.imageLoader.previewImages = [];
                            this.$inertia.visit(route('projects.edit', response.data.project_id));
                        } else if (response.data.project_id && !imageResponse.data.project_id) {
                            Swal.fire({
                                title: 'Los datos se guardaron, pero parece que hubo un error con las imágenes',
                                text: 'Por favor intente de nuevo',
                                icon: 'warning',
                                confirmButtonText: 'Ok',

                            });

                            this.$inertia.visit(route('projects.edit', response.data.project_id));

                        } else if (!response.data.project_id && imageResponse.data.project_id) {
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
                title: 'Proyecto Guardado',
                text: 'El proyecto se ha guardado correctamente',
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
                const url = this.$inertia.page.props.project?.project_id ? route('projects.edit', this.$inertia.page.props.project.project_id) : route('projects');

                console.log(url);
                return url;
            }

        }

    }
}
</script>
<template>
    <AppLayout title="Proyecto">
        <div class="bg-gray-100 w-full h-full">

            <section class="bg-ctmblue py-10 md:py-16 xl:relative">
                <div class="container max-w-screen-xl mx-auto px-4">
                    <div class="flex flex-wrap justify-start items-center gap-4">
                        <!--back feather button icon-->
                        <Link v-if="project?.project_id" :href="route('projects.show', project.project_id)"
                            class="text-gray-200">
                        <i data-feather="arrow-left" class="h-6 w-6"></i>
                        </Link>
                        <Link v-else :href="route('projects')" class="text-gray-200">
                        <i data-feather="arrow-left" class="h-6 w-6"></i>
                        </Link>


                        <h1
                            class="text-3xl md:text-4xl xl:text-6xl font-bold text-center font-dancing text-gray-200 scroll-animation">
                            <span v-if="project?.project_id">Editar Proyecto</span>
                            <span v-else>Crear Proyecto</span>
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
                                                ¿Como se llama el proyecto?</label>
                                            <input type="text" name="name" id="name" v-model="form.name"
                                                autocomplete="name"
                                                class="mt-1 focus:ring-ctmblue focus:border-cmtblue block w-full shadow-sm  border-gray-300 rounded-md text-ctmblue">
                                            <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">
                                                {{ form.errors.name[0] }}
                                            </div>
                                        </div>

                                        <!--location-->
                                        <div>
                                            <label for="location" class="block font-medium text-ctmblue">
                                                ¿Donde se encuentra?</label>
                                            <input type="text" name="location" id="location" v-model="form.location"
                                                autocomplete="location"
                                                class="mt-1 focus:ring-ctmblue focus:border-cmtblue block w-full shadow-sm border-gray-300 rounded-md text-ctmblue">
                                            <div v-if="form.errors.location" class="text-red-500 text-sm mt-1">
                                                {{ form.errors.location[0] }}
                                            </div>
                                        </div>

                                        <!--status-->
                                        <div>
                                            <label for="status" class="block font-medium text-ctmblue">
                                                ¿Cual es el estado del proyecto?</label>
                                            <select id="status" name="status" v-model="form.status"
                                                class="mt-1 block w-full pl-3 pr-10 py-2 border-gray-300 focus:outline-none focus:ring-cmtblue focus:border-cmtblue text-cmtblue rounded-md">
                                                <option value="1">En Proceso</option>
                                                <option value="2">Finalizado</option>
                                                <option value="3">Cancelado</option>
                                            </select>
                                            <div v-if="form.errors.status" class="text-red-500 text-sm mt-1">
                                                {{ form.errors.status[0] }}
                                            </div>

                                        </div>

                                        <!--category-->
                                        <div>
                                            <label for="category" class="block text-base font-medium text-ctmblue">
                                                ¿A que categoria pertenece?
                                            </label>
                                            <select id="category" name="category" v-model="form.category"
                                                class="mt-1 block w-full pl-3 pr-10 py-2 border-gray-300 focus:outline-none focus:ring-cmtblue focus:border-cmtblue text-cmtblue rounded-md">
                                                <option class="text-ctmblue" value="1">Lotificacion</option>
                                                <option class="text-ctmblue" value="2">Urabnizacion</option>
                                                <option class="text-ctmblue" value="3">Construccion</option>
                                                <option class="text-ctmblue" value="4">Remodelacion</option>
                                            </select>
                                            <div v-if="form.errors.category" class="text-red-500 text-sm mt-1">
                                                {{ form.errors.category[0] }}
                                            </div>
                                        </div>

                                        <!--developer -- Desarrollado por: 1. Desarrolladora JC, 2. Constructora
                                            CMT, 3. Constructora CMT-->
                                        <div>
                                            <label for="developer" class="block font-medium text-ctmblue">
                                                Desarrollado por
                                            </label>
                                            <select id="developer" name="developer" v-model="form.developer"
                                                class="mt-1 block w-full pl-3 pr-10 py-2 border-gray-300 focus:outline-none focus:ring-cmtblue focus:border-cmtblue text-cmtblue rounded-md">
                                                <option value="1">Desarrolladora JC</option>
                                                <option value="2">DGD Urbano</option>
                                            </select>
                                            <div v-if="form.errors.developer" class="text-red-500 text-sm mt-1">
                                                {{ form.errors.developer[0] }}
                                            </div>

                                        </div>

                                        <!--Coordinates-->
                                        <div>
                                            <label for="coordinates" class="block font-medium text-ctmblue">
                                                Coordenadas
                                            </label>
                                            <input type="text" name="coordinates" id="coordinates"
                                                v-model="form.coordinates" autocomplete="coordinates"
                                                class="mt-1 focus:ring-ctmblue focus:border-cmtblue block w-full shadow-sm border-gray-300 rounded-md text-ctmblue"
                                                placeholder="Ejemplo: 14.123456, -87.123456">
                                            <div v-if="form.errors.coordinates" class="text-red-500 text-sm mt-1">
                                                {{ form.errors.coordinates[0] }}
                                            </div>
                                        </div>


                                        <!--start date-->
                                        <div>
                                            <label for="start_date" class="block font-medium text-ctmblue">
                                                Fecha de inicio
                                            </label>
                                            <input type="date" name="start_date" id="start_date"
                                                v-model="form.start_date" autocomplete="start_date"
                                                class="mt-1 focus:ring-ctmblue focus:border-cmtblue block w-full shadow-sm border-gray-300 rounded-md text-ctmblue">
                                            <div v-if="form.errors.start_date" class="text-red-500 text-sm mt-1">
                                                {{ form.errors.start_date[0] }}
                                            </div>

                                        </div>

                                        <!--end date-->
                                        <div>
                                            <label for="end_date" class="block font-medium text-ctmblue">
                                                Fecha de finalizacion
                                            </label>
                                            <input type="date" name="end_date" id="end_date" v-model="form.end_date"
                                                autocomplete="end_date"
                                                class="mt-1 focus:ring-ctmblue focus:border-cmtblue block w-full shadow-sm border-gray-300 rounded-md text-ctmblue">
                                            <div v-if="form.errors.end_date" class="text-red-500 text-sm mt-1">
                                                {{ form.errors.end_date[0] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <!--Description Quill Editor-->
                                <div class="bg-gray-200 w-100 p-8  mb-8 rounded-2xl  scroll-animation">
                                    <label for="content" class="block font-medium text-ctmblue">
                                        Agrega una descripción al Proyecto
                                    </label>
                                    <QuillEditor v-model="form.description" />
                                    <div v-if="form.errors.description" class="text-red-500 text-sm mt-1">
                                        {{ form.errors.description[0] }}
                                    </div>

                                </div>

                                <!--lot description-->
                                <div class="bg-gray-200 w-100 p-8  mb-8 rounded-xl  scroll-animation">
                                    <label for="content" class="block font-medium text-ctmblue">
                                        Describe los Lotes del Proyecto
                                    </label>
                                    <QuillEditor v-model="form.lot_description" />
                                    <div v-if="form.errors.lot_description" class="text-red-500 text-sm mt-1">
                                        {{ form.errors.lot_description[0] }}
                                    </div>
                                </div>

                                <!--infraestructure description-->
                                <div class="bg-gray-200 w-100 p-8  mb-8 rounded-2xl scroll-animation">
                                    <label for="content" class="block font-medium text-ctmblue">
                                        Describe las Obras de Infraestructura que se realizaran
                                    </label>
                                    <QuillEditor v-model="form.infrastructure_description" />
                                    <div v-if="form.errors.infrastructure_description"
                                        class="text-red-500 text-sm mt-1">
                                        {{ form.errors.infrastructure_description[0] }}
                                    </div>
                                </div>

                                <!--area_description, estas son como zona de juegos, piscina, etc-->
                                <div class="bg-gray-200 w-100 p-8 mb-8 rounded-xl scroll-animation">
                                    <label for="content" class="block font-medium text-ctmblue">
                                        Describe las Areas Comunes del Proyecto
                                    </label>
                                    <QuillEditor v-model="form.area_description" />
                                    <div v-if="form.errors.area_description" class="text-red-500 text-sm mt-1">
                                        {{ form.errors.area_description[0] }}
                                    </div>

                                </div>


                            </form>

                            <!--project gallery-->
                            <div v-if="project?.project_id"
                                class="bg-gray-200 w-100 p-8 mb-8 rounded-xl scroll-animation">
                                <label for="content" class="block font-medium text-ctmblue mb-10">
                                    Imagenes del Proyecto
                                </label>

                                <div class="flex flex-wrap">
                                    <div v-for="(image, index) in project.images" :key="index"
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
                            <!--it will mobed to the edit project page-->

                            <!--image files upload-->

                            <div class="bg-gray-200 w-100 p-8 mb-8 rounded-xl scroll-animation">
                                <label for="content" class="block font-medium text-ctmblue mb-10">
                                    Sube imágenes del Proyecto
                                </label>

                                <ImageUploader ref="imageLoader" :projectId="project?.project_id || 0"
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
                                    Proyecto</button>
                            </div>

                        </div>

                    </div>
                </div>


            </section>


        </div>



    </AppLayout>
</template>
