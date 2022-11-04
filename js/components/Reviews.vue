<template>
    <div>
        <section class="clients" id="section-clients">
            <div class="container clients__container">
                <h2 class="section-heading clients__heading">Отзывы наших клиентов</h2>
                <ul class="clients__list">
                    <li v-for="review in reviews" :key="review.id" class="clients__item">
                        <p class="clients__testimonial">
                            {{ review.message }}
                        </p>
                        <div class="clients__user">
                            <img src="img/user.svg" alt="Аватар" class="clients__avatar">
                            <div class="clients__user-info">
                                <div class="clients__username">
                                    {{ review.name }}
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <button @click="toggleReview" class="btn clients__button-review">Оставить отзыв или пожелание</button>
            </div>
        </section>

        <div v-if="isShow" class="review case">
            <div class="review__content animate">
                <h2 class="review__heading text-center">Оставить отзыв</h2>
                <form @submit.prevent="useFetch" class="review__container" autocomplete="off">

                    <div class="review__name">
                        <label class="review__label" for="review-name">Ваше имя*</label>
                        <input v-model="name"
                               maxlength="35"
                               class="review__input"
                               id="review-name"
                               type="text"
                               required
                        >
                    </div>

                    <div class="review__mail">
                        <label class="review__label" for="review-mail">Ваш E-Mail* <span class="review__desc">(не отображается на сайте)</span></label>
                        <input v-model="mail"
                               maxlength="45"
                               class="review__input"
                               id="review-mail"
                               type="email"
                               required
                        >
                    </div>

                    <label class="review__label" for="review-text">Ваш Отзыв*</label>
                    <textarea v-model="message"
                              maxlength="420"
                              class="review__textarea"
                              id="review-text"
                              rows="5"
                              type="text"
                              required>
                    </textarea>

                    <div class="text-center">
                        <button @click="useFetch" :disabled="isButtonDisabled" type="submit"
                                class="review__add-review btn">
                            <img v-if="loading" class="loading" src="img/loading.gif" alt="Загрузка">
                            {{ loadingText }}
                        </button>
                        <button @click="toggleReview" class="close">Закрыть</button>
                    </div>
                </form>
            </div>
        </div>
        <div v-if="returnMessage">
            <Success @close-popup="closePopup" :returnMessage="returnMessage"></Success>
        </div>
    </div>
</template>

<script>
import Success from "./Success.vue";

export default {
    name: "Review",

    props: ['initReviews'],

    components: {
        Success
    },

    data() {
        return {
            reviews: this.initReviews,

            name: '',
            mail: '',
            message: '',

            isShow: false,
            loading: false,

            returnMessage: '',

            isButtonDisabled: false
        }
    },

    computed: {
        loadingText() {
            return this.loading ? '' : 'Отправить';
        }
    },

    created() {
        window.addEventListener('click', this.windowClose);
    },

    methods: {
        toggleReview() {
            this.isShow = !this.isShow;
        },

        windowClose(ev) {
            const review = document.querySelector('.review');
            if (ev.target === review) {
                this.isShow = !this.isShow;
            }
        },

        async useFetch() {
            this.isButtonDisabled = true;
            this.loading = true;

            const params = new URLSearchParams();
            params.set('name', this.name);
            params.set('mail', this.mail);
            params.set('message', this.message);

            let response = await fetch('php/add/add-review.php', {
                method: 'POST',
                body: params
            });

            let text = await response.text();

            if (text === 'Отправлено!') {
                this.isShow = !this.isShow;

                this.name = '';
                this.mail = '';
                this.message = '';

                this.loading = false;
                this.isButtonDisabled = false

                this.returnMessage = text;

                await this.getReviews();
            }
        },

        async getReviews() {
            let result = await fetch('php/select-reviews.php');
            this.reviews = await result.json();
        },

        closePopup() {
            this.returnMessage = '';
        }
    }
}
</script>
