import * as types from './mutation-types'

interface VuexContext {
    commit(type: string, value: boolean): void;
}

interface VuexState {
    loading: boolean;
}

export default function () {
    return {
        namespaced: true,
        state: {
            loading: false,
            list: [],
            company: {
                id: '',
                name: '',
                state: 'active',
                address: '',
                phone: ''
            }
        },
        mutations: {
            [types.CHANGE_LOADING](state: VuexState, value: boolean) {
                state.loading = value;
            }
        },
        actions: {
            changeLoading(context: VuexContext, value: boolean) {
                context.commit(types.CHANGE_LOADING, value);
            }
        }
    };
}
