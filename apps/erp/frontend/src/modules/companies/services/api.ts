import {Company} from "@/modules/companies/types/Company";

export const api = {
    getCompanies(): Promise<Company[]> {
        return new Promise(resolve => {
            resolve([]);
        });
    },
};
