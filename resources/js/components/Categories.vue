<template>
    <div>
        <div class="container register_wrap">
            <form class="col s12" autocomplete="off"  v-on:submit.prevent="register" method="post">

                <div class="row">
                  <h3>Categories</h3>
                </div>
                <div v-for="category in cCategories" class="row">
                  <div class="input-field col s12">
                    <input type="text" v-model="category.type">
                    <label class="active" for="name">Поле {{category.id}}</label>
                  </div>
                </div>

                <button class="btn waves-effect waves-light" type="submit" name="action">Save
                <i class="material-icons right">send</i>
                </button>
                <button @click.prevent="addCategory" class="btn waves-effect waves-light" name="action">Add new Category
                <i class="material-icons right">send</i>
                </button>

              </form>
          </div>
          <preloader v-if="isLoad" ></preloader>
    </div>
</template>

<script>
import Preloader from './parts/Preloader.vue';
export default {
    components : {
        preloader : Preloader
    },
    methods : {

        getCategories : function () {
            this.axios.get('/api/categories').then((response) => {
              this.categories = response.data.fields
              this.isLoad = false;
            })
        },
        addCategory : function () {
            var category = {
                id : 0,
                type : "New Type"
            }
            this.categories.push(category);
        }
    },
    mounted () {
        console.log(this.isLoad);
        this.getCategories();
    },
  data: function () {
    return {
      categories: [],
      isLoad : true
    }
  },
  computed : {
    cCategories : function() {

        return this.categories;
    }
  }
}
</script>

<style scoped>

</style>