<template>
    <div class="pt-5 bg-dark">
        <h1 v-if="this.$route.params.id !== 'new'" class="mx-auto text-light text-center">Modifier un projet</h1>
        <h1 v-else class="mx-auto text-light text-center">Ajouter un projet</h1>
        <div class="list px-5 mt-5">
            <b-container fluid class="pr-5 pl-5 pt-5 pb-2" style="background-color: #111111;">
                <b-row class="my-1">
                    <b-col sm="3">
                        <label class="text-light">Nom ({{sizeLeft(formulaire.nom, 500)}}):</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-input :state="this.formulaire.nom != null && this.formulaire.nom != ''" v-model="formulaire.nom" type="text"></b-form-input>
                    </b-col>
                </b-row>

                <b-row class="my-1">
                    <b-col sm="3">
                        <label class="text-light">Date:</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-input type="date" :state="this.formulaire.date != null && this.formulaire.date != ''"
                                      v-model="formulaire.date" placeholder="1900"></b-form-input>
                    </b-col>
                </b-row>

                <b-row class="my-1">
                    <b-col sm="3">
                        <label class="text-light">Miniature ({{sizeLeft(formulaire.miniature, 200)}}):</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-file
                                :state="Boolean(formulaire.miniature)"
                                placeholder="Choisissez un fichier ou faites le glisser ici..."
                                drop-placeholder="Faire glisser..."
                                @change="onFileChange"
                        ></b-form-file>
                        <div class="w-100 bg-dark text-center"><img v-if="formulaire.miniature || projet != null" class="w-25 h-100 mx-auto" :src="miniatureUrl" alt="img film"></div>
                    </b-col>
                </b-row>


                <b-row class="my-1">
                    <b-col sm="3">
                        <label class="text-light">Images du carousel :</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-file
                                placeholder="Choisissez des fichiers ou faites les glisser ici..."
                                drop-placeholder="Faire glisser..."
                                @change="onFileChange2"
                                multiple
                        ></b-form-file>
                        <div v-if="formulaire.carousel.length != 0 || projet != null" class="w-100 bg-dark text-center;">
                            <img v-for="(url, index ) in carouselUrls" :key="index" class="w-25 h-100" :src="url" alt="img carousel">
                            <div v-for="(url, index) in carouselCurrent" :key="url" class="w-25 mx-auto d-inline-block" style="position: relative;">
                                <img  class="w-100 h-100" :src="url" alt="img carousel">
                                <div @click="supprCarouselImage(index)" class="" style="top: 10px; right: 10px; position: absolute;">
                                    <i class="fas fa-trash text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </b-col>
                </b-row>

                <b-row class="my-1">
                    <b-col sm="3">
                        <label class="text-light">Description ({{sizeLeft(formulaire.description, 20000)}}):</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-textarea v-model="formulaire.description" :state="this.formulaire.description != null && this.formulaire.description != ''"></b-form-textarea>
                    </b-col>
                </b-row>

                <b-row class="my-1">
                    <b-col sm="3">
                        <label class="text-light">Contexte ({{sizeLeft(formulaire.contexte, 10000)}}):</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-textarea v-model="formulaire.contexte" :state="this.formulaire.contexte != null && this.formulaire.contexte != ''" ></b-form-textarea>
                    </b-col>
                </b-row>

                <b-row class="my-1">
                    <b-col sm="3">
                        <label class="text-light">Collaboration ({{sizeLeft(formulaire.collaboration, 500)}}):</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-textarea v-model="formulaire.collaboration" :state="this.formulaire.collaboration != null && this.formulaire.collaboration != ''"></b-form-textarea>
                    </b-col>
                </b-row>

                <b-row class="my-1">
                    <b-col sm="3">
                        <label class="text-light">ID de la vidéo Youtube ({{sizeLeft(formulaire.message, 50)}}):</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-input v-model="formulaire.idVideo" :state="this.formulaire.idVideo != null && this.formulaire.idVideo !== ''" type="text"></b-form-input>
                    </b-col>
                </b-row>

                <b-row class="my-1">
                    <b-col sm="3">
                        <label class="text-light">URL du site ({{sizeLeft(formulaire.urlSite, 500)}}):</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-input v-model="formulaire.urlSite" :state="this.formulaire.urlSite != null && this.formulaire.urlSite !== ''" type="text"></b-form-input>
                    </b-col>
                </b-row>

                <b-row class="my-1">
                    <b-col sm="3">
                        <label class="text-light">Type de Projet ( Animation, Site, Illustration, Jeu ) </label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-select :options="optionsDropList" v-model="formulaire.type" :state="this.formulaire.type != null && this.formulaire.type != ''"></b-form-select>
                    </b-col>
                </b-row>
            </b-container>
        </div>

        <b-modal id="sent" centered title="Envoyé !">
            <p class="my-4">Requête envoyée</p>
        </b-modal>

        <b-button v-if="this.$route.params.id !== 'new'" class="mt-2 d-block ml-auto mr-5" v-on:click="UpdateData()">Mettre à jour</b-button>
        <b-button v-else class="mt-2 d-block ml-auto mr-5" v-on:click="sendData()">Envoyer</b-button>

    </div>
</template>

