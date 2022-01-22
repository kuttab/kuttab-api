import objectPath from "object-path";
import merge from "deepmerge";
import config from "../helper/layout.config.json";

// action types
export const SET_LAYOUT_CONFIG = "setLayoutConfig";
export const RESET_LAYOUT_CONFIG = "resetLayoutConfig";
export const OVERRIDE_LAYOUT_CONFIG = "overrideLayoutConfig";
export const OVERRIDE_PAGE_LAYOUT_CONFIG = "overridePageLayoutConfig";
export const SET_ACTION_BUTTON_CONFIG = "setActionButtonConfig";

// mutation types
export default {
    state: {
        config: config,
        initial: config,
        action_button_config: []
    },
    getters: {
        /**
         * Get config from layout config
         * @param state
         * @returns {function(path, defaultValue): *}
         */
        layoutConfig: state => (path, defaultValue) => {
            return objectPath.get(state.config, path, defaultValue);
        },

        /**
         *
         * @param state
         * @returns {[]}
         */
        action_button_config(state) {
            return state.action_button_config;
        },

    },
    actions: {
        /**
         * Set and replace the whole config
         * @param state
         * @param payload
         */
        [SET_LAYOUT_CONFIG](state, payload) {
            state.commit(SET_LAYOUT_CONFIG, payload);
        },

        /**
         * Reset the config at the initial state
         * @param state
         */
        [RESET_LAYOUT_CONFIG](state) {
            state.commit(RESET_LAYOUT_CONFIG);
        },

        /**
         * Reset the config using saved config in the cache by the layout builder
         * @param state
         */
        [OVERRIDE_LAYOUT_CONFIG](state) {
            state.commit(OVERRIDE_LAYOUT_CONFIG);
        },

        /**
         * Override config by page level
         * @param state
         * @param payload
         */
        [OVERRIDE_PAGE_LAYOUT_CONFIG](state, payload) {
            state.commit(OVERRIDE_PAGE_LAYOUT_CONFIG, payload);
        },

        /**
         * Set the breadcrumbs list
         * @param state
         * @param payload
         */
        [SET_ACTION_BUTTON_CONFIG](state, payload) {
            state.commit(SET_ACTION_BUTTON_CONFIG, payload);
        },
    },
    mutations: {
        [SET_LAYOUT_CONFIG](state, payload) {
            state.config = payload;
        },
        [RESET_LAYOUT_CONFIG](state) {
            state.config = Object.assign({}, state.initial);
        },
        [OVERRIDE_LAYOUT_CONFIG](state) {
            state.config = state.initial = Object.assign(
                {},
                state.initial,
                JSON.parse(localStorage.getItem("config"))
            );
        },
        [OVERRIDE_PAGE_LAYOUT_CONFIG](state, payload) {
            state.config = merge(state.config, payload);
        },
        [SET_ACTION_BUTTON_CONFIG](state, payload) {
            state.action_button_config = payload;
        }
    }
};
