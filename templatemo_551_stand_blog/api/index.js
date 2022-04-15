$(function () {
  //fetch

  //slider:
  let $owl = $(".owl-carousel").owlCarousel({
    items: 1,
    loop: true,
  });

  const options = {
    day: "numeric",
    year: "numeric",
    month: "long",
  };

  const map = new Map();

  fetch("http://localhost:81/task26/api/comments/comments_count")
    .then((res) => res.json())
    .then((data) => {
      for (const item of data) {
        map.set(item.post_id, item.count);
      }
      return fetch("http://localhost:81/task26/api/post?limit=5");
    })
    .then((res) => res.json())
    .then((data) => {
      let sliderItems = "";
      let postDetails = "";

      for (const item of data) {
        //date
        let postDate = new Date(item.createAt).toLocaleDateString(
          "en-US",
          options
        );

        /* **for slider** */
        sliderItems = `
        <div class="item">
        <img src=" http://localhost:81/task26/image/${item.path}" 
         alt="post photo">
        <div 
        class="item-content"
         >
          <div class="main-content">
            <div class="meta-category">
              <span>${item.category}</span>
            </div>
            <a href="http://localhost:81/task26/templatemo_551_stand_blog/post-details.php?postId=${
              item.id
            }">
              <h4>${item.title}</h4>
            </a>
            <ul class="post-info">
              <li><a href="#">${item.name}</a></li>
              <li><a href="#">${postDate}</a></li>
              <li><a href="#">Comments: ${
                map.get(item.id) ? map.get(item.id) : 0
              } </a></li>
            </ul>
          </div>
        </div>
      </div>
      <!--  -->
        `;

        /* **For Post Details** */
        postDetails += `
        <div class="col-lg-12">
        <div class="blog-post">
          <div class="blog-thumb">
          <img
          class="img-fluid"
          style='object-fit: cover;          '
          src=" http://localhost:81/task26/image/${item.path}" 
          alt="post photo">
          </div>
          <div class="down-content">
            <span>${item.category}</span>
            <a href="http://localhost:81/task26/templatemo_551_stand_blog/post-details.php?postId=${
              item.id
            }">
              <h4>${item.title}</h4>
            </a>
            <ul class="post-info">
              <li><a href="#">${item.name}</a></li>
              <li><a href="#">${postDate}</a></li>
              <li><a href="#">${
                map.get(item.id) ? map.get(item.id) : 0
              } Comments</a></li>
            </ul>
            <p> ${item.content.trim().substring(0, 200)}...</p>
            <div class="post-options">
              <div class="row">
                <div class="col-md-12">
                  <a href="http://localhost:81/task26/templatemo_551_stand_blog/post-details.php?postId=${
                    item.id
                  }" class="btn btn-primary">Read Full Post</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        `;

        //add item to slider
        $(".owl-carousel").owlCarousel("add", sliderItems);
      }
      //add posts details
      $("#postDetails").html(postDetails);
      window.dispatchEvent(new Event("resize"));
    });
});
