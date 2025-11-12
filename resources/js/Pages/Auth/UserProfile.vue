<template>
  <BaseLayout>
    <div class="p-4 max-w-4xl mx-auto text-white">
      <h1 class="text-2xl font-bold mb-6">Dados da Conta</h1>

      <div v-if="isLoading">Carregando...</div>
      <div v-else class="grid gap-4">
        <!-- Nome -->
        <ProfileField
          label="Nome"
          :value="user.name"
          @edit="editarCampo('name')"
        />

        <!-- E-mail -->
        <ProfileField
          label="E-mail"
          :value="user.email"
          @edit="editarCampo('email')"
        />

        <!-- Saldo -->
        <ProfileField
          label="Saldo"
          :value="`R$ ${parseFloat(user.balance).toFixed(2)}`"
        />

        <!-- Desde -->
        <ProfileField
          label="Desde"
          :value="user.created_at"
        />
      </div>
    </div>
  </BaseLayout>
</template>

<script>
import BaseLayout from "@/Layouts/BaseLayout.vue";
import ProfileField from "@/Components/ProfileField.vue";

export default {
  components: {
    BaseLayout,
    ProfileField,
  },
  data() {
    return {
      isLoading: true,
      user: {
        name: "",
        email: "",
        balance: 0,
        created_at: "",
      },
    };
  },
  mounted() {
    this.loadUser();
    window.scrollTo(0, 0);
  },
  methods: {
    async loadUser() {
      try {
        const response = await this.$axios.get("/api/user/profile");
        this.user = response.data;
      } catch (error) {
        console.error("Erro ao carregar perfil:", error);
      } finally {
        this.isLoading = false;
      }
    },
    editarCampo(campo) {
      console.log("Editar", campo);
    },
  },
};
</script>

<style scoped>
/* Estilos personalizados aqui, se quiser */
</style>
