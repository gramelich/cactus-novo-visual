// src/store/index.js
import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    radioStation: {
      name: 'Minha Rádio',
      url: '',
      isPlaying: false
    }
  },
  mutations: {
    setRadioStation(state, station) {
      state.radioStation = station;
    },
    setRadioPlaying(state, isPlaying) {
      state.radioStation.isPlaying = isPlaying;
    }
  },
  actions: {
    playRadio({ commit }) {
      commit('setRadioPlaying', true);
    },
    pauseRadio({ commit }) {
      commit('setRadioPlaying', false);
    },
    setStationAndPlay({ commit }, station) {
      commit('setRadioStation', station);
      commit('setRadioPlaying', true);
    }
  },
  getters: {
    currentStation(state) {
      return state.radioStation;
    }
  }
});
