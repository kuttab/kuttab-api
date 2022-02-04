<template>
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Row-->
            <div class="row">
                <!--begin::Col-->
                <div v-for="user in parents" class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b card-stretch">
                        <!--begin::Body-->
                        <div class="card-body pt-4">
                            <!--begin::User-->
                            <div class="d-flex align-items-end mb-3">
                                <!--begin::Pic-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Pic-->
                                    <div class="flex-shrink-0 mr-4 mt-lg-0 mt-3">
                                        <div class="symbol symbol-circle symbol-lg-75">
                                            <img v-if="user.image" :src="'./storage/'+user.image" alt="image">
                                            <img v-else :src="'./media/users/default.jpg'" alt="image">
                                        </div>
                                        <div class="symbol symbol-lg-75 symbol-circle symbol-primary d-none">
                                            <span class="font-size-h3 font-weight-boldest">JM</span>
                                        </div>
                                    </div>
                                    <!--end::Pic-->
                                    <!--begin::Title-->
                                    <div class="d-flex flex-column">
                                        <router-link :to="{name:'show-user',params:{id:user.id}}" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">
                                            {{user.first_name +' '+ user.last_name}}
                                        </router-link>
                                        <span v-if="user.type == 'teacher'" class="text-muted font-weight-bold">{{ $t('USERS.TYPES.TEACHER') }}</span>
                                        <span v-if="user.type == 'student'" class="text-muted font-weight-bold">{{ $t('USERS.TYPES.STUDENT') }}</span>
                                        <span v-if="user.type == 'parent'" class="text-muted font-weight-bold">{{ $t('USERS.TYPES.PARENT') }}</span>
                                        <span v-if="user.type == 'assistant'" class="text-muted font-weight-bold">{{ $t('USERS.TYPES.ASSISTANT') }}</span>
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::User-->
                            <!--begin::Info-->
                            <div class="mb-7">
                                <div class="d-flex justify-content-center align-items-center">
                                    <h5 class="text-hover-primary mb-2"></h5>
                                </div>
                                <div class="d-flex justify-content-between align-items-center my-1">
                                    <span class="text-dark-75 font-weight-bolder mr-2">{{$t('PARENT_CHILD.ADD.NAV.GENERAL_INFO.FROM.PARENT')}}:</span>
                                    <a class="text-muted text-hover-primary">{{user.first_name+' '+user.middle_name+' '+user.last_name}}</a>
                                </div>
                                <div class="d-flex justify-content-between align-items-center my-1">
                                    <span class="text-dark-75 font-weight-bolder mr-2">{{$t('USERS.ADD.NAV.CONTACT_INFO.FROM.MOBILE')}}:</span>
                                    <a class="text-muted text-hover-primary">{{ user.mobile_number }}</a>
                                </div>
                                <div class="d-flex justify-content-between align-items-center my-1">
                                    <span class="text-dark-75 font-weight-bolder mr-2">{{$t('PARENT_CHILD.ADD.NAV.GENERAL_INFO.FROM.CHILDREN')}}:</span>
                                </div>
                                <div class="row d-flex justify-content-center align-items-center">
                                    <a v-for="children in user.children" class="col-12 text-center text-muted text-hover-primary">{{ children.child.first_name + ' ' + children.child.last_name}}</a>
                                </div>
                            </div>
                            <!--end::Info-->
                            <div class="mt-9 text-center">
                                <router-link :to="{name:'show-user',params:{id:user.id}}" class="btn btn-md btn-icon btn-light-success btn-pill mx-2">
                                    <i class="flaticon-arrows"></i>
                                </router-link>
                                <router-link :to="{name:'edit-user',params:{id:user.id}}" class="btn btn-md btn-icon btn-light-warning btn-pill mx-2">
                                    <i class="flaticon-interface-1"></i>
                                </router-link>
                                <button @click="showConfirmToast(user.id)" class="btn btn-md btn-icon btn-light-danger btn-pill mx-2">
                                    <i class="flaticon-delete"></i>
                                </button>
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
</template>

<script>
import {SET_BREADCRUMB} from "../../store/breadcrumbs.module";
import apiService from "../../services/api.service";
import {SET_ACTION_BUTTON_CONFIG} from "../../store/config.module";
import KTUtil from "../../helper/util";
import formValidation from "../../plugins/formvalidation/dist/es6/core/Core";
import Trigger from "../../plugins/formvalidation/dist/es6/plugins/Trigger";
import SubmitButton from "../../plugins/formvalidation/dist/es6/plugins/SubmitButton";
import Bootstrap from "../../plugins/formvalidation/dist/es6/plugins/Bootstrap";
import Swal from "sweetalert2";
import toastConfirm from "./vue-toast/toast-confirm";
let baseApi = 'api/v1/parentChild/'

export default {
    name: "Families",
    data() {
        return {
            parents: []
        }
    },
    mounted() {
        this.$store.dispatch(SET_BREADCRUMB, [{ title: this.$t('PARENT_CHILD.TITLE') }]);
        this.$store.dispatch(SET_ACTION_BUTTON_CONFIG, { display: true,title:this.$t('MENU.NEW'),route:'/families/add' });
        this.index();
    },
    methods: {
        index() {
            apiService.get('api/v1/parentChild').then(({data}) => this.parents = data)
        },
        destroy(id) {
            apiService.delete('api/v1/parentChild/' + id).then(() => {
                this.$toast.success(this.$t('PARENT_CHILD.API.RESPONSE.MESSAGE.DELETE'))
            });
        },
        showConfirmToast(id) {
            // Define the content object with the component, props and listeners
            const content = {
                component: toastConfirm,
                // Any prop can be passed, but don't expect them to be reactive
                props: {
                    message : 'حذف عائلة !! هل أنت متأكد ؟',
                },
                // Listen and react to events using callbacks. In this case we listen for
                // the "click" event emitted when clicking the toast button
                listeners: {
                    click: () => {
                        this.destroy(id)
                        this.index()
                    }
                }
            }

            // Render the toast and its contents
            this.$toast(content);
        }
    }
}
</script>

<style scoped>

</style>
