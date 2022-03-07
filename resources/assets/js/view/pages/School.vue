<template>
    <div>
            <div class="card card-custom">
                <div class="card-header">
                    <div class="card-title">
                        <span class="card-icon">
                            <i class="flaticon2-chat-1 text-primary"></i>
                        </span>
                        <h3 class="card-label">
                            {{$t("SCHOOL.TITLE")}}
                        </h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-lg-3 col-md-12 col-sm-12">
                            <label>{{ $t('SCHOOL.INPUT.NAME') }}</label>
                            <input
                                type="text"
                                class="form-control form-control-solid form-control-lg"
                                name="name"
                                ref="rName"
                                v-model="school.name"
                                :placeholder="$t('SCHOOL.INPUT.NAME')"
                            />
                        </div>
                        <div class="form-group col-lg-9 col-md-12 col-sm-12">
                            <label>{{ $t('SCHOOL.INPUT.DESCRIPTION') }}</label>
                            <input
                                type="text"
                                class="form-control form-control-solid form-control-lg"
                                name="description"
                                ref="rDescription"
                                v-model="school.description"
                                :placeholder="$t('SCHOOL.INPUT.DESCRIPTION')"
                            />
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-3 col-md-12 col-sm-12">
                            <label>{{ $t('SCHOOL.INPUT.COUNTRY') }}</label>
                            <input
                                type="text"
                                class="form-control form-control-solid form-control-lg"
                                name="country"
                                ref="rCountry"
                                v-model="school.country"
                                :placeholder="$t('SCHOOL.INPUT.COUNTRY')"
                            />
                        </div>
                        <div class="form-group col-lg-3 col-md-12 col-sm-12">
                            <label>{{ $t('SCHOOL.INPUT.CITY') }}</label>
                            <input
                                type="text"
                                class="form-control form-control-solid form-control-lg"
                                name="city"
                                ref="rCity"
                                v-model="school.city"
                                :placeholder="$t('SCHOOL.INPUT.CITY')"
                            />
                        </div>
                        <div class="form-group col-lg-6 col-md-12 col-sm-12">
                            <label>{{ $t('SCHOOL.INPUT.ADDRESS') }}</label>
                            <input
                                type="text"
                                class="form-control form-control-solid form-control-lg"
                                name="address"
                                ref="rAddress"
                                v-model="school.address"
                                :placeholder="$t('SCHOOL.INPUT.ADDRESS')"
                            />
                        </div>
                    </div>
                    <button @click="update(school.id)"
                            class="btn btn-primary font-weight-bold text-uppercase px-9 py-4">
                        {{ $t('BUTTONS.SAVE') }}
                    </button>
                </div>
            </div>
    </div>
</template>

<script>
import {SET_BREADCRUMB} from "../../store/breadcrumbs.module";
import {SET_ACTION_BUTTON_CONFIG} from "../../store/config.module";
import apiService from "../../services/api.service";
import toastConfirm from "./vue-toast/toast-confirm";
import {mapGetters} from "vuex";

export default {
    name: "School",
    data() {
        return {
            school: []
        }
    },
    mounted() {
        this.$store.dispatch(SET_BREADCRUMB, [{ title: this.$t('SCHOOL.TITLE') }]);
        this.show();
    },
    methods: {
        show() {
            apiService.get('api/v1/school/'+this.authUser.school_id).then(({data}) => this.school = data)
        },
        update(id){
            apiService.put('api/v1/school/'+id,this.school)
                .then(({data}) => {
                    if (data.status){
                        this.$toast.success(data.message)
                    }else {
                        this.$toast.error(data.message)
                    }
                })
        },
        destroy(id) {
            apiService.delete('api/v1/parentChild/' + id).then(() => {
                this.$toast.success(this.$t('PARENT_CHILD.API.RESPONSE.MESSAGE.DELETE'))
            });
        }
    },
    computed: {
        ...mapGetters(["currentUser"]),

        authUser() {
            return this.currentUser
        }
    }
}
</script>

<style scoped>

</style>
