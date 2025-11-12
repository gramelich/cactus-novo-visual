<template>
    <LandingLayout>
        
    </LandingLayout>
</template>

<script>
    import { ref } from "vue";

    import LandingLayout from '@/Layouts/LandingLayout.vue';
    import { useAuthStore } from "@/Stores/Auth.js";
    import LoadingComponent from "@/Components/UI/LoadingComponent.vue";
    import LandingModal from '@/Components/LandingSpin/LandingModal.vue';

    export default {
        props: [],
        components: {
            LoadingComponent,
            LandingLayout,
            LandingModal
        },
        data() {
            return {
                isLoading: true,
                showModal: false
            }
        },
        setup(props) {
            const ckCarouselOriginals = ref(null);
            return {
                ckCarouselOriginals
            };
        },
        computed: {
            isAuthenticated() {
                const authStore = useAuthStore();
                return authStore.isAuth;
            }
        },
        mounted() {
            if (this.isAuthenticated) {
                location.href='/';
            }
        },
        methods: {
            CloseModal() {
                this.showModal=false;
                location.href='/';
            },
            HandleLoaded() {
                this.showModal = true;
                this.isLoading = false;
            }
        }
    };
</script>

<style>
    html, document, body {
        user-select: none;
    }
</style>
