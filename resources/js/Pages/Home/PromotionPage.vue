<template>
    <BaseLayout>
      <br />
      <div class="max-w-7xl mx-auto py-8 px-4">
        <h1 class="text-white text-2xl font-bold mb-6">Promoções e Bônus</h1>
  
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div
            v-for="promo in promocoes"
            :key="promo.id"
            class="bg-[#1a1c1d] rounded-lg overflow-hidden shadow-md cursor-pointer"
            @click="handlePromoClick(promo)"
          >
            <img
              :src="getImageUrl(promo.imagem)"
              :alt="promo.titulo"
              class="w-full h-48 object-cover"
            />
            <div class="p-4">
              <h2 class="text-white text-lg font-semibold mb-2">
                {{ promo.titulo }}
              </h2>
              <p class="text-gray-400 text-sm mb-4" v-html="promo.regras_html"></p>
            </div>
          </div>
        </div>
      </div>
    </BaseLayout>
  </template>
  
  <script>
  import BaseLayout from "@/Layouts/BaseLayout.vue";
  import axios from "axios";
  
  export default {
    components: { BaseLayout },
    data() {
      return {
        promocoes: [],
      };
    },
    methods: {
      async fetchPromocoes() {
        try {
          const res = await axios.get("/api/promocoes");
          this.promocoes = res.data;
        } catch (error) {
          console.error("Erro ao carregar promoções:", error);
        }
      },
      getImageUrl(imagePath) {
        if (!imagePath) return "";
        return imagePath.startsWith("http")
          ? imagePath
          : `/storage/${imagePath.replace(/^\/?storage\/?/, "")}`;
      },
      handlePromoClick(promo) {
        if (promo.link) {
          window.open(promo.link, "_blank");
        }
      },
    },
    mounted() {
      window.scrollTo(0, 0);
      this.fetchPromocoes();
    },
  };
  </script>
  
  <style scoped>
  img:hover {
    filter: brightness(1.1);
  }
  </style>
  