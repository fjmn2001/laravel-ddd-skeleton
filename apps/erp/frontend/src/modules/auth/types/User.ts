type Company = {
    id: string,
    logo: string,
    name: string
}

export interface User {
    id: number,
    email: string,
    name: string,
    company: Company,
    companies: Company[]
}
