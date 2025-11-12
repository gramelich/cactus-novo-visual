import { defineStore } from "pinia";
import { ref, computed } from "vue";

export const useBannerStore = defineStore("banner", () => {
    const showTopBanner = ref(true);

    const isVisible = computed(() => showTopBanner.value);

    function closeBanner() {
        showTopBanner.value = false;
    }

    return {
        showTopBanner,
        isVisible,
        closeBanner,
    };
});
