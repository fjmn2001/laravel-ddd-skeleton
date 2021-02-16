import * as types from './mutation-types'

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
            [types.CHANGE_LOADING](state, value: boolean) {
                state.companies.loading = value;
            }
        },
        actions: {
            changeLoading(context, value: boolean) {
                context.commit(types.CHANGE_LOADING, value);
            }
        }
    };
}
