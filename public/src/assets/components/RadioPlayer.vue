<!-- src/components/RadioPlayer.vue -->
<template>
    <div class="radio-player">
      <h2>{{ station.name }}</h2>
      <p v-if="station.isPlaying">Tocando agora...</p>
      <audio v-if="station.isPlaying" ref="audioPlayer" :src="station.url" autoplay></audio>
  
      <div class="controls">
        <button @click="play" :disabled="station.isPlaying">Play</button>
        <button @click="pause" :disabled="!station.isPlaying">Pause</button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    computed: {
      station() {
        return this.$store.getters.currentStation;
      }
    },
    methods: {
      play() {
        this.$store.dispatch('playRadio');
      },
      pause() {
        this.$store.dispatch('pauseRadio');
      }
    }
  };
  </script>
  
  <style scoped>
  .radio-player {
    max-width: 400px;
    margin: auto;
    text-align: center;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }
  .controls {
    margin-top: 20px;
  }
  button {
    padding: 10px 20px;
    margin: 0 10px;
    cursor: pointer;
  }
  button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
  }
  </style>
  