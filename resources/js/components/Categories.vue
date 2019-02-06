<template>
    <div>
        <form class="col s12" autocomplete="off"  v-on:submit.prevent="saveCategories" method="post">

            <div class="row">
              <h3 class="col s12 m12 l12">Категории</h3>
            </div>
            <div  class="row">
              <div v-for="category in cCategories" class="input-field col s12 m12 l6">
                <input class="input-field__width-70" type="text" v-model="category.type">
                <a v-on:click="removeCategory(category.id)" class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">remove</i></a>
                <label class="active" for="name">Поле {{category.id}}</label>
              </div>
            </div>

            <button class="btn waves-effect waves-light" type="submit" name="action">Сохранить
            <i class="material-icons right">send</i>
            </button>
            <button @click.prevent="addCategory" class="btn waves-effect waves-light" name="action">Добавить категорию
            <i class="material-icons right">send</i>
            </button>

        </form>
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
        removeCategory : function(id) {
            this.isLoad = true;
            this.axios.delete('/api/categories/' + id).then((response) => {

                          let tmpIndCat = null;
                          this.categories.forEach(function(item,i) {
                            if(item.id == id) {
                                tmpIndCat = i;
                            }
                          });

                          if(tmpIndCat) {
                            this.categories.splice(tmpIndCat, 1);
                          }
                          this.isLoad = false;
                          M.toast({html: 'Удалено.',classes: ['teal lighten-2']});
            })
        },
        getCategories : function () {
            this.axios.get('/api/categories').then((response) => {
              this.categories = response.data.fields
              this.isLoad = false;
            })
        },
        addCategory : function () {
            var id = 0;
            this.categories.forEach(function(item) {
                if(item.id > id) {
                    id = item.id;
                }
            });
            ++id;
            var category = {
                id : id,
                type : "New Type"
            }
            this.categories.push(category);
        },
        saveCategories : function () {
            this.isLoad = true;
            var fields = [];
            this.categories.forEach(function (item) {
                fields[item.id] = item.type;
            });
             this.axios.post('/api/categories',
             {
                fields : fields
             }).then((response) => {
                this.isLoad = false;
               M.toast({html: 'Сохранено.',classes: ['teal lighten-2']});
            })
        }
    },
    mounted () {

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