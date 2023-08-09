<?php
// Initialize an empty array to hold the data
$contacts = [];

// Check if cookies are set and contain data
if (isset($_COOKIE['contact_data'])) {
    $contacts = json_decode($_COOKIE['contact_data'], true);
}

// Create
if (isset($_POST['create'])) {
    $newContact = [
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'address' => $_POST['address']
    ];
    $contacts[] = $newContact;
    setcookie('contact_data', json_encode($contacts), time() + 3600, '/');
}

// Delete
if (isset($_GET['delete'])) {
    $contactId = $_GET['delete'];
    if (isset($contacts[$contactId])) {
        unset($contacts[$contactId]);
        setcookie('contact_data', json_encode($contacts), time() + 3600, '/');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD with Cookies - Contact Data</title>
</head>

<body>
    <h1>CRUD with Cookies - Contact Data</h1>

    <!-- Create Form -->
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="address">Address:</label>
        <textarea id="address" name="address" required></textarea>
        <button type="submit" name="create">Create Contact</button>
    </form>

    <!-- Display Contacts -->
    <h2>Contact Data:</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
        <?php foreach ($contacts as $contactId => $contactData) : ?>
            <tr>
                <td><?php echo $contactId; ?></td>
                <td><?php echo $contactData['name']; ?></td>
                <td><?php echo $contactData['email']; ?></td>
                <td><?php echo $contactData['address']; ?></td>
                <td><a href="?delete=<?php echo $contactId; ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>