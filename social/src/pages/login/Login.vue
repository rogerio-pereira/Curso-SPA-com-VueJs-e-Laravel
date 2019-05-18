<template>
    <login-template>
        <h2>Login</h2>

        <input type='email' placeholder='E-mail'>
        <input type='password' placeholder='Senha'>
        <button class='btn'>Entrar</button>
    </login-template>
</template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'
import CardConteudoVue from '@/components/social/CardConteudoVue'
import CardDetalheVue from '@/components/social/CardDetalheVue'
import PublicarConteudoVue from '@/components/social/PublicarConteudoVue'

export default {
    name: 'Login',
    components: {
        LoginTemplate,
        CardConteudoVue,
        CardDetalheVue,
        PublicarConteudoVue
    },
    data () {
        return {
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
