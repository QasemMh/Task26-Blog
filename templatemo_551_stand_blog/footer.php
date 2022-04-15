<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="social-icons" id="social-links">

                </ul>
            </div>
            <div class="col-lg-12">
                <div class="copyright-text">
                    <p>Copyright 2020 Stand Blog Co.

                        | Design: <a rel="nofollow" href="https://templatemo.com" target="_parent">TemplateMo</a></p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>








<!-- Additional Scripts -->
<script src="assets/js/custom.js"></script>
<script src="assets/js/owl.js"></script>
<script src="assets/js/slick.js"></script>
<script src="assets/js/isotope.js"></script>
<script src="assets/js/accordions.js"></script>

<script language="text/Javascript">
    cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
    function clearField(t) { //declaring the array outside of the
        if (!cleared[t.id]) { // function makes it static and global
            cleared[t.id] = 1; // you could use true and false, but that's more typing
            t.value = ''; // with more chance of typos
            t.style.color = '#fff';
        }
    }
</script>



<!-- Index -->
<?php if (!empty(setActive("index"))) {
    echo '<script src="api/index.js"></script>';
} ?>
<!-- all post blog -->
<?php if (!empty(setActive("blog"))) {
    echo '<script src="api/allPost.js"></script>';
} ?>

<!-- contact -->
<?php if (!empty(setActive("contact"))) {
    echo '<script src="api/contact.js"></script>';
} ?>
<!-- about -->
<?php if (!empty(setActive("about"))) {
    echo '<script src="api/about.js"></script>';
} ?>


<!-- single post -->
<?php if (!empty(setActive("post"))) {
    echo '<script src="api/post.js"></script>';
} ?>


<script>
    $(function() {
        //contact info
        fetch("http://localhost:81/task26/api/home")
            .then((res) => res.json())
            .then((data) => {
                let contactData = `
                    <li><a href="${data.facebook_url}">Facebook</a></li>
                    <li><a href="${data.twitter_url}">Twitter</a></li>
                    <li><a href="${data.insta_urls}">Instagram</a></li>`;

                $("#social-links").html(contactData);
                $("#main-logo").html(data.logo_name);
                document.title = data.tap_title;

            });
    });
</script>




</body>

</html>