<template>
    <login-template>
        <span slot='menu-esquerdo'>
            <img src='https://bizcapital.com.br/blog/wp-content/uploads/2019/02/Img_Redes_Sociais_para_Neg%C3%B3cios_2-2-848x400.png' class='responsive-img'>
        </span>
        <span slot='principal'>
            <h2>Login</h2>

            <input type='email' name='email' v-model='email'>
            <input type='password' name='password' v-model='password'>
            <button class='btn' v-on:click='login'>Entrar</button>
            <router-link to="/cadastro" class='btn orange'>Cadastre-se</router-link>
        </span>
    </login-template>
</template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'
import axios from 'axios';

export default {
    name: 'Login',
    components: {
        LoginTemplate
    },
    data () {
        return {
            email:'',
            password:''
        }
    },
    methods: {
        login() {
            axios.post('http://localhost:8000/api/login', {
                email: this.email,
                password: this.password
            })
            .then(response => {
                //console.log(response)

                if(response.data.token) {
                    //login com sucesso
                    console.log('login com sucesso')
                    sessionStorage.setItem('usuario', JSON.stringify(response.data));
                }
                else if(response.data.status == false) {
                    //login não existe
                    console.log('login não existe')
                    alert('Login inválido')
                }
                else {
                    //Erros de validação
                    console.log('Erros de validação')
                    let errors = '';

                    for(let error of Object.values(response.data)) {
                        errors += error + " ";
                    }

                    alert(errors)
                }
            })
            .catch(e => {
                console.log(e)
                alert('Erro! Tente novamente mais tarde')
            })
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
