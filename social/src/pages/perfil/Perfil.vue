<template>
    <site-template>
        <span slot='menu-esquerdo'>
            <img src='https://bizcapital.com.br/blog/wp-content/uploads/2019/02/Img_Redes_Sociais_para_Neg%C3%B3cios_2-2-848x400.png' class='responsive-img'>
        </span>
        <span slot='principal'>
            <h2>Perfil</h2>

            <input type='text' placeholder='Nome' v-model='name'>
            <input type='email' placeholder='E-mail' v-model='email'>
            <div class="file-field input-field">
                <div class="btn">
                    <span>Imagem</span>
                    <input type="file">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <input type='password' placeholder='Senha' v-model='password'>
            <input type='password' placeholder='Confirme a senha' v-model='password_confirmation'>
            <button class='btn' v-on:click='perfil()'>Atualizar</button>
        </span>
    </site-template>
</template>

<script>
import SiteTemplate from '@/templates/SiteTemplate'
import axios from 'axios';

export default {
    name: 'Perfil',
    components: {
        SiteTemplate
    },
    data () {
        return {
            usuario:false,
            nome:'',
            email:'',
            password:'',
            password_confirmation:''
        }
    },
    created() {
        let usuarioAux = sessionStorage.getItem('usuario');

        if(usuarioAux) {
            this.usuario = JSON.parse(usuarioAux);
            this.name = this.usuario.name;
            this.email = this.usuario.email;
        }
    },
    methods: {
        perfil() {
            axios.put('http://localhost:8000/api/perfil', {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            }, {
                'headers':{
                    'authorization': 'Bearer '+this.usuario.token
                }
            })
            .then(response => {
                //console.log(response)

                if(response.data.token) {
                    //Cadastro realizado com sucesso
                    console.log('Cadastro realizado com sucesso');
                    console.log(response.data);
                    sessionStorage.setItem('usuario', JSON.stringify(response.data));
                    alert('Perfil atualizado');
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
