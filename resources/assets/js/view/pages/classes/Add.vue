<template>
    <div class="card card-custom">
        <div class="card-body p-0">
            <!--begin: Wizard-->
            <div class="wizard wizard-2" id="kt_wizard_add_class" data-wizard-state="step-first" data-wizard-clickable="true">
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
                                        {{$t('CLASSES.ADD.NAV.GENERAL_INFO.TITLE')}}
                                    </h3>
                                    <div class="wizard-desc">
                                        {{$t('CLASSES.ADD.NAV.GENERAL_INFO.SUB_TITLE')}}
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
                                        {{$t('CLASSES.ADD.NAV.ADD_STUDENT.TITLE')}}
                                    </h3>
                                    <div class="wizard-desc">
                                        {{$t('CLASSES.ADD.NAV.ADD_STUDENT.SUB_TITLE')}}
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
                                        <label>{{ $t('CLASSES.ADD.NAV.GENERAL_INFO.FROM.NAME') }}</label>
                                        <input
                                            type="text"
                                            class="form-control form-control-solid form-control-lg"
                                            name="name"
                                            ref="rname"
                                            v-model="classForm.name"
                                            :placeholder="$t('CLASSES.ADD.NAV.GENERAL_INFO.FROM.NAME')"
                                        />
                                    </div>
                                    <div class="form-group">
                                        <label>{{ $t('CLASSES.ADD.NAV.GENERAL_INFO.FROM.TEACHER') }}</label>
                                        <Multiselect
                                            class="form-control form-control-solid form-control-lg"
                                            v-model="classForm.teacher_id"
                                            label="name"
                                            :close-on-select="true"
                                            :searchable="true"
                                            trackBy="name"
                                            :options="teachers"
                                        >
                                            <template v-slot:singlelabel="{ value }">
                                                <div class="form-control form-control-solid form-control-lg multiselect-single-label" style="right: 0;padding-right: 0">
                                                    <img class="mr-2 w-25px h-25px rounded-circle character-label-icon" :src="value.image">
                                                    <span class="mr-2">{{ value.name }}</span>
                                                </div>
                                            </template>
                                            <template v-slot:option="{ option }">
                                                <img class="w-30px h-30px rounded-circle" :src="option.image">
                                                <span class="mr-3">{{ option.name }}</span>
                                            </template>
                                        </Multiselect>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ $t('CLASSES.ADD.NAV.GENERAL_INFO.FROM.ASSISTANT') }}</label>
                                        <Multiselect
                                            v-model="classForm.assistants_ids"
                                            mode="tags"
                                            :close-on-select="false"
                                            :searchable="true"
                                            trackBy="name"
                                            :options="assistants"
                                            class="form-control form-control-solid form-control-lg"
                                        >
                                            <template v-slot:tag="{ option,handleTagRemove, disabled }">
                                                <div class="form-control-solid multiselect-tag is-user">
                                                    <img :src="option.image">
                                                    {{ option.name }}
                                                    <span v-if="!disabled" class="multiselect-tag-remove"
                                                          @mousedown.prevent="handleTagRemove(option, $event)">
                                                        <span class="multiselect-tag-remove-icon"></span>
                                                    </span>
                                                </div>
                                            </template>
                                            <template v-slot:option="{ option }">
                                                <img class="w-30px h-30px rounded-circle" :src="option.image">
                                                <span class="mr-3">{{ option.name }}</span>
                                            </template>
                                        </Multiselect>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ $t('CLASSES.ADD.NAV.GENERAL_INFO.FROM.CATEGORY') }}</label>
                                        <div class="row">
                                            <Multiselect :options="categories" v-model="classForm.categories_ids" :mode="'tags'" :searchable="true" class="col-8 form-control form-control-solid form-control-lg"></Multiselect>
                                            <a @click="toggleModal('rkt_modal_add_category')" class="col-3 btn btn-success">فئة جديدة</a>
                                        </div>
                                    </div>
                                </div>
                                <!--end: Wizard Step 1-->

                                <!--begin: Wizard Step 2-->
                                <div class="pb-5" data-wizard-type="step-content">
                                    <label>{{ $t('CLASSES.ADD.NAV.ADD_STUDENT.FROM.STUDENTS') }}</label>
                                    <Multiselect
                                        v-model="classForm.students_ids"
                                        mode="tags"
                                        :close-on-select="false"
                                        :searchable="true"
                                        trackBy="name"
                                        :options="students"
                                    >
                                        <template v-slot:tag="{ option,handleTagRemove, disabled }">
                                            <div class="multiselect-tag is-user">
                                                <img :src="option.image">
                                                {{ option.name }}
                                                <span v-if="!disabled" class="multiselect-tag-remove"
                                                      @mousedown.prevent="handleTagRemove(option, $event)">
                                                        <span class="multiselect-tag-remove-icon"></span>
                                                    </span>
                                            </div>
                                        </template>
                                        <template v-slot:option="{ option }">
                                            <img class="w-30px h-30px rounded-circle" :src="option.image">
                                            <span class="mr-3">{{ option.name }}</span>
                                        </template>
                                    </Multiselect>
                                </div>
                                <!--end: Wizard Step 2-->

                                <!--begin: Wizard Step 3-->
                                <div class="pb-5" data-wizard-type="step-content">
                                    <div class="border-bottom mb-5 pb-5">
                                        <div class="font-weight-bold mb-3">
                                            {{$t('CLASSES.ADD.NAV.GENERAL_INFO.TITLE')}}
                                            {{classForm.name}}
                                            <span v-for="user in teachers" v-if="user.id == classForm.teacher_id">{{user.first_name+' '+user.middle_name+' '+user.last_name}}</span>
                                        </div>
                                        <div class="line-height-md">
                                            {{classForm.name}}<br/>
                                            {{classForm.teacher_id}}<br/>
                                            {{classForm.assistants_ids}}<br/>
                                            {{classForm.categories_ids}}
                                        </div>
                                    </div>
                                    <div class="mb-5">
                                        <div class="font-weight-bold mb-3">
                                            {{$t('CLASSES.ADD.NAV.ADD_STUDENT.FROM.STUDENTS')}}
                                            <div class="line-height-md">
                                                {{classForm.students_ids}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end: Wizard Step 3-->

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
        <b-modal ref="rkt_modal_add_category" id="kt_modal_add_category" :title="$t('CATEGORY.MODAL_TITLE')">
            <div class="form-group">
                <label>{{ $t('CATEGORY.FORM.NAME') }}</label>
                <input
                    type="text"
                    class="form-control form-control-solid form-control-lg"
                    name="categoryName"
                    ref="rCategoryName"
                    v-model="category.name"
                    :placeholder="$t('CATEGORY.FORM.NAME')"
                />
            </div>
            <template #modal-footer="{ ok, cancel }">
                <b-button size="md" variant="success" @click="addCategory()">
                    {{ $t('MENU.SUBMIT') }}
                </b-button>
                <b-button size="md" variant="danger" @click="cancel()">
                    {{ $t('BUTTONS.CANCEL') }}
                </b-button>
            </template>
        </b-modal>
    </div>
</template>
<style>
.multiselect-tag.is-user {
    padding: 5px 8px;
    border-radius: 22px;
    background: #35495e;
    margin: 3px 3px 8px;
}

.multiselect-tag.is-user img {
    width: 18px;
    border-radius: 50%;
    height: 18px;
    margin-right: 8px;
    border: 2px solid #f3f6f9;
}

.multiselect-tag.is-user i:before {
    color: #f3f6f9;
    border-radius: 50%;;
}

.user-image {
    margin: 0 6px 0 0;
    border-radius: 50%;
    height: 22px;
}
</style>
<style lang="scss">
@import "../../../../sass/pages/wizard/wizard-2.scss";
@import "@vueform/multiselect/themes/default.scss";
</style>

<script>
import { SET_BREADCRUMB } from "../../../store/breadcrumbs.module";
import KTUtil from "../../../helper/util";
import KTWizard from "../../../helper/wizard";
import Swal from "sweetalert2";
import {SET_ACTION_BUTTON_CONFIG} from "../../../store/config.module";
import formValidation from "../../../plugins/formvalidation/dist/es6/core/Core";
import Trigger from "../../../plugins/formvalidation/dist/es6/plugins/Trigger";
import SubmitButton from "../../../plugins/formvalidation/dist/es6/plugins/SubmitButton";
import Bootstrap from "../../../plugins/formvalidation/dist/es6/plugins/Bootstrap";
import apiService from "../../../services/api.service";
import {mapGetters} from "vuex";
import Multiselect from '@vueform/multiselect/dist/multiselect.vue2.js'

export default {
    name: "Add",
    components: {
        Multiselect,
    },
    data() {
        return {
            value:[],
            teachers:[],
            assistants:[],
            students:[],
            categories:[],
            category:{
                name:'',
            },
            isImageSelected: false,
            imageUrl: '',
            classForm:{
                name:'',
                teacher_id:'',
                assistants_ids:[],
                categories_ids:[],
                students_ids:[],
            },
        };
    },
    mounted() {
        this.index()
        // Initialize form wizard
        const wizard = new KTWizard("kt_wizard_add_class", {
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
            { title: this.$t('CLASSES.TITLE'), route: "classes" },
            { title: this.$t('CLASSES.ADD.TITLE') }
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
        index(){
            this.getAvailable('teachers',this.teachers)
            this.getAvailable('assistants',this.assistants)
            this.getAvailable('students',this.students)
            this.getCategories()
        },
        getAvailable(type,array){
            array.length = 0
            apiService.get('api/v1/available/'+type).then(({data})=>{
                for (const user of data) {
                    array.push({
                        value: user.id,
                        name: user.first_name+' '+user.middle_name+' '+user.last_name,
                        image: user.image
                    })
                }
            })
        },
        getCategories(){
            this.categories.length = 0
            apiService.get('api/v1/category').then(({data})=>{
                for (const category of data) {
                    this.categories.push({
                        value: category.id,
                        label: category.name,
                    })
                }
            })
        },
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
        },
        toggleModal(ref) {
            this.$refs[ref].show();
        },
        addCategory(){
           if (!this.category.name){
                this.$toast.error('اسم الفئة مطلوب')
            }else{
                let data = {
                    name:this.category.name,
                    school_id: this.authUser.school_id
                }
                apiService.post('api/v1/category',data).then(()=>{
                    this.getCategories();
                    this.$toast.success(this.$t('CATEGORY.API.STORE.RESPONSE.SUCCESS'))
                })
            }
        }
    },
    computed: {
        ...mapGetters(["currentUser"]),

        authUser(){
            return this.currentUser
        }
    },
};

</script>
