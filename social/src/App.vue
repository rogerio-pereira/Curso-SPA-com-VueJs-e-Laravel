<template>
    <span>
        <header>
            <navbar cor='green darken-1' logo='Social' url='/' />
        </header>

        <main>
            <div class='container'>
            <div class='row'>
                <grid-vue tamanho="4">
                Menu
                </grid-vue>

                <grid-vue tamanho="8">
                <router-view/>
                </grid-vue>
            </div>
            </div>
        </main>

        <footer-vue cor='green darken-1' logo='Social' descricao='Teste de Descrição' >
            <li><a class="grey-text text-lighten-3" href="#!">Home</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
            <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
        </footer-vue>
    </span>
</template>

<script>
import Navbar from '@/components/layouts/Navbar'
import FooterVue from '@/components/layouts/FooterVue'
import GridVue from '@/components/layouts/GridVue'

export default {
    name: 'App',
    components: {
        Navbar,
        FooterVue,
        GridVue
    },
}

<style>

</style>
