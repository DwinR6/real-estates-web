<template>
    <div>
        <input type="file" @change="onFileChange" multiple class="hidden" ref="fileInput">
        <button @click="triggerFileInput" class="bg-blue-500 text-white py-2 px-4 rounded">
            <!--image add icon-->
            <i data-feather="file-plus" class="h-6 w-6"></i>
        </button>
        <div v-if="previewImages.length" class="mt-4">
            <h3 class="text-lg font-semibold mb-2">Vista Previa</h3>
            <div class="preview-images flex flex-wrap gap-4">
                <div v-for="(image, index) in previewImages" :key="index" class="relative group">
                    <img :src="image" class="preview-image rounded shadow">
                    <button @click="removeImage(index)"
                        class="absolute top-2 right-2 bg-red-500 text-white p-1 rounded opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        &times;
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
import Swal from 'sweetalert2';
export default {
    props: {
        projectId: {
            type: Number,
            required: true
        },
        onUpload: {
            type: Function,
            default: () => { }
        }
    },
    data() {
        return {
            previewImages: [],
            files: [],
            savedImages: []
        };
    },
    methods: {
        triggerFileInput() {
            this.$refs.fileInput.click();
        },
        onFileChange(event) {
            const selectedFiles = event.target.files;
            for (let i = 0; i < selectedFiles.length; i++) {
                const file = selectedFiles[i];
                this.previewImages.push(URL.createObjectURL(file));
                this.files.push(file);
            }
        },
        removeImage(index) {
            this.previewImages.splice(index, 1);
            this.files.splice(index, 1);
        },
        async uploadImages() {
            if (!this.files.length) {
                return;
            }



            const formData = new FormData();
            this.files.forEach(file => {
                formData.append('images[]', file);
            });
            formData.append('project_id', this.projectId);
            console.log('formData:', formData);
            try {
                const response = await axios.post('/images/upload', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });

                //reset the preview images
                for (let i = 0; i < this.previewImages.length; i++) {
                    this.removeImage(i);
                }



                this.savedImages = response.data.savedImages;
                this.onUpload(this.savedImages);

                await Swal.fire({
                    icon: 'success',
                    title: 'Imágenes subidas con éxito',
                    showConfirmButton: false,
                    toast: true,
                    timer: 2500,
                    position: 'top-end'
                });
            } catch (error) {
                console.error(error);
                await Swal.fire({
                    icon: 'error',
                    title: 'Ocurrió un error al subir las imágenes',
                    text: 'Por favor intente de nuevo',
                    showConfirmButton: true
                });
            }
        },

        async syncImages() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'bg-green-500 text-white px-4 py-2 rounded',
                    cancelButton: 'bg-red-500 text-white px-4 py-2 rounded'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Subiendo imágenes',
                html: 'Por favor espere...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });

            await this.uploadImages();

            swalWithBootstrapButtons.fire({
                icon: 'success',
                title: 'Imágenes subidas con éxito',
                showConfirmButton: false,
                timer: 1500
            });

        }
        //show a swal alert while uploading images no can close



    }
};
</script>

<style scoped>
.upload-container {
    margin: 20px 0;
    text-align: center;
}

.upload-label {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007BFF;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.upload-label:hover {
    background-color: #0056b3;
}

.upload-label input {
    display: none;
}

.preview-container {
    margin-top: 20px;
}

.preview-images {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.preview-item {
    position: relative;
    display: inline-block;
}

.preview-image {
    max-width: 500px;
    max-height: 300px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.remove-button {
    position: absolute;
    top: 5px;
    right: 5px;
    background: rgba(255, 0, 0, 0.7);
    color: white;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    padding: 2px 5px;
    transition: background 0.3s;
}

.remove-button:hover {
    background: rgba(255, 0, 0, 1);
}
</style>
