<template>
    <header>
        <img :src="logoSrc" alt="Logo" class="logo" />
        <!-- Otros elementos del header -->
    </header>
</template>

<script>
export default {
    name: 'Header',
    data() {
        return {
            logoSrc: '/image/logo-jc.jpg'
        };
    }
};
</script>

<style scoped>
.logo {
    width: 100px;
    /* Ajusta el tamaño según tus necesidades */
    height: auto;
}
</style>
