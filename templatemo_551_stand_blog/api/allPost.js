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

  //get comment
  fetch("http://localhost:81/task26/api/comments/comments_count")
    .then((res) => res.json())
    .then((data) => {
      for (const item of data) {
        map.set(item.post_id, item.count);
      }
      //get posts
      return fetch("http://localhost:81/task26/api/post?limit=100");
    })
    .then((res) => res.json())
    .then((data) => {
      let sliderItems = "";
      let postDetails = "";
      let recentPost = "";
      let i = 1;

      for (const item of data) {
        //date
        let postDate = new Date(item.createAt).toLocaleDateString(
          "en-US",
          options
        );

        /* ** recent post ** */
        if (i < 4) {
          recentPost += `
        <li>
                  <a href="http://localhost:81/task26/templatemo_551_stand_blog/post-details.php?postId=${item.id}">
                        <h5>
                           ${item.title}
                        </h5>
                        <span>${postDate}</span>
                      </a>
         </li>
        `;
          i++;
        }

        /* **For Post Details** */
        postDetails += `
        <div class="col-lg-6">
        <div class="blog-post">
          <div class="blog-thumb">
          <img src=" http://localhost:81/task26/image/${item.path}" 
          alt="post photo">
          </div>
          <div class="down-content">
            <span> ${item.category}</span>
            <a href="http://localhost:81/task26/templatemo_551_stand_blog/post-details.php?postId=${
              item.id
            }">
              <h4> ${item.title}</h4>
            </a>
            <ul class="post-info">
              <li><a href="#">${item.name}</a></li>
              <li><a href="#">${postDate}</a></li>
              <li><a href="#">${
                map.get(item.id) ? map.get(item.id) : 0
              } Comments</a></li>
            </ul>
            <p>
               ${item.content.trim().substring(0, 60)}...
            </p>
            <div class="post-options">
              <div class="row">
                <div class="col-lg-12">
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
      }
      //add posts details and recent post
      $("#posts-data").html(postDetails);
      $("#recent-post").html(recentPost);
    });

  //category-list:
  fetch("http://localhost:81/task26/api/category")
    .then((res) => res.json())
    .then((data) => {
      let categories = "";
      for (const item of data) {
        categories += `<li><a href="#">- ${item.name}</a></li>`;
      }

      $("#category-list").html(categories);
    });
});
