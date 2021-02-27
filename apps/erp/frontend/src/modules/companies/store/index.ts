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


    };
}
