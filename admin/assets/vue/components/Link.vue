<template>
    <div class="form-group">
      <label for="`exampleInputEmail1">Page url</label>
      <input type="text" class="form-control" id='exampleInputEmail1' aria-describedby="emailHelp" placeholder="Enter email">
    </div>
</template>

<script>
export default {
  name: "Link",
  props: [
    'rowPosition'
  ],
  data() {
    return {
      msg: "I am list component"
    };
  },
  mounted: 
    function() {
      console.log(this.msg)
    }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
input {
  border: none;
}
</style>
