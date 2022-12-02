<!DOCTYPE html>
<html lang="en">
<head>

    <?php
    //should probably all be moved into a separate database creation script etc
    $db = new SQLite3('test_127.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

    // Create a table.
    $db->exec(
        'CREATE TABLE IF NOT EXISTS "users" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "name" VARCHAR
  )'
    );

    // Insert some sample data.
    $db->exec('INSERT INTO "users" ("name") VALUES ("Osvaldo")');
    $db->exec('INSERT INTO "users" ("name") VALUES ("Priyanka")');
    $db->exec('INSERT INTO "users" ("name") VALUES ("Powercat")');

    $users_sql = $db->prepare('SELECT * FROM "users"');
    // could do a bindParam -> see here for more details https://www.php.net/manual/en/sqlite3.prepare.php
    $users = $users_sql->execute();
    ?>
</head>
<body>
<h1>People here:</h1>
<ul>
    <?php while ($user = $users->fetchArray(SQLITE3_ASSOC)) {
        ?>
        <li><?= $user["name"] ?></li>
        <?php
    } ?>
</ul>
</body>
</html>
<?php
// Close the connection
$db->close();