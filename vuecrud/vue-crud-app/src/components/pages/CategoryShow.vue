<template>
  <layout-div>
    <h2 class="text-center mt-5 mb-3">Show Category</h2>
    <div class="card">
      <div class="card-header">
        <router-link class="btn btn-outline-info float-right" to="/"
          >View All Categories
        </router-link>
      </div>
      <div class="card-body">
        <b className="text-muted">Name:</b>
        <p>{{ category.name }}</p>
      </div>
    </div>
  </layout-div>
</template>

<script>
import axios from "axios";
import LayoutDiv from "../LayoutDiv.vue";
import Swal from "sweetalert2";

export default {
  name: "CategoryShow",
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
  methods: {},
};
</script>
