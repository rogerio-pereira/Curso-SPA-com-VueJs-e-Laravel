<template>
    <login-template>
        <span slot='menu-esquerdo'>
            <img src='https://bizcapital.com.br/blog/wp-content/uploads/2019/02/Img_Redes_Sociais_para_Neg%C3%B3cios_2-2-848x400.png' class='responsive-img'>
        </span>
        <span slot='principal'>
            <h2>Cadastro</h2>

            <input type='text' placeholder='Nome' v-model='nome'>
            <input type='email' placeholder='E-mail' v-model='email'>
            <input type='password' placeholder='Senha' v-model='password'>
            <input type='password' placeholder='Confirme a senha' v-model='password_confirmation'>
            <button class='btn' v-on:click='cadastro()'>Enviar</button>
            <router-link to="/login" class='btn orange'>Ja tenho conta</router-link>
        </span>
    </login-template>
</template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'
import axios from 'axios';

export default {
    name: 'Cadastro',
    components: {
        LoginTemplate
    },
    data () {
        return {
            nome:'',
            email:'',
            password:'',
            password_confirmation:''
        }
    },
    methods: {
        cadastro() {
            axios.post('http://localhost:8000/api/cadastro', {
                name: this.nome,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            })
            .then(response => {
                //console.log(response)

                if(response.data.token) {
                    //Cadastro realizado com sucesso
                    console.log('Cadastro realizado com sucesso')
                    sessionStorage.setItem('usuario', JSON.stringify(response.data));
                    this.$router.push('/');
                }
                else if(response.data.status == false) {
                    //lErro no cadastro
                    console.log('Erro no cadastro, tente novamente mais tarde')
                    alert('Erro no cadastro, tente novamente mais tarde')
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
