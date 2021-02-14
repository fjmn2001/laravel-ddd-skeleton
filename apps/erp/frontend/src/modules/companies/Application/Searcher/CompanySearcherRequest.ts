export default class CompanySearcherRequest {
    private filters: Array<object> = [];
    private orderBy: string;
    private order: string;
    private limit: number;
    private offset: number;


    constructor(filters: Array<object> = [], orderBy: string, order: string, limit: number, offset: number) {
        this.filters = filters;
        this.orderBy = orderBy;
        this.order = order;
        this.limit = limit;
        this.offset = offset;
    }
}
