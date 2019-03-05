<template>
  <div>
          <form class="col s12" autocomplete="off"  v-on:submit.prevent="saveAmount" method="post">

              <div class="row">
                <h3 class=" col s12 m12 l12">Затраты</h3>
                <div class=" col s12 m12 l12"><p>Всего за день расход: {{cTotalAmount}}</p></div>
                <div class=" col s12 m12 l12"><p>Всего за день доход: {{cTotalProfit}}</p></div>
              </div>

                <div  class="row">
                    <div class="input-field col s12 m12 l6">
                    <input date class="datepicker" type="text"  v-model="date">
                    <label class="active" for="name">Дата</label>
                    </div>
                </div>

              <div  class="row">
                <div v-for="(field, index) in cFields" :key="field.id" class="input-field col s12 m12 l6">

                  <input class="input-field__width-60" type="text" v-model.number="field.amount">

                  <a v-on:click="subToValue(field)" class="btn-floating btn-small waves-effect waves-light red"><i class="material-icons">remove</i></a>
                  <input :ref="field.id" class="input-field__width-20" type="text" :value="tmpAdd" v-on:change="">
                  <a v-on:click="addToValue(field)" class="btn-floating btn-small waves-effect waves-light green"><i class="material-icons">add</i></a>

                  <label class="active" for="name">{{field.type}}</label>
                </div>
              </div>

              <button class="btn waves-effect waves-light" type="submit" name="action">Сохранить
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
    data: function () {
        return {
            tmpAdd : null,
            fields: [],
            isLoad : true,
            date : new Date().toLocaleDateString(),
        }
    },
    methods : {
        addToValue : function (field) {
            let value = this.$refs[field.id][0].value;

            let tmp = field.amount;
            if(!field.amount) {
                field.amount = 0;
            }
            tmp = parseInt(field.amount) + parseInt(value);
            if(tmp) {
                field.amount = tmp;
            }
        },
        subToValue : function (field) {

            let value = this.$refs[field.id][0].value;

            let tmp = field.amount;
            if(!field.amount) {
                field.amount = 0;
            }
            tmp = parseInt(field.amount) - parseInt(value);
            if(tmp && tmp > 0) {
                field.amount = tmp;
            }
            else if(tmp == 0) {
                field.amount = tmp;
            }
        },
        getFields : function() {
            this.isLoad = true;
            var app = this;
            this.axios.post('/api/calc',
             {
                date : app.date
             }).then((response) => {
                this.fields = response.data.fields
                this.isLoad = false;
            })
        },
        saveAmount : function () {
            this.isLoad = true;
            var fields = [];
                        this.fields.forEach(function (item) {
                            fields[item.id] = item.amount;
                        });
            this.axios.post('/api/calc/store',
             {
                calcs : fields,
                date : this.date
             }).then((response) => {
              this.isLoad = false;
              M.toast({html: 'Сохранено.',classes: ['teal lighten-2']});
            })
        }
    },
    mounted () {
        this.getFields();
        var app = this;

        var elems = document.querySelectorAll('.datepicker');
        var instances = M.Datepicker.init(elems,{
            format : "dd.mm.yyyy",
            onClose : function () {
                app.getFields();
            },
            onSelect : function (value) {
                app.date = value.toLocaleDateString();
            }
        });
    },
    computed : {
        cFields : function() {
            return this.fields;
        },
        cTotalAmount : function() {
            var result = 0;
            this.fields.forEach(function(item) {
                if(item.amount && item.is_profit == 0) {
                    result += parseInt(item.amount);
                }

            });
            return result;
        },
        cTotalProfit : function() {
            var result = 0;
            this.fields.forEach(function(item) {
                if(item.amount && item.is_profit == 1) {
                    result += parseInt(item.amount);
                }

            });
            return result;
        }
    }
}
</script>

<style scoped>

</style>