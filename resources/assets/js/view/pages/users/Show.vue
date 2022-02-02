<template>
    <div class="card card-custom">
        <div class="card-body p-0">
            <!--begin: Wizard-->
            <div class="wizard wizard-3" id="kt_wizard_v3" data-wizard-state="step-first" data-wizard-clickable="true">
                <!--begin: Wizard Nav -->
                <div class="wizard-nav border-bottom mb-1 mb-lg-5">
                    <div class="wizard-steps px-8 py-8 px-lg-15 py-lg-3">
                        <div
                            class="wizard-step"
                            data-wizard-type="step"
                            data-wizard-state="current"
                        >
                            <div class="wizard-label">
                                <h3 class="wizard-title">{{$t('USERS.ADD.NAV.PERSONAL_INFO.TITLE')}}</h3>
                                <div class="wizard-bar"></div>
                            </div>
                        </div>
                        <div class="wizard-step" data-wizard-type="step">
                            <div class="wizard-label">
                                <h3 class="wizard-title">{{$t('USERS.ADD.NAV.ACCOUNT_INFO.TITLE')}}</h3>
                                <div class="wizard-bar"></div>
                            </div>
                        </div>
                        <div class="wizard-step" data-wizard-type="step">
                            <div class="wizard-label">
                                <h3 class="wizard-title">{{$t('USERS.ADD.NAV.CHANGE_PASSWORD.TITLE')}}</h3>
                                <div class="wizard-bar"></div>
                            </div>
                        </div>
                        <div v-if="false" class="wizard-step" data-wizard-type="step">
                            <div class="wizard-label">
                                <h3 class="wizard-title">{{$t('USERS.ADD.NAV.CHANGE_PERMISSIONS.TITLE')}}</h3>
                                <div class="wizard-bar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end: Wizard Nav -->

                <!--begin: Wizard Body-->
                <div class="row justify-content-center py-12 px-8 py-lg-15 px-lg-10">
                    <div class="col-xl-12 col-xxl-7">
                        <!--begin: Wizard Step 1-->
                        <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                            <div class="form-group">
                                <div class="image-input image-input-outline image-input-changed" id="kt_user_add_avatar">
                                    <div v-if="isImageSelected" ref="previewImage" class="image-input-wrapper" :style="'background-image:url(\''+imageUrl+'\')'"></div>
                                    <div v-else-if="imagePath" ref="previewImage" class="image-input-wrapper" :style="'background-image:url(\'./storage/'+imagePath+'\')'"></div>
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
                                    :placeholder="$t('USERS.ADD.NAV.PERSONAL_INFO.FROM.MIDDLE_NAME_PLACEHOLDER')"
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
                            <button @click="update(user.id)" class="btn btn-primary font-weight-bold text-uppercase px-9 py-4">
                                {{$t('BUTTONS.SAVE')}}
                            </button>
                        </div>
                        <!--end: Wizard Step 1-->

                        <!--begin: Wizard Step 2-->
                        <div class="pb-5" data-wizard-type="step-content">
                            <div class="form-group">
                                <label>{{$t('USERS.ADD.NAV.ACCOUNT_INFO.FROM.TYPE')}}</label>
                                <select name="type" ref="rType" v-model="user.type" class="form-control form-control-solid form-control-lg">
                                    <option value="">{{$t('USERS.ADD.NAV.ACCOUNT_INFO.FROM.TYPE')}}</option>
                                    <option value="teacher">{{$t('USERS.TYPES.TEACHER')}}</option>
                                    <option value="assistant">{{$t('USERS.TYPES.ASSISTANT')}}</option>
                                    <option value="parent">{{$t('USERS.TYPES.PARENT')}}</option>
                                    <option value="student">{{$t('USERS.TYPES.STUDENT')}}</option>
                                </select>
                            </div>
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
                            <button @click="update(user.id)" class="btn btn-primary font-weight-bold text-uppercase px-9 py-4">
                                {{$t('BUTTONS.SAVE')}}
                            </button>
                        </div>
                        <!--end: Wizard Step 2-->

                        <!--begin: Wizard Step 3-->
                        <div class="pb-5" data-wizard-type="step-content">
                            <div class="form-group">
                                <label>{{$t('USERS.ADD.NAV.ACCOUNT_INFO.FROM.PASSWORD')}}</label>
                                <div class="input-group">
                                    <input type="text"
                                           class="form-control form-control-solid form-control-lg"
                                           name="password"
                                           ref="rPassword"
                                           :placeholder="$t('USERS.ADD.NAV.ACCOUNT_INFO.FROM.PASSWORD')"
                                    />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>{{$t('AUTH.INPUT.CONFIRM_PASSWORD')}}</label>
                                <div class="input-group">
                                    <input type="text"
                                           class="form-control form-control-solid form-control-lg"
                                           name="password"
                                           ref="rPassword"
                                           :placeholder="$t('AUTH.INPUT.CONFIRM_PASSWORD')"
                                    />
                                </div>
                            </div>
                            <button class="btn btn-primary font-weight-bold text-uppercase px-9 py-4">
                                {{$t('BUTTONS.SAVE')}}
                            </button>
                        </div>
                        <!--end: Wizard Step 3-->

                        <!--begin: Wizard Step 4-->
                        <div v-if="false" class="pb-5" data-wizard-type="step-content">

                        </div>
                        <!--end: Wizard Step 4-->
                    </div>
                </div>
                <!--end: Wizard Body-->
            </div>
            <!--end: Wizard-->
        </div>
    </div>
</template>

<style lang="scss">
@import "../../../../sass/pages/wizard/wizard-3.scss";
</style>

<script>
import { SET_BREADCRUMB } from "../../../store/breadcrumbs.module";
import KTUtil from "../../../helper/util";
import KTWizard from "../../../helper/wizard";
import Swal from "sweetalert2";
import {SET_ACTION_BUTTON_CONFIG} from "../../../store/config.module";
import {mapGetters} from "vuex";
import ApiService from "../../../services/api.service";

export default {
    name: "Show",
    data() {
        return {
            isImageSelected: false,
            imageUrl: '',
            user:'',
            imagePath:'',
        };
    },
    mounted() {
        this.show()
        this.$store.dispatch(SET_BREADCRUMB, [
            { title: this.$t('USERS.TITLE'), route: "users" },
            { title: this.$t('USERS.SHOW.TITLE') },
        ]);
        this.$store.dispatch(SET_ACTION_BUTTON_CONFIG, { display: false,title:this.$t('MENU.NEW'),route:'/users/add' });

        // Initialize form wizard
        const wizard = new KTWizard("kt_wizard_v3", {
            startStep: 1, // initial active step number
            clickableSteps: true // allow step clicking
        });

    },
    methods: {
        show(){
            ApiService.get('api/v1/user/'+this.$route.params.id).then(({data})=>{
                this.user = data
                this.imagePath = data.image
            })

        },
        update(id){
            let data = new FormData();
            data.append('image', this.user.image)
            data.append('email', this.user.email)
            data.append('type', this.user.type)
            data.append('birth_date', this.user.birth_date)
            data.append('mobile_number', this.user.mobile_number)
            data.append('telephone_number', this.user.telephone_number)
            data.append('first_name', this.user.first_name)
            data.append('middle_name', this.user.middle_name)
            data.append('last_name', this.user.last_name)
            data.append('academic', this.user.academic)
            data.append('_method', 'put')
            ApiService.post('api/v1/user/'+id,data).then(({data})=>{
                this.$toast.success(data.message)
            })
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
