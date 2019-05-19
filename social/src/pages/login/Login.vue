<template>
    <login-template>
        <span slot='menu-esquerdo'>
            <img src='https://bizcapital.com.br/blog/wp-content/uploads/2019/02/Img_Redes_Sociais_para_Neg%C3%B3cios_2-2-848x400.png' class='responsive-img'>
        </span>
        <span slot='principal'>
            <h2>Login</h2>

            <input type='email' placeholder='E-mail'>
            <input type='password' placeholder='Senha'>
            <button class='btn'>Entrar</button>
        </span>
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
