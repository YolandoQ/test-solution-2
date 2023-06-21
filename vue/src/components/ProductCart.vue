<template>
  <div class="product-cart">
    <ul v-if="cart && cart.length">
      <li v-for="item in cart" :key="item.id">
        <button class="remove-from-cart-button" @click="removeFromCart(item)">-</button>
        {{ item.name }} - x {{ item.quantity }} - {{formatCurrency(item.price * item.quantity) }}
      </li>
    </ul>
    <p v-else>Nenhum produto adicionado ao carrinho.</p>
    <p>Total: {{formatCurrency(total) }}</p>
  </div>
</template>


<script>
import { currency } from '../filters';

export default {
  computed: {
    cart() {
      return this.$store.state.cart;
    },
    total() {
      return this.cart.reduce((acc, item) => acc + (item.price * item.quantity), 0);
    },
  },
  methods: {
    removeFromCart(item) {
      this.$store.commit('removeFromCart', item);
    },
    formatCurrency: currency,
  },
};
</script>

<style scoped>
.product-cart {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.product-cart ul {
  list-style: none;
  padding: 0;
  width: 100%;
}

.product-cart li {
  display: flex;
  margin: 5px;
  align-items: center;
  width: 100%;
}

.remove-from-cart-button {
  background-color: rgb(236, 180, 59);
  color: white;
  border-radius: 50%;
  height: 20px;
  width: 20px;
  border: none;
  margin-right: 10px;
  cursor: pointer;
}

.remove-from-cart-button:hover {
  background-color: rgb(168, 113, 9);
}
</style>
