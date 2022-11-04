<template>
    <div>
        <a @click="toggleProducts" class="do__button">Открыть весь каталог</a>

        <div v-if="isShow" class="catalog case">
            <div class="catalog__content animate">
                <div class="catalog__content-top">
                    <h2 class="catalog__heading">Каталог товаров</h2>
                    <span @click="toggleProducts" class="catalog__close" title="Закрыть окно">x</span>
                </div>
                <div class="catalog__container">
                    <ul v-for="product in products" :key="product.id" class="catalog__list-product">
                        <li class="catalog__item-product">
                            <strong class="catalog__item-product-heading">
                                {{ product.title }} {{ product.volume }} мл
                            </strong>
                            <p class="catalog__item-product-description">
                                {{ product.price }} &#8381
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    name: "Products",

    data() {
        return {
            isShow: false,
        }
    },
    props: ['products'],

    created() {
        window.addEventListener('click', this.windowClose);
    },

    methods: {
        toggleProducts() {
            this.isShow = !this.isShow;
        },

        windowClose(ev) {
            const catalog = document.querySelector('.catalog');

            if (ev.target === catalog) {
                this.isShow = false;
            }
        },
    }
}
</script>
