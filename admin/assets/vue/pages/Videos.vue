<template>
  <div class="video">
    <div class="container">
      <h2>Videos page</h2>
      <div class="row">
        <div class="col-sm-4" v-for="video in videos" v-bind:key="video.id">
          <video width="320" height="240" controls>
            <source v-bind:src="video.url" type="video/mp4">
          Your browser does not support the video tag.
          </video>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Videos",
  components: {},

  data() {
    return {
      videos: object.specialvideos,
    };
  },
};
</script>

<style lang="css" scoped>
</style>
