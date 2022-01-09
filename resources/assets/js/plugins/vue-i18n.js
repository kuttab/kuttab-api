import Vue from "vue";
import VueI18n from "vue-i18n";

// Localisation language list
import { locale as en } from "../i18n/en";
import { locale as ar } from "../i18n/ar";

Vue.use(VueI18n);

let messages = {};
messages = { ...messages, en, ar };

// get current selected language
const lang = localStorage.getItem("language") || "en";

// Create VueI18n instance with options
const i18n = new VueI18n({
  locale: lang, // set locale
  messages // set locale messages
});

export default i18n;
