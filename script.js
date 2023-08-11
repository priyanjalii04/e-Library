document
  .getElementById("loginform")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    var formdata = new FormData(event.target);

    fetch("services.php", {
      method: "POST",
      body: formdata,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then(server=>{
        if(server.response === 'email'){
          document.getElementById('emailHelp').textContent = 'Email does not match'
        }else if(server.response === 'pass'){
          document.getElementById('passwordHelp').textContent = 'Password does not match'
        }else if(server.response === 'success'){
          window.location.reload();
        }
      })
      .catch((error) => {
        console.error("Fetch error:", error);
      });
  });

  document.getElementById('inputEmail').addEventListener('input',function(){
    document.getElementById('emailHelp').textContent = '';
  })
  document.getElementById('inputPassword').addEventListener('input',function(){
    document.getElementById('passwordHelp').textContent = '';
  })
