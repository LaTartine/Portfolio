<template>
    <div class="projet bg-dark">
        <div style="min-height: 100vh; padding-top: 50px; padding-left: 10%; padding-right: 10%;">
            <h1 class="mx-auto text-light text-center">Messages</h1>
            <div class="pt-5 mb-5 pb-5">
                <div v-for="(message, index) in listeMessages" :key="message.id" class="d-flex flex-row text-light w-100 p-4 mt-2" style="background-color: #111111;">

                    <div class="container-fluid row text-light justify-content-between " style="width: 95%">
                        <p v-if="message.nom !== '' || message.prenom !== '' || message.mail !== ''" class="mx-0 mb-4 col-12 col-md-4 mb-md-0 font-weight-bold">{{message.nom}}</p>
                        <p v-if="message.nom !== '' || message.prenom !== '' || message.mail !== ''" class="mx-0 mb-4 col-12 col-md-4 mb-md-0 font-weight-bold">{{message.prenom}}</p>
                        <p v-if="message.nom !== '' || message.prenom !== '' || message.mail !== ''" class="mx-0 mb-4 col-12 col-md-4 mb-md-0 font-weight-bold">{{message.mail}}</p>
                        <p class="mx-0 mb-4 col-12 col-md-12 mb-md-0">{{message.date}}</p>
                        <p v-if="message.nom !== '' || message.prenom !== '' || message.mail !== ''" class="mx-0 mb-4 col-12 col-md-12 mb-md-0">{{message.message}}</p>
                        <p v-else class="mx-0 mb-4 col-12">{{message.message}}</p>
                    </div>

                    <div class=" d-flex flex-row text-light justify-content-end" style="width: 5%">
                        <div v-b-modal.modal-suppr-contact @click="updateClickedItem(message.id, index)"><i class="fas fa-trash"></i></div>
                    </div>

                </div>
                <b-modal id="modal-suppr-contact" ref="modal-suppr-contact" centered title="Supprimer le message ?">
                    <p class="my-4">Êtes vous sûr de vouloir supprimer ce message définitivement ?</p>
                    <template #modal-footer="{ ok, cancel }">
                        <!-- Emulate built in modal footer ok and cancel button actions -->
                        <b-button size="sm" variant="success" @click="deleteContact(itemId, indexListe)">
                            Yup
                        </b-button>
                        <b-button size="sm" variant="danger" @click="cancel()">
                            Non !
                        </b-button>
                    </template>
                </b-modal>
            </div>

            <h1 class="mx-auto text-light text-center">Modifier les projets</h1>
            <div class="pt-5">
                <div v-for="(Projet, index) in listeProjets" :key="Projet.projet.id" class="d-flex flex-row text-light w-100 p-4 mt-2" style="background-color: #111111;">

                    <div class="container-fluid row text-light justify-content-between w-75 align-items-center">
                        <img class="col-md-2 mb-md-0 mb-3 col-12" width="100%" :src="Projet.projet.miniature" alt="miniature">
                        <p class="mx-0 mb-md-0 mb-3 col-md-5 col-12">{{Projet.projet.nom}}</p>
                        <p class="mx-0 mb-md-0 mb-3 col-md-5 col-12">{{Projet.projet.type}}</p>
                    </div>

                    <div class="w-25 d-flex flex-row text-light justify-content-end align-items-center">

                        <div @click="$router.push({ name: 'AddModProject', params: { id:Projet.projet.id } })" style="margin-right: 15%;"><i class="fas fa-edit"></i></div>
                        <div v-b-modal.modal-suppr @click="updateClickedItem(Projet.projet.id, index)"><i class="fas fa-trash"></i></div>
                    </div>

                </div>
                <b-modal id="modal-suppr" ref="modal-suppr" centered title="Supprimer le projet ?">
                    <p class="my-4">Êtes vous sûr de vouloir supprimer ce projet définitivement ?</p>
                    <template #modal-footer="{ ok, cancel }">
                        <!-- Emulate built in modal footer ok and cancel button actions -->
                        <b-button size="sm" variant="success" @click="deleteProjet(itemId, indexListe)">
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
                listeMessages: null,
                itemId: null,
                indexListe: null,
            }
        },

        components: {},
        mounted() {
            ajaxService.axiosGetAllProjets().then(result => {
                this.listeProjets = result;
            });
            ajaxService.axiosGetAllContacts().then(result => {
                this.listeMessages = result;
            });
        },
        methods:
        {
            updateClickedItem( itemId, index)
            {
                this.itemId = itemId;
                this.indexListe = index;
            },
            deleteProjet(projetId, index)
            {
                console.log(projetId);
                ajaxService.axiosDeleteProjet(projetId).then(result => {
                    console.log(result);
                });
                this.listeProjets.splice(index, 1);
                this.$refs['modal-suppr'].hide()
            },
            deleteContact(contactId, index)
            {
                ajaxService.axiosDeleteContact(contactId).then(result => {
                    console.log(result);
                });
                this.listeMessages.splice(index, 1);
                this.$refs['modal-suppr-contact'].hide()
            }
        }
    }

</script>

<style scoped lang="scss">

    #nav {
        background-color: black;
    }

</style>