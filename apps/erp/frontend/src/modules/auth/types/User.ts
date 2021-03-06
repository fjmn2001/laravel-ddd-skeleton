import {Company} from "@/modules/auth/types/Company";

export interface User {
    id: number,
    email: string,
    name: string,
    company: Company,
    companies: Company[]
}
