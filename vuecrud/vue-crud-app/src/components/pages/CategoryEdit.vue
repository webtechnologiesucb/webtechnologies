<template>
  <layout-div>
    <h2 class="text-center mt-5 mb-3">Edit Category</h2>
    <div class="card">
      <div class="card-header">
        <router-link class="btn btn-outline-info float-right" to="/"
          >View All Categories
        </router-link>
      </div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <label htmlFor="name">Name</label>
            <input
              v-model="category.name"
              type="text"
              class="form-control"
              id="name"
              name="name"
            />
          </div>
          <button
            @click="handleSave()"
            :disabled="isSaving"
            type="button"
            class="btn btn-outline-primary mt-3"
          >
            Save Category
          </button>
        </form>
      </div>
    </div>
  </layout-div>
</template>

<script>
import axios from "axios";
import LayoutDiv from "../LayoutDiv.vue";
import Swal from "sweetalert2";

export default {
  name: "CategoryEdit",
  components: {
    LayoutDiv,
  },
  data() {
    return {
      category: {
        name: "",
      },
      isSaving: false,
    };
  },
  created() {
    const id = this.$route.params.id;
    axios
      .get(`/api/categories/${id}`)
      .then((response) => {
        let categoryInfo = response.data;
        this.category.name = categoryInfo.name;
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
  },
  methods: {
    handleSave() {
      this.isSaving = true;
      const id = this.$route.params.id;
      axios
        .put(`/api/categories/${id}`, this.category)
        .then((response) => {
          Swal.fire({
            icon: "success",
            title: "Category updated successfully!",
            showConfirmButton: false,
            timer: 1500,
          });
          this.isSaving = false;
          this.category.name = "";
          return response;
        })
        .catch((error) => {
          this.isSaving = false;
          Swal.fire({
            icon: "error",
            title: "An Error Occured!",
            showConfirmButton: false,
            timer: 1500,
          });
          return error;
        });
    },
  },
};
</script>
