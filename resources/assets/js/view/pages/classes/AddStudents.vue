<template>
    <div class="card card-custom">
        <div class="card-body p-0">
            <!--begin: Wizard-->
            <div class="wizard wizard-2" id="kt_wizard_add_class" data-wizard-state="step-first"
                 data-wizard-clickable="true">
                <!--begin: Wizard Nav -->
                <div class="wizard-nav border-right py-8 px-8 py-lg-20 px-lg-10">
                    <div class="wizard-steps">
                        <div class="wizard-step" data-wizard-type="step">
                            <div class="wizard-wrapper">
                                <div class="wizard-icon">
                  <span class="svg-icon svg-icon-2x">
                    <inline-svg src="media/svg/icons/Map/Compass.svg"/>
                  </span>
                                </div>
                                <div class="wizard-label">
                                    <h3 class="wizard-title">
                                        {{ $t('CLASSES.ADD.NAV.ADD_STUDENT.TITLE') }}
                                    </h3>
                                    <div class="wizard-desc">
                                        {{ $t('CLASSES.ADD.NAV.ADD_STUDENT.SUB_TITLE') }}
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
                                <!--begin: Wizard Step 2-->
                                <div class="pb-5" data-wizard-type="step-content">
                                    <label>{{ $t('CLASSES.ADD.NAV.ADD_STUDENT.FROM.STUDENTS') }}</label>
                                    <Multiselect
                                        v-model="students_ids"
                                        mode="tags"
                                        :close-on-select="false"
                                        :searchable="true"
                                        trackBy="name"
                                        :options="students"
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
                                <button @click="addStudents" type="button"
                                        class="btn btn-success font-weight-bold text-uppercase px-9 py-4"
                                        data-wizard-type="action-submit">
                                    اضافة
                                </button>
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
import {SET_BREADCRUMB} from "../../../store/breadcrumbs.module";
import KTWizard from "../../../helper/wizard";
import {SET_ACTION_BUTTON_CONFIG} from "../../../store/config.module";
import apiService from "../../../services/api.service";
import {mapGetters} from "vuex";
import Multiselect from '@vueform/multiselect/dist/multiselect.vue2.js'

export default {
    name: "AddStudents",
    components: {
        Multiselect,
    },
    data() {
        return {
            teacher_id: '',
            class_id: '',
            school_id: '',
            value: [],
            students: [],
            students_ids: [],
        };
    },
    mounted() {
        this.teacher_id = this.$route.params.id
        this.school_id = this.currentUser.school_id

        apiService.get('api/v1/teacher/' + this.$route.params.id + '/classInfo').then(({data}) => {
            this.class_id = data.class_id
        })

        this.index()
        // Initialize form wizard
        const wizard = new KTWizard("kt_wizard_add_class", {
            startStep: 1, // initial active step number
            clickableSteps: true // allow step clicking
        });

        this.$store.dispatch(SET_BREADCRUMB, [
            {title: this.$t('CLASSES.TITLE'), route:{name: 'classes'}},
            {title: this.$t('CLASSES.SHOW.TITLE'), route: {name: 'show-class', params: {id: this.teacher_id}}},
            {title: this.$route.params.id},
            {title: 'اضافة طالب'},
        ]);

        this.$store.dispatch(SET_ACTION_BUTTON_CONFIG, {display: false});

    },
    methods: {
        index() {
            this.getAvailable('students', this.students)
        },

        getAvailable(type, array) {
            array.length = 0
            apiService.get('api/v1/available/' + type).then(({data}) => {
                for (const user of data) {
                    array.push({
                        value: user.id,
                        name: user.first_name + ' ' + user.middle_name + ' ' + user.last_name,
                        image: user.image
                    })
                }
            })
        },

        addStudents() {
            let students = [];
            let today = new Date()
            let date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
            for (const student_id of this.students_ids) {
                console.log(student_id)
                students.push({
                    school_id: this.school_id,
                    teacher_id: this.teacher_id,
                    student_id: student_id,
                    class_id: this.class_id,
                    start_date: date
                })
            }
            console.log(students)

            apiService.post('api/v1/teacherStudent',{students:students}).then(() => {
                this.$toast.success("تم اضافة طالب");
                this.$router.back()
            })
        }
    },
    computed: {
        ...mapGetters(["currentUser"]),

        authUser() {
            return this.currentUser
        }
    },
};

</script>
