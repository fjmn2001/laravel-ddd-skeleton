import {ref, Ref} from "vue";
import {TopBarOption} from "@/types/TopBarOption";
import {api} from "@/services/api";
import {LeftBarOption} from "@/types/LeftBarOption";

const leftBarOptions: Ref<LeftBarOption[]> = ref([])

export function useMenu() {
    const topBarOptions: Ref<TopBarOption[]> = ref([])
    const topBarOptionSelected: Ref<string | null> = ref(null)

    async function getTopBarOptions() {
        topBarOptions.value = await api.getTopBarOptions();
    }

    async function getLeftBarOptions(name: string) {
        topBarOptionSelected.value = name;
        leftBarOptions.value = await api.getLeftBarOptions(name);
    }

    return {
        topBarOptions,
        leftBarOptions,
        topBarOptionSelected,
        getTopBarOptions,
        getLeftBarOptions
    }
}
