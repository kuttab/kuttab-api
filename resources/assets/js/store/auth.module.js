import ApiService from "../services/api.service";
import SanctumService from "../services/sanctum.service";
import Toast from "vue-toastification";
import Swal from "sweetalert2";

// action types
export const VERIFY_AUTH = "verifyAuth";
export const LOGIN = "login";
export const LOGOUT = "logout";
export const REGISTER = "register";
export const UPDATE_PASSWORD = "updateUser";

// mutation types
export const PURGE_AUTH = "logOut";
export const SET_AUTH = "setUser";
export const SET_PASSWORD = "setPassword";
export const SET_ERROR = "setError";

const state = {
    errors: null,
    user: {},
    isAuthenticated: !!SanctumService.getToken()
};

const getters = {
    currentUser(state) {
        return state.user;
    },
    isAuthenticated(state) {
        return state.isAuthenticated;
    }
};

const actions = {
    [LOGIN](context, credentials) {
        return new Promise(resolve => {
            ApiService.post("api/v1/auth/admin/login", credentials)
                .then(({ data }) => {
                    context.commit(SET_AUTH, data);
                    resolve(data);
                })
                .catch(({ response }) => {
                    this._vm.$toast.error(response.data.message);
                    context.commit(SET_ERROR, response.data.message);
                });
        });
    },
    [LOGOUT](context) {
        ApiService.post("api/v1/auth/logout")
            .then(() => {
                context.commit(PURGE_AUTH);
                this._vm.$toast.success("تم تسجيل الخروج");
            })
            .catch(() => {
                this._vm.$toast.error('error');
            });
    },
    [REGISTER](context, credentials) {
        return new Promise(resolve => {
            ApiService.post("api/v1/school", credentials)
                .then(({ data }) => {
                    context.commit(SET_AUTH, data.data.admin);
                    resolve(data.data.admin);
                    Swal.fire({
                        title: "قم بحفظ البيانات التالية لتتمكن من تسجيل الدخول",
                        html:'<span>اسم المستخدم :</span>'+data.data.admin.username+'<br><span>كلمة السر الجديدة :</span>'+data.data.admin.password,
                        icon: "success",
                        confirmButtonClass: "btn btn-secondary",
                        heightAuto: false
                    });
                })
                .catch(({ response }) => {
                    context.commit(SET_ERROR, response);
                });
        });
    },
    [VERIFY_AUTH](context) {
        if (SanctumService.getToken() != 'undefined' && SanctumService.getToken()) {
            ApiService.setHeader();
            ApiService.post("api/v1/auth/verify")
                .then(({ data }) => {
                    context.commit(SET_AUTH, data);
                })
                .catch(({ response }) => {
                    context.commit(SET_ERROR, response.data.errors);
                });
        } else {
            context.commit(PURGE_AUTH);
        }
    },
    [UPDATE_PASSWORD](context, payload) {
        const password = payload;

        return ApiService.put("api/v1/auth/password", {password:password}).then(({ data }) => {
            context.commit(SET_PASSWORD, data);
            Swal.fire({
                title: "قم بحفظ البيانات التالية لتتمكن من تسجيل الدخول",
                html:'<span>اسم المستخدم :</span>'+state.user.username+'<br><span>كلمة السر الجديدة :</span>'+data,
                icon: "success",
                confirmButtonClass: "btn btn-secondary",
                heightAuto: false
            });
            return data;
        });
    }
};

const mutations = {
    [SET_ERROR](state, error) {
        state.errors = error;
    },
    [SET_AUTH](state, user) {
        state.isAuthenticated = true;
        state.user = user;
        state.errors = {};
        SanctumService.saveToken(state.user.token);
    },
    [SET_PASSWORD](state, password) {
        state.user.password = password;
    },
    [PURGE_AUTH](state) {
        state.isAuthenticated = false;
        state.user = {};
        state.errors = {};
        SanctumService.destroyToken();
    }
};

export default {
    state,
    actions,
    mutations,
    getters
};
