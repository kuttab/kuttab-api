<template>
    <div>
        <div class="topbar-item position-absolute right-0">
            <b-dropdown size="sm" variant="link" toggle-class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 text-decoration-none" no-caret right no-flip>
                <template v-slot:button-content>
                    <img class="h-20px w-20px rounded-sm" :src="languageFlag || getLanguageFlag" alt=""/>
                </template>
                <b-dropdown-text tag="div" class="min-w-md-175px">
                    <KTDropdownLanguage
                        v-on:language-changed="onLanguageChanged"
                    ></KTDropdownLanguage>
                </b-dropdown-text>
            </b-dropdown>
        </div>
        <div class="d-flex flex-column flex-root h-100">
            <div class="login login-1 d-flex flex-column flex-lg-row flex-column-fluid bg-white"
                 :class="{
        'login-signin-on': this.state == 'signin',
        'login-signup-on': this.state == 'signup',
        'login-forgot-on': this.state == 'forgot'
        }" id="kt_login">
                <!--begin::Aside-->
                <div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #F2C98A;">
                    <div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
                        <a href="#" class="text-center mb-10">
                            <img
                                src="/media/logos/logo-letter-1.png"
                                class="max-h-70px"
                                alt=""
                            />
                        </a>
                        <h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #986923;">
                            {{ $t("AUTH.DETAILS.TITLE")}}
                            <br/>
                        </h3>
                    </div>
                    <div
                        class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"
                        :style="{ backgroundImage: `url(${backgroundImage})` }"
                    ></div>
                </div>
                <!--begin::Aside-->
                <!--begin::Content-->
                <div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
                    <div class="d-flex flex-column-fluid flex-center">
                        <!--begin::Signin-->
                        <div class="login-form login-signin">
                            <form class="form" novalidate="novalidate" id="kt_login_signin_form">
                                <div class="pb-13 pt-lg-0 pt-5">
                                    <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">
                                        {{ $t("AUTH.LOGIN.TITLE")}}
                                    </h3>
                                    <span class="text-muted font-weight-bold font-size-h4">
                                        {{ $t("AUTH.LOGIN.SUB_TITLE")}}
                                          <a id="kt_login_signup" class="text-primary font-weight-bolder" @click="showForm('signup')" style="cursor: pointer">
                                              {{$t("AUTH.LOGIN.CREATE_SCHOOL")}}
                                          </a>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label class="font-size-h6 font-weight-bolder text-dark"
                                    >{{$t("AUTH.INPUT.USERNAME")}}</label
                                    >
                                    <div
                                        id="example-input-group-1"
                                        label=""
                                        label-for="example-input-1"
                                    >
                                        <input
                                            class="form-control form-control-solid h-auto py-7 px-6 rounded-lg"
                                            type="text"
                                            name="username"
                                            ref="rusername"
                                            v-model="form.username"
                                        />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="d-flex justify-content-between mt-n5">
                                        <label class="font-size-h6 font-weight-bolder text-dark pt-5"
                                        >{{$t("AUTH.INPUT.PASSWORD")}}</label
                                        >
                                        <a
                                            class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5"
                                            id="kt_login_forgot"
                                            @click="showForm('forgot')"
                                            style="cursor: pointer"
                                        >{{$t("AUTH.GENERAL.FORGOT_BUTTON")}}</a
                                        >
                                    </div>
                                    <div
                                        id="example-input-group-2"
                                        label=""
                                        label-for="example-input-2"
                                    >
                                        <input
                                            class="form-control form-control-solid h-auto py-7 px-6 rounded-lg"
                                            type="password"
                                            name="password"
                                            ref="rpassword"
                                            v-model="form.password"
                                            autocomplete="off"
                                        />
                                    </div>
                                </div>
                                <div class="pb-lg-0 pb-5">
                                    <button ref="kt_login_signin_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-15 py-4 my-3 mr-3">
                                        {{$t("AUTH.LOGIN.BUTTON")}}
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!--end::Signin-->
                        <!--begin::Signup-->
                        <div class="login-form login-signup">
                            <form class="form" novalidate="novalidate" id="kt_login_signup_form">
                                <div class="pb-13 pt-lg-0 pt-5">
                                    <h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">
                                        {{$t("SCHOOL.CREATE.TITLE")}}
                                    </h3>
                                    <p class="text-muted font-weight-bold font-size-h4">
                                        {{$t("SCHOOL.CREATE.SUB_TITLE")}}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <input
                                        class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                                        type="text"
                                        :placeholder="$t('SCHOOL.INPUT.NAME')"
                                        name="name"
                                        ref="rname"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group">
                                    <input
                                        class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                                        type="text"
                                        :placeholder="$t('SCHOOL.INPUT.DESCRIPTION')"
                                        name="description"
                                        ref="rdescription"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group">
                                    <input
                                        class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                                        type="text"
                                        :placeholder="$t('SCHOOL.INPUT.COUNTRY')"
                                        name="country"
                                        ref="rcountry"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group">
                                    <input
                                        class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                                        type="text"
                                        :placeholder="$t('SCHOOL.INPUT.CITY')"
                                        name="city"
                                        ref="rcity"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group">
                                    <input
                                        class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                                        type="text"
                                        :placeholder="$t('SCHOOL.INPUT.ADDRESS')"
                                        name="address"
                                        ref="raddress"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group">
                                    <input
                                        class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                                        type="file"
                                        :placeholder="$t('SCHOOL.INPUT.LOGO')"
                                        name="logo"
                                        ref="rlogo"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group">
                                    <select class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                                        name="language"
                                        ref="rlanguage"
                                        autocomplete="off"
                                    >
                                        <option selected>{{$t('SCHOOL.INPUT.LANG')}}</option>
                                        <option value="ar">العربية</option>
                                        <option value="en">الانجليزية</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="checkbox mb-0">
                                        <input type="checkbox" name="agree"/>
                                        <span class="mr-2"></span>
                                        {{ $t('SCHOOL.INPUT.AGREE') }}
                                        <a class="ml-2"> {{ $t('SCHOOL.INPUT.CONDITIONS') }}</a>.
                                    </label>
                                </div>
                                <div class="form-group d-flex flex-wrap pb-lg-0 pb-3">
                                    <button
                                        ref="kt_login_signup_submit"
                                        class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4"
                                        style="width:150px;"
                                    >
                                        {{ $t('AUTH.GENERAL.SUBMIT_BUTTON') }}
                                    </button>
                                    <button
                                        type="button"
                                        id="kt_login_signup_cancel"
                                        class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3"
                                        @click="showForm('signin')"
                                    >
                                        {{ $t('AUTH.GENERAL.CANCEL') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!--end::Signup-->
                        <!--begin::Forgot-->
                        <div class="login-form login-forgot">
                            <!--begin::Form-->
                            <form
                                class="form"
                                novalidate="novalidate"
                                id="kt_login_forgot_form"
                                ref="kt_login_forgot_form"
                            >
                                <div class="pb-13 pt-lg-0 pt-5">
                                    <h3
                                        class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg"
                                    >
                                        {{$t('AUTH.FORGOT.TITLE')}}

                                    </h3>
                                    <p class="text-muted font-weight-bold font-size-h4">
                                        {{$t('AUTH.FORGOT.DESC')}}
                                    </p>
                                </div>
                                <div class="form-group">
                                    <input
                                        class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6"
                                        type="text"
                                        placeholder="username"
                                        name="username"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group d-flex flex-wrap pb-lg-0">
                                    <button
                                        type="button"
                                        id="kt_login_forgot_submit"
                                        class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4"
                                    >
                                        Submit
                                    </button>
                                    <button
                                        type="button"
                                        id="kt_login_forgot_cancel"
                                        class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3"
                                        @click="showForm('signin')"
                                    >
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!--end::Forgot-->
                    </div>

                </div>
                <!--end::Content-->
            </div>
        </div>
    </div>
</template>

<script>
import formValidation from "../../plugins/formvalidation/dist/es6/core/Core";

// FormValidation plugins
import Trigger from "../../plugins/formvalidation/dist/es6/plugins/Trigger";
import Bootstrap from "../../plugins/formvalidation/dist/es6/plugins/Bootstrap";
import SubmitButton from "../../plugins/formvalidation/dist/es6/plugins/SubmitButton";

import KTUtil from "../../helper/util";
import {mapGetters, mapState} from "vuex";
import {LOGIN, REGISTER} from "../../store/auth.module";
import Swal from "sweetalert2";
import i18nService from "../../services/i18n.service.js";
import KTDropdownLanguage from "../layout/extras/dropdown/DropdownLanguage";
import Wizard3 from "./wizard/Wizard-3";


export default {
    name: "login-1",
    components: {Wizard3, KTDropdownLanguage},
    data() {
        return {
            state: "signin",
            // Remove this dummy login info
            form: {
                username: "admin",
                password: "password"
            },
            languageFlag: "",
            languages: i18nService.languages
        };
    },
    computed: {
        ...mapState({
            errors: state => state.auth.errors
        }),
        ...mapGetters(["currentUser"]),

        backgroundImage() {
            return ("./media/svg/illustrations/login-visual-1.svg");
        },
        getLanguageFlag() {
            return this.onLanguageChanged();
        }
    },
    mounted() {
        const signin_form = KTUtil.getById("kt_login_signin_form");
        const signup_form = KTUtil.getById("kt_login_signup_form");
        const forgot_form = KTUtil.getById("kt_login_forgot_form");

        this.fv = formValidation(signin_form, {
            fields: {
                username: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.REQUIRED',{name:this.$t('AUTH.INPUT.USERNAME')})
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.REQUIRED',{name:this.$t('AUTH.INPUT.PASSWORD')})
                        }
                    }
                }
            },
            plugins: {
                trigger: new Trigger(),
                submitButton: new SubmitButton(),
                bootstrap: new Bootstrap()
            }
        });

        this.fv1 = formValidation(signup_form, {
            fields: {
                name: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.REQUIRED',{name:this.$t('SCHOOL.INPUT.NAME')})
                        }
                    }
                },
                description: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.REQUIRED',{name:this.$t('SCHOOL.INPUT.DESCRIPTION')})
                        }
                    }
                },
                country: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.REQUIRED',{name:this.$t('SCHOOL.INPUT.COUNTRY')})
                        }
                    }
                },
                city: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.REQUIRED',{name:this.$t('SCHOOL.INPUT.CITY')})
                        }
                    }
                },
                address: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.REQUIRED',{name:this.$t('SCHOOL.INPUT.ADDRESS')})
                        }
                    }
                },
                logo: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.REQUIRED',{name:this.$t('SCHOOL.INPUT.LOGO')})
                        }
                    }
                },
                language: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.REQUIRED',{name:this.$t('SCHOOL.INPUT.LANG')})
                        }
                    }
                },
                agree: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.AGREEMENT_REQUIRED')
                        }
                    }
                }
            },
            plugins: {
                trigger: new Trigger(),
                submitButton: new SubmitButton(),
                bootstrap: new Bootstrap()
            }
        });

        this.fv2 = formValidation(forgot_form, {
            fields: {
                username: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.REQUIRED',{name:this.$t('AUTH.INPUT.USERNAME')})
                        },
                    }
                }
            },
            plugins: {
                trigger: new Trigger(),
                submitButton: new SubmitButton(),
                bootstrap: new Bootstrap()
            }
        });

        this.fv.on("core.form.valid", () => {
            var username = this.form.username;
            var password = this.form.password;


            // set spinner to submit button
            const submitButton = this.$refs["kt_login_signin_submit"];
            submitButton.classList.add("spinner", "spinner-light", "spinner-right");

            // dummy delay
            setTimeout(() => {
                // send login request
                this.$store.dispatch(LOGIN, {username, password})
                    // go to which page after successfully login
                    .then(() => this.$router.push({name: "dashboard"}))
                    .catch(() => {

                    });

                submitButton.classList.remove(
                    "spinner",
                    "spinner-light",
                    "spinner-right"
                );
            }, 2000);
        });

        this.fv.on("core.form.invalid", () => {
            Swal.fire({
                title: "",
                text: "Please, provide correct data!",
                icon: "error",
                confirmButtonClass: "btn btn-secondary",
                heightAuto: false
            });
        });

        this.fv1.on("core.form.valid", () => {
            const name = this.$refs.rname.value;
            const description = this.$refs.rdescription.value;
            const country = this.$refs.rcountry.value;
            const city = this.$refs.rcity.value;
            const address = this.$refs.raddress.value;
            const logo = this.$refs.rlogo.value;
            const language = this.$refs.rlanguage.value;

            // set spinner to submit button
            const submitButton = this.$refs["kt_login_signup_submit"];
            submitButton.classList.add("spinner", "spinner-light", "spinner-right");

            // dummy delay
            setTimeout(() => {
                // send register request
                this.$store.dispatch(REGISTER, {
                        name: name,
                        description: description,
                        country: country,
                        city: city,
                        address: address,
                        logo: logo,
                        language: language,
                    }).then(() => this.$router.push({name: "dashboard"}));

                submitButton.classList.remove(
                    "spinner",
                    "spinner-light",
                    "spinner-right"
                );
            }, 2000);
        });

        this.fv1.on("core.form.invalid", () => {
            Swal.fire({
                title: "",
                text: "Please, provide correct data!",
                icon: "error",
                confirmButtonClass: "btn btn-secondary",
                heightAuto: false
            });
        });
    },
    methods: {
        showForm(form) {
            this.state = form;
            var form_name = "kt_login_" + form + "_form";
            KTUtil.animateClass(
                KTUtil.getById(form_name),
                "animate__animated animate__backInUp"
            );
        },
        onLanguageChanged() {
            this.languageFlag = this.languages.find(val => {
                return val.lang === i18nService.getActiveLanguage();
            }).flag;
        }
    }
};
</script>

<style lang="scss">
.topbar {
    .dropdown-toggle {
        padding: 0;
        &:hover {
            text-decoration: none;
        }

        &.dropdown-toggle-no-caret {
            &:after {
                content: none;
            }
        }
    }

    .dropdown-menu {
        margin: 0;
        padding: 0;
        outline: none;
        .b-dropdown-text {
            padding: 0;
        }
    }
}
@import "../../../sass/pages/login/login-1";
</style>
