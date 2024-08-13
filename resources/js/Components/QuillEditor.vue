<template>
    <div ref="editorContainer" class="quill-editor"></div>
</template>

<script>
import Quill from 'quill';
import 'quill/dist/quill.snow.css'; // Estilo del tema Snow, puedes usar otro tema

export default {
    name: 'QuillEditor',
    props: {
        modelValue: String, // Usar modelValue en lugar de value para compatibilidad con v-model
    },
    mounted() {
        this.initQuill();
    },
    methods: {
        initQuill() {
            const options = {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': '1' }, { 'header': '2' }, { 'font': [] }],
                        [{ size: [] }],
                        ['bold', 'italic', 'underline', 'strike', 'blockquote'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' },
                        { 'indent': '-1' }, { 'indent': '+1' }
                        ],
                        ['link', 'image', 'video'],
                        ['clean']
                    ],


                },

                // Puedes agregar más opciones de configuración aquí
            };

            this.quill = new Quill(this.$refs.editorContainer, options);

            // Configurar el valor inicial
            if (this.modelValue) {
                this.quill.root.innerHTML = this.modelValue;
            }

            // Configurar el editor para actualizar el valor
            this.quill.on('text-change', () => {
                this.updateValue();
            });
        },
        updateValue() {
            const content = this.quill.root.innerHTML;
            this.$emit('update:modelValue', content);
        },
    },
    watch: {
        modelValue(newValue) {
            if (this.quill && newValue !== this.quill.root.innerHTML) {
                this.quill.root.innerHTML = newValue;
            }
        },
    },
};
</script>

<style scoped>
.quill-editor {
    min-height: 150px;
    height: auto;
}
</style>
