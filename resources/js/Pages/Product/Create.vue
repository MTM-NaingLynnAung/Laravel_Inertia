<template>
  <div class="container"> 
    <div class="center">
      <h2>Product Create</h2>
      <form class="" @submit.prevent="store">
        <div class="form-group">
          <label for="">Name</label>
          <input type="text" class="form-control" :class="{ 'is-invalid' : errors.name }" v-model="product.name">
          <div class="invalid-feedback">{{ errors.name }}</div>
        </div>
        <div class="form-group">
          <label for="">Price</label>
          <input type="text" class="form-control" :class="{ 'is-invalid' : errors.price }" v-model="product.price">
          <div class="invalid-feedback">{{ errors.price }}</div>
        </div>
        <div class="form-group">
          <label for="">Image</label>
          <input type="file" class="form-control" :class="{ 'is-invalid' : errors.image }" @change="onChange">
          <div class="invalid-feedback">{{ errors.image }}</div>
        </div>
        <Link href="/product" class="btn btn-outline-dark mt-3 me-2" type="button" as="button">Back</Link>
        <button type="submit" class="btn btn-primary mt-3">Create</button>
      </form>
    </div>
  </div>
</template>
<script>
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3'
export default {
  components: { Link },
  props: {
    errors: Object
  },
  data(){
    return {
      product: {
        name: '',
        price: '',
        image: ''
      }
    }
  },
  methods: {
    store() {
      Inertia.post('/product', this.product)
    },
    onChange(e) {
      this.product.image = e.target.files[0]
    }
  }
}
</script>
<style>
.center {
  width: 360px;
  margin:100px auto;
  padding: 20px;
  border-radius: 12px;
  background: #fafafa;
}
</style>