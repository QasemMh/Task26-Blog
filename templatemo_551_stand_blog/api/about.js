$(function () {
  //contact info
  fetch("http://localhost:81/task26/api/about")
    .then((res) => res.json())
    .then((data) => {
      let contactData = `
      <img src=" http://localhost:81/task26/image/${data.path}" 
      alt="post photo">
        <p>
            ${data.content}
        </p>
      `;

      $("#about-content").html(contactData);
    });
});
