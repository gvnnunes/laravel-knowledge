<template>
    <v-app id="inspire">
        <v-main class="bg-grey-lighten-3">
            <v-container fluid>
                <v-card>
                    <v-card-text>
                        <v-toolbar flat>
                            <v-toolbar-title>
                                <div
                                    class="d-flex align-center justify-space-between me-3"
                                >
                                    <p>Events</p>
                                    <v-chip color="red">
                                        <v-icon
                                            icon="mdi-circle"
                                            size="x-small"
                                            start
                                        ></v-icon>
                                        Offline
                                    </v-chip>
                                </div>
                            </v-toolbar-title>
                        </v-toolbar>
                        <v-text-field
                            v-model="search"
                            prepend-inner-icon="mdi-magnify"
                            label="Search"
                            single-line
                            hide-details
                            clearable
                            class="mt-3"
                        ></v-text-field>
                        <v-data-table
                            v-model:expanded="expanded"
                            item-value="id"
                            :search="search"
                            :items="events"
                            :headers="headers"
                            :loading="loading"
                            hover
                            fixed-header
                            show-expand
                        >
                            <template v-slot:item.description="{ item }">
                                <template v-if="item.description.length > 100">
                                    <v-tooltip
                                        :text="item.description"
                                        max-width="300px"
                                    >
                                        <template v-slot:activator="{ props }">
                                            <p v-bind="props">
                                                {{
                                                    item.description.slice(
                                                        0,
                                                        100
                                                    ) + "..."
                                                }}
                                            </p>
                                        </template>
                                    </v-tooltip>
                                </template>
                                <template v-else>
                                    {{ item.description }}
                                </template>
                            </template>
                            <template v-slot:item.participants_count="{ item }">
                                <v-chip>
                                    {{ item.participants_count }}/{{
                                        item.capacity
                                    }}
                                </v-chip>
                            </template>
                            <template v-slot:expanded-row="{ columns, item }">
                                <tr>
                                    <td :colspan="columns.length">
                                        <div class="d-flex flex-column"></div>
                                    </td>
                                </tr>
                            </template>
                            <template v-slot:loading>
                                <v-skeleton-loader
                                    type="table-row@10"
                                ></v-skeleton-loader>
                            </template>
                        </v-data-table>
                    </v-card-text>
                </v-card>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
export default {
    props: {
        headers: Array,
    },
    data() {
        return {
            search: "",
            expanded: [],
            loading: true,
            events: [],
        };
    },
    mounted() {
        this.getEvents();
    },
    methods: {
        async getEvents() {
            this.loading = true;
            this.events = [];

            const response = await axios.get("/api/events");

            this.events = response.data;
            this.loading = false;
        },
    },
};
</script>
