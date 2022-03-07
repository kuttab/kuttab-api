<template>
  <div class="topbar-item">
    <div class="btn btn-icon w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
      <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">
        مرحبا,
      </span>
      <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">
        {{ currentUser.username }}
      </span>
      <span class="symbol symbol-35 symbol-light-success">
        <img v-if="false" alt="Pic" :src="'/media/users/100_1.jpg'" />
        <span v-if="true" class="symbol-label font-size-h5 font-weight-bold">
           A
        </span>
      </span>
    </div>

    <div
      id="kt_quick_user"
      ref="kt_quick_user"
      class="offcanvas offcanvas-right p-10"
    >
      <!--begin::Header-->
      <div
        class="offcanvas-header d-flex align-items-center justify-content-between pb-5"
      >
        <h3 class="font-weight-bold m-0">
          ملف المستخدم
        </h3>
        <a
          href="#"
          class="btn btn-xs btn-icon btn-light btn-hover-primary"
          id="kt_quick_user_close"
        >
          <i class="ki ki-close icon-xs text-muted"></i>
        </a>
      </div>
      <!--end::Header-->

      <!--begin::Content-->
      <perfect-scrollbar
        class="offcanvas-content pr-5 mr-n5 scroll"
        style="max-height: 90vh; position: relative;"
      >
        <!--begin::Header-->
        <div class="d-flex align-items-center mt-5">
          <div class="symbol symbol-100 mr-5">
            <img
              class="symbol-label"
              :src="'./media/users/default.jpg'"
              alt=""
            />
            <i class="symbol-badge bg-success"></i>
          </div>
          <div class="d-flex flex-column">
            <router-link
              to="/custom-pages/profile"
              class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary"
            >
                {{ currentUser.username }}
            </router-link>
            <div class="text-muted mt-1">Admin</div>
            <div class="navi mt-2">
              <a href="#" class="navi-item">
                <span class="navi-link p-0 pb-2">
                  <span class="navi-text text-muted text-hover-primary">
                    {{ currentUser.school_id }}
                  </span>
                </span>
              </a>
            </div>
            <button class="btn btn-light-primary btn-bold" @click="onLogout">
                {{ $t('AUTH.LOGOUT.BUTTON') }}
            </button>
          </div>
        </div>
        <!--end::Header-->
        <div class="separator separator-dashed mt-8 mb-5"></div>
        <!--begin::Nav-->
        <div class="navi navi-spacer-x-0 p-0">
            <!--begin::Item-->
            <div @click='toggleModal("rChangePassword")' class="navi-item cursor-pointer">
            <div class="navi-link">
              <div class="symbol symbol-40 bg-light mr-3">
                <div class="symbol-label">
                  <span class="svg-icon svg-icon-md svg-icon-success">
                    <!--begin::Svg Icon-->
                    <inline-svg src="media/svg/icons/General/Notification2.svg"/>
                    <!--end::Svg Icon-->
                  </span>
                </div>
              </div>
              <div class="navi-text">
                 <div class="font-weight-bold">{{$t('QUICK_USER.NAV.NEW_PASSWORD_TITLE')}}</div>
                <div class="text-muted">
                    {{$t('QUICK_USER.NAV.NEW_PASSWORD_SUB_TITLE')}}
                </div>
              </div>
            </div>
          </div>
            <!--end:Item-->
        </div>
        <!--end::Nav-->
      </perfect-scrollbar>
      <!--end::Content-->
    </div>
      <b-modal modal-class="dorid-kufi" ref="rChangePassword" :title="$t('QUICK_USER.NAV.NEW_PASSWORD_TITLE')">
          <div class="form-group">
              <input placeholder="كلمة المرور القديمة" class="form-control form-control-solid rounded-lg font-size-h6" type="password" autocomplete="off"/>
          </div>
          <div class="form-group">
              <input placeholder="كلمة المرور الجديدة" class="form-control form-control-solid rounded-lg font-size-h6" type="password" autocomplete="off"/>
          </div>
          <div class="form-group">
              <input placeholder="تأكيد كلمة المرور" class="form-control form-control-solid rounded-lg font-size-h6" type="password" autocomplete="off"/>
          </div>
          <template #modal-footer="{ cancel }">
              <b-button size="sm" variant="success" @click="newPassword()">
                  تغيير
              </b-button>
              <b-button size="sm" variant="danger" @click="cancel()">
                  اغلاق
              </b-button>
          </template>
      </b-modal>
  </div>
</template>

<style lang="scss" scoped>
#kt_quick_user {
  overflow: hidden;
}
</style>

<script>
import { mapGetters } from "vuex";
import {LOGOUT, UPDATE_PASSWORD} from "../../../../store/auth.module";
import KTLayoutQuickUser from "../../../../helper/layout/extended/quick-user.js";
import KTOffcanvas from "../../../../helper/offcanvas.js";
import apiService from "../../../../services/api.service";

export default {
  name: "KTQuickUser",
  data() {
    return {
    };
  },
  mounted() {
    // Init Quick User Panel
    KTLayoutQuickUser.init(this.$refs["kt_quick_user"]);
  },
  methods: {
      onLogout() {
          this.$store.dispatch(LOGOUT).then(() => this.$router.push({name: "login"}));
      },
      closeOffcanvas() {
          new KTOffcanvas(KTLayoutQuickUser.getElement()).hide();
      },
      newPassword() {
          alert('hi')
          //this.$store.dispatch(UPDATE_PASSWORD)
      },
      toggleModal(id) {
          this.$refs[id].show();
      },
  },
    computed: {
        ...mapGetters(["currentUser"]),

        user(){
            return this.currentUser
        }
    }
};
</script>
