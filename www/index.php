<?php
$host = "localhost";
$db_name = "mysql";
$db_username = "root";
$db_password = "";

$conn = new mysqli($host, $db_username, $db_password, $db_name);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$conn->query("CREATE TABLE IF NOT EXISTS chats (message TEXT, attachment TEXT);");
$result = $conn->query("SELECT * FROM chats;");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Lab 4</title>
    <link rel="stylesheet" href="/static/bulma.min.css">
    <script src="https://kit.fontawesome.com/2bd72336da.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <section class="hero is-primary is-fullheight">
      <div class="hero-body">
        <div class="box">
          <?php
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $message = $row["message"];
              $attachment = $row["attachment"];
              echo '<article class="media">';
              echo '  <figure class="media-left">';
              echo '    <p class="image is-64x64">';
              echo '      <img src="https://bulma.io/images/placeholders/128x128.png">';
              echo '    </p>';
              echo '  </figure>';
              echo '  <div class="media-content">';
              echo '    <div class="content">';
              echo '      <p>';
              echo '        <strong>Admin</strong>';
              echo '        <br>';
              echo "        $message";
              echo '        <br>';
              echo '      </p>';
              echo '    </div>';
              echo '  </div>';
              echo '</article>';
            }
          }
          ?>
          <form action="/chat.php" method="POST">
            <div class="field has-addons">
              <div class="control is-expanded">
                <input name="message" class="input" type="text" placeholder="Send message">
              </div>
              <div class="control">
                <a class="button is-info">
                  Send
                  <i class="ml-2 fas fa-fw fa-paper-plane"></i>
                </a>
              </div>
            </div>
            <div class="file has-name">
              <label class="file-label">
                <input name="attachment" class="file-input" type="file" name="resume">
                  <span class="file-cta">
                    <span class="file-icon">
                      <i class="fas fa-upload"></i>
                    </span>
                    <span class="file-label">
                      Attach file
                    </span>
                  </span>
                  <span class="file-name">
                    Screen Shot 2017-07-29 at 15.54.25.png
                  </span>
                </label>
              </div>
            </div>
          </form>
          </div>
        </div>
      </div>
    </section>
    <script>
      const fileInput = document.querySelector('input[type=file]');
      fileInput.onchange = () => {
        if (fileInput.files.length > 0) {
          const fileName = document.querySelector('.file-name');
          fileName.textContent = fileInput.files[0].name;
        }
      }
    </script>
  </body>
</html>