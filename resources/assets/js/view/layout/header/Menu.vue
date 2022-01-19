<template>
  <ul class="menu-nav">
      <router-link
          to="/dashboard"
          v-slot="{ href, navigate, isActive, isExactActive }"
      >
          <li
              aria-haspopup="true"
              data-menu-toggle="hover"
              class="menu-item"
              :class="[
          isActive && 'menu-item-active',
          isExactActive && 'menu-item-active'
        ]"
          >
              <a :href="href" class="menu-link" @click="navigate">
                  <span class="menu-text">{{$t('KT_MENU.DASHBOARD')}}</span>
              </a>
          </li>
      </router-link>
      <router-link hidden to="/schools" v-slot="{ href, navigate, isActive, isExactActive }">
          <li
              aria-haspopup="true"
              data-menu-toggle="hover"
              class="menu-item"
              :class="[
          isActive && 'menu-item-active',
          isExactActive && 'menu-item-active'
        ]"
          >
              <a :href="href" class="menu-link" @click="navigate">
                  <span class="menu-text">{{ $t('KT_MENU.SCHOOLS') }}</span>
              </a>
          </li>
      </router-link>
      <router-link
          to="/school"
          v-slot="{ href, navigate, isActive, isExactActive }"
      >
          <li
              aria-haspopup="true"
              data-menu-toggle="hover"
              class="menu-item"
              :class="[
          isActive && 'menu-item-active',
          isExactActive && 'menu-item-active'
        ]"
          >
              <a :href="href" class="menu-link" @click="navigate">
                  <span class="menu-text">{{ $t('KT_MENU.SCHOOL_INFO') }}</span>
              </a>
          </li>
      </router-link>
      <router-link
          to="/users"
          v-slot="{ href, navigate, isActive, isExactActive }"
      >
          <li
              aria-haspopup="true"
              data-menu-toggle="hover"
              class="menu-item"
              :class="[
          isActive && 'menu-item-active',
          isExactActive && 'menu-item-active'
        ]"
          >
              <a :href="href" class="menu-link" @click="navigate">
                  <span class="menu-text">{{$t('KT_MENU.USERS_MANAGEMENT')}}</span>
              </a>
          </li>
      </router-link>
      <router-link
          to="/classes"
          v-slot="{ href, navigate, isActive, isExactActive }"
      >
          <li
              aria-haspopup="true"
              data-menu-toggle="hover"
              class="menu-item"
              :class="[
          isActive && 'menu-item-active',
          isExactActive && 'menu-item-active'
        ]"
          >
              <a :href="href" class="menu-link" @click="navigate">
                  <span class="menu-text">{{$t('KT_MENU.CLASSES_MANAGEMENT')}}</span>
              </a>
          </li>
      </router-link>
      <router-link
          to="/families"
          v-slot="{ href, navigate, isActive, isExactActive }"
      >
          <li
              aria-haspopup="true"
              data-menu-toggle="hover"
              class="menu-item"
              :class="[
          isActive && 'menu-item-active',
          isExactActive && 'menu-item-active'
        ]"
          >
              <a :href="href" class="menu-link" @click="navigate">
                  <span class="menu-text">{{$t('KT_MENU.PARENT_CHILDREN')}}</span>
              </a>
          </li>
      </router-link>
  </ul>
</template>

<script>
export default {
  name: "KTMenu",
  methods: {
    hasActiveChildren(match) {
      return this.$route["path"].indexOf(match) !== -1;
    }
  }
};
</script>
