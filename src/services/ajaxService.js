import axios from 'axios'
import param from '../param/param.js'

export default {

    axiosGetProjet(idProj)
    {
        const params = {id: idProj};
        var form_data = new FormData();
        for ( var key in params ) {
            form_data.append(key, params[key]);
        }

        return axios.post(param["getProjet"], form_data ).then(reponse => {return reponse.data} );
    },

    axiosGetProjetsOfType(type)
    {
        const params = {type: type};
        var form_data = new FormData();
        for ( var key in params ) {
            form_data.append(key, params[key]);
        }

        return axios.post(param["getAllProjetOfType"], form_data ).then(reponse => {return reponse.data} );
    },

    axiosGetAllProjets()
    {
        return axios.post(param["getAllProjets"] ).then(reponse => {return reponse.data} );
    },

    axiosGetImageCarouselFromProjet(id)
    {
        const params = {id: id};
        var form_data = new FormData();
        for ( var key in params ) {
            form_data.append(key, params[key]);
        }
        return axios.post(param["getImageCarouselFromProjet"], form_data ).then(reponse => {return reponse.data} );
    },

    axiosCreateProjet( id, nom, date, miniature, imagesCarousel, description, contexte, collaboration, idVideo, url, type )
    {
        const params = {
            id: id,
            nom: nom,
            date: date,
            miniature: miniature,
            /*imagesCarousel: imagesCarousel,*/
            description: description,
            contexte: contexte,
            collaboration: collaboration,
            idVideo: idVideo,
            url: url,
            type: type,
        };
        var form_data = new FormData();
        for ( let key in params ) {
            form_data.append(key, params[key]);
        }
        for ( let key in imagesCarousel ) {
            form_data.append("imagesCarousel[]", imagesCarousel[key]);
        }


        return axios.post(param["createProjet"], form_data, {headers: {
                'Content-Type': 'multipart/form-data'
            }} ).then(reponse => {
            //console.log(reponse);
            return reponse
        } );
    },

    axiosUpdateProjet( id, nom, date, miniature, imagesCarousel, description, contexte, collaboration, idVideo, url, type, updateMiniature )
    {
        const params = {
            id: id,
            nom: nom,
            date: date,
            miniature: miniature,
            /*imagesCarousel: imagesCarousel,*/
            description: description,
            contexte: contexte,
            collaboration: collaboration,
            idVideo: idVideo,
            url: url,
            type: type,
            updateMiniature: updateMiniature
        };

        var form_data = new FormData();
        for ( let key in params ) {
            form_data.append(key, params[key]);
        }
        for ( let key in imagesCarousel ) {
            form_data.append("imagesCarousel[]", imagesCarousel[key]);
        }

        console.log("UPDATE");

        return axios.post(param["updateProjet"], form_data, {headers: {
                'Content-Type': 'multipart/form-data'
            }} ).then(reponse => {
            //console.log(reponse);
            return reponse
        } );
    },

    axiosSupprCarouselImages( array )
    {
        var form_data = new FormData();
        for ( let key in array ) {
            form_data.append("imagesCarousel[]", array[key]);
        }
        return axios.post(param["supprCarouselImages"], form_data ).then(reponse => {
            //console.log(reponse);
            return reponse
        } );
    },

    axiosDeleteProjet(id)
    {
        const params = {
            id: id,
        };
        var form_data = new FormData();
        for ( let key in params ) {
            form_data.append(key, params[key]);
        }

        return axios.post(param["deleteProjet"], form_data ).then(reponse => {
            return reponse.data
        } );
    },

    axiosCreateContact(nom, prenom, mail, message, date)
    {
        const params = {
            nom: nom,
            prenom: prenom,
            mail: mail,
            message: message,
            date: date,
        };
        var form_data = new FormData();
        for ( let key in params ) {
            form_data.append(key, params[key]);
        }

        return axios.post(param["createContact"], form_data ).then(reponse => {
            return reponse.data
        } );
    },

    axiosGetAllContacts()
    {
        const params = {
            key: "getAllContacttcAtnocllateg_-?!.",
        };
        var form_data = new FormData();
        for ( let key in params ) {
            form_data.append(key, params[key]);
        }

        return axios.post(param["getAllContacts"], form_data ).then(reponse => {
            return reponse.data
        } );
    },

    axiosTryConnexion( username, password)
    {
        const params = {
            username: username,
            password: password
        };
        var form_data = new FormData();
        for ( let key in params ) {
            form_data.append(key, params[key]);
        }

        return axios.post(param["connect"], form_data ).then(reponse => {
            return reponse.data
        } );
    },

    axiosDeleteContact( id )
    {
        const params = {
            id: id,
        };
        var form_data = new FormData();
        for ( let key in params ) {
            form_data.append(key, params[key]);
        }

        return axios.post(param["supprContact"], form_data ).then(reponse => {
            return reponse.data
        } );
    },

}
