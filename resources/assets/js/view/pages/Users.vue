<template>
    <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Row-->
                <div class="row">
                    <!--begin::Col-->
                    <div v-for="user in users" class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
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
                                                <img v-if="user.image" :src="'../storage/'+user.image" alt="image">
                                                <img v-else :src="'./media/users/default.jpg'" alt="image">
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
                                        <h5 class="text-hover-primary mb-2">{{user.first_name+' '+user.middle_name+' '+user.last_name}}</h5>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center my-1">
                                        <span class="text-dark-75 font-weight-bolder mr-2">{{$t('USERS.ADD.NAV.ADDRESS_INFO.FROM.ADDRESS')}}:</span>
                                        <a class="text-muted text-hover-primary">{{ user.address }}</a>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center my-1">
                                        <span class="text-dark-75 font-weight-bolder mr-2">{{$t('USERS.ADD.NAV.CONTACT_INFO.FROM.MOBILE')}}:</span>
                                        <a class="text-muted text-hover-primary">{{ user.mobile_number }}</a>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center my-1">
                                        <span class="text-dark-75 font-weight-bolder mr-2">{{$t('USERS.ADD.NAV.PERSONAL_INFO.FROM.ACADEMIC')}}:</span>
                                        <a class="text-muted text-hover-primary">{{ user.academic }}</a>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center my-1">
                                        <span class="text-dark-75 font-weight-bolder mr-2">{{$t('USERS.ADD.NAV.ACCOUNT_INFO.FROM.USERNAME')}}:</span>
                                        <a class="text-muted text-hover-primary">{{ user.username }}</a>
                                    </div>
                                </div>
                                <!--end::Info-->
                                <div class="mt-9 text-center">
                                    <router-link :to="{name:'show-user',params:{id:user.id}}" class="btn btn-md btn-icon btn-light-warning btn-pill mx-2">
                                        <i class="flaticon-interface-1"></i>
                                    </router-link>
                                    <button @click="destroy(user.id)" class="btn btn-md btn-icon btn-light-danger btn-pill mx-2">
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
let baseApi = 'api/v1/user/'

export default {
    name: "Users",
    data() {
        return {
            users: []
        }
    },
    mounted() {
        this.$store.dispatch(SET_BREADCRUMB, [{ title: this.$t('USERS.TITLE') }]);
        this.$store.dispatch(SET_ACTION_BUTTON_CONFIG, { display: true,title:this.$t('MENU.NEW'),route:'/users/add' });
        this.index();
    },
    methods: {
        index() {
            apiService.get(baseApi).then(({data}) => this.users = data)
        },
        destroy(id) {
            apiService.delete(baseApi + id).then(() => {
                this.$toast.success(this.$t('USERS.API.RESPONSE.MESSAGE.DELETE'))
                this.index()
            });
        }
    }
}
</script>

<style scoped>

</style>
