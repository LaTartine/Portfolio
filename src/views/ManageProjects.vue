<template>
    <div class="projet bg-dark">
        <div style="min-height: 100vh; padding-top: 50px; padding-left: 10%; padding-right: 10%;">
            <h1 class="mx-auto text-light text-center">Modifier les projets</h1>
            <div class="pt-5">
                <div v-for="(Projet, index) in listeProjets" :key="Projet.projet.id" class="d-flex flex-row text-light w-100 p-4 mt-2" style="background-color: #111111;">

                    <div class="container-fluid row text-light justify-content-between w-75 align-items-center">
                        <img class="col-2" width="100%" :src="Projet.projet.miniature" alt="miniature">
                        <p class="m-0 col-5">{{Projet.projet.nom}}</p>
                        <p class="m-0 col-5">{{Projet.projet.type}}</p>
                    </div>

                    <div class="w-25 d-flex flex-row text-light justify-content-end align-items-center">

                        <div @click="$router.push({ name: 'AddModProject', params: { id:Projet.projet.id } })" style="margin-right: 15%;"><i class="fas fa-edit"></i></div>
                        <div v-b-modal.modal-suppr @click="updateClickedProject(Projet.projet.id, index)"><i class="fas fa-trash"></i></div>
                    </div>

                </div>
                <b-modal id="modal-suppr" centered title="Supprimer le projet ?">
                    <p class="my-4">Êtes vous sûr de vouloir supprimer ce projet définitivement ?</p>
                    <template #modal-footer="{ ok, cancel }">
                        <!-- Emulate built in modal footer ok and cancel button actions -->
                        <b-button size="sm" variant="success" @click="deleteProjet(projetId, indexListe)">
                            Yup
                        </b-button>
                        <b-button size="sm" variant="danger" @click="cancel()">
                            Non !
                        </b-button>
                    </template>
                </b-modal>

                <div class="w-100 mt-3 ManageProjects.vue">
                    <div  @click="$router.push({ name: 'AddModProject', params: { id:'new' } })" class="text-light d-flex justify-content-center align-items-center mx-auto" style="border-radius: 50px; width: 50px; height: 50px; background-color: #111111;">
                        <span class="mt-1" style="font-size: 2.5rem">+</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ajaxService from "../services/ajaxService.js";

    export default {
        name: 'ManageProjects',

        data() {
            return {
                listeProjets :  null,
                projetId: null,
                indexListe: null,
            }
        },

        components: {},
        mounted() {
            ajaxService.axiosGetAllProjets().then(result => {
                console.log(result);
                this.listeProjets = result;
            });
        },
        methods:
        {
            updateClickedProject( projetId, index)
            {
                this.projetId = projetId;
                this.indexListe = index;
            },
            deleteProjet(projetId, index)
            {
                console.log(projetId);
                ajaxService.axiosDeleteProjet(projetId).then(result => {
                    console.log(result);
                });
                this.listeProjets.splice(index, 1);
            }
        }
    }

</script>

<style scoped lang="scss">

    #nav {
        background-color: black;
    }

</style>