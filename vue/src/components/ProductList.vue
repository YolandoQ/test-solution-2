<template>
  <div class="product-list">
    <h2>Lista de produtos</h2>
    <p>Escolha uma das opções abaixo:</p>
    <ul v-if="products && products.length">
      <li v-for="product in products" :key="product.id">
        <button class="add-to-cart-button" @click="addToCart(product)">+</button>
        {{ product.name }} - {{ formatCurrency(product.price) }}
      </li>
    </ul>
    <p v-else>Nenhum produto disponível no momento.</p>
  </div>
</template>


<script>

import { currency } from '../filters';

export default {
  computed: {
    products() {
      return this.$store.state.products;
    },
  },
  methods: {
    addToCart(product) {
      this.$store.commit('addToCart', product);
    },
    formatCurrency: currency,
  },
};
</script>

<style scoped>
.product-list {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.product-list ul {
  list-style: none;
  padding: 0;
}

.product-list li {
  display: flex;
  margin: 5px;
  align-items: center;
  width: 100%;
}

.add-to-cart-button {
  background-color: rgb(60, 156, 60);
  color: white;
  border-radius: 50%;
  height: 20px;
  width: 20px;
  border: none;
  margin-right: 10px;
  cursor: pointer;
}

.add-to-cart-button:hover {
  background-color: rgb(22, 95, 22);
}
</style>