<script>
    import ajaxService from "../services/ajaxService.js";
    import param from "../param/param.js";

    export default {
        name: 'AddModProject',

        data() {
            return {
                projet: null,
                formulaire: {
                    nom: null,
                    date: null,
                    miniature: null,
                    carousel: [],
                    description: null,
                    contexte: null,
                    collaboration: null,
                    idVideo: null,
                    urlSite: null,
                    type: null,
                },
                optionsDropList: [
                    { value: 'Site', text: 'Site' },
                    { value: 'Animation', text: 'Animation' },
                    { value: 'Jeu', text: 'Jeu' },
                    { value: 'Illustration', text: 'Illustration' },
                ],
                miniatureUrl: null,
                carouselUrls: null,
                carouselCurrent:null,
                carouselToSuppr: [],
            }
        },

        components: {},
        mounted() {
            if(this.$route.params.id !== "new") {
                ajaxService.axiosGetProjet(this.$route.params.id).then(result => {
                    console.log(result);
                    this.projet = result;


                    if( this.projet.projet.nom && this.projet.projet.nom !== "null" ) this.formulaire.nom =  this.projet.projet.nom;
                    if( this.projet.projet.date && this.projet.projet.date !== "null" ) this.formulaire.date =  this.projet.projet.date.split(' ')[0];
                    if( this.projet.projet.miniature && this.projet.projet.miniature !== "null" ) this.formulaire.miniature = this.projet.projet.miniature;
                    let temp =  this.projet.ImagesCarousel;
                    this.carouselCurrent = Array();
                    for (let i = 0; i < temp.length; i++) {
                        const image = temp[i].image;
                        this.carouselCurrent[i] = image;
                    }
                    if( this.projet.projet.miniature && this.projet.projet.miniature !== "null" ) this.miniatureUrl = this.projet.projet.miniature;
                    if( this.projet.projet.description && this.projet.projet.description !== "null" ) this.formulaire.description = this.projet.projet.description;
                    if( this.projet.projet.contexte && this.projet.projet.contexte !== "null" ) this.formulaire.contexte = this.projet.projet.contexte;
                    if( this.projet.projet.collaboration && this.projet.projet.collaboration !== "null" ) this.formulaire.collaboration = this.projet.projet.collaboration;
                    if( this.projet.projet.idVideo && this.projet.projet.idVideo !== "null" ) this.formulaire.idVideo = this.projet.projet.idVideo;
                    if( this.projet.projet.url && this.projet.projet.url !== "null" ) this.formulaire.urlSite = this.projet.projet.url;
                    if( this.projet.projet.type && this.projet.projet.type !== "null" ) this.formulaire.type = this.projet.projet.type;
                });
                /*ajaxService.axiosGetImageCarouselFromProjet(this.$route.params.id).then(result => {
                    this.formulaire.carousel = result.data;
                });*/
            }

        },
        methods:
        {
            sizeLeft( str, totalSize)
            {
                if( str )
                {
                    return str.length+" / "+totalSize;
                }
                return 0+" / "+totalSize;
            },
            onFileChange(e) {
                const file = e.target.files[0];
                this.formulaire.miniature = file;
                this.miniatureUrl = URL.createObjectURL(file);
            },
            onFileChange2(e) {
                const files = e.target.files;
                this.carouselUrls = Array();
                this.formulaire.carousel = Array();

                for (let i = 0; i < files.length; i++) {
                    this.carouselUrls[i] = URL.createObjectURL(files[i]);
                    this.formulaire.carousel[i] = files[i];
                }
            },
            sendData()
            {
                console.log("start sending data...");
                let formType = -1;
                if( this.formulaire.type === "Animation")
                {
                    formType = 1;
                }
                else if( this.formulaire.type === "Jeu")
                {
                    formType = 2;
                }else if( this.formulaire.type === "Site")
                {
                    formType = 3;
                }else if( this.formulaire.type === "Illustration")
                {
                    formType = 4;
                }

                ajaxService.axiosCreateProjet(2,
                    this.formulaire.nom,
                    this.formulaire.date,
                    this.formulaire.miniature,
                    this.formulaire.carousel,
                    this.formulaire.description,
                    this.formulaire.contexte,
                    this.formulaire.collaboration,
                    this.formulaire.idVideo,
                    this.formulaire.urlSite,
                    formType
                ).then(result =>{console.log(result.data);});
                this.$bvModal.show("sent");
            },
            UpdateData()
            {
                console.log("start sending data...");
                let formType = -1;
                if( this.formulaire.type === "Animation")
                {
                    formType = 1;
                }
                else if( this.formulaire.type === "Jeu")
                {
                    formType = 2;
                }else if( this.formulaire.type === "Site")
                {
                    formType = 3;
                }else if( this.formulaire.type === "Illustration")
                {
                    formType = 4;
                }

                let updateMiniature  = false;

                if( typeof this.formulaire.miniature === 'string' || this.formulaire.miniature instanceof String )
                {
                    updateMiniature  = false;
                }
                else
                {
                    updateMiniature  = true;
                }

                ajaxService.axiosUpdateProjet(
                    parseInt(this.$route.params.id),
                    this.formulaire.nom,
                    this.formulaire.date,
                    this.formulaire.miniature,
                    this.formulaire.carousel,
                    this.formulaire.description,
                    this.formulaire.contexte,
                    this.formulaire.collaboration,
                    this.formulaire.idVideo,
                    this.formulaire.urlSite,
                    formType,
                    updateMiniature
                ).then(result =>{console.log(result.data);});

                ajaxService.axiosSupprCarouselImages(
                    this.carouselToSuppr
                ).then(result =>{console.log(result.data);});
                this.$bvModal.show("sent");
            },
            supprCarouselImage(index)
            {
                let toSuppr = param.host + "carousel/";
                let toSuppr2 = param.host2 + "carousel/";
                let result =  this.carouselCurrent[index].replace(toSuppr,'');
                result =  this.carouselCurrent[index].replace(toSuppr2,'');
                console.log(toSuppr2);
                console.log(result);
                this.carouselToSuppr.push(result);
                this.carouselCurrent.splice(index, 1);
            }
        }
    }

</script>

<style scoped lang="scss">

    #nav {
        background-color: black;
    }

</style>