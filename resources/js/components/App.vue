<template>
    <div>
        <div class="container">
            <nav class="blue accent-3">
                <ul class="list-inline">
                    <li>
                        <router-link :to="{ name: 'home' }">Главная</router-link>
                    </li>
                    <li v-if="!$auth.check()" class="pull-right">
                                            <router-link :to="{ name: 'login' }">Вход</router-link>
                                        </li>
                                        <li v-if="!$auth.check()" class="pull-right">
                                            <router-link :to="{ name: 'register' }">Регистрация</router-link>
                     <li>
                        <router-link :to="{ name: 'categories' }">Категории</router-link>
                    </li>
                    <li class="pull-right">
                        <router-link :to="{ name: 'calc' }">Внести затраты</router-link>
                    </li>
                     <li class="pull-right">
                        <router-link :to="{ name: 'results' }">Подсчет затрат</router-link>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="container content-wrap">
            <router-view></router-view>
        </div>


    </div>
</template>

<script>
module.exports = {
  data: function () {
    return {

    }
  }
}
</script>

<style scoped>

</style>