<template>
  <div class="app-container">
    <img class="logo" src="./assets/logo.png" alt="Logo">
    <div class="isLoading" v-if="isLoading">
      <div class="spinner"></div>
    </div>
    <div class="card">
      <ProductList />
      <ProductCheckout />
      <div class="message" v-if="message">{{ message }}</div>
    </div>
    <div class="footer">Copyright &copy; {{ new Date().getFullYear() }} Master Da Web. Todos os direitos reservados.</div>
  </div>
</template>

<script>
import ProductList from './components/ProductList.vue';
import ProductCheckout from './components/ProductCheckout.vue';

export default {
  components: {
    ProductList,
    ProductCheckout,
  },
  computed: {
    message() {
      return this.$store.state.message;
    },
    isLoading() {
      return this.$store.state.isLoading;
    },
  },
  created() {
    this.$store.dispatch('fetchProducts');
  },
};
</script>

<style>
body {
  margin: 0;
  font-size: 18px;
}
</style>

<style scoped>
.app-container {
  background-color: #a502b4;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

.logo {
  width: 200px;
  margin-bottom: 10px;
}

.card {
  background-color: #fff;
  color: #000;
  width: 60%;
  padding: 20px;
  border-radius: 15px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.footer {
  margin-top: 20px;
  color: #fff;
}

.isLoading {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 9999;
}

.spinner {
  border: 10px solid #f3f3f3;
  border-top: 10px solid #a502b4;
  border-radius: 50%;
  width: 100px;
  height: 100px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.message {
  background-color: #fff;
  color: #000;
  border: 1px solid #000;
  padding: 10px;
  margin-top: 1em;
  text-align: center;
}
</style>
