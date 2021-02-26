import HttpCompanyRepository from "@/modules/companies/Infrastructure/HttpCompanyRepository";
import CompanyFinderRequest from "@/modules/companies/Application/Find/CompanyFinderRequest";

export default class CompanyFinder {
    repository: HttpCompanyRepository

    constructor() {
        this.repository = new HttpCompanyRepository();
    }

    async __invoke(request: CompanyFinderRequest) {
        return await this.repository.find(request.id);
    }
}
