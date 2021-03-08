<template>
    <div class="pt-5 bg-dark" style="min-height: 100vh">
        <h1 class="mx-auto text-light text-center" >Contact</h1>
        <div class="list px-5 mt-5">
            <b-container fluid class="pr-5 pl-5 pt-5 pb-2 bg-secondary">
                <b-row class="my-1">
                    <b-col sm="3">
                        <label class="text-light">Nom :</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-input :state="this.formulaire.nom.length <= 200" v-model="formulaire.nom" type="text" placeholder="Laisser vide pour rester anonyme"></b-form-input>
                    </b-col>
                </b-row>
                <b-row class="my-1">
                    <b-col sm="3">
                        <label class="text-light">Prenom :</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-input :state="this.formulaire.prenom.length <= 200" v-model="formulaire.prenom" type="text" placeholder="Laisser vide pour rester anonyme"></b-form-input>
                    </b-col>
                </b-row>
                <b-row class="my-1">
                    <b-col sm="3">
                        <label class="text-light">Mail :</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-input :state="this.formulaire.mail.length <= 200 && this.isMail(this.formulaire.mail) || this.formulaire.mail == ''" v-model="formulaire.mail" type="text" placeholder="Laisser vide pour rester anonyme"></b-form-input>
                    </b-col>
                </b-row>
                <b-row class="my-1">
                    <b-col sm="3">
                        <label class="text-light">Message ({{sizeLeft(formulaire.message, 10000)}}):</label>
                    </b-col>
                    <b-col sm="9">
                        <b-form-textarea v-model="formulaire.message" :state="this.formulaire.message != null && this.formulaire.message != '' && this.formulaire.message.length <= 10000" placeholder="Votre message"></b-form-textarea>
                    </b-col>
                </b-row>


            </b-container>
        </div>

        <b-modal id="sent" centered title="Envoyé !">
            <p class="my-4">Un pigeon est parti pour porter votre message !</p>
        </b-modal>
        <b-modal id="echec" centered title="Echec">
            <p class="my-4">Merci de veiller à remplir le formulaire correctement. Pensez à vérifiez la longueur de votre message.</p>
        </b-modal>
        <b-modal id="mailNotvalid" centered title="Echec">
            <p class="my-4">Le format de votre adresse mail n'est pas valide. Merci de vérifier celui-ci, ou de laisser la case vide.</p>
        </b-modal>

        <b-button class="mt-2 d-block ml-auto mr-5" v-on:click="sendData()">Envoyer</b-button>

    </div>
</template>

<script>
    import ajaxService from "../services/ajaxService.js";

    export default {
        name: "Contact",

        data()
        {
            return{
                formulaire: {
                    nom: "",
                    prenom: "",
                    mail: "",
                    message: null,
                },
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
            isMail(str)
            {
                const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(str).toLowerCase());
            },
            sendData()
            {
                if(
                    this.formulaire.nom.length < 200 &&
                    this.formulaire.prenom.length < 200 &&
                    this.formulaire.mail.length < 200 &&
                    this.formulaire.message.length > 0 &&
                    this.formulaire.message.length < 10000
                )
                {
                    if( this.formulaire.mail.length > 0 )
                    {
                        if(this.isMail(this.formulaire.mail))
                        {
                            ajaxService.axiosCreateContact(this.formulaire.nom, this.formulaire.prenom, this.formulaire.mail, this.formulaire.message).then(result => {
                                console.log(result);
                                this.$bvModal.show("sent");
                            });
                        }
                        else
                        {
                            this.$bvModal.show("mailNotvalid");
                        }
                    }
                    else
                    {
                        ajaxService.axiosCreateContact(this.formulaire.nom, this.formulaire.prenom, this.formulaire.mail, this.formulaire.message, this.today()).then(result => {
                            console.log(result);
                            this.$bvModal.show("sent");
                        });
                    }

                }
                else{
                    this.$bvModal.show("echec");
                }
            },
            today()
            {
                var now = new Date();
                var todayUTC = now.toLocaleString(); // "9/29/2020, 2:42:07 PM"
                return todayUTC;
            }
        }
    }
</script>

<style scoped>

</style>