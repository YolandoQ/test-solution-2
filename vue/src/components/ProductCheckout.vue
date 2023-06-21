<template>
  <div class="product-checkout">
    <h2>Checkout</h2>
    <p>Resumo da compra:</p>
    <ProductCart />
    <button class="checkout-button" @click="checkout" :disabled="isCartEmpty"><font-awesome-icon icon="shopping-cart" /> Confirmar pedido</button>
  </div>
</template>

<script>
import ProductCart from './ProductCart.vue';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faShoppingCart } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

library.add(faShoppingCart);

export default {
  components: {
    ProductCart,
    FontAwesomeIcon,

  },
  computed: {
    isCartEmpty() {
      return this.$store.state.cart.length === 0;
    },
  },
  methods: {
    async checkout() {
      this.$store.dispatch('postOrder');
    },
  },
};
</script>

<style scoped>
.product-checkout {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.checkout-button {
  border: 2px solid darkblue;
  color: black;
  background-color: transparent;
  padding: 5px 10px;
  border-radius: 0;
  cursor: pointer;
}

.checkout-button:hover {
  background-color: rgb(16, 79, 216);
}

.checkout-button:disabled {
  color: grey;
  border-color: grey;
  cursor: not-allowed;
}
</style>