<template>
    <login-template>
        <span slot='menu-esquerdo'>
            <img src='https://bizcapital.com.br/blog/wp-content/uploads/2019/02/Img_Redes_Sociais_para_Neg%C3%B3cios_2-2-848x400.png' class='responsive-img'>
        </span>
        <span slot='principal'>
            <span v-if='!cadastro'>
                <h2>Login</h2>

                <input type='email' placeholder='E-mail'>
                <input type='password' placeholder='Senha'>
                <button class='btn'>Entrar</button>
                <button class='btn orange' v-on:click='cadastro = !cadastro'>Cadastre-se</button>
            </span>

            <span v-if='cadastro'>
                <h2>Cadastro</h2>

                <input type='text' placeholder='Nome'>
                <input type='email' placeholder='E-mail'>
                <input type='password' placeholder='Senha'>
                <input type='password' placeholder='Confirme a senha'>
                <button class='btn'>Enviar</button>
                <button class='btn orange' v-on:click='cadastro = !cadastro'>Ja tenho conta</button>
            </span>
        </span>
    </login-template>
</template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'

export default {
    name: 'Login',
    components: {
        LoginTemplate
    },
    data () {
        return {
            cadastro:false
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
