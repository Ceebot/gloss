<template>
    <div>
        <section class="section-form" id="section-form">
            <div class="container section-form__container">
                <div class="section-form__text">
                    <h2 class="section-form__title">
                        Онлайн запись
                    </h2>
                    <Success></Success>
                    <p class="section-form__description">
                        Здесь вы можете записаться на любую услугу
                    </p>
                </div>
                <form @submit.prevent="useFetch" autocomplete="off" class="section-form__form">
                    <div class="section-form__block-input">
                        <input required
                               type="text"
                               placeholder="Имя*"
                               class="section-form__input"
                               v-model="name"
                        >
                        <input required
                               type="tel"
                               placeholder="Телефон*"
                               class="section-form__input"
                               v-model="tel"
                        >
                        <input required
                               type="email"
                               placeholder="Почта*"
                               class="section-form__input"
                               v-model="mail"
                        >

                        <div class="section-form__div-label">
                            <label class="section-form__label" for="date">Выбрать дату: </label>
                        </div>

                        <input type="date"
                               class="section-form__input section-form__input_date"
                               id="date"
                               v-model="date"
                        >

                        <select
                            class="section-form__set-service" v-model="selected">
                            <option disabled value="">Выбрать услугу</option>
                            <option v-for="service in services" :key="service.id" :value="service.title">
                                {{ service.title }} - {{ service.description }} {{ service.price }} &#8381
                            </option>
                        </select>

                        <textarea v-model="message"
                                  maxlength="1000"
                                  class="section-form__textarea"
                                  rows="5" type="text"
                                  placeholder="Сообщение...">
                        </textarea>

                        <button class="btn section-form__btn-submit" type="submit" :disabled="isButtonDisabled">
                            <img v-if="loading" class="loading" src="img/loading.gif" alt="Загрузка">
                            {{ loadingText }}
                        </button>
                    </div>
                </form>
            </div>
        </section>
        <div v-if="returnMessage">
            <Success :returnMessage="returnMessage"></Success>
        </div>
        <!--<Success :returnMessage="returnMessage"></Success>-->
    </div>
</template>

<script>
import Success from "./Success.vue";

export default {
    name: "Application",
    props: ['services'],

    components: {
        Success
    },

    data() {
        return {
            name: '',
            tel: '',
            mail: '',
            date: '',
            selected: '',
            message: '',

            isShow: false,
            loading: false,

            returnMessage: '',

            isButtonDisabled: false
        }
    },

    computed: {
        loadingText() {
            return this.loading ? '' : 'Оставить заявку';
        },
    },

    methods: {
        async useFetch() {
            this.isButtonDisabled = true;
            this.loading = true;

            const params = new URLSearchParams();
            params.set('name', this.name);
            params.set('tel', this.tel);
            params.set('mail', this.mail);
            params.set('date', this.date);
            params.set('selected', this.selected);
            params.set('message', this.message);

            let response = await fetch('php/add/add-application.php', {
                method: 'POST',
                body: params
            });

            let text = await response.text();

            if (text === 'Отправлено!') {
                this.name = '';
                this.tel = '';
                this.mail = '';
                this.date = '';
                this.selected = '';
                this.message = '';

                this.returnMessage = text;
                this.loading = false;
                this.isButtonDisabled = false;
            }
        }
    }
}
</script>
