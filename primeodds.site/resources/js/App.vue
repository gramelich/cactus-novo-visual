<template>
    <!-- TELA DE CARREGAMENTO -->
    <div v-if="!ready" class="loading-container">
      <div class="logo-wrapper">
        <img
          v-if="logoUrl"
          :src="logoUrl"
          alt="Logo"
          class="logo-img"
          @load="handleLogoLoaded"
          @error="handleLogoError"
        />
      </div>
      <div class="loading-dots">
        <span>.</span><span>.</span><span>.</span>
      </div>
    </div>
  
    <!-- APLICAÇÃO -->
    <div v-else>
      <RouterView v-slot="{ Component, route }">
        <Transition name="page-opacity" mode="out-in">
          <div :key="route.name">
            <component :is="Component"></component>
          </div>
        </Transition>
      </RouterView>
    </div>
  </template>
  
  <script>
  import { onMounted, ref, computed } from "vue";
  import { useSettingStore } from "@/Stores/SettingStore";
  import { RouterView } from "vue-router";
  
  export default {
    components: { RouterView },
    setup() {
      const settingStore = useSettingStore();
      const ready = ref(false);
      const logoLoaded = ref(false);
      const minLoadingTimePassed = ref(false);
  
      const logoUrl = computed(() => {
        const logo = settingStore.setting?.software_logo_black;
        if (!logo) return null;
  
        const isFullUrl = logo.startsWith("http");
        return isFullUrl ? logo : `${window.location.origin}/storage/${logo}`;
      });
  
      // Marca que a imagem carregou
      const handleLogoLoaded = () => {
        logoLoaded.value = true;
        checkReady();
      };
  
      const handleLogoError = () => {
        console.warn("Erro ao carregar a logo. Prosseguindo sem ela.");
        logoLoaded.value = true;
        checkReady();
      };
  
      // Função que decide se já pode liberar o app
      const checkReady = () => {
        if (logoLoaded.value && minLoadingTimePassed.value) {
          ready.value = true;
        }
      };
  
      onMounted(async () => {
        // Pega configurações do backend se não tiver
        try {
          if (!settingStore.setting?.software_logo_black) {
            const settings = await settingStore.getSetting();
            settingStore.setSetting(settings);
          }
        } catch (e) {
          console.error("Erro ao buscar configurações:", e);
          ready.value = true;
        }
  
        // Garante tempo mínimo de 2 segundos de loading
        setTimeout(() => {
          minLoadingTimePassed.value = true;
          checkReady();
        }, 2000);
      });
  
      return {
        logoUrl,
        ready,
        handleLogoLoaded,
        handleLogoError,
      };
    },
  };
  </script>
  
  <style scoped>
  .loading-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #000;
  }
  
  .logo-wrapper {
    margin-bottom: 20px;
  }
  
  .logo-img {
    max-width: 220px;
    max-height: 110px;
    object-fit: contain;
    filter: brightness(1.3);
  }
  
  .loading-dots {
    font-size: 32px;
    color: #fff;
    letter-spacing: 8px;
    animation: blink 1.5s infinite;
  }
  
  @keyframes blink {
    0% {
      opacity: 0.2;
    }
    50% {
      opacity: 1;
    }
    100% {
      opacity: 0.2;
    }
  }
  </style>
  