<!-- form to add new machinaries -->
<template>
    <div class="bg-gray-100 p-4 rounded-lg w-full flex flex-col">
        <div class="flex items-center justify-center  rounded-lg  mb-4">
            <h1 class="text-2xl text-ctmblue font-bold">
                <span v-if="machinary">Editar</span>
                <span v-else>Agregar</span> Maquinaria
            </h1>
        </div>
        <div class="flex flex-col">
            <div class="mb-4">
                <label for="name" class="text-gray-500 text-base font-semibold">¿Qué maquinaria es?</label>
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
                <div v-for="(image, index) in machinary?.images" :key="index"
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
                    Sube imágenes del Proyecto
                </label>

                <ImageUploader ref="imageLoader" :projectId="machinary?.project_id || 0" :onUpload="() => { }" />

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
        machinary: Object
    },
    data() {
        return {
            form: useForm({
                name: this.machinary?.name || '',
                description: this.machinary?.description || '',
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
                if (this.machinary) {

                    const response = await axios.put(route('machinaries.update', this.machinary.machinary_id), this.form.data());
                    const imageForm = new FormData();
                    this.$refs.imageLoader.files
                        .forEach((image) => {
                            imageForm.append('images[]', image);
                        });
                    const imageResponse = await axios.post(route('machinaries.images.store', this.machinary.machinary_id), imageForm, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });

                    console.log({
                        response,
                        imageResponse
                    });

                    if (response.data.machinary_id && imageResponse.data.machinary_id) {
                        this.$emit('close');
                        await Swal.fire({
                            icon: 'success',
                            title: 'Guardado',
                            text: 'La maquinaria y las imágenes han sido guardadas con éxito',
                            customClass: {
                                popup: 'z-[99999] absolute'
                            },
                        });

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


                    const response = await axios.post(route('machinaries.store'), this.form.data());

                    const imageForm = new FormData();

                    this.$refs.imageLoader.files
                        .forEach((image) => {
                            imageForm.append('images[]', image);
                        });

                    const imageResponse = await axios.post(route('machinaries.images.store', response.data.machinary_id), imageForm, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    });
                    console.log({
                        response,
                        imageResponse
                    });
                    if (response.data.machinary_id && imageResponse.data.machinary_id) {
                        console.log('emit close');
                        this.$emit('close');
                        await Swal.fire({
                            icon: 'success',
                            title: 'Guardado',
                            text: 'La maquinaria ha sido guardada y las imágenes han sido guardadas',
                            customClass: {
                                popup: 'z-[99999] absolute'
                            },
                        });

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
