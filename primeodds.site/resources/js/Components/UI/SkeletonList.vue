<template>
    <div class="skeleton-list">
      <div class="skeleton-item" v-for="(item, index) in itemCount" :key="index"></div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'SkeletonList',
    props: {
      itemCount: {
        type: Number,
        default: 5
      }
    }
  };
  </script>
  
  <style scoped>
  .skeleton-list {
    display: flex;
    flex-direction: column;
  }
  
  .skeleton-item {
    background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
    background-size: 200% 100%;
    border-radius: 4px;
    height: 50px;
    margin-bottom: 10px;
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
  