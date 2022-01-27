<!-- Header.vue -->
<template>
    <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block">
            <a href="javascript:void(0)" @click="logoutAdmin" class="nav-link"><i class="fas fa-sign-out-alt fa-2x text-primary" title="Logout"></i></a>
        </li>
    </ul>
  </nav>
</template>
<script>
import { _LOGOUT } from '../config/constants';
import api from "../http-common";
import { mapGetters, mapActions } from "vuex";
export default {
    name: 'TopHeader',
    computed: {
      ...mapGetters("account", ["isLoggedIn"]),
      ...mapActions("account", ["logout"]),
    },
    methods : {
        async logoutAdmin(){
          if (this.isLoggedIn) {
            const response = await api.execute(_LOGOUT,_LOGOUT.route);
            if (response && response.success) {
              this.logout;
              this.$toast.success(response.message);
               this.$router.push({ name: "AdminLogin" });
            } else {
              this.logout;
              this.$toast.error("Else User Logout");
              this.$router.push({ name: "Login" });
            }
          } else {
            this.$toast.error("You are not logged in user!");
            this.$router.push({ name: "Login" });
          }
        }
    }
}
</script>
