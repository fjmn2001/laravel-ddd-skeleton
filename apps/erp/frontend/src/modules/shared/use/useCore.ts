const ERP_URL = process.env.VUE_APP_ERP_URL;

export function useCore() {
    return {
        ERP_URL
    };
}
