<?php

// check if this page requested by admin
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

    <div id="features">
      <div class="jumbotron">
        <br><br>
        <h3 class="heading">Features<br>
          <a class="btn btn-primary btn-sm" href="javascript:addFeature()">Add New Feature</a>
        </h3>
        <div class="table-responsive">
          <table class="table table-sm">
            <thead class="thead-light">
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Body</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Print Feature Rows -->
              <?php
              $result = $db->query("SELECT * FROM feature");
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo '<tr id="feature_' . $row["id"] . '">';
                  echo '<td>' . $row["id"] . '</td>';
                  echo '<td class="ftitle">' . $row["title"] . '</td>';
                  echo '<td class="fbody">' . $row["body"] . '</td>';

                  // Print Action Buttons for feature
                  echo '<td class="btn-group"><a class="btn btn-warning btn-sm" 
                  href="javascript:editFeature(' . $row["id"] . ')">Edit</a><a class="btn btn-danger btn-sm" 
                  href="javascript:deleteFeature(' . $row["id"] . ')">Delete</a></td>';
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
      function addFeature(id) {
        // Open add Feature Dialog
        Swal.fire({
          title: 'New Feature',
          animation: false,
          confirmButtonText: 'Add Feature',
          html: '<input id="newtitle" class="swal2-input" placeholder="Title" type="text" >' +
            '<textarea id="newbody" class="swal2-textarea" placeholder="Body"></textarea>',
          focusConfirm: false,
          preConfirm: () => {
            // get input data
            return {
              title: document.getElementById('newtitle').value,
              body: document.getElementById('newbody').value,
            };
          },
        }).then(({
          value: data
        }) => {
          // post feature to php api
          $.post('add_feature.php', data)
            .then((res) => {
              // return home page
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
        });
      }

      function editFeature(id) {
        // prefill edit dialog
        const oldData = {
          title: $(' #feature_' + id).children('.ftitle').text(),
          body: $('#feature_' + id).children('.fbody').text()
        };

        // Open edit Feature Dialog
        Swal.fire({
          title: 'Feature',
          animation: false,
          confirmButtonText: 'Edit Feature',
          html: '<input id="ntitle" class="swal2-input" placeholder="Title" type="text" value="' + oldData.title + '">' +
            '<textarea id="nbody" class="swal2-textarea" placeholder="Body">' + oldData.body + '</textarea>',
          focusConfirm: false,
          preConfirm: () => {
            // get input data
            return {
              id,
              title: document.getElementById('ntitle').value || oldData.title,
              body: document.getElementById('nbody').value || oldData.body,
            };
          },
        }).then(({
          value: data
        }) => {
          // post feature to php api
          $.post('edit_feature.php', data)
            .then((res) => {
              // return home page
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
        });
      }

      function deleteFeature(id) {
        // send delete request to php api
        $.get('delete_feature.php?id=' + id)
          .then((res) => {
            // return home page
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