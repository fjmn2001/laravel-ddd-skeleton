import HttpRepository from "@/modules/shared/Infrastructure/HttpRepository";
import Company from "@/modules/companies/Domain/Company";

export default class HttpCompanyRepository extends HttpRepository {
    save(company: Company) {
        return new Promise((resolve, reject) => {
            super.post(process.env.VUE_APP_ERP_URL + '/api/company', {
                name: company.name,
                state: company.state,
                address: company.address,
                phone: company.phone,
            })
                .then(response => resolve(response))
                .catch(e => reject(e));
        });
    }
}
