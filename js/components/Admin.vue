<template>
    <div>
        <div v-if="session">
            <a v-for="user in users" :key="user.id" href="/admin.php" class="header__link">
                Вход: {{ user.firstname }} {{ user.lastname }}
            </a>
        </div>

        <div v-else>
            <a @click="toggleLogAdmin" class="header__link">Администрирование</a>
        </div>

        <div v-if="isShowLog" class="log case">
            <form @submit.prevent="useFetch" class="log__content animate">
                <h2 class="log__heading">Вход от администратора</h2>
                <div class="log__container">
                    <label for="login">Логин</label>
                    <input class="log__input"
                           type="text"
                           v-model="login"
                           required>
                    <label for="psw">Пароль</label>
                    <input class="log__input"
                           type="password"
                           v-model="password"
                           required>
                    <div class="log__center-btn">
                        <button class="log__btn" type="submit" :disabled="isButtonDisabled">
                            <img v-if="loading" class="loading" src="img/loading.gif" alt="Загрузка">
                            {{ loadingText }}
                        </button>
                    </div>
                    <div class="pass__false message" v-if="message">{{ message }}</div>
                </div>
                <div class="text-center">
                    <button @click="toggleLogAdmin" class="close">Закрыть</button>
                </div>
            </form>

        </div>
    </div>
</template>

<script>

export default {
    name: "Admin",
    props: ['users', 'session'],
    data() {
        return {
            login: '',
            password: '',

            isShowLog: false,
            message: '',
            loading: false,
            isButtonDisabled: false
        }
    },

    computed: {
        loadingText() {
            return this.loading ? '' : 'Вход';
        },
    },

    created() {
        window.addEventListener('click', this.windowClose);
    },

    methods: {
        toggleLogAdmin() {
            this.isShowLog = !this.isShowLog;
            this.message = '';
            this.loading = false;
            this.login = '';
            this.password = '';
        },

        windowClose(ev) {
            const logAdmin = document.querySelector('.log');

            if (ev.target === logAdmin) {
                this.isShowLog = false;
                this.message = '';
                this.loading = false;
                this.login = '';
                this.password = '';
            }
        },

        async useFetch() {
            this.isButtonDisabled = true;
            this.loading = true;
            this.message = '';

            const params = new URLSearchParams();
            params.set('login', this.login);
            params.set('password', this.password);

            let responce =  await fetch('php/check-log.php', {
                method: 'POST',
                body: params
            });

            let text = await responce.text();

            if (text === 'success')
                location.href = 'admin.php';
            else {
                this.message = text;
                this.loading = false;
                this.isButtonDisabled = false;
            }
        }
    }
}
</script>
