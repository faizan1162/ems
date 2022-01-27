<!-- Footer.vue -->
<template>
    <footer class="main-footer">
        <strong>Copyright &copy; 2022 <a href="#">{{ appName }}</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
        <b>Developed By</b> <a href="#" target="_blank">{{ developedBy }}</a>
        </div>
  </footer>
</template>
<script>
export default {
    name : "SiteFooter",
    setup(){
        return {
            appName: "Event Management Dashboard",
            developedBy: "Faizan Ali",
        }
    }
}
</script>>
