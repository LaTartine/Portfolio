<template>
    <div class="pt-5 bg-dark" style="min-height: 100vh">
        <h1 class="mx-auto text-light text-center">Connexion</h1>
        <div class="w-75 d-flex justify-content-center flex-column mx-auto" style="height: 80vh">
            <div class="list p-5">
                <b-container fluid class="p-5" style="background-color: #111111;">
                    <b-row class="my-1">
                        <b-col sm="3">
                            <label class="text-light">Username :</label>
                        </b-col>
                        <b-col sm="9">
                            <b-form-input :state="this.formulaire.username.length <= 200" v-model="formulaire.username"
                                          type="text" placeholder=""></b-form-input>
                        </b-col>
                    </b-row>
                    <b-row class="my-1">
                        <b-col sm="3">
                            <label class="text-light">Password :</label>
                        </b-col>
                        <b-col sm="9">
                            <b-form-input :state="this.formulaire.password.length <= 200" v-model="formulaire.password"
                                          type="password" placeholder=""></b-form-input>
                        </b-col>
                    </b-row>

                </b-container>
            </div>

            <b-modal id="sent" centered title="Connecté !" @ok="redirect">
                <p class="my-4">Bienvenue !</p>
            </b-modal>
            <b-modal id="echec" centered title="Bien tenté">
                <p class="my-4">Bien tenté mais ce n'est pas ça ! ;)</p>
            </b-modal>

            <b-button class="d-block ml-auto mr-5" v-on:click="sendData()">Envoyer</b-button>
        </div>
    </div>
</template>

<script>
    import ajaxService from "../services/ajaxService.js";

    export default {
        name: "Connexion",

        data() {
            return {
                formulaire: {
                    username: "",
                    password: "",
                },
            }
        },
        methods:
            {
                sizeLeft(str, totalSize) {
                    if (str) {
                        return str.length + " / " + totalSize;
                    }
                    return 0 + " / " + totalSize;
                },
                sendData() {
                    if (
                        this.formulaire.username.length < 200 &&
                        this.formulaire.password.length < 200
                    ) {
                        ajaxService.axiosTryConnexion(this.formulaire.username, this.formulaire.password).then(result => {
                            console.log(result);
                            this.$bvModal.show("sent");
                            this.$store.commit("setConnected");
                        });
                    } else {
                        this.$bvModal.show("echec");
                    }
                },
                redirect() {
                    this.$router.push("Admin");
                }
            }
    }
</script>

<style scoped>

</style>