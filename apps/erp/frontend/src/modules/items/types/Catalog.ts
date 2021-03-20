interface defaultCatalog {
    id: string,
    title: string
}

export interface Catalog {
    categories: defaultCatalog[]
    states: defaultCatalog[]
}
