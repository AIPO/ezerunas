<template>
  <div class="alert alert-warning alert-flash" role="alert">
    <strong>Success</strong>
    {{message}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      message: "Temp message"
    };
  },
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
<style>
.alert-flash {
  position: fixed;
  right: 25px;
  bottom: 20px;
}
</style>
