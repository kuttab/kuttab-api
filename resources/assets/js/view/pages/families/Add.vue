<template>
    <div class="card card-custom">
        <div class="card-body p-0">
            <!--begin: Wizard-->
            <div class="wizard wizard-2" id="kt_wizard_add_family" data-wizard-state="step-first" data-wizard-clickable="true">
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
                                        {{$t('PARENT_CHILD.ADD.NAV.GENERAL_INFO.TITLE')}}
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
                            <form class="form" novalidate="novalidate" id="kt_form_add_family">
                                <!--begin: Wizard Step 1-->
                                <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                    <div class="form-group">
                                        <label>{{ $t('PARENT_CHILD.ADD.NAV.GENERAL_INFO.FROM.PARENT') }}</label>
                                        <Multiselect
                                            class="form-control form-control-solid form-control-lg"
                                            v-model="familyForm.parent_id"
                                            label="name"
                                            :close-on-select="true"
                                            :searchable="true"
                                            trackBy="name"
                                            :options="parents"
                                            :allowEmpty="false"
                                        >
                                            <template v-slot:singlelabel="{ value }">
                                                <div class="form-control form-control-solid form-control-lg multiselect-single-label" style="right: 0;padding-right: 0">
                                                    <img class="mr-2 w-25px h-25px rounded-circle character-label-icon" :src="'./storage/'+value.image">
                                                    <span class="mr-2">{{ value.name }}</span>
                                                </div>
                                            </template>
                                            <template v-slot:option="{ option }">
                                                <img class="w-30px h-30px rounded-circle" :src="'./storage/'+option.image">
                                                <span class="mr-3">{{ option.name }}</span>
                                            </template>
                                        </Multiselect>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ $t('PARENT_CHILD.ADD.NAV.GENERAL_INFO.FROM.CHILDREN') }}</label>
                                        <Multiselect
                                            v-model="familyForm.children_ids"
                                            mode="tags"
                                            :close-on-select="false"
                                            :searchable="true"
                                            trackBy="name"
                                            :options="children"
                                            :allow-empty="false"
                                        >
                                            <template v-slot:tag="{ option,handleTagRemove, disabled }">
                                                <div class="multiselect-tag is-user">
                                                    <img :src="'./storage/'+option.image">
                                                    {{ option.name }}
                                                    <span v-if="!disabled" class="multiselect-tag-remove"
                                                          @mousedown.prevent="handleTagRemove(option, $event)">
                                                        <span class="multiselect-tag-remove-icon"></span>
                                                    </span>
                                                </div>
                                            </template>
                                            <template v-slot:option="{ option }">
                                                <img class="w-30px h-30px rounded-circle" :src="'./storage/'+option.image">
                                                <span class="mr-3">{{ option.name }}</span>
                                            </template>
                                        </Multiselect>
                                    </div>
                                </div>
                                <!--end: Wizard Step 1-->

                                <!--begin: Wizard Step 3-->
                                <div class="pb-5" data-wizard-type="step-content">
                                    <div class="border-bottom mb-3">
                                        <div class="font-weight-bold mb-3">
                                            {{$t('PARENT_CHILD.ADD.NAV.GENERAL_INFO.FROM.PARENT')}}
                                            <div>
                                                <span v-for="user in parents" v-if="user.value == familyForm.parent_id">{{user.name}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="font-weight-bold mb-3">
                                            {{$t('PARENT_CHILD.ADD.NAV.GENERAL_INFO.FROM.CHILDREN')}}
                                            <div v-for="id in familyForm.children_ids">
                                                <span v-for="user in children" v-if="user.value == id">{{user.name}}</span>
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
                                            ref="kt_add_family_submit"
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
            parents:[],
            children:[],
            familyForm:{
                parent_id:'',
                children_ids:[],
            },
        };
    },
    mounted() {
        this.index()
        // Initialize form wizard
        const wizard = new KTWizard("kt_wizard_add_family", {
            startStep: 1, // initial active step number
            clickableSteps: true // allow step clicking
        });

        const add_form = KTUtil.getById("kt_form_add_family");
        this.fv = formValidation(add_form, {
            fields: {
                parent_id: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.REQUIRED',{name:this.$t('PARENT_CHILD.ADD.NAV.GENERAL_INFO.FROM.PARENT')})
                        }
                    }
                },
                children_ids: {
                    validators: {
                        notEmpty: {
                            message: this.$t('AUTH.VALIDATION.REQUIRED',{name:this.$t('PARENT_CHILD.ADD.NAV.GENERAL_INFO.FROM.CHILDREN')})
                        }
                    }
                },
            },
            plugins: {
                trigger: new Trigger(),
                submitButton: new SubmitButton(),
                bootstrap: new Bootstrap()
            }
        });
        this.fv.on("core.form.valid", () => {
            if (this.familyForm.parent_id == '') {
                Swal.fire({
                    title: "",
                    text: this.$t('AUTH.VALIDATION.FORM_VALIDATION') + " | " + this.$t('CLASSES.ADD.NAV.GENERAL_INFO.FROM.TEACHER'),
                    icon: "error",
                    confirmButtonClass: "btn btn-secondary",
                    heightAuto: false
                });
                wizard.goTo(1)
            } else {
                let data = new FormData;
                data.append('parent_id', this.familyForm.parent_id)
                data.append('children_ids', this.familyForm.children_ids)

                // set spinner to submit button
                const submitButton = this.$refs["kt_add_family_submit"];
                submitButton.classList.add("spinner", "spinner-light", "spinner-right");

                // dummy delay
                setTimeout(() => {
                    // send add user request
                    apiService.post('api/v1/parentChild', data)
                        .then(({data}) => {
                            this.$toast.success(data.message);
                            this.familyForm.parent_id = ''
                            this.familyForm.children_ids = []
                            this.$router.push({name:'families'})
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
            }
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
            { title: this.$t('PARENT_CHILD.TITLE'), route: "families" },
            { title: this.$t('PARENT_CHILD.ADD.TITLE') }
        ]);
        this.$store.dispatch(SET_ACTION_BUTTON_CONFIG, { display: false,title:this.$t('MENU.NEW'),route:'/users/add' });

        // Validation before going to next page
        wizard.on("beforeNext", function(wizardObj) {
            // validate the form and use below function to stop the wizard's step
            // wizardObj.stop();
        });

        // Change event
        wizard.on("change", function(wizardObj) {
            //wizardObj.stop();
            setTimeout(() => {
                KTUtil.scrollTop();
            }, 500);
        });

    },
    methods: {
        index(){
            this.getAvailable('parent',this.parents)
            this.getAvailable('children',this.children)
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
