<template>
  <div id="custom-modal">
    <div :class="className"  tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title">Monster Breaks Latest Video</h2>
            <button type="button"
              class="close"
              @click="$emit('close')"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <iframe
              width="100%"
              height="400"
              :src="yt_source"
              title="YouTube video player"
              frameborder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
              allowfullscreen
            ></iframe>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary btn-sm"
              @click="$emit('close')"
            >
              Close
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>

export default {
  name: "CustomModal",
  props:['toggle','videosrc'],
  data() {
    return {
      className: "modal fade in modal-active "+this.toggle,
      yt_source: this.videosrc,
    }
  }
};
</script>
<style scoped>
#custom-modal .modal {
    background-image: linear-gradient(to bottom, #000, transparent);
}
.modal-active {
  display: block;
}
</style>
