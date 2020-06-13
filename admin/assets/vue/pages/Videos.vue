<template>
  <div class="videos">
    <h2>Videos page</h2>
  </div>
</template>

<script>
export default {
  name: "Videos",
  components: {},

  data: () => ({
    item: 1,
    items: [
      { text: "Real-Time", icon: "mdi-clock" },
      { text: "Audience", icon: "mdi-account" },
      { text: "Conversions", icon: "mdi-flag" }
    ]
  })
};
</script>

<style lang="css" scoped>
</style>
