async function login() {
  // Open Login Dialog
  const { value } = await Swal.fire({
    title: 'Login to Fit&Life',
    animation: false,
    confirmButtonText: 'Login',
    html:
      '<input id="username" class="swal2-input" placeholder="username" type="text">' +
      '<input id="password" class="swal2-input" placeholder="password" type="password">',
    focusConfirm: false,
    preConfirm: () => {
      // get Login input data
      const data = {
        username: document.getElementById('username').value,
        password: document.getElementById('password').value,
      };

      // validate Login information
      if (!data.username || !data.password) {
        return { ok: false, err: `Enter username and password!` };
      } else if (username.length < 3) {
        return { ok: false, err: `Enter a valid username!` };
      }
      // post login request to php api
      return $.post('login.php', data)
        .then((res) => {
          console.log(res);
          return { ok: true };
        })
        .catch((err) => {
          console.error(err);
          return { ok: false, err: err.responseText };
        });
    },
  });

  // Display error if error exists, then open login dialog again
  if (!value || !value.ok) {
    return Swal.fire({
      icon: 'error',
      animation: false,
      text: value.err,
    }).then(login);
  }

  // Show success message then reload page
  Swal.fire({
    icon: 'success',
    animation: false,
    allowOutsideClick: false,
    text: 'Logged In Successfully',
  }).then(() => location.reload());
}

function logout() {
  // delete cookies and reload page to logout
  //deleteAllCookies()
  eraseCookie("PHPSESSID"); 
  location.reload();
}

// delete session cookies
function deleteAllCookies() {
  const cookies = document.cookie.split(';');

  for (let i = 0; i < cookies.length; i++) {
    var cookie = cookies[i];
    var eqPos = cookie.indexOf('=');
    var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
    // setting cookie expire date to an old date makes it invalid.
    document.cookie = name + '=;path=/;expires=Thu, 01 Jan 1970 00:00:00 GMT';
  }
}
function eraseCookie(name) {   
    document.cookie = name+'=; Max-Age=-99999999;';  
}
