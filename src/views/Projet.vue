<template>
    <div v-if="projet" class="projet" style="background-color: #111111; padding-top: 5vh;">
        <MenuHeader/>

        <div class="p-3">

            <div style="min-height: 90vh; margin-top: 5vh;" class="container-fluid mb-4 bg-dark p-4">
                <div class="row">
                    <div class="d-flex flex-column col-12 col-md-6 px-3">
                        <div class="w-100 h-100 mb-2">
                            <div class="d-flex flex-row align-items-center mb-4"><h1 class="text-light mr-4">{{projet.projet.nom}}</h1><span class="d-inline-block text-light">{{this.dateToFrench(projet.projet.date)}}</span></div>
                            <iframe v-if="projet.projet.idVideo && projet.projet.idVideo != 'null'" class="mx-auto" style="" width="100%" height="480"
                                    :src=calculateYoutubelink(projet.projet.idVideo) frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                        </div>
                        <div v-if="projet.ImagesCarousel && projet.ImagesCarousel.length !== 0">
                            <b-carousel
                                    id="carousel-1"
                                    v-model="slideNb"
                                    :interval="4000"
                                    controls
                                    indicators
                                    background="#ababab"
                                    img-width="1024"
                                    img-height="480"
                                    style="text-shadow: 1px 1px 2px #333;"
                            >
                                <!-- Slides with custom text -->
                                <b-carousel-slide v-for="image in projet.ImagesCarousel" :key="image.id" :img-src="image.image">
                                    <b-button variant="outline-light" @click="openLink(image.image)">Afficher en grand</b-button>
                                </b-carousel-slide>

                            </b-carousel>
                        </div>
                        <div class="text-light">

                        </div>
                    </div>
                    <div class="col-12 col-md-6 px-3 mt-5 text-light">
                        <h2>Description</h2>
                        <p>{{projet.projet.description}}</p>
                        <h2>Contexte</h2>
                        <p>{{projet.projet.contexte}}</p>
                        <h2>Collaboration</h2>
                        <p>{{projet.projet.collaboration}}</p>
                        <b-button v-if="projet.projet.url && projet.projet.url !== 'null'" @click="openLink(projet.projet.url)">Voir le site</b-button>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div v-else>
        <div class="d-flex justify-content-center align-items-center text-center flex-column" style="height: 100vh">
            <span class="mb-3">Ohoh... Contenu non trouvé ! Merci de contacter l'administrateur du site.</span>
            <b-button @click="$router.push('/')" class="mb-3">Revenir à l'accueil</b-button>
            <b-button @click="$router.push('Contact')" class="mb-3">Contacter l'administrateur</b-button>
        </div>
    </div>
</template>

<script>
    import ajaxService from "../services/ajaxService.js";
    import MenuHeader from "../components/MenuHeader";

    export default {
        name: 'Projet',
        components: {MenuHeader},

        data() {
            return {
             projet :  null,
             slideNb : 0,
            }
        },

        mounted() {
            ajaxService.axiosGetProjet(this.$store.getters.getProjetID).then(result => {
                this.projet = result;
                console.log(result);
            });

            /*ajaxService.axiosGetProjetsOfType("Animation").then(result => {
                console.log(result);
                this.hello = result;
            });*/
        },
        methods:
            {
                openLink( link )
                {
                    window.open(link)
                },
                calculateYoutubelink(id)
                {
                    return "https://www.youtube.com/embed/"+id;
                },
                dateToFrench(date)
                {
                    return date.split(' ')[0].split('-').reverse().join('/');
                }
            }
    }

</script>

<style scoped lang="scss">

    #nav {
        background-color: black;
    }

</style>