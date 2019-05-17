<template>
    <span>
        <header>
            <navbar cor='green darken-1' logo='Social' url='/' />
        </header>

        <main>
            <div class='container'>
            <div class='row'>
                <grid-vue tamanho="4">
                    <card-menu-vue>
                        <div class="row valign-wrapper">
                            <grid tamanho="4">
                                <img src="https://materializecss.com/images/yuna.jpg" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
                            </grid>
                            <grid tamanho="8">
                                <span class="black-text">
                                    <h5>Rogerio</h5>
                                    Add the "circle" class to it to make it appear circular.
                                </span>
                            </grid>
                        </div>
                    </card-menu-vue>
                    <card-menu-vue>
                        <h3>Teste</h3>
                    </card-menu-vue>
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
import CardMenuVue from '@/components/layouts/CardMenuVue'

export default {
    name: 'App',
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
