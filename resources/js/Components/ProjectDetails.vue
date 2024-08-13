<script>
export default {
    props: {
        isOpen: {
            type: Boolean,
            required: true
        },
        project: {
            type: Object,
            required: true
        },
    },
    methods: {
        closeModal() {
            this.$emit('close');
        }
    }
}
</script>

<template>
    <div v-if="isOpen" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg leading-6 font-medium text-gray-900">{{ project.name }}</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">{{ project.description }}</p>
                    <!-- Añade más detalles aquí -->
                </div>
                <div class="items-center px-4 py-3">
                    <button @click="closeModal"
                        class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-700">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
