<template>
    <div class='row'>
        <div class="card">
            <div class="card-content">
                <div class="row valign-wrapper">
                    <grid-vue tamanho="1">
                        <img :src="perfil" :alt="nome" class="circle responsive-img"> <!-- notice the "circle" class -->
                    </grid-vue>
                    <grid-vue tamanho="11">
                        <span>
                            <strong>{{nome}}</strong> - <small>{{data}}</small>
                        </span>
                    </grid-vue>
                </div>

                <slot></slot>
            </div>
            <div class="card-action">
                <p>
                    <a style='cursor:pointer;' @click='curtida(id)'>
                        <i class='material-icons'>{{curtiu}}</i>
                        {{totalCurtidas}}
                    </a>

                    <a style='cursor:pointer;' @click='abreComentarios'>
                        <i class='material-icons'>insert_comment</i>
                        {{comentarios.length}}
                    </a>
                </p>

                <p  v-if='exibirComentario' class='right-align'>
                    <input type='text' v-model='textoComentario' placeholder='Comentar'>
                    <button v-if='textoComentario' @click='comentar(id)' class='btn waves-effect waves-light orange'>
                        <i class='material-icons'>send</i>
                    </button>
                </p>

                <p v-if='exibirComentario'>
                    <ul class='collection'>
                        <li class="collection-item avatar" v-for='item in comentarios' :key='item.id' >
                            <img :src="item.user.imagem" alt="" class="circle">
                            <span class="title">{{item.user.name}} <small>{{item.data}}</small></span>
                            <p>
                                {{item.texto}}
                            </p>
                        </li>
                    </ul>
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import GridVue from '@/components/layouts/GridVue'

export default {
    name: 'CardConteudoVue',
    components: {
        GridVue
    },
    props:[
        'id',
        'perfil',
        'nome',
        'data',
        'comentarios',
        'totalcurtidas',
        'curtiuconteudo'
    ],
    data () {
        return {
            curtiu: this.curtiuconteudo ? 'favorite' : 'favorite_border',
            totalComentarios: this.totalcomentarios,
            totalCurtidas: this.totalcurtidas,
            exibirComentario: false,
            textoComentario: ''
        }
    },
    methods: {
        curtida(id) {
            this.$http.put(this.$urlAPI+'conteudo/curtir/'+this.id, {}, {
                'headers':{
                    'authorization': 'Bearer '+this.$store.getters.getToken
                }
            })
            .then(response => {
                //console.log(response)
                if(response.data.status) {
                    this.totalCurtidas = response.data.curtidas;
                    this.$store.commit('setConteudosLinhaTempo', response.data.lista.conteudos.data);

                    if(this.curtiu == 'favorite_border')
                        this.curtiu = 'favorite';
                    else
                        this.curtiu = 'favorite_border'; 
                }
                else {
                    alert(response.data.erro);
                }
            })
            .catch(e => {
                console.log(e)
                alert('Erro! Tente novamente mais tarde')
            });
        },
        comentar(id) {
            if(!this.textoComentario) 
                return;

            this.$http.put(this.$urlAPI+'conteudo/comentar/'+this.id, 
            {
                'texto': this.textoComentario 
            }, 
            {
                'headers':{
                    'authorization': 'Bearer '+this.$store.getters.getToken
                }
            })
            .then(response => {
                //console.log(response)
                if(response.data.status) {
                    this.textoComentario = '';
                    this.$store.commit('setConteudosLinhaTempo', response.data.lista.conteudos.data);
                }
                else if(response.data.status == false && response.data.validacao) {
                    //Erros de validação
                    let errors = '';

                    for(let error of Object.values(response.data.erros)) {
                        errors += error + " ";
                    }

                    alert(errors)
                }
            })
            .catch(e => {
                console.log(e)
                alert('Erro! Tente novamente mais tarde')
            });
        },
        abreComentarios() {
            this.exibirComentario = !this.exibirComentario;
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
