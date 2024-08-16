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
    },
    data() {
        return {
            previewImages: [],
            files: [],
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
