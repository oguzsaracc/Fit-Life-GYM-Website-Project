<?php
// init session data
session_start();

// reject if user is not admin
if ($_SESSION['userType'] != 'admin') {
  die('no');
}
?>
<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fit&amp;Life</title>
  <link href="https://fonts.googleapis.com/css?family=Bebas+Neue|Montserrat:500|Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
</head>

<!-- Header -->
<?php include("header.php") ?>

<body data-spy="scroll" data-target="#menu">

  <!-- Home Section -->
  <div id="home">

    <div id="testimonial">
      <div class="jumbotron">
        <br><br>
        <h3 class="heading">Memberships<br>
          <a class="btn btn-primary btn-sm" href="javascript:addMembership()">Add New Membership</a>
        </h3>
        <div class="table-responsive">
          <table class="table table-sm center">
            <thead class="thead-light">
              <tr>
                <th>#</th>
                <th>Membership Name</th>
                <th>Sub Type</th>
                <th>Price</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Print membership types -->
              <?php
              $result = $db->query("SELECT * FROM membership_type");
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo '<tr id="membership_' . $row["id"] . '">';
                  echo '<td>' . $row["id"] . '</td>';
                  echo '<td class="fname">' . $row["name"] . '</td>';
                  echo '<td class="fsubtype">' . $row["sub_type"] . '</td>';
                  echo '<td class="fprice">' . $row["price"] . '</td>';
                  echo '<td class="btn-group"><a class="btn btn-warning btn-sm" 
                  href="javascript:editMembership(' . $row["id"] . ')">Edit</a><a class="btn btn-danger btn-sm" 
                  href="javascript:deleteMembership(' . $row["id"] . ')">Delete</a></td>';
                  echo '</tr>';
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <?php include("footer.html") ?>
    <script>
      function addMembership() {
        // Open new membership type dialog
        Swal.fire({
          title: 'New Membership',
          animation: false,
          confirmButtonText: 'Add Membership',
          html: '<input id="newname" class="swal2-input" placeholder="Name" type="text" >' +
            '<input id="newsubtype" class="swal2-input" placeholder="Sub Type" type="text" >' +
            '<input id="newprice" class="swal2-input" placeholder="Price" type="text" >',
          focusConfirm: false,
          preConfirm: () => {
            // get input data
            return {
              name: document.getElementById('newname').value,
              sub_type: document.getElementById('newsubtype').value,
              price: document.getElementById('newprice').value,
            };
          },
        }).then(({
          value: data
        }) => {
          // post membership to php api
          $.post('add_membership.php', data)
            .then((res) => {
              // reload page
              return location.href = '/';
            })
            .catch((err) => {
              // Display error if error exists, then reload page
              Swal.fire({
                icon: 'error',
                animation: false,
                text: err.responseText,
              }).then(() => location.href = '/registration_edit.php');
            });
        });
      }

      function editMembership(id) {
        //pre-fill membership data
        const oldData = {
          name: $(' #membership_' + id).children('.fname').text(),
          sub_type: $('#membership_' + id).children('.fsubtype').text(),
          price: $('#membership_' + id).children('.fprice').text()
        };
        // open edit membership dialog
        Swal.fire({
          title: 'Membership',
          animation: false,
          confirmButtonText: 'Edit Membership',
          html: '<input id="newname" class="swal2-input" placeholder="Name" type="text"  value="' + oldData.name + '">' +
            '<input id="newsubtype" class="swal2-input" placeholder="Sub Type" type="text"  value="' + oldData.sub_type + '">' +
            '<input id="newprice" class="swal2-input" placeholder="Price" type="text"  value="' + oldData.price + '">',
          focusConfirm: false,
          preConfirm: () => {
            // get input data
            return {
              id,
              name: document.getElementById('newname').value,
              sub_type: document.getElementById('newsubtype').value,
              price: document.getElementById('newprice').value,
            };
          },
        }).then(({
          value: data
        }) => {
          // post membership to php api
          $.post('edit_membership.php', data).then((res) => {
              return location.href = '/';
            })
            .catch((err) => {
              console.error(err);
              Swal.fire({
                icon: 'error',
                animation: false,
                text: err.responseText,
              }).then(() => location.href = '/index_edit.php');
            });
        });
      }

      function deleteMembership(id) {
        console.log(id);
        $.get('delete_membership.php?id=' + id)
          .then((res) => {
            // reload page
            return location.href = '/';
          })
          .catch((err) => {
            // Display error if error exists, then reload page
            Swal.fire({
              icon: 'error',
              animation: false,
              text: err.responseText,
            }).then(() => location.href = '/index_edit.php');
          });
      }
    </script>
</body>

</html>