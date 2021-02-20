import * as types from './mutation-types'
import CompanySearcher from "@/modules/companies/Application/Searcher/CompanySearcher";
import CompanySearcherRequest from "@/modules/companies/Application/Searcher/CompanySearcherRequest";

interface VuexContext {
    commit(type: string, value): void;
    state: VuexState;
}

interface VuexState {
    loading: boolean;
    list: [];
    filters: [];
}

export default function () {
    return {
        namespaced: true,
        state: {
            loading: false,
            list: [],
            filters: [],
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
            },
            [types.CHANGE_LIST](state: VuexState, value: []) {
                state.list = value;
            },
            [types.CHANGE_FILTERS](state: VuexState, value: []) {
                state.filters = value;
            }
        },
        actions: {
            changeLoading(context: VuexContext, value: boolean) {
                context.commit(types.CHANGE_LOADING, value);
            },
            changeFilters(context: VuexContext, value: []) {
                context.commit(types.CHANGE_FILTERS, value);
            },
            async companySearcher(context: VuexContext) {
                context.commit(types.CHANGE_LOADING, true);
                const searcher = new CompanySearcher();
                const response = await searcher.__invoke(
                    new CompanySearcherRequest(context.state.filters, 'created_at', 'desc', 10, 0)
                )
                context.commit(types.CHANGE_LIST, response.data);
                context.commit(types.CHANGE_LOADING, false);
            }
        }
    };
}
