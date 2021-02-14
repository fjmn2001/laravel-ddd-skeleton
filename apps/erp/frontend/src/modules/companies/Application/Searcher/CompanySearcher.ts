import CompanySearcherRequest from "@/modules/companies/Application/Searcher/CompanySearcherRequest";
import HttpCompanyRepository from "@/modules/companies/Infrastructure/HttpCompanyRepository";

export default class CompanySearcher {
    repository: HttpCompanyRepository

    constructor() {
        this.repository = new HttpCompanyRepository();
    }

    async __invoke(request: CompanySearcherRequest) {
        console.log(request);
        return await this.repository.matching();
    }
}
