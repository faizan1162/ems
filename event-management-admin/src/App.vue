<template>
  <div id="main-header" v-if="isLoggedIn">
    <TopHeader v-if="isLoggedIn"/>
    <LeftSidebar v-if="isLoggedIn" />
  </div>
  <div class="page-wrapper">
    <div class="main">
      <router-view />
      <div id="my-modals"></div>
    </div>
    <SiteFooter v-if="isLoggedIn"/>
  </div>
   
</template>
<script>
import TopHeader from './components/TopHeader.vue';
import LeftSidebar from './components/LeftSidebar.vue';
import SiteFooter from "./components/SiteFooter.vue";
import { mapGetters } from "vuex";

export default {
  name: "App",
  components: {
    TopHeader,
    LeftSidebar,
    SiteFooter,
  },
   data() {
    return {
      isAdminLoggedin: false,
    }
  },
  computed: {
    ...mapGetters("account", ["isLoggedIn"]),
  },
  mounted(){
    console.log(this.isLoggedIn);
    // console.log('isAdminlogin',this.isLoggedIn);
    // this.isAdminLoggedin = this.isLoggedIn;
  }
};
</script>