import HttpCompanyRepository from "@/modules/companies/Infrastructure/HttpCompanyRepository";
import Company from "@/modules/companies/Domain/Company";
import CompanyUpdaterRequest from "@/modules/companies/Application/Update/CompanyUpdaterRequest";

export default class CompanyUpdater {
    repository: HttpCompanyRepository

    constructor() {
        this.repository = new HttpCompanyRepository();
    }

    async __invoke(request: CompanyUpdaterRequest) {
        const $Company = new Company(
            request.id,
            request.name,
            request.state,
            request.address,
            request.phone
        );
        //
        return await this.repository.update($Company);
    }
}
