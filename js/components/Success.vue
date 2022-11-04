<template>
    <div>
        <div v-if="returnMessage" class="check-mark case">
            <div class="check-mark__content animate">
                <img class="check-mark__img" src="img/check-mark.png" alt="Галочка">
                <h1 class="section-heading text-center">{{ returnMessage }}</h1>
                <a class="check-mark__close btn" @click="toggleMark">Закрыть</a>
            </div>
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
        },

        windowClose(ev) {
            const success = document.querySelector('.check-mark');

            if (ev.target === success) {
                this.returnMessage = '';
            }
        }
    }
}
</script>
