<template>
    <!-- Main -->
    <div id="main">
        <!-- Post -->
        <PostComponent />

        <!-- Pagination -->
        <ul class="actions pagination">
            <li><a href="" class="disabled button big previous">Previous Page</a></li>
            <li><a href="#" class="button big next">Next Page</a></li>
        </ul>
    </div>

    <!-- Sidebar -->
    <SidebarComponent />
</template>
<script>
import PostComponent from '@/components/PostComponent.vue';
import SidebarComponent from '@/components/SidebarComponent.vue';

export default {
    name: 'HomePage',
    components: {
        PostComponent,
        SidebarComponent,
    },
};
</script>
