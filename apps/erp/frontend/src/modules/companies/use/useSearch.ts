import {ref, Ref} from "vue";

export default function useSearch() {
    const searchQuery: Ref<string> = ref("");

    function setSearchQuery(search: string) {
        searchQuery.value = search;
    }

    return {
        setSearchQuery
    }
}
