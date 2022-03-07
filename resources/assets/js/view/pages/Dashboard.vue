<template>
  <div>

  </div>
</template>

<script>
import { SET_BREADCRUMB } from "../../store/breadcrumbs.module";
import AdvancedTableWidget2 from "../content/widgets/advance-table/Widget2.vue";
import AdvancedTableWidget3 from "../content/widgets/advance-table/Widget3.vue";
import MixedWidget1 from "../content/widgets/mixed/Widget1.vue";
import ListWidget1 from "../content/widgets/list/Widget1.vue";
import ListWidget3 from "../content/widgets/list/Widget3.vue";
import ListWidget4 from "../content/widgets/list/Widget4.vue";
import ListWidget8 from "../content/widgets/list/Widget8.vue";
import ListWidget9 from "../content/widgets/list/Widget9.vue";
import StatsWidget7 from "../content/widgets/stats/Widget7.vue";
import StatsWidget12 from "../content/widgets/stats/Widget12.vue";
import StatsWidget13 from "../content/widgets/stats/Widget13.vue";

export default {
  name: "dashboard",
  components: {
    AdvancedTableWidget2,
    AdvancedTableWidget3,
    MixedWidget1,
    ListWidget1,
    ListWidget3,
    ListWidget4,
    ListWidget8,
    ListWidget9,
    StatsWidget7,
    StatsWidget12,
    StatsWidget13
  },
  mounted() {
    this.$store.dispatch(SET_BREADCRUMB, [{ title: this.$t('DASHBOARD.TITLE') }]);
  },
  methods: {
    setActiveTab1(event) {
      this.tabIndex = this.setActiveTab(event);
    },
    setActiveTab2(event) {
      this.tabIndex2 = this.setActiveTab(event);
    },
    /**
     * Set current active on click
     * @param event
     */
    setActiveTab(event) {
      // get all tab links
      const tab = event.target.closest('[role="tablist"]');
      const links = tab.querySelectorAll(".nav-link");
      // remove active tab links
      for (let i = 0; i < links.length; i++) {
        links[i].classList.remove("active");
      }

      // set current active tab
      event.target.classList.add("active");

      // set clicked tab index to bootstrap tab
      return parseInt(event.target.getAttribute("data-tab"));
    }
  }
};
</script>
