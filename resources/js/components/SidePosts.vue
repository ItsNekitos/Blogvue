<template>
    <section id="sidebar">
        <!-- Intro -->
        <section id="intro">
            <a href="#" class="logo"><img src="images/logo.jpg" alt="" /></a>
            <header>
                <h2>Blog</h2>
                <p>Be popular with us</p>
            </header>
        </section>

        <!-- Mini Posts -->
        <section>
            <h3>Popular posts</h3>
            <div class="mini-posts">
                <!-- Mini Post -->
                <article class="mini-post">
                    <header>
                        <h3><a href="#">{{ post.name }}</a></h3>
                        <time class="published" datetime="2015-10-20">{{ post.created_at.split("T")[0] }}, {{ post.created_at.split(".")[0].split("T")[1] }}</time>
                        <a href="#" class="author"><img :src="PUBLIC + post.user.avatar" alt="" /></a>
                    </header>
                    <a href="#" class="image"><img :src="PUBLIC + post.photo" alt=""/></a>
                </article>
            </div>
        </section>

        <!-- Posts List -->
        <section>
            <h3>Rating bloggers</h3>

            <ul class="posts">
                <li>
                    <article>
                        <header>
                            <h3><a href="#">Lorem ipsum fermentum ut nisl vitae</a></h3>
                            <span class="published">30 likes in 10 posts</span>
                        </header>
                        <a href="#" class="image"><img src="images/pic08.jpg" alt="" /></a>
                    </article>
                </li>
                <li>
                    <article>
                        <header>
                            <h3><a href="#">Convallis maximus nisl mattis nunc id lorem</a></h3>
                            <span class="published">30 likes in 10 posts</span>
                        </header>
                        <a href="#" class="image"><img src="images/pic09.jpg" alt="" /></a>
                    </article>
                </li>
                <li>
                    <article>
                        <header>
                            <h3><a href="#">Euismod amet placerat vivamus porttitor</a></h3>
                            <span class="published">20 likes in 5 posts</span>
                        </header>
                        <a href="#" class="image"><img src="images/pic10.jpg" alt="" /></a>
                    </article>
                </li>
                <li>
                    <article>
                        <header>
                            <h3><a href="#">Magna enim accumsan tortor cursus ultricies</a></h3>
                            <span class="published">10 likes in 15 posts</span>
                        </header>
                        <a href="#" class="image"><img src="images/pic11.jpg" alt="" /></a>
                    </article>
                </li>
                <li>
                    <article>
                        <header>
                            <h3><a href="#">Congue ullam corper lorem ipsum dolor</a></h3>
                            <span class="published">1 likes in 1 post</span>
                        </header>
                        <a href="#" class="image"><img src="images/pic12.jpg" alt="" /></a>
                    </article>
                </li>
            </ul>
        </section>
    </section>
</template>

<script>
export default {
    name: 'SidebarPosts',
    props: ['post', 'PUBLIC'],
};
</script>
