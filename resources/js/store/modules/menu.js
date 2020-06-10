export const state = {
  arreglo: []
}
export const getters = {
  getMenu: state=>state.arreglo
}
export const mutations = {
  setArreglo(state,payload){
    state.arreglo = payload
  }
}
export const actions = {
  async fetchMenu({commit}){
    try {
      const {data} = await axios(`/api/menu-principal/listar-menu`)
      commit('setArreglo',data)
    } catch (e) {
      console.warn('se daño ');
    }
  }
}
