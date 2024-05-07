<template>
    <v-app id="inspire">
        <v-app-bar color="cyan-darken-3" :elevation="2" density="compact">
            <v-container>
                <v-responsive max-width="400">
                    <v-text-field
                        density="compact"
                        label="Search"
                        variant="outlined"
                        append-inner-icon="mdi-magnify"
                        hide-details
                        single-line
                        flat
                        clearable
                    ></v-text-field>
                </v-responsive>
            </v-container>

            <v-spacer></v-spacer>

            <v-toolbar-items class="d-none d-md-flex">
                <v-btn
                    v-for="link in links"
                    :text="link.text"
                    :active="link.active"
                    :to="link.route"
                    :color="link.color"
                ></v-btn>
            </v-toolbar-items>

            <div class="d-sm-flex d-md-none">
                <v-app-bar-nav-icon></v-app-bar-nav-icon>
            </div>
        </v-app-bar>

        <v-main class="bg-grey-lighten-3">
            <v-container>
                <slot />
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
export default {
    data: () => ({
        links: [],
    }),
    mounted() {
        this.links = [
            {
                text: "Events",
                active: this.$page.component.startsWith("Events"),
                route: route("events.index"),
                color: '',
            },
            {
                text: "Manage",
                active: this.$page.component.startsWith("Manage"),
                route: "#",
                color: "orange-lighten-1",
            },
        ];
    },
};
</script>
