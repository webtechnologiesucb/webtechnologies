<template>
  <layout-div>
    <div class="container">
      <h2 class="text-center mt-5 mb-3">Category Manager</h2>
      <div class="card">
        <div class="card-header">
          <router-link to="/create" class="btn btn-outline-primary"
            >Create New Category
          </router-link>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Name</th>
                <th width="240px">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="category in categories" :key="category.category_id">
                <td>{{ category.name }}</td>
                <td>
                  <router-link
                    :to="`/show/${category.category_id}`"
                    class="btn btn-outline-info mx-1"
                    >Show</router-link
                  >
                  <router-link
                    :to="`/edit/${category.category_id}`"
                    class="btn btn-outline-success mx-1"
                    >Edit</router-link
                  >
                  <button
                    @click="handleDelete(category.category_id)"
                    className="btn btn-outline-danger mx-1"
                  >
                    Delete
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </layout-div>
</template>

<script>
import axios from "axios";
import LayoutDiv from "../LayoutDiv.vue";
import Swal from "sweetalert2";

export default {
  name: "CategoryList",
  components: {
    LayoutDiv,
  },
  data() {
    return {
      posts: [],
      categories: [],
    };
  },
  created() {
    this.fetchCategoryList();
  },
  methods: {
    fetchCategoryList() {
      axios
        .get("/api/categories")
        .then((response) => {
          this.categories = response.data;
          return response;
        })
        .catch((error) => {
          return error;
        });
    },
    handleDelete(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .delete(`/api/categories/${id}`)
            .then((response) => {
              Swal.fire({
                icon: "success",
                title: "Category deleted successfully!",
                showConfirmButton: false,
                timer: 1500,
              });
              this.fetchCategoryList();
              return response;
            })
            .catch((error) => {
              Swal.fire({
                icon: "error",
                title: "An Error Occured!",
                showConfirmButton: false,
                timer: 1500,
              });
              return error;
            });
        }
      });
    },
  },
};
</script>
