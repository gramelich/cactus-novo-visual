import { createI18n } from "vue-i18n";
import pt_BR from "../lang/pt_BR.json";
import en from "../lang/en.json";
import es from "../lang/es.json";

const defaultLocale = localStorage.getItem("locale") || "pt_BR";

const i18n = createI18n({
  legacy: false,
  locale: defaultLocale,
  fallbackLocale: "en",
  globalInjection: true,
  messages: {
    pt_BR,
    en,
    es,
  },
});

export default i18n;
