<template>
    <span>
        <header>
            <navbar cor='green darken-1' logo='Social' url='#/'>
                <li><a href="#/">Home</a></li>
                <li><a href="#/login">Entrar</a></li>
            </navbar>
        </header>

        <main>
            <div class='container'>
            <div class='row'>
                <grid-vue tamanho="8">
                    <card-menu-vue>
                        <slot name='menu-esquerdo' />
                    </card-menu-vue>
                </grid-vue>

                <grid-vue tamanho="4">
                    <slot name='principal' />
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
import CardMenuVue from '@/components/layouts/CardMenuVue'

export default {
    name: 'LoginTemplate',
    components: {
        Navbar,
        FooterVue,
        GridVue,
        CardMenuVue
    },
}
</script>

<style>
</style>
