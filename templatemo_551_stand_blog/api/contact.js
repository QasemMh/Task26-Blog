$(function () {
  //contact info
  fetch("http://localhost:81/task26/api/contact")
    .then((res) => res.json())
    .then((data) => {
      let contactData = `
        <li>
                      <h5>${data.phone}</h5>
                      <span>PHONE NUMBER</span>
                    </li>
                    <li>
                      <h5>${data.email}</h5>
                      <span>EMAIL ADDRESS</span>
                    </li>
                    <li>
                      <h5> ${data.location}
                      </h5>
                      <span>STREET ADDRESS</span>
                    </li>
        `;

      document.getElementById("iframe-info").src = `${data.map_url}`;
      $("#contact-info").html(contactData);
    });

  //when form submit
  // will run if create  form was submitted
  $(document).on("submit", "#contact-form", function (e) {
    e.preventDefault();
    const form = document.getElementById("contact-form");
    const formData = {};
    // Get all input elements inside a form
    // and create key:value pairs inside formData
    form.querySelectorAll("input").forEach((element) => {
      formData[element.name] = element.value;
    });
    form.querySelectorAll("textarea").forEach((element) => {
      formData[element.name] = element.value;
    });

    // Send data to backend
    fetch("http://localhost:81/task26/api/message/create", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formData),
    }).then((res) => {
      if (res.ok) {
        form.reset();
        alert("Message Sent");
      } else {
        alert("Error. try again");
      }
    });
  });
});
