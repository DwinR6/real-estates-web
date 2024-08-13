<template>
    <div id="slider" class="slider" @wheel="handleScroll">
        <div class="slider__inner">
            <img v-for="(image, index) in images" :key="index" :src="`/storage/${image.path}`" :alt="image.name" :class="[
                'slider__image',
                getPositionClass(index),
                { active: isActive(index) }
            ]" />
        </div>
        <div class="slider__action">
            <div id="prev" class="slider__button slider__button--prev flex items-center justify-start"
                @click="previous">
                <i data-feather="chevron-left"></i>
            </div>
            <div id="next" class="slider__button slider__button--next  flex items-center justify-end" @click="next">
                <i data-feather="chevron-right"></i>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        images: {
            type: Array,
            required: true,
            default: () => [],
        },
    },
    data() {
        return {
            currentIndex: 0,
        };
    },
    methods: {
        next() {
            this.currentIndex = (this.currentIndex + 1) % this.images.length;
        },
        previous() {
            this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
        },
        getPositionClass(index) {
            const diff = (index - this.currentIndex + this.images.length) % this.images.length;
            const middleIndex = Math.floor(this.images.length / 2);

            if (diff === 0) return 'center'; // Imagen central

            if (diff <= middleIndex) return `left-${diff * 5}`; // Lado izquierdo
            return `right-${(this.images.length - diff) * 5}`; // Lado derecho
        },
        isActive(index) {
            return this.getPositionClass(index) === 'center';
        },
        handleScroll(event) {
            if (event.deltaY > 0) {
                this.next();
            } else {
                this.previous();
            }
        },
    },
};
</script>

<style scoped>
.slider {
    max-width: 100%;
    height: 100%;
    margin: 0 auto;
    position: relative;
    overflow: hidden;
    padding: 0 25px;
}

.slider__inner {
    height: 100%;
    width: 100%;
    position: relative;
}

.slider__button {
    position: absolute;
    width: 30px;
    height: 30px;
    top: 50%;
    margin-top: -10px;
    z-index: 120;
    background: #F2F2F2;
    color: #991c27;
    opacity: 0.4;
    cursor: pointer;
    text-align: center;
    border-radius: 50%;
    box-shadow: -1px 1px 5px 0px #000;
}

.slider__button:hover {
    opacity: 1;
}

.slider__button--next {
    right: 2px;
}

.slider__button--prev {
    left: 2px;
}

.slider__image {
    display: block;
    width: 50%;
    height: inherit;
    position: absolute;
    border: solid 1px #000;
    top: 30px;
    transition: all 0.3s ease-in-out;
    opacity: 0.85;
    transform: scale(0.8);
    filter: blur(5px);
    z-index: 40;
    border-radius: 10px;
}

.center {
    left: 50%;
    transform: translateX(-50%) scale(1);
    opacity: 1;
    filter: blur(0);
    z-index: 50;
    height: auto;
}

/* Left-side classes */
.left-5 {
    left: 45%;
}

.left-10 {
    left: 40%;
}

.left-15 {
    left: 35%;
}

.left-20 {
    left: 30%;
}

.left-25 {
    left: 25%;
}

/* Right-side classes */
.right-5 {
    right: 45%;
}

.right-10 {
    right: 40%;
}

.right-15 {
    right: 35%;
}

.right-20 {
    right: 30%;
}

.right-25 {
    right: 25%;
}
</style>
