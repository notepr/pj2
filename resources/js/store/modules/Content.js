export default {
    namespaced: true,
    state: {
        page_title: ''
    },
    mutations: {
    	page_title(state, title) {
    		state.page_title = title;
    	}
    },
    actions: {}
}
