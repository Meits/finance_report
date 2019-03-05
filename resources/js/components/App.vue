<template>
    <div>
        <div class="container">
            <nav class="blue accent-3">
                <div class="nav-wrapper">
                <a href="#" class="brand-logo">Finance Calc</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down">
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
                        <router-link :to="{ name: 'calc' }">Затраты</router-link>
                    </li>
                     <li class="pull-right">
                        <router-link :to="{ name: 'results' }">Подсчет</router-link>
                    </li>
                </ul>
                </div>
            </nav>

            <ul class="sidenav" id="mobile-demo">
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
                    <router-link :to="{ name: 'calc' }">Затраты</router-link>
                </li>
                 <li class="pull-right">
                    <router-link :to="{ name: 'results' }">Подсчет</router-link>
                </li>
              </ul>
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