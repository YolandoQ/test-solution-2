import { createApp } from 'vue';
import { createStore } from 'vuex';
import axios from 'axios';
import App from './App.vue';

const store = createStore({
  state: {
    products: [],
    cart: [],
    message: null,
    isLoading: false,
  },
  mutations: {
    setProducts(state, products) {
      state.products = products;
    },
    addToCart(state, product) {
      let item = state.cart.find(i => i.id === product.id);

      if (item) {
        item.quantity++;
      } else {
        state.cart.push({...product, quantity: 1});
      }
    },
    removeFromCart(state, product) {
      let item = state.cart.find(i => i.id === product.id);

      if (item) {
        if (item.quantity > 1) {
          item.quantity--;
        } else {
          state.cart = state.cart.filter(i => i.id !== product.id);
        }
      }
    },
    setMessage(state, message) {
        state.message = message;
    },
    clearMessage(state) {
      setTimeout(() => {
        state.message = null
      }, 5000);
    },
    setLoading(state, isLoading) {
      state.isLoading = isLoading;
    },
  },
  actions: {
    async fetchProducts({commit}) {
      commit('setLoading', true);
      try {
        const response = await axios.get('http://localhost:9000/api/products');
        commit('setProducts', response.data.data);
      } catch (error) {
        console.log(error)
        commit('setMessage', 'Houve um erro ao tentar carregar os produtos: ' + error.response.data.message ?? error.response);
        commit('setLoading', false);
        commit('clearMessage');
      }
      commit('setLoading', false);
    },
    async postOrder({commit, state}) {
      commit('setLoading', true);
      try {
        const response = await axios.post('http://localhost:9000/api/orders', {
          products: state.cart.map(item => ({ id: item.id, quantity: item.quantity })),
        });
        if (response.data.success === false) {
          throw new Error(response.data.message);
        }
        state.cart = [];
        commit('setMessage', response.data.message);
        commit('setLoading', false);
        commit('clearMessage');
      } catch (error) {
        commit('setMessage', 'Houve um erro ao fazer o pedido: ' + error.response.data.message ?? error.response);
        commit('setLoading', false);
        commit('clearMessage');
      }
    },
  },
});

axios.defaults.headers.common['api-token'] = 'MASTERDAWEB';

createApp(App).use(store).mount('#app');
