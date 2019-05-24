<template>
    <span>
        <header>
            <navbar cor='green darken-1' logo='Social' url='/'>
                <li><router-link to='/'>Home</router-link></li>
                <li v-if='!usuario'><router-link to="/login">Entrar</router-link></li>
                <li v-if='!usuario'><router-link to="/cadastro">Cadastre-se</router-link></li>
                <li v-if='usuario'><router-link to="/perfil">{{usuario.name}}</router-link></li>
                <li v-if='usuario'><a v-on:click='sair()'>Sair</a></li>
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
    data() {
        return {
            usuario: false
        }
    },
    created() {
        console.log('created');
        let usuarioAux = sessionStorage.getItem('usuario');

        if(usuarioAux) {
            this.usuario = JSON.parse(usuarioAux);
            this.$router.push('/');
        }
    },
    methods: {
        sair() {
            sessionStorage.clear();
            this.usuario = false;
        }
    }
}
</script>

<style>
</style>
