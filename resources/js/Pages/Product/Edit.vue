<template>
  <div class="container">
    <div class="center">
      <h2>Product Edit</h2>
      <form class="" @submit.prevent="update">
        <div class="form-group">
          <label for="">Name</label>
          <input type="text" class="form-control" v-model="form.name" :class="{ 'is-invalid' : errors.name }">
          <div class="invalid-feedback">{{ errors.name }}</div>
        </div>
        <div class="form-group">
          <label for="">Price</label>
          <input type="text" class="form-control" v-model="form.price" :class="{ 'is-invalid' : errors.price }" >
          <div class="invalid-feedback">{{ errors.price }}</div>
        </div>
        <div class="form-group">
          <label for="">Image</label>
          <input type="file" class="form-control" @change="onChange" :class="{ 'is-invalid' : errors.image }" >
          <div class="invalid-feedback">{{ errors.image }}</div>
        </div>
        <Link href="/product" class="btn btn-outline-dark mt-3 me-2" type="button" as="button">Back</Link>
        <button type="submit" class="btn btn-primary mt-3">Update</button>
      </form>
    </div>
  </div>
</template>
<script>
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3'
export default {
  components: { Link },
  props: [
    'product',
    'errors'
  ],
  data() {
    return {
      form: {
        name: this.product.name,
        price: this.product.price,
        image: this.product.image
      }
    }
  },
  methods: {
    update() {
      Inertia.post(`/product/update/${this.product.id}`, this.form)
    },
    onChange(e) {
      this.form.image = e.target.files[0]
    }
  }
}
</script>
<style>
.center {
  width: 360px;
  margin: 100px auto;
  padding: 20px;
  border-radius: 12px;
  background: #fafafa;
}
</style>
