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
            this.$http.post(this.$urlAPI+'cadastro', {
                name: this.nome,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            })
            .then(response => {
                //console.log(response)

                if(response.data.status) {
                    //Cadastro realizado com sucesso
                    console.log('Cadastro realizado com sucesso')
                    sessionStorage.setItem('usuario', JSON.stringify(response.data.usuario));
                    this.$router.push('/');
                }
                else if(response.data.status == false && response.data.validacao) {
                    //Erros de validação
                    let errors = '';

                    for(let error of Object.values(response.data.erros)) {
                        errors += error + " ";
                    }

                    alert(errors);
                }
                else {
                    //erro no cadastro
                    alert('Erro no cadastro! Tente novamente mais tarde.');
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
