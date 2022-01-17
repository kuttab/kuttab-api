const i18nService = {
    defaultLanguage: "ar",

    languages: [
        {
            lang: "ar",
            name: "العربية",
            flag: "./media/svg/flags/008-saudi-arabia.svg"
        },
        {
            lang: "en",
            name: "English",
            flag: "./media/svg/flags/226-united-states.svg"
        },
    ],

    /**
     * Keep the active language in the localStorage
     * @param lang
     */
    setActiveLanguage(lang) {
        localStorage.setItem("language", lang);
    },

    /**
     * Get the current active language
     * @returns {string | string}
     */
    getActiveLanguage() {
        return localStorage.getItem("language") || this.defaultLanguage;
    }
};

export default i18nService;
