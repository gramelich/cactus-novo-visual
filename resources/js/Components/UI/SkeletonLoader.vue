<template>
    <div class="skeleton-loader" :style="skeletonStyle">
      <!-- Você pode personalizar o conteúdo aqui conforme a necessidade -->
      <div class="skeleton-item" v-for="(item, index) in items" :key="index" :style="itemStyle"></div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'SkeletonLoader',
    props: {
      items: {
        type: Array,
        default: () => [
          { width: '100%', height: '20px', marginBottom: '10px' },
          { width: '80%', height: '20px', marginBottom: '10px' },
          { width: '60%', height: '20px' }
        ]
      },
      width: {
        type: String,
        default: '100%'
      },
      height: {
        type: String,
        default: '100%'
      }
    },
    computed: {
      skeletonStyle() {
        return {
          width: this.width,
          height: this.height,
          display: 'flex',
          flexDirection: 'column'
        };
      },
      itemStyle() {
        return {
          background: '#e0e0e0',
          borderRadius: '4px',
          marginBottom: '10px'
        };
      }
    }
  };
  </script>
  
  <style scoped>
  .skeleton-loader {
    display: flex;
    flex-direction: column;
  }
  
  .skeleton-item {
    background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
  }
  
  @keyframes loading {
    0% {
      background-position: 200% 0;
    }
    100% {
      background-position: -200% 0;
    }
  }
  </style>
  