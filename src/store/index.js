import Vue from 'vue'
import Vuex from 'vuex'
import ASScroll from '@ashthornton/asscroll'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    projetID: "0",
    asscroll: null,
    isConn: false
  },
  getters: {
    getProjetID(context)
    {
      return context.projetID;
    },
    getAsscroll(context)
    {
      return context.asscroll;
    },
    isConnected(context)
    {
      return context.isConn;
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
    },
    setConnected(state)
    {
      console.log("set connected");
      state.isConn = true;
      console.log(state.isConn);
    }
  },
  actions: {
  },
  modules: {
  }
})
