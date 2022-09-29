<template>
  <div class="container my-5">
    <h1>Product List</h1>
    <div class="alert alert-success" v-if="success">
      {{ success }}
    </div>
    <Link href="/product/create" class="btn btn-primary" type="button" as="button">Create</Link>
    <table class="table">
      <thead>
        <tr>
          <td>ID</td>
          <td>Name</td>
          <td>Price</td>
          <td>Image</td>
          <td>Action</td>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in products" :key="product.id">
          <td>{{ product.id }}</td>
          <td>{{ product.name }}</td>
          <td>{{ product.price }}</td>
          <td>{{ product.image}} </td>
          <td>
            <a href="#" class="btn btn-outline-secondary me-2">Edit</a>
            <button class="btn btn-outline-danger" @click="destroy(product.id)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
export default {
  components: { Link },
  props: [
    'products', 'success'
  ],
  methods: {
    destroy(id){
      Inertia.delete(`/product/${id}`);
    }
  }
}
</script>

<style>

</style>
