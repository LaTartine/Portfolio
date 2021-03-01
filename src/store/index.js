import Vue from 'vue'
import Vuex from 'vuex'
import ASScroll from '@ashthornton/asscroll'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    projetID: "0",
    asscroll: null,
  },
  getters: {
    getProjetID(context)
    {
      return context.projetID;
    },
    getAsscroll(context)
    {
      return context.asscroll;
    }
  },
  mutations: {
    setProjetID(state, id)
    {
      state.projetID = id;
    },
    setAsscroll(state, asscroll)
    {
      state.asscroll = asscroll;
    },
    createAsscroll(state)
    {
        console.log(state.asscroll);
        state.asscroll = new ASScroll({
            customScrollbar: true, ease: "0.25", disableOnTouch : false
        });
    }
  },
  actions: {
  },
  modules: {
  }
})
