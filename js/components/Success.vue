<template>
    <div v-if="returnMessage" class="check-mark case">
        <div class="check-mark__content animate">
            <img class="check-mark__img" src="img/check-mark.png" alt="Галочка">
            <h1 class="section-heading text-center">Отправлено!</h1>
            <a class="check-mark__close btn" @click="toggleMark">Закрыть</a>
        </div>
    </div>
</template>

<script>

export default {
    name: "Success",

    props: ['returnMessage'],

    created() {
        window.addEventListener('click', this.windowClose);
    },

    methods: {
        toggleMark() {
            this.returnMessage = '';
            this.$emit('close-popup');
            console.log('попап закрыт');
        },

        windowClose(ev) {
            const success = document.querySelector('.check-mark');

            if (ev.target === success) {
                this.returnMessage = '';
                this.$emit('close-popup');
            }
        }
    }
}
</script>
