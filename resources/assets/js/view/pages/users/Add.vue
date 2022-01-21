<template>
    <div class="card card-custom">
        <div class="card-body p-0">
            <!--begin: Wizard-->
            <div class="wizard wizard-2" id="kt_wizard_v2" data-wizard-state="step-first" data-wizard-clickable="true">
                <!--begin: Wizard Nav -->
                <div class="wizard-nav border-right py-8 px-8 py-lg-20 px-lg-10">
                    <div class="wizard-steps">
                        <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                            <div class="wizard-wrapper">
                                <div class="wizard-icon">
                              <span class="svg-icon svg-icon-2x">
                                <inline-svg src="media/svg/icons/General/User.svg" />
                              </span>
                                </div>
                                <div class="wizard-label">
                                    <h3 class="wizard-title">
                                        {{$t('USERS.ADD.NAV.PERSONAL_INFO.TITLE')}}
                                    </h3>
                                    <div class="wizard-desc">
                                        {{$t('USERS.ADD.NAV.PERSONAL_INFO.SUB_TITLE')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wizard-step" data-wizard-type="step">
                            <div class="wizard-wrapper">
                                <div class="wizard-icon">
                  <span class="svg-icon svg-icon-2x">
                    <inline-svg src="media/svg/icons/Map/Compass.svg" />
                  </span>
                                </div>
                                <div class="wizard-label">
                                    <h3 class="wizard-title">
                                        {{$t('USERS.ADD.NAV.ADDRESS_INFO.TITLE')}}
                                    </h3>
                                    <div class="wizard-desc">
                                        {{$t('USERS.ADD.NAV.ADDRESS_INFO.SUB_TITLE')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wizard-step" data-wizard-type="step">
                            <div class="wizard-wrapper">
                                <div class="wizard-icon">
                  <span class="svg-icon svg-icon-2x">
                    <inline-svg
                        src="media/svg/icons/General/Thunder-move.svg"
                    />
                  </span>
                                </div>
                                <div class="wizard-label">
                                    <h3 class="wizard-title">
                                        {{$t('USERS.ADD.NAV.CONTACT_INFO.TITLE')}}
                                    </h3>
                                    <div class="wizard-desc">
                                        {{$t('USERS.ADD.NAV.CONTACT_INFO.SUB_TITLE')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wizard-step" data-wizard-type="step">
                            <div class="wizard-wrapper">
                                <div class="wizard-icon">
                  <span class="svg-icon svg-icon-2x">
                    <inline-svg src="media/svg/icons/Map/Position.svg" />
                  </span>
                                </div>
                                <div class="wizard-label">
                                    <h3 class="wizard-title">
                                        {{$t('USERS.ADD.NAV.ACCOUNT_INFO.TITLE')}}
                                    </h3>
                                    <div class="wizard-desc">
                                        {{$t('USERS.ADD.NAV.ACCOUNT_INFO.SUB_TITLE')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="wizard-step" data-wizard-type="step">
                            <div class="wizard-wrapper">
                                <div class="wizard-icon">
                  <span class="svg-icon svg-icon-2x">
                    <inline-svg src="media/svg/icons/General/Like.svg" />
                  </span>
                                </div>
                                <div class="wizard-label">
                                    <h3 class="wizard-title">
                                        {{$t('USERS.ADD.NAV.COMPLETED.TITLE')}}
                                    </h3>
                                    <div class="wizard-desc">
                                        {{$t('USERS.ADD.NAV.COMPLETED.SUB_TITLE')}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end: Wizard Nav -->

                <!--begin: Wizard Body -->
                <div class="wizard-body py-8 px-8 py-lg-20 px-lg-10">
                    <!--begin: Wizard Form-->
                    <div class="row">
                        <div class="offset-xxl-2 col-xxl-8">
                            <form class="form" novalidate="novalidate" id="kt_form_add_user">
                                <!--begin: Wizard Step 1-->
                                <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                    <div class="form-group">
                                        <div class="image-input image-input-outline image-input-changed" id="kt_user_add_avatar">
                                            <div ref="previewImage" class="image-input-wrapper" :style="'background-image:url(\''+imageUrl+'\')'"></div>
                                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change"
                                                   data-toggle="tooltip" title="" data-original-title="Change avatar">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" @change="imageSelected($event)" ref="rImage" name="image" accept=".png, .jpg, .jpeg">
                                            </label>
                                            <span v-if="isImageSelected" @click="deleteSelectedImage()"
                                                  class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel"
                                                  data-toggle="tooltip" title="" data-original-title="Cancel avatar">
            <i class="ki ki-bold-close icon-xs text-muted"></i>
        </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ $t('USERS.ADD.NAV.PERSONAL_INFO.FROM.FIRST_NAME') }}</label>
                                        <input
                                            type="text"
                                            class="form-control form-control-solid form-control-lg"
                                            name="first_name"
                                            ref="rFirst_name"
                                            v-model="user.first_name"
                                            :placeholder="$t('USERS.ADD.NAV.PERSONAL_INFO.FROM.FIRST_NAME')"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>{{ $t('USERS.ADD.NAV.PERSONAL_INFO.FROM.MIDDLE_NAME') }}</label>
                                        <input
                                            type="text"
                                            class="form-control form-control-solid form-control-lg"
                                            name="middle_name"
                                            ref="rMiddle_name"
                                            v-model="user.middle_name"
                                            :placeholder="$t('USERS.ADD.NAV.PERSONAL_INFO.FROM.MIDDLE_NAME')"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>{{ $t('USERS.ADD.NAV.PERSONAL_INFO.FROM.LAST_NAME') }}</label>
                                        <input
                                            type="text"
                                            class="form-control form-control-solid form-control-lg"
                                            name="last_name"
                                            ref="rLast_name"
                                            v-model="user.last_name"
                                            :placeholder="$t('USERS.ADD.NAV.PERSONAL_INFO.FROM.LAST_NAME')"
                                        />
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>{{ $t('USERS.ADD.NAV.PERSONAL_INFO.FROM.BIRTH_DATE') }}</label>
                                                <input
                                                    type="date"
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="birth_date"
                                                    ref="rBirth_date"
                                                    v-model="user.birth_date"
                                                    :placeholder="$t('USERS.ADD.NAV.PERSONAL_INFO.FROM.BIRTH_DATE')"
                                                />
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group">
                                                <label>{{ $t('USERS.ADD.NAV.PERSONAL_INFO.FROM.ACADEMIC') }}</label>
                                                <input
                                                    type="text"
                                                    class="form-control form-control-solid form-control-lg"
                                                    name="academic"
                                                    ref="rAcademic"
                                                    v-model="user.academic"
                                                    :placeholder="$t('USERS.ADD.NAV.PERSONAL_INFO.FROM.ACADEMIC')"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end: Wizard Step 1-->

                                <!--begin: Wizard Step 2-->
                                <div class="pb-5" data-wizard-type="step-content">
                                    <div class="form-group">
                                        <label>{{$t('USERS.ADD.NAV.ADDRESS_INFO.FROM.COUNTRY')}}</label>
                                        <input type="text"
                                            class="form-control form-control-solid form-control-lg"
                                            name="country"
                                               ref="rCountry"
                                               v-model="user.country"
                                            :placeholder="$t('USERS.ADD.NAV.ADDRESS_INFO.FROM.COUNTRY')"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>{{$t('USERS.ADD.NAV.ADDRESS_INFO.FROM.CITY')}}</label>
                                        <input type="text"
                                               class="form-control form-control-solid form-control-lg"
                                               name="city"
                                               ref="rCity"
                                               v-model="user.city"
                                               :placeholder="$t('USERS.ADD.NAV.ADDRESS_INFO.FROM.CITY')"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>{{$t('USERS.ADD.NAV.ADDRESS_INFO.FROM.ADDRESS')}}</label>
                                        <input type="text"
                                               class="form-control form-control-solid form-control-lg"
                                               name="address"
                                               ref="rAddress"
                                               v-model="user.address"
                                               :placeholder="$t('USERS.ADD.NAV.ADDRESS_INFO.FROM.ADDRESS')"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>{{$t('USERS.ADD.NAV.ADDRESS_INFO.FROM.NATIONALITY')}}</label>
                                        <input type="text"
                                               class="form-control form-control-solid form-control-lg"
                                               name="nationality"
                                               ref="rNationality"
                                               v-model="user.nationality"
                                               :placeholder="$t('USERS.ADD.NAV.ADDRESS_INFO.FROM.NATIONALITY')"
                                        />
                                    </div>
                                </div>
                                <!--end: Wizard Step 2-->

                                <!--begin: Wizard Step 3-->
                                <div class="pb-5" data-wizard-type="step-content">
                                    <div class="form-group">
                                        <label>{{$t('USERS.ADD.NAV.CONTACT_INFO.FROM.EMAIL')}}</label>
                                        <input type="email"
                                               class="form-control form-control-solid form-control-lg"
                                               name="email"
                                               ref="rEmail"
                                               v-model="user.email"
                                               :placeholder="$t('USERS.ADD.NAV.CONTACT_INFO.FROM.EMAIL')"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>{{$t('USERS.ADD.NAV.CONTACT_INFO.FROM.MOBILE')}}</label>
                                        <input type="number"
                                               class="form-control form-control-solid form-control-lg"
                                               name="mobile_number"
                                               ref="rMobile_number"
                                               v-model="user.mobile_number"
                                               :placeholder="$t('USERS.ADD.NAV.CONTACT_INFO.FROM.MOBILE')"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>{{$t('USERS.ADD.NAV.CONTACT_INFO.FROM.TELEPHONE')}}</label>
                                        <input type="number"
                                               class="form-control form-control-solid form-control-lg"
                                               name="telephone_number"
                                               ref="rTelephone_number"
                                               v-model="user.telephone_number"
                                               :placeholder="$t('USERS.ADD.NAV.CONTACT_INFO.FROM.TELEPHONE')"
                                        />
                                    </div>
                                </div>
                                <!--end: Wizard Step 3-->

                                <!--begin: Wizard Step 4-->
                                <div class="pb-5" data-wizard-type="step-content">
                                    <div class="form-group">
                                        <label>{{$t('USERS.ADD.NAV.ACCOUNT_INFO.FROM.TYPE')}}</label>
                                        <select name="type" ref="rType" v-model="user.type" class="form-control form-control-solid form-control-lg">
                                            <option>{{$t('USERS.ADD.NAV.ACCOUNT_INFO.FROM.TYPE')}}</option>
                                            <option value="teacher">{{$t('USERS.TYPES.TEACHER')}}</option>
                                            <option value="assistant">{{$t('USERS.TYPES.ASSISTANT')}}</option>
                                            <option value="parent">{{$t('USERS.TYPES.PARENT')}}</option>
                                            <option value="student">{{$t('USERS.TYPES.STUDENT')}}</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>{{$t('USERS.ADD.NAV.ACCOUNT_INFO.FROM.PASSWORD')}}</label>
                                       <div class="input-group">
                                           <input type="text"
                                                  class="form-control form-control-solid form-control-lg"
                                                  name="password"
                                                  ref="rPassword"
                                                  v-model="user.password"
                                                  :placeholder="$t('USERS.ADD.NAV.ACCOUNT_INFO.FROM.PASSWORD')"
                                           />
                                           <div class="input-group-append">
                                               <button @click="generatePassword()" class="btn btn-success" type="button">{{$t('USERS.ADD.NAV.ACCOUNT_INFO.FROM.GENERATE')}}</button>
                                           </div>
                                       </div>
                                    </div>
                                </div>
                                <!--end: Wizard Step 4-->

                                <!--begin: Wizard Step 5-->
                                <div class="pb-5" data-wizard-type="step-content">
                                    <div class="border-bottom mb-5 pb-5">
                                        <div class="font-weight-bold mb-3">
                                            {{ $t('USERS.ADD.NAV.PERSONAL_INFO.TITLE') }}
                                        </div>
                                        <div class="line-height-md">
                                            {{user.first_name + ' ' + user.middle_name + ' ' + user.last_name}}<br/>
                                            {{user.birth_date}}<br/>
                                            {{user.academic}}
                                        </div>
                                    </div>
                                    <div class="border-bottom mb-5 pb-5">
                                        <div class="font-weight-bold mb-3">
                                            {{ $t('USERS.ADD.NAV.ADDRESS_INFO.TITLE') }}
                                        </div>
                                        <div class="line-height-md">
                                            {{user.nationality }}<br/>
                                            {{user.address}}<br/>
                                            {{user.city+', '+user.country}}
                                        </div>
                                    </div>
                                    <div class="border-bottom mb-5 pb-5">
                                        <div class="font-weight-bold mb-3">
                                            {{ $t('USERS.ADD.NAV.CONTACT_INFO.TITLE') }}
                                        </div>
                                        <div class="line-height-md">
                                            {{user.email }}<br/>
                                            {{user.mobile_number}}<br/>
                                            {{user.telephone_number}}
                                        </div>
                                    </div>
                                    <div class="border-bottom mb-5 pb-5">
                                        <div class="font-weight-bold mb-3">
                                            {{ $t('USERS.ADD.NAV.ACCOUNT_INFO.TITLE') }}
                                        </div>
                                        <div class="line-height-md">
                                            {{user.type }}<br/>
                                            {{user.password}}<br/>
                                        </div>
                                    </div>
                                </div>
                                <!--end: Wizard Step 5-->

                                <!--begin: Wizard Actions -->
                                <div class="d-flex justify-content-between border-top pt-10">
                                    <div class="mr-2">
                                        <button
                                            class="btn btn-light-primary font-weight-bold text-uppercase px-9 py-4"
                                            data-wizard-type="action-prev"
                                        >
                                            {{$t('MENU.PREVIOUS')}}
                                        </button>
                                    </div>
                                    <div>
                                        <button
                                            ref="kt_add_user_submit"
                                            type="submit"
                                            class="btn btn-success font-weight-bold text-uppercase px-9 py-4"
                                            data-wizard-type="action-submit"
                                        >
                                            {{$t('MENU.SUBMIT')}}
                                        </button>
                                        <button
                                            class="btn btn-primary font-weight-bold text-uppercase px-9 py-4"
                                            data-wizard-type="action-next"
                                        >
                                            {{$t('MENU.NEXT')}}
                                        </button>
                                    </div>
                                </div>
                                <!--end: Wizard Actions -->
                            </form>
                        </div>
                        <!--end: Wizard-->
                    </div>
                </div>
                <!--end: Wizard Body -->
            </div>
            <!--end: Wizard-->
        </div>
    </div>
</template>

<style lang="scss">
    @import "../../../../sass/pages/wizard/wizard-2.scss";
</style>

<script>
import { SET_BREADCRUMB } from "../../../store/breadcrumbs.module";
import KTUtil from "../../../helper/util";
import KTWizard from "../../../helper/wizard";
import Swal from "sweetalert2";
import {SET_ACTION_BUTTON_CONFIG} from "../../../store/config.module";
import ImagePicker from "../vue-bootstrap/ImagePicker";
import formValidation from "../../../plugins/formvalidation/dist/es6/core/Core";
import Trigger from "../../../plugins/formvalidation/dist/es6/plugins/Trigger";
import SubmitButton from "../../../plugins/formvalidation/dist/es6/plugins/SubmitButton";
import Bootstrap from "../../../plugins/formvalidation/dist/es6/plugins/Bootstrap";
import {LOGIN} from "../../../store/auth.module";
import apiService from "../../../services/api.service";
import {mapGetters} from "vuex";


export default {
    name: "Add",
    components: {ImagePicker},
    data() {
        return {
            isImageSelected: false,
            imageUrl: '',
            user:{
                email:'',
                password:'',
                type:'',
                nationality:'',
                country:'',
                city:'',
                address:'',
                birth_date:'',
                mobile_number:'',
                telephone_number:'',
                image:'',
                first_name:'',
                middle_name:'',
                last_name:'',
                academic:''
            }
        };
    },
    mounted() {
        // Initialize form wizard
        const wizard = new KTWizard("kt_wizard_v2", {
            startStep: 1, // initial active step number
            clickableSteps: true // allow step clicking
        });

        const add_form = KTUtil.getById("kt_form_add_user");
        this.fv = formValidation(add_form, {
            fields: {
                email: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.REQUIRED',{name:this.$t('USERS.ADD.NAV.CONTACT_INFO.FROM.EMAIL')})
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.REQUIRED',{name:this.$t('USERS.ADD.NAV.ACCOUNT_INFO.FROM.PASSWORD')})
                        }
                    }
                },
                type: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.REQUIRED',{name:this.$t('USERS.ADD.NAV.ACCOUNT_INFO.FROM.TYPE')})
                        }
                    }
                },
                country: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.REQUIRED',{name:this.$t('USERS.ADD.NAV.ADDRESS_INFO.FROM.COUNTRY')})
                        }
                    }
                },
                city: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.REQUIRED',{name:this.$t('USERS.ADD.NAV.ADDRESS_INFO.FROM.CITY')})
                        }
                    }
                },
                address: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.REQUIRED',{name:this.$t('USERS.ADD.NAV.ADDRESS_INFO.FROM.ADDRESS')})
                        }
                    }
                },
                birth_date: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.REQUIRED',{name:this.$t('USERS.ADD.NAV.PERSONAL_INFO.FROM.BIRTH_DATE')})
                        }
                    }
                },
                mobile_number: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.REQUIRED',{name:this.$t('USERS.ADD.NAV.CONTACT_INFO.FROM.MOBILE')})
                        }
                    }
                },
                first_name: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.REQUIRED',{name:this.$t('USERS.ADD.NAV.PERSONAL_INFO.FROM.FIRST_NAME')})
                        }
                    }
                },
                middle_name: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.REQUIRED',{name:this.$t('USERS.ADD.NAV.PERSONAL_INFO.FROM.MIDDLE_NAME')})
                        }
                    }
                },
                last_name: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.REQUIRED',{name:this.$t('USERS.ADD.NAV.PERSONAL_INFO.FROM.LAST_NAME')})
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
        this.fv.on("core.form.valid", () => {
            console.log(this.user.image)
            let data = new FormData;
            data.append('school_id',this.authUser.school_id)
            data.append('email',this.user.email)
            data.append('password',this.user.password)
            data.append('type',this.user.type)
            data.append('nationality',this.user.nationality)
            data.append('country',this.user.country)
            data.append('city',this.user.city)
            data.append('address',this.user.address)
            data.append('birth_date',this.user.birth_date)
            data.append('mobile_number',this.user.mobile_number)
            data.append('telephone_number',this.user.telephone_number)
            data.append('image',this.user.image)
            data.append('first_name',this.user.first_name)
            data.append('middle_name',this.user.middle_name)
            data.append('last_name',this.user.last_name)
            data.append('academic',this.user.academic)
            data.append('created_by',this.authUser.id)

            // set spinner to submit button
            const submitButton = this.$refs["kt_add_user_submit"];
            submitButton.classList.add("spinner", "spinner-light", "spinner-right");

            // dummy delay
            setTimeout(() => {
                // send add user request
                apiService.post('api/v1/user',data)
                    .then(({data}) => {
                        this.$toast.success(data.message);
                        this.user.first_name = ''
                        this.user.middle_name = ''
                        this.user.last_name = ''
                        this.user.academic = ''
                        this.user.birth_date = ''
                        this.user.type=''
                        this.user.password=''
                        wizard.goTo(1)
                    })
                    .catch(() => {
                        this.$toast.error(this.$t('MENU.ERROR'));
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
                text: this.$t('AUTH.VALIDATION.FORM_VALIDATION'),
                icon: "error",
                confirmButtonClass: "btn btn-secondary",
                heightAuto: false
            });
        });

        this.$store.dispatch(SET_BREADCRUMB, [
            { title: this.$t('USERS.TITLE'), route: "users" },
            { title: this.$t('USERS.ADD.TITLE') }
        ]);
        this.$store.dispatch(SET_ACTION_BUTTON_CONFIG, { display: false,title:this.$t('MENU.NEW'),route:'/users/add' });



        // Validation before going to next page
        wizard.on("beforeNext", function(/*wizardObj*/) {
            // validate the form and use below function to stop the wizard's step
            // wizardObj.stop();
        });

        // Change event
        wizard.on("change", function(wizardObj) {
            setTimeout(() => {
                KTUtil.scrollTop();
            }, 500);
        });
    },
    methods: {
        generatePassword(){
            this.user.password = Math.random().toString(36).slice(-8);
        },
        imageSelected(event) {
            const file = event.target.files[0];
            this.user.image = file
            this.imageUrl = URL.createObjectURL(file)
            this.isImageSelected = true
        },
        deleteSelectedImage() {
            this.user.image = ''
            this.imageUrl = ''
            this.isImageSelected = false
        }
    },
    computed: {
        ...mapGetters(["currentUser"]),

        authUser(){
            return this.currentUser
        }
    }
};
</script>
