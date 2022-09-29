<template>
  <div> 
    <h2>Product Create</h2>
    <form class="col-3" @submit.prevent="store">
      <div class="form-group">
        <label for="">Name</label>
        <input type="text" class="form-control" v-model="name">
      </div>
      <div class="form-group">
        <label for="">Price</label>
        <input type="text" class="form-control" v-model="price">
      </div>
      <div class="form-group">
        <label for="">Image</label>
        <input type="text" class="form-control" v-model="image">
      </div>
      <button type="submit">Create</button>
    </form>
  </div>
</template>
<script>
export default {
  
}
</script>
