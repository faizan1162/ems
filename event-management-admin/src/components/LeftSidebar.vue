<template>
    <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
       <div class="p-2 text-center admin-logo">
          <img :src="siteLogo" class="img-circle elevation-2" alt="User Image" width="150" height="150">
        </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview">
                <router-link class="nav-link" to="/dashboard">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </router-link>
            </li>
            <li class="nav-item has-treeview" >
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-calendar"></i>
                    <p>
                    Events
                    <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/events">
                            <i class="nav-icon far fa-circle nav-icon"></i>
                            <p>All Events</p>
                        </router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/event/add">
                            <i class="nav-icon far fa-circle nav-icon"></i>
                            <p>Add Event</p>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <router-link class="nav-link" to="/tickets">
                    <i class="nav-icon fas fa-ticket-alt"></i>
                    <p>Tickets</p>
                </router-link>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</template>
<script>
export default {
    name : "LeftSidebar",
    data(){
        return {
            'siteLogo' : '/assets/logo.jpg',
        }
    }

}
</script>
<style scoped>
.admin-logo{
    border-bottom: 2px solid #f5f3f3;
}
.layout-navbar-fixed.layout-fixed .wrapper .sidebar{
    margin-top: 5px;
}
</style>
