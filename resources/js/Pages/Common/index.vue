<script setup>
import DataTable from '@/Shared/DataTable.vue';
import SearchFilter from "@/Shared/SearchFilter.vue";
import SelectList from "@/Shared/SelectList.vue";
import Alert from "@/Shared/Alert.vue";
import { computed, watch } from 'vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import throttle from "lodash/throttle";
import pickBy from "lodash/pickBy";
import { CheckIcon, PencilSquareIcon, PlusIcon, XMarkIcon } from '@heroicons/vue/24/solid'
import AddNewBtn from '@/Components/AddNewBtn.vue';

const props = defineProps({
    items: Array | Object,
    filters: Object,
    title: String,
    success: String,
});

const headers = [
    { text: "ID", value: "id" },
    { text: "Name", value: "name" },
    { text: "Status", value: "is_active" },
    { text: "", value: "actions" },
];

const form = useForm({
    search: props.filters.search || "",
    count: props.filters.count || "15",
    page: props.filters.page || 1,
});

// Throttled function
const throttledHandler = throttle(() => {
    const query = pickBy(form); // Remove empty or undefined values from form
    const queryParams = Object.keys(query).length ? query : { remember: "forget" };

    router.visit(
        window.route(`${props.title}.index`, queryParams),
        { preserveState: true }
    );
}, 150);

// Watcher for `form`
watch(form, () => { throttledHandler(); }, { deep: true });

function deleteUser(id) {
    if (confirm("Are You sure you want to delete this item ?")) {
        this.$inertia.delete(props.title + "/" + id);
    }
};


const currentPath = computed(() => {
    return window.location.pathname;
});

</script>

<template>
    <AppLayout :title="title">
        <!-- Success Messgage -->
        <Alert
            v-if="success"
            :message="success"
        />
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h1 class="my-8 font-bold text-3xl capitalize">{{ title }} List</h1>

            <div class="mb-3 flex justify-between items-center">
                <!--
                        Filters
                    -->
                <div class="flex max-w-md mr-4">
                    <!-- Select Row Count -->
                    <SelectList
                        v-model="form.count"
                        classes="rounded-l-md"
                    />

                    <!-- Search field -->
                    <SearchFilter
                        v-model="form.search"
                        @reset="form.reset()"
                    ></SearchFilter>
                </div>
                <!--
                    Create Button
                -->
                <AddNewBtn :href="currentPath + '/create'"/>
            </div>
            <!--
                Data Table
            -->
            <DataTable
                :items="items"
                :headers="headers"
                :filters="form"
            >
                <template v-slot:is_active="{ item }">
                    <td v-if="item.is_active" class="bg-green-800 rounded">
                        <CheckIcon class="w-5 h-5"/>
                    </td>
                    <td v-else class="bg-red-800 rounded">
                        <XMarkIcon class="w-5 h-5"/>
                    </td>
                </template>

                <template v-slot:actions="{ item }">
                    <td class="flex justify-end text-sm leading-5 font-medium space-x-2">
                        <!-- <a
                            :href="currentPath + '/' + item.id"
                            class="text-gray-600 hover:text-green-600"
                        >View</a> -->

                        <Link
                            class="text-gray-600 hover:text-blue-600"
                            :href="currentPath + '/' + item.id + '/edit'"
                        >
                        <PencilSquareIcon class="w-6 h-6"/>
                    </Link>

                        <!-- <delete-item :url="`sell_items/${item.id}`"></delete-item> -->
                    </td>
                </template>
            </DataTable>
        </div>
    </AppLayout>
</template>